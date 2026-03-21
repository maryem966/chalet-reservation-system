<?php
declare(strict_types=1);

namespace App\Controller;


class ClientsController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->viewBuilder()->setLayout('dashboard');
    }

    // 📋 Index method
    public function index()
    {
        $query = $this->Clients->find();
        $clients = $this->paginate($query);
        $this->set(compact('clients'));
    }

    // 👁 View method
    public function view($id = null)
    {
        $client = $this->Clients->get($id);
        $this->set(compact('client'));
        $this->viewBuilder()->setLayout('dashboard');
    }

    // ➕ Add method
    public function add()
    {
        $client = $this->Clients->newEmptyEntity();
        if ($this->request->is('post')) {
            $client = $this->Clients->patchEntity($client, $this->request->getData());
            if ($this->Clients->save($client)) {
                return $this->redirect(['action' => 'clientstable']);
            }
            $this->Flash->error(__('خطأ! حاول مجدداً.'));
        }
        $this->set(compact('client'));
        $this->viewBuilder()->setLayout('dashboard');
    }

    // 📝 Edit method
    public function edit($id = null)
    {
        $client = $this->Clients->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $client = $this->Clients->patchEntity($client, $this->request->getData());
            if ($this->Clients->save($client)) {
                return $this->redirect(['action' => 'clientstable']);
            }
            $this->Flash->error(__('لم يتم الSave، حاول مجدداً.'));
        }
        $this->set(compact('client'));
        $this->viewBuilder()->setLayout('dashboard');
    }

    // ❌ Delete method
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $client = $this->Clients->get($id);
        if ($this->Clients->delete($client)) {
        } else {
            $this->Flash->error(__('فشل الDelete، حاول مجدداً.'));
        }
        return $this->redirect(['action' => 'clientstable']);
    }

    // 🧭 Dashboard method
    public function dashboard()
    {
        if (!$this->request->getSession()->check('User')) {
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }

        $user = $this->request->getSession()->read('User');
        $clients = $this->paginate($this->Clients);
        $this->set(compact('user', 'clients'));
        $this->viewBuilder()->setLayout('dashboard');
    }

    // 📊 Table method
    public function clientstable()
    {
        $user = $this->request->getSession()->read('User');
        $clients = $this->paginate($this->Clients);
        $this->set(compact('user', 'clients'));
        $this->viewBuilder()->setLayout('dashboard');
    }
    public function updatePaymentStatus($id)
{
    $client = $this->Clients->get($id);
    if ($this->request->is('post')) {
        $client->payment_status = $this->request->getData('payment_status');
        if ($this->Clients->save($client)) {
        } else {
            $this->Flash->error(__('تعذر Update حالة Payment.'));
        }
    }
    return $this->redirect($this->referer());
}

public function ajaxAdd()
{
    $this->request->allowMethod(['post']);

    $client = $this->Clients->newEmptyEntity();
    $client = $this->Clients->patchEntity($client, $this->request->getData());

    if ($this->Clients->save($client)) {
        return $this->response->withType('application/json')->withStringBody(json_encode([
            'success' => true,
            'client' => [
                'id' => $client->id,
                'name' => $client->name
            ]
        ]));
    } else {
        return $this->response->withType('application/json')->withStringBody(json_encode([
            'success' => false
        ]));
    }
    $this->viewBuilder()->setClassName('Json');

}



}
