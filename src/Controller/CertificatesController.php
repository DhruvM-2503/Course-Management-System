<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\ORM\TableRegistry;
use Dompdf\Dompdf;
use Dompdf\Options;

/**
 * Certificates Controller
 *
 * @property \App\Model\Table\CertificatesTable $Certificates
 */
class CertificatesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Certificates->find()
            ->contain(['Users', 'Courses']);
        $certificates = $this->paginate($query);

        $this->set(compact('certificates'));
    }

    /**
     * View method
     *
     * @param string|null $id Certificate id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $certificate = $this->Certificates->get($id, contain: ['Users', 'Courses']);
        $this->set(compact('certificate'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $certificate = $this->Certificates->newEmptyEntity();
        if ($this->request->is('post')) {
            $certificate = $this->Certificates->patchEntity($certificate, $this->request->getData());
            if ($this->Certificates->save($certificate)) {
                $this->Flash->success(__('The certificate has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The certificate could not be saved. Please, try again.'));
        }
        $users = $this->Certificates->Users->find('list', limit: 200)->all();
        $courses = $this->Certificates->Courses->find('list', limit: 200)->all();
        $this->set(compact('certificate', 'users', 'courses'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Certificate id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $certificate = $this->Certificates->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $certificate = $this->Certificates->patchEntity($certificate, $this->request->getData());
            if ($this->Certificates->save($certificate)) {
                $this->Flash->success(__('The certificate has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The certificate could not be saved. Please, try again.'));
        }
        $users = $this->Certificates->Users->find('list', limit: 200)->all();
        $courses = $this->Certificates->Courses->find('list', limit: 200)->all();
        $this->set(compact('certificate', 'users', 'courses'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Certificate id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $certificate = $this->Certificates->get($id);
        if ($this->Certificates->delete($certificate)) {
            $this->Flash->success(__('The certificate has been deleted.'));
        } else {
            $this->Flash->error(__('The certificate could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function generate($courseId)
    {
        $userId = $this->Authentication->getIdentity()->get('id');

        $lessonsTable = TableRegistry::getTableLocator()->get('Lessons');
        $progressTable = TableRegistry::getTableLocator()->get('LessonUserProgress');

        $lessonIds = $lessonsTable->find()
            ->select(['id'])
            ->where(['course_id' => $courseId])
            ->all()
            ->extract('id')
            ->toList();

        $total = count($lessonIds);

        $passed = $progressTable->find()
            ->where([
                'user_id' => $userId,
                'lesson_id IN' => $lessonIds,
                'quiz_passed' => 1
            ])
            ->count();

        if ($total === 0 || $passed < $total) {
            $this->Flash->error('You must complete all quizzes to get your certificate.');
            return $this->redirect(['controller' => 'Courses', 'action' => 'view', $courseId]);
        }

        $certificatesTable = TableRegistry::getTableLocator()->get('Certificates');

        $existing = $certificatesTable->find()
            ->where(['user_id' => $userId, 'course_id' => $courseId])
            ->first();

        if (!$existing) {
            $certificate = $certificatesTable->newEntity([
                'user_id' => $userId,
                'course_id' => $courseId,
                'issued_on' => date('Y-m-d H:i:s'),
            ]);
            $certificatesTable->save($certificate);
        } else {
            $certificate = $existing;
        }

        $user = $this->Authentication->getIdentity();
        $course = TableRegistry::getTableLocator()->get('Courses')->get($courseId);

        $dompdf = new Dompdf();
        $html = $this->renderCertificateHtml($user->username, $course->title);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        return $this->response
            ->withType('application/pdf')
            ->withStringBody($dompdf->output())
            ->withDownload('Certificate-' . $course->title . $user->id . '.pdf');
    }

    private function renderCertificateHtml($userName, $courseTitle)
        {
        return "
            <html>
    <head>
        <style>
            body {
                font-family: 'Georgia', serif;
                text-align: center;
                padding: 50px;
                background: #f9f9f9;
            }
            .certificate-container {
                border: 10px solid #1d3557;
                padding: 40px;
                background-color: white;
            }
            h1 {
                font-size: 42px;
                color: #1d3557;
                margin-bottom: 20px;
            }
            h2 {
                font-size: 28px;
                margin: 20px 0;
                color: #457b9d;
            }
            p {
                font-size: 18px;
                color: #333;
            }
            .footer {
                margin-top: 40px;
                font-size: 14px;
                color: #888;
            }
            
        </style>
    </head>
    <body>
        <div class='certificate-container'>
            <h1>Certificate of Completion</h1>
            <p>This is to certify that</p>
            <h2 class='username'>$userName</h2>
            <p>has successfully completed the course</p>
            <h2>$courseTitle</h2>
            <p>Issued on: " . date('F j, Y') . "</p>
            <div class='footer'>
                <p>Powered by <strong>Queueloop Solutions LLP</strong></p>
            </div>
        </div>
    </body>
</html>
        ";
    }
}

