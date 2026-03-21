<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Auth\DefaultPasswordHasher;

class UsersController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('Flash');
    }

    /**
     * Index method
     */
    public function index()
    {
        $query = $this->Users->find();
        $users = $this->paginate($query);

        $this->set(compact('users'));
    }

    /**
     * View method
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, ['contain' => []]);
        $this->set(compact('user'));
        $this->viewBuilder()->setLayout('dashboard');

    }

    /**
     * Add (Register) method
     */
public function add()
{
    $user = $this->Users->newEmptyEntity();
    if ($this->request->is('post')) {
        $user = $this->Users->patchEntity($user, $this->request->getData());
        if ($this->Users->save($user)) {
            return $this->redirect(['action' => 'table']);
        }
        $this->Flash->error(__('خطأ! حاول مجدداً.'));
    }

    $this->set(compact('user'));

    // ✅ THIS LINE IS ESSENTIAL:
    $this->viewBuilder()->setLayout('dashboard');
}


    /**
     * Edit method
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, ['contain' => []]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();

            // Si mot de passe vide, on ne le modifie pas
            if (empty($data['password'])) {
                unset($data['password']);
            }

            $user = $this->Users->patchEntity($user, $data);

            if ($this->Users->save($user)) {
                return $this->redirect(['action' => 'table']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
        $this->viewBuilder()->setLayout('dashboard');

    }

    /**
     * Delete method
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'table']);
    }

    /**
     * Login method
     */
    
    public function login()
{
    if ($this->request->is('post')) {
        $user = $this->Users->find('all', [
            'conditions' => ['email' => $this->request->getData('email')]
        ])->first();

        if ($user) {
            if (password_verify($this->request->getData('password'), $user->password)) {
                $this->request->getSession()->write('User', $user);
                return $this->redirect(['action' => 'dashboard']);
            } else {
                $this->Flash->error('Invalid password.');
            }
        } else {
            $this->Flash->error('Email not found.');
        }
    }
}


    /**
     * Logout method
     */
    public function logout()
    {
        $this->request->getSession()->delete('User');
        return $this->redirect(['action' => 'login']);
    }

    /**
     * Dashboard (protected area)
     */
public function dashboard()
{
    if (!$this->request->getSession()->check('User')) {
        return $this->redirect(['action' => 'login']);
    }

    $user = $this->request->getSession()->read('User');
    
    // Load counts for the dashboard statistics cards
    $chaletsTable = $this->fetchTable('Chalets');
    $clientsTable = $this->fetchTable('Clients');
    $reservationsTable = $this->fetchTable('Reservations');
    
    $stats = [
        'chalets_count' => $chaletsTable->find()->count(),
        'clients_count' => $clientsTable->find()->count(),
        'reservations_count' => $reservationsTable->find()->count(),
        'users_count' => $this->Users->find()->count(),
    ];

    $this->set(compact('user', 'stats'));
    $this->viewBuilder()->setLayout('dashboard');
}

    // src/Controller/UsersController.php
    public function table()
    {
        

        $user = $this->request->getSession()->read('User');
        $users = $this->paginate($this->Users);

        $this->set(compact('user', 'users'));
        $this->viewBuilder()->setLayout('dashboard');
    }


}
