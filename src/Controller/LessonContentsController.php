<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * LessonContents Controller
 *
 * @property \App\Model\Table\LessonContentsTable $LessonContents
 */
class LessonContentsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->LessonContents->find()
            ->contain(['Lessons']);
        $lessonContents = $this->paginate($query);

        $this->set(compact('lessonContents'));
    }

    /**
     * View method
     *
     * @param string|null $id Lesson Content id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $lessonContent = $this->LessonContents->get($id, contain: ['Lessons']);
        $this->set(compact('lessonContent'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $lessonContent = $this->LessonContents->newEmptyEntity();
        if ($this->request->is('post')) {
            $lessonContent = $this->LessonContents->patchEntity($lessonContent, $this->request->getData());
            if ($this->LessonContents->save($lessonContent)) {
                $this->Flash->success(__('The lesson content has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The lesson content could not be saved. Please, try again.'));
        }
        $lessons = $this->LessonContents->Lessons->find('list', limit: 200)->all();
        $this->set(compact('lessonContent', 'lessons'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Lesson Content id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $lessonContent = $this->LessonContents->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $lessonContent = $this->LessonContents->patchEntity($lessonContent, $this->request->getData());
            if ($this->LessonContents->save($lessonContent)) {
                $this->Flash->success(__('The lesson content has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The lesson content could not be saved. Please, try again.'));
        }
        $lessons = $this->LessonContents->Lessons->find('list', limit: 200)->all();
        $this->set(compact('lessonContent', 'lessons'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Lesson Content id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $lessonContent = $this->LessonContents->get($id);
        if ($this->LessonContents->delete($lessonContent)) {
            $this->Flash->success(__('The lesson content has been deleted.'));
        } else {
            $this->Flash->error(__('The lesson content could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
