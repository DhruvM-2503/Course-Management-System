<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\ORM\TableRegistry;

/**
 * Leaderboards Controller
 *
 */
class LeaderboardsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $progressTable = TableRegistry::getTableLocator()->get('LessonUserProgress');
        $usersTable = TableRegistry::getTableLocator()->get('Users');

        $query = $progressTable->find()
            ->select([
                'user_id',
                'total' => 'COUNT(*)',
                'Users.username'
            ])
            ->contain(['Users'])
            ->where(['quiz_passed' => 1])
            ->group(['user_id', 'Users.username'])
            ->order(['total' => 'DESC'])
            ->limit(10);

        $leaderboard = [];

        foreach ($query as $row) {
            $user = $usersTable->get($row->user_id);
            $leaderboard[] = [
                'user' => $user,
                'score' => $row->total,
            ];
        }

        $this->set(compact('leaderboard'));
    }

    /**
     * View method
     *
     * @param string|null $id Leaderboard id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $leaderboard = $this->Leaderboards->get($id, contain: []);
        $this->set(compact('leaderboard'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $leaderboard = $this->Leaderboards->newEmptyEntity();
        if ($this->request->is('post')) {
            $leaderboard = $this->Leaderboards->patchEntity($leaderboard, $this->request->getData());
            if ($this->Leaderboards->save($leaderboard)) {
                $this->Flash->success(__('The leaderboard has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The leaderboard could not be saved. Please, try again.'));
        }
        $this->set(compact('leaderboard'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Leaderboard id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $leaderboard = $this->Leaderboards->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $leaderboard = $this->Leaderboards->patchEntity($leaderboard, $this->request->getData());
            if ($this->Leaderboards->save($leaderboard)) {
                $this->Flash->success(__('The leaderboard has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The leaderboard could not be saved. Please, try again.'));
        }
        $this->set(compact('leaderboard'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Leaderboard id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $leaderboard = $this->Leaderboards->get($id);
        if ($this->Leaderboards->delete($leaderboard)) {
            $this->Flash->success(__('The leaderboard has been deleted.'));
        } else {
            $this->Flash->error(__('The leaderboard could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
