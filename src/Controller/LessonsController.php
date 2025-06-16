<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Lessons Controller
 *
 * @property \App\Model\Table\LessonsTable $Lessons
 */
class LessonsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Lessons->find()
            ->contain(['Courses']);
        $lessons = $this->paginate($query);

        $this->set(compact('lessons'));
    }

    /**
     * View method
     *
     * @param string|null $id Lesson id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $lesson = $this->Lessons->get($id, contain: ['Courses']);
        $this->set(compact('lesson'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add($courseId = null)
{
    $lesson = $this->Lessons->newEmptyEntity();
    if ($this->request->is('post')) {
        $lesson = $this->Lessons->patchEntity($lesson, $this->request->getData());
        $lesson->course_id = $courseId;
        if ($this->Lessons->save($lesson)) {
            $this->Flash->success(__('The lesson has been saved.'));
            return $this->redirect(['controller' => 'Courses', 'action' => 'view', $lesson->course_id]);
        }
        $this->Flash->error(__('The lesson could not be saved. Please, try again.'));
    }

    $courses = $this->Lessons->Courses->find('list');
    if ($courseId) {
        $lesson->course_id = $courseId;
    }
    $this->set(compact('lesson', 'courses'));
}


    /**
     * Edit method
     *
     * @param string|null $id Lesson id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $lesson = $this->Lessons->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $lesson = $this->Lessons->patchEntity($lesson, $this->request->getData());
            if ($this->Lessons->save($lesson)) {
                $this->Flash->success(__('The lesson has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The lesson could not be saved. Please, try again.'));
        }
        $courses = $this->Lessons->Courses->find('list', limit: 200)->all();
        $this->set(compact('lesson', 'courses'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Lesson id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $lesson = $this->Lessons->get($id);
        if ($this->Lessons->delete($lesson)) {
            $this->Flash->success(__('The lesson has been deleted.'));
        } else {
            $this->Flash->error(__('The lesson could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function learn($id = null)
{
    $lesson = $this->Lessons->get($id, [
        'contain' => ['LessonContents']
    ]);

    $this->set(compact('lesson'));
}

}
