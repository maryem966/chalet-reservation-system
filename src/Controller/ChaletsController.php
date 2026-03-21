<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\ORM\TableRegistry;

class ChaletsController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('Flash');
        $this->loadComponent('Upload');
    }

    // 📋 Index method
    public function index()
    {
        // Création d'une requête avec contain pour récupérer les types liés
        $query = $this->Chalets->find()->contain(['Typechalets']);
        
        // Pagination sur la requête
        $chalets = $this->paginate($query);

        $this->set(compact('chalets'));
    }

    // 👁 View method
    public function view($id = null)
    {
        $chalet = $this->Chalets->get($id, [
            'contain' => ['Typechalets'] // Charger les données liées aussi pour la vue
        ]);
        $this->set(compact('chalet'));
        $this->viewBuilder()->setLayout('dashboard');
    }

    // ➕ Add method
    public function add()
    {
        $chalet = $this->Chalets->newEmptyEntity();

        // Charger la liste des types
        $typechaletsTable = TableRegistry::getTableLocator()->get('Typechalets');
        $typechalets = $typechaletsTable->find('list', [
            'keyField' => 'id',
            'valueField' => 'name'
        ])->toArray();

        if ($this->request->is('post')) {
            $data = $this->request->getData();

            $filename = $this->Upload->handleImageUpload($this->request->getData('photo'), 'chalets');
            if ($filename) {
                $data['photo'] = $filename;
            } else {
                unset($data['photo']);
            }

            $chalet = $this->Chalets->patchEntity($chalet, $data);

            if ($this->Chalets->save($chalet)) {
                return $this->redirect(['action' => 'chaletstable']);
            }

            $this->Flash->error(__('حدث خطأ أثناء Add Chalet.'));
        }

        $this->set(compact('chalet', 'typechalets'));
        $this->viewBuilder()->setLayout('dashboard');
    }

    // 📝 Edit method
    public function edit($id = null)
{
    $chalet = $this->Chalets->get($id);

    // جلب قائمة أنواع Chaletات (نفس ما تفعل في add)
    $typechaletsTable = TableRegistry::getTableLocator()->get('Typechalets');
    $typechalets = $typechaletsTable->find('list', [
        'keyField' => 'id',
        'valueField' => 'name'
    ])->toArray();

    if ($this->request->is(['patch', 'post', 'put'])) {
        $data = $this->request->getData();

        $filename = $this->Upload->handleImageUpload($data['photo_file'] ?? null, 'chalets');
        if ($filename) {
            $data['photo'] = $filename;
        } else {
            unset($data['photo']);
        }

        $chalet = $this->Chalets->patchEntity($chalet, $data);

        if ($this->Chalets->save($chalet)) {
            return $this->redirect(['action' => 'chaletstable']);
        }

        $this->Flash->error(__('لم يتم الSave، حاول مجدداً.'));
    }

    $this->set(compact('chalet', 'typechalets'));
    $this->viewBuilder()->setLayout('dashboard');
}


    // ❌ Delete method
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $chalet = $this->Chalets->get($id);
        if (!$this->Chalets->delete($chalet)) {
            $this->Flash->error(__('فشل الDelete، حاول مجدداً.'));
        }
        return $this->redirect(['action' => 'chaletstable']);
    }

    // 🧭 Dashboard method
    public function dashboard()
    {
        if (!$this->request->getSession()->check('User')) {
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }

        $user = $this->request->getSession()->read('User');

        // Pagination simple sans contain ici (modifie si besoin)
        $chalets = $this->paginate($this->Chalets->find());

        $this->set(compact('user', 'chalets'));
        $this->viewBuilder()->setLayout('dashboard');
    }

    // 📊 Table method
    public function chaletstable()
    {
        $user = $this->request->getSession()->read('User');

        // Pagination avec contain pour charger les types liés
        $query = $this->Chalets->find()->contain(['Typechalets']);
        $chalets = $this->paginate($query);

        $this->set(compact('user', 'chalets'));
        $this->viewBuilder()->setLayout('dashboard');
    }
}
