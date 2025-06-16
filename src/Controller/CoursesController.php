<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\ORM\TableRegistry;
use Cake\Utility\Text;
use Cake\Collection\Collection;

/**
 * Courses Controller
 *
 * @property \App\Model\Table\CoursesTable $Courses
 */
class CoursesController extends AppController
{
    public $Users;
    public $Courses;

    public function initialize(): void
    {
        parent::initialize();

        $this->Users = TableRegistry::getTableLocator()->get('Users');
        $this->Courses = TableRegistry::getTableLocator()->get('Courses');
    }
    public function index()
    {
        $query = $this->Courses->find()
            ->contain(['Users']);
        $courses = $this->paginate($query);

        $this->set(compact('courses'));
    }

    /**
     * View method
     *
     * @param string|null $id Course id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    
public function view($id = null)
{
    $identity = $this->request->getAttribute('identity');
    $userId = $identity?->getIdentifier();
    $userRole = $identity?->get('role');

    $course = $this->Courses->get($id, [
        'contain' => ['Users', 'Reviews' => ['Users'], 'Lessons' => ['LessonContents']]
    ]);

    $isEnrolled = false;
    foreach ($course->users as $user) {
        if ($user->id === $userId) {
            $isEnrolled = true;
            break;
        }
    }

    if ($userRole === 'admin') {
        $isEnrolled = true;
    }

    $showCertificate = false;

    if ($isEnrolled && $userRole !== 'admin') {
        $progressTable = TableRegistry::getTableLocator()->get('LessonUserProgress');
        $rawProgress = $progressTable->find()
            ->where(['user_id' => $userId])
            ->all();

        $userProgress = (new Collection($rawProgress))
            ->indexBy('lesson_id')
            ->toArray();

        $filteredLessons = [];

        $lessons = $course->lessons;
        foreach ($lessons as $i => $lesson) {
            if (
                $i === 0 ||
                (isset($userProgress[$lessons[$i - 1]->id]) &&
                $userProgress[$lessons[$i - 1]->id]->quiz_passed)
            ) {
                $filteredLessons[] = $lesson;
            } else {
                break;
            }
        }

        $course->lessons = $filteredLessons;

        $allLessonIds = collection($lessons)->extract('id')->toList();
        $passedCount = $progressTable->find()
            ->where([
                'user_id' => $userId,
                'lesson_id IN' => $allLessonIds,
                'quiz_passed' => 1
            ])
            ->count();

        if (!empty($allLessonIds) && $passedCount === count($allLessonIds)) {
            $showCertificate = true;
        }
    }

    $this->set(compact('course', 'isEnrolled', 'showCertificate'));
}


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
{
    $user = $this->request->getAttribute('identity');
    if ($user->role !== 'admin') {
        $this->Flash->error(__('Only admins can add courses.'));
        return $this->redirect(['action' => 'index']);
    }

    $course = $this->Courses->newEmptyEntity();

    if ($this->request->is('post')) {
        $data = $this->request->getData();

        $image = $data['thumbnail'] ?? null;

        if ($image && $image->getError() === 0) {
            $filename = Text::slug(pathinfo($image->getClientFilename(), PATHINFO_FILENAME));
            $ext = pathinfo($image->getClientFilename(), PATHINFO_EXTENSION);
            $newName = $filename . '_' . time() . '.' . $ext;

            $targetPath = WWW_ROOT . 'img/courses/' . $newName;
            $image->moveTo($targetPath);

            $data['thumbnail'] = $newName;
        } else {
            $data['thumbnail'] = null;
        }

        $course = $this->Courses->patchEntity($course, $data);
        $course->user_id = $user->get('id'); 

        if ($this->Courses->save($course)) {
            $this->Flash->success(__('The course has been saved.'));
            return $this->redirect(['action' => 'index']);
        }

        $this->Flash->error(__('The course could not be saved. Please, try again.'));
    }

    $users = $this->Courses->Users->find('list', ['limit' => 200])->all();
    $this->set(compact('course', 'users'));
}


    /**
     * Edit method
     *
     * @param string|null $id Course id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
{
    $user = $this->request->getAttribute('identity');
    if ($user->role !== 'admin') {
        $this->Flash->error(__('Only admins can edit courses.'));
        return $this->redirect(['action' => 'index']);
    }

    $course = $this->Courses->get($id, contain: ['Users']);

    if ($this->request->is(['patch', 'post', 'put'])) {
        $course = $this->Courses->patchEntity($course, $this->request->getData());
        $course->user_id = $user->get('id');
        if ($this->Courses->save($course)) {
            $this->Flash->success(__('The course has been saved.'));
            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('The course could not be saved. Please, try again.'));
    }

    $users = $this->Courses->Users->find('list', ['limit' => 200])->all();
    $this->set(compact('course', 'users'));
}

    /**
     * Delete method
     *
     * @param string|null $id Course id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
{
    $user = $this->request->getAttribute('identity');
    if ($user->role !== 'admin') {
        $this->Flash->error(__('Only admin can delete courses.'));
        return $this->redirect(['action' => 'index']);
    }

    $this->request->allowMethod(['post', 'delete']);

    $course = $this->Courses->get($id);
    if ($this->Courses->delete($course)) {
        $this->Flash->success(__('The course has been deleted.'));
    } else {
        $this->Flash->error(__('The course could not be deleted. Please, try again.'));
    }

    return $this->redirect(['action' => 'index']);
}


public function myCourses()
{
    $userId = $this->request->getAttribute('identity')->getIdentifier();

    $courses = $this->Courses->find()
        ->matching('Users', function ($q) use ($userId) {
            return $q->where(['Users.id' => $userId]);
        })
        ->contain(['Users'])
        ->all();

    $this->set(compact('courses'));
}

public function adminDashboard()
{
    $coursesTable = TableRegistry::getTableLocator()->get('Courses');

    $courses = $coursesTable->find()
        ->contain([
            'Users',
            'Lessons' => [
                'LessonUserProgress' => function ($q) {
                    return $q->select(['lesson_id', 'user_id', 'quiz_passed']);
                }
            ]
        ])
        ->all();

    $this->set(compact('courses'));

}


public function userDashboard()
{
    $userId = $this->request->getAttribute('identity')->getIdentifier();

    $usersTable = TableRegistry::getTableLocator()->get('Users');

    $user = $usersTable->get($userId, [
        'contain' => ['Courses' => ['Lessons']]
    ]);

    $progressTable = TableRegistry::getTableLocator()->get('LessonUserProgress');
    $passedLessons = $progressTable->find()
        ->where(['user_id' => $userId, 'quiz_passed' => true])
        ->all();

    $progress = (new Collection($passedLessons))
        ->indexBy('lesson_id')
        ->toArray();

    $this->set(compact('user', 'progress'));
}

}
