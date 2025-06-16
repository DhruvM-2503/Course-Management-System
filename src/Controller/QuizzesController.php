<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\ORM\TableRegistry;
/**
 * Quizzes Controller
 *
 * @property \App\Model\Table\QuizzesTable $Quizzes
 */
class QuizzesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'limit' => 5,
            'order' => [
                'Quizzes.created' => 'asc'
            ]
            ];
        $query = $this->Quizzes->find()
            ->contain(['Lessons']);
        $quizzes = $this->paginate($query);

        $this->set(compact('quizzes'));
    }

    /**
     * View method
     *
     * @param string|null $id Quiz id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $quiz = $this->Quizzes->get($id, contain: ['Lessons']);
        $this->set(compact('quiz'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $quiz = $this->Quizzes->newEmptyEntity();
        if ($this->request->is('post')) {
            $quiz = $this->Quizzes->patchEntity($quiz, $this->request->getData());
            if ($this->Quizzes->save($quiz)) {
                $this->Flash->success(__('The quiz has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The quiz could not be saved. Please, try again.'));
        }
        $lessons = $this->Quizzes->Lessons->find('list', limit: 200)->all();
        $this->set(compact('quiz', 'lessons'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Quiz id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $quiz = $this->Quizzes->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $quiz = $this->Quizzes->patchEntity($quiz, $this->request->getData());
            if ($this->Quizzes->save($quiz)) {
                $this->Flash->success(__('The quiz has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The quiz could not be saved. Please, try again.'));
        }
        $lessons = $this->Quizzes->Lessons->find('list', limit: 200)->all();
        $this->set(compact('quiz', 'lessons'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Quiz id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $quiz = $this->Quizzes->get($id);
        if ($this->Quizzes->delete($quiz)) {
            $this->Flash->success(__('The quiz has been deleted.'));
        } else {
            $this->Flash->error(__('The quiz could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function start($lessonId)
{
    $questions = $this->Quizzes->find()
        ->where(['lesson_id' => $lessonId])
        ->limit(5)
        ->all();

    $this->set(compact('questions', 'lessonId'));
}

public function submit()
{
    $data = $this->request->getData();
    $score = 0;

    foreach ($data['answers'] as $questionId => $selected) {
        $question = $this->Quizzes->get($questionId);
        if (strtoupper($selected) === strtoupper($question->correct_option)) {
            $score++;
        }
    }

    $lessonId = $data['lesson_id'];
    $lesson = $this->Quizzes->Lessons->get($lessonId);
    $courseId = $lesson->course_id;
    $userId = $this->request->getAttribute('identity')?->getIdentifier();

    $progressTable = TableRegistry::getTableLocator()->get('LessonUserProgress');
    $existing = $progressTable->find()
        ->where(['user_id' => $userId, 'lesson_id' => $lessonId])
        ->first();
    if ($score >= 3) {
        if (!$existing) {
            $progress = $progressTable->newEntity([
                'user_id' => $userId,
                'lesson_id' => $lessonId,
                'quiz_passed' => true,
                'completed_at' => date('Y-m-d H:i:s'),
            ]);
        } else {
            $progress = $progressTable->patchEntity($existing, [
                'quiz_passed' => true,
                'completed_at' => date('Y-m-d H:i:s'),
            ]);
        }
        $progressTable->save($progress);

        $this->Flash->success('Completed successfully! You can move to the next lesson.');
        return $this->redirect(['controller' => 'Courses', 'action' => 'view', $courseId]);
    } else {
        $this->Flash->error('You need to revise more. Try again.');
        return $this->redirect(['controller' => 'Lessons', 'action' => 'learn', $lessonId]);
    }
}
}
