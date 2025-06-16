<?php
namespace App\Controller;

use App\Controller\AppController;

class ReviewsController extends AppController
{
    public function add($courseId)
    {
        $review = $this->Reviews->newEmptyEntity();

        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $data['user_id'] = $this->request->getAttribute('identity')->get('id');
            $data['course_id'] = $courseId;

            $review = $this->Reviews->patchEntity($review, $data);

            if ($this->Reviews->save($review)) {
                $this->Flash->success('Review submitted.');
                return $this->redirect(['controller' => 'Courses', 'action' => 'view', $courseId]);
            }

            $this->Flash->error('Could not submit review. Try again.');
        }

        $this->set(compact('review', 'courseId'));
    }

    public function edit($id = null)
{
    $review = $this->Reviews->get($id);

    if ($review->user_id != $this->Authentication->getIdentity()->get('id')) {
        $this->Flash->error('You are not authorized to edit this review.');
        return $this->redirect($this->referer());
    }

    if ($this->request->is(['patch', 'post', 'put'])) {
        $review = $this->Reviews->patchEntity($review, $this->request->getData());
        if ($this->Reviews->save($review)) {
            $this->Flash->success('Review updated.');
            return $this->redirect(['controller' => 'Courses', 'action' => 'view', $review->course_id]);
        }
        $this->Flash->error('The review could not be updated.');
    }

    $this->set(compact('review'));
}
public function delete($id = null)
{
    $this->request->allowMethod(['post', 'delete']);
    $review = $this->Reviews->get($id);

    if ($review->user_id != $this->Authentication->getIdentity()->get('id')) {
        $this->Flash->error('You are not authorized to delete this review.');
        return $this->redirect($this->referer());
    }

    if ($this->Reviews->delete($review)) {
        $this->Flash->success('Review deleted.');
    } else {
        $this->Flash->error('The review could not be deleted.');
    }

    return $this->redirect(['controller' => 'Courses', 'action' => 'view', $review->course_id]);
}
}
