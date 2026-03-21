<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\Event\EventInterface; 

class ModespaiementsController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('Flash');
    }

    /**
     * Index method (not used if you're using modestable instead)
     */
    public function index()
    {
        $modespaiements = $this->paginate($this->Modespaiements);
        $this->set(compact('modespaiements'));
        $this->viewBuilder()->setLayout('dashboard');
    }

    /**
     * View method - détails d'une méthode de paiement
     */
    public function view($id = null)
    {
        $modespaiement = $this->Modespaiements->get($id);
        $this->set(compact('modespaiement'));
        $this->viewBuilder()->setLayout('dashboard');
    }

    /**
     * Add method - ajouter une méthode de paiement
     */

    public function add()
{
    $modespaiement = $this->Modespaiements->newEmptyEntity();

    if ($this->request->is('post')) {
        $modespaiement = $this->Modespaiements->patchEntity($modespaiement, $this->request->getData());
        if ($this->Modespaiements->save($modespaiement)) {
            return $this->redirect(['action' => 'modestable']);  // <-- ici sans s
        }
        $this->Flash->error(__('حدث خطأ أثناء الSave. حاول مرة أخرى.'));
    }

    $this->set(compact('modespaiement'));
    $this->viewBuilder()->setLayout('dashboard');
}


    /**
     * Edit method - Edit طريقة دفع موجودة
     */
    public function edit($id = null)
    {
        $modespaiement = $this->Modespaiements->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $modespaiement = $this->Modespaiements->patchEntity($modespaiement, $this->request->getData());
            if ($this->Modespaiements->save($modespaiement)) {
                return $this->redirect(['action' => 'modestable']);
            }
            $this->Flash->error(__('حدث خطأ، يرجى المحاولة مرة أخرى.'));
        }
        $this->set(compact('modespaiement'));
        $this->viewBuilder()->setLayout('dashboard');
    }

    /**
     * Delete method - Delete طريقة دفع
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $modespaiement = $this->Modespaiements->get($id);
        if ($this->Modespaiements->delete($modespaiement)) {
        } else {
            $this->Flash->error(__('لم يتم Delete Payment Method. حاول مجدداً.'));
        }
        return $this->redirect(['action' => 'modestable']);
    }

    /**
     * Dashboard - facultatif selon ton besoin
     */
    public function dashboard()
    {
        if (!$this->request->getSession()->check('User')) {
            return $this->redirect(['action' => 'login']);
        }

        $user = $this->request->getSession()->read('User');
        $modespaiements = $this->paginate($this->Modespaiements);

        $this->set(compact('user', 'modespaiements'));
        $this->viewBuilder()->setLayout('dashboard');
    }

    /**
     * Table view personnalisée - gestion des méthodes de paiement
     */
    public function modestable()
    {
        $user = $this->request->getSession()->read('User');
        $modespaiements = $this->paginate($this->Modespaiements);

        $this->set(compact('user', 'modespaiements'));
        $this->viewBuilder()->setLayout('dashboard');
    }
}
