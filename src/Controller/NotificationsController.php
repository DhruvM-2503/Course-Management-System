<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\ORM\TableRegistry;

/**
 * Notifications Controller
 *
 * @property \App\Model\Table\NotificationsTable $Notifications
 */
class NotificationsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Notifications->find()
            ->contain(['Users']);
        $notifications = $this->paginate($query);

        $this->set(compact('notifications'));
    }

    /**
     * View method
     *
     * @param string|null $id Notification id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $notification = $this->Notifications->get($id, contain: ['Users']);
        $this->set(compact('notification'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->request->getAttribute('identity');
    if (!$user || $user->get('role') !== 'admin') {
        $this->Flash->error('You are not authorized to send notifications.');
        return $this->redirect(['controller' => 'courses', 'action' => 'index']);
    }
        $usersTable = TableRegistry::getTableLocator()->get('Users');
        $notification = $this->Notifications->newEmptyEntity();
    
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $notification = $this->Notifications->patchEntity($notification, $data);
            if ($this->Notifications->save($notification)) {
                $this->Flash->success(__('Notification sent successfully.'));
                return $this->redirect(['controller' => 'Courses' ,'action' => 'index']);
            }
            $this->Flash->error(__('Failed to send notification.'));
        }
    
        $users = $usersTable->find('list')->toArray();
        $this->set(compact('notification', 'users'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Notification id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $notification = $this->Notifications->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $notification = $this->Notifications->patchEntity($notification, $this->request->getData());
            if ($this->Notifications->save($notification)) {
                $this->Flash->success(__('The notification has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The notification could not be saved. Please, try again.'));
        }
        $users = $this->Notifications->Users->find('list', limit: 200)->all();
        $this->set(compact('notification', 'users'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $notification = $this->Notifications->get($id);
        if ($this->Notifications->delete($notification)) {
            $this->Flash->success(__('The notification has been deleted.'));
        } else {
            $this->Flash->error(__('The notification could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

public function userNotifications()
{
    $userId = $this->request->getAttribute('identity')->getIdentifier();
    $notificationsTable = TableRegistry::getTableLocator()->get('Notifications');

    $notifications = $notificationsTable->find()
        ->where(['user_id' => $userId])
        ->order(['created' => 'DESC'])
        ->all();

    $notificationsTable->updateAll(
        ['is_read' => true],
        ['user_id' => $userId, 'is_read' => false]
    );

    $this->set(compact('notifications'));
}


}
