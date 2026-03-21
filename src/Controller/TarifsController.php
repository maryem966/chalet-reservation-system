<?php
declare(strict_types=1);

namespace App\Controller;

class TarifsController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('Flash');
    }

    /**
     * Index method - liste paginée des tarifs
     */
    public function index()
    {
        $query = $this->Tarifs->find('all')->contain(['Chalets']); // si relation avec chalets
        $tarifs = $this->paginate($query);
        $this->set(compact('tarifs'));
        $this->viewBuilder()->setLayout('dashboard');
    }

    /**
     * View method - détail d'un tarif
     */
    public function view($id = null)
    {
        $tarif = $this->Tarifs->get($id, ['contain' => ['Chalets']]);
        $this->set(compact('tarif'));
        $this->viewBuilder()->setLayout('dashboard');
    }

    /**
     * Add method - ajouter un nouveau tarif
     */
    public function add()
    {
        $tarif = $this->Tarifs->newEmptyEntity();
        if ($this->request->is('post')) {
            $tarif = $this->Tarifs->patchEntity($tarif, $this->request->getData());
            if ($this->Tarifs->save($tarif)) {
                return $this->redirect(['action' => 'tarifstable']);
            }
            $this->Flash->error(__('حدث خطأ، يرجى المحاولة مرة أخرى.'));
        }

        // Pour la sélection des chalets dans le formulaire (si tu veux)
        $chalets = $this->Tarifs->Chalets->find('list', ['limit' => 200]);
        $this->set(compact('tarif', 'chalets'));

        $this->viewBuilder()->setLayout('dashboard');
    }

    /**
     * Edit method - modifier un tarif existant
     */
    public function edit($id = null)
    {
        $tarif = $this->Tarifs->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tarif = $this->Tarifs->patchEntity($tarif, $this->request->getData());
            if ($this->Tarifs->save($tarif)) {
                return $this->redirect(['action' => 'tarifstable']);
            }
            $this->Flash->error(__('حدث خطأ، يرجى المحاولة مرة أخرى.'));
        }

        $chalets = $this->Tarifs->Chalets->find('list', ['limit' => 200]);
        $this->set(compact('tarif', 'chalets'));
        $this->viewBuilder()->setLayout('dashboard');
    }

    /**
     * Delete method - supprimer un tarif
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tarif = $this->Tarifs->get($id);
        if ($this->Tarifs->delete($tarif)) {
        } else {
            $this->Flash->error(__('لم يتم Delete التعريف. حاول مجدداً.'));
        }
        return $this->redirect(['action' => 'tarifstable']);
    }
    public function dashboard()
{
    if (!$this->request->getSession()->check('User')) {
        return $this->redirect(['action' => 'login']);
    }

    $user = $this->request->getSession()->read('User');
    $this->set(compact('user'));

    // Charger tous les tarifs paginés
    $tarifs = $this->paginate($this->Tarifs);
    $this->set(compact('tarifs'));

    $this->viewBuilder()->setLayout('dashboard');
}

public function tarifstable()
{
    $user = $this->request->getSession()->read('User');
    $tarifs = $this->paginate($this->Tarifs);

    $this->set(compact('user', 'tarifs'));
    $this->viewBuilder()->setLayout('dashboard');
}

}
