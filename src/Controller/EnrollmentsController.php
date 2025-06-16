<?php
declare(strict_types=1);

namespace App\Controller;
use App\Model\Table\EnrollmentsTable;
use Cake\ORM\TableRegistry;
use Cake\Http\Exception\BadRequestException;

/**
 * Enrollments Controller
 *
 * @property \App\Model\Table\EnrollmentsTable $Enrollments
 */
class EnrollmentsController extends AppController
{
    private $Enrollments;

    public function initialize(): void
    {
        parent::initialize();
        $this->Enrollments = TableRegistry::getTableLocator()->get('Enrollments');
    }
    public function index()
    {
        $query = $this->Enrollments->find()
            ->contain(['Users', 'Courses']);
        $enrollments = $this->paginate($query);

        $this->set(compact('enrollments'));
    }

    /**
     * View method
     *
     * @param string|null $id Enrollment id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $enrollment = $this->Enrollments->get($id, contain: ['Users', 'Courses']);
        $this->set(compact('enrollment'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add($courseId = null)
{
    $this->request->allowMethod(['post']);
    $userId = $this->request->getAttribute('identity')->getIdentifier();

    $enrollment = $this->Enrollments->newEmptyEntity();
    $enrollment->user_id = $userId;
    $enrollment->course_id = $courseId;

    if ($this->Enrollments->save($enrollment)) {
        $this->Flash->success(__('You have been enrolled successfully.'));
    } else {
        $this->Flash->error(__('User cannot be enrolled. Please try again.'));
    }

    return $this->redirect(['controller' => 'Courses', 'action' => 'view', $courseId]);
}


    /**
     * Edit method
     *
     * @param string|null $id Enrollment id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $enrollment = $this->Enrollments->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $enrollment = $this->Enrollments->patchEntity($enrollment, $this->request->getData());
            if ($this->Enrollments->save($enrollment)) {
                $this->Flash->success(__('The enrollment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The enrollment could not be saved. Please, try again.'));
        }
        $users = $this->Enrollments->Users->find('list', limit: 200)->all();
        $courses = $this->Enrollments->Courses->find('list', limit: 200)->all();
        $this->set(compact('enrollment', 'users', 'courses'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Enrollment id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($courseId)
{
    $this->request->allowMethod(['post', 'delete']);

    $userId = $this->request->getAttribute('identity')->getIdentifier();

    $enrollmentsTable = TableRegistry::getTableLocator()->get('Enrollments');

    $enrollment = $enrollmentsTable->find()
        ->where(['user_id' => $userId, 'course_id' => $courseId])
        ->first();

    if ($enrollment) {
        if ($enrollmentsTable->delete($enrollment)) {
            $this->Flash->success(__('You have been un-enrolled from the course.'));
        } else {
            $this->Flash->error(__('Un-enrollment failed.'));
        }
    }

    return $this->redirect($this->referer());
}

public function toggleAjax()
{
    $this->request->allowMethod(['post']);
    $this->viewBuilder()->disableAutoLayout();
    $this->autoRender = false;

    $userId = $this->Authentication->getIdentity()->get('id');
    $courseId = $this->request->getData('course_id');

    if (!$userId || !$courseId) {
        return $this->response->withType('application/json')->withStringBody(json_encode([
            'status' => 'error',
            'message' => 'Missing user or course ID'
        ]));
    }

    $enrollmentsTable = TableRegistry::getTableLocator()->get('Enrollments');
    $existing = $enrollmentsTable->find()
        ->where(['user_id' => $userId, 'course_id' => $courseId])
        ->first();

    if ($existing) {
        $enrollmentsTable->delete($existing);
        return $this->response->withType('application/json')->withStringBody(json_encode([
            'status' => 'unenrolled'
        ]));
    } else {
        $entity = $enrollmentsTable->newEntity([
            'user_id' => $userId,
            'course_id' => $courseId
        ]);
        $enrollmentsTable->save($entity);
        return $this->response->withType('application/json')->withStringBody(json_encode([
            'status' => 'enrolled'
        ]));
    }
}


}
