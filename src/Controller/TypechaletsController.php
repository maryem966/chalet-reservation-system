<?php
declare(strict_types=1);

namespace App\Controller;

class TypechaletsController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('Flash');
    }

    // 📋 Index
    public function index()
    {
        $query = $this->Typechalets->find();
        $typechalets = $this->paginate($query);
        $this->set(compact('typechalets'));
    }

    // 👁️ View
    public function view($id = null)
    {
        $typechalet = $this->Typechalets->get($id, ['contain' => []]);
        $this->set(compact('typechalet'));
        $this->viewBuilder()->setLayout('dashboard');
    }

    // ➕ Add
    public function add()
    {
        $typechalet = $this->Typechalets->newEmptyEntity();

        if ($this->request->is('post')) {
            $typechalet = $this->Typechalets->patchEntity($typechalet, $this->request->getData());
            if ($this->Typechalets->save($typechalet)) {
                $this->Flash->success(__('تمت Add Chalet Type بنجاح.'));
                return $this->redirect(['action' => 'typechaletstable']);
            }

            $this->Flash->error(__('خطأ! حاول مجدداً.'));
        }

        $this->set(compact('typechalet'));
        $this->viewBuilder()->setLayout('dashboard');
    }

    // 📝 Edit
    public function edit($id = null)
    {
        $typechalet = $this->Typechalets->get($id, ['contain' => []]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $typechalet = $this->Typechalets->patchEntity($typechalet, $this->request->getData());
            if ($this->Typechalets->save($typechalet)) {
                $this->Flash->success(__('تم Edit Chalet Type.'));
                return $this->redirect(['action' => 'typechaletstable']);
            }

            $this->Flash->error(__('تعذر الEdit. حاول مجددًا.'));
        }

        $this->set(compact('typechalet'));
        $this->viewBuilder()->setLayout('dashboard');
    }

    // ❌ Delete
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $typechalet = $this->Typechalets->get($id);

        if ($this->Typechalets->delete($typechalet)) {
            $this->Flash->success(__('تم Delete Chalet Type.'));
        } else {
            $this->Flash->error(__('تعذر الDelete. حاول مجددًا.'));
        }

        return $this->redirect(['action' => 'typechaletstable']);
    }

    // 📊 Dashboard view (optional)
    public function dashboard()
    {
        $user = $this->request->getSession()->read('User');
        $typechalets = $this->paginate($this->Typechalets);

        $this->set(compact('user', 'typechalets'));
        $this->viewBuilder()->setLayout('dashboard');
    }

    // 📑 Table view
    public function typechaletstable()
    {
        $user = $this->request->getSession()->read('User');
        $typechalets = $this->paginate($this->Typechalets);

        $this->set(compact('user', 'typechalets'));
        $this->viewBuilder()->setLayout('dashboard');
    }
}
