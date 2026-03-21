<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Filesystem\Filesystem;

class SocietesController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('Flash');
    }

    // 📋 Index
    public function index()
    {
        $query = $this->Societes->find();
        $societes = $this->paginate($query);

        $this->set(compact('societes'));
    }

    // 👁️ View
    public function view($id = null)
    {
        $societe = $this->Societes->get($id, ['contain' => []]);
        $this->set(compact('societe'));
        $this->viewBuilder()->setLayout('dashboard');
    }

    // ➕ Add
public function add()
{
    $societe = $this->Societes->newEmptyEntity();

    if ($this->request->is('post')) {
        $data = $this->request->getData();

        // 🔍 1. Récupérer le fichier
        $file = $this->request->getData('logo');

        if ($file && $file->getError() === 0) {
            // 🔒 2. Créer nom unique et chemin
            $filename = time() . '_' . $file->getClientFilename();
            $filepath = WWW_ROOT . 'img' . DS . 'logos' . DS . $filename;

            // 💾 3. Déplacer le fichier
            $file->moveTo($filepath);

            // ✅ 4. Stocker le nom du fichier dans $data
            $data['logo'] = $filename;
        } else {
            unset($data['logo']);
        }

        // 🧩 5. patchEntity avec un tableau SANS l'objet fichier
        $societe = $this->Societes->patchEntity($societe, $data);

        if ($this->Societes->save($societe)) {
            $this->Flash->success(__('تمت Add Company بنجاح.'));
            return $this->redirect(['action' => 'societestable']);
        }

        $this->Flash->error(__('خطأ! حاول مجدداً.'));
    }

    $this->set(compact('societe'));
    $this->viewBuilder()->setLayout('dashboard');
}



    // 📝 Edit
    public function edit($id = null)
    {
        $societe = $this->Societes->get($id, ['contain' => []]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();

            // ✅ Gestion du nouveau logo si uploadé
            $file = $this->request->getData('logo');
            if ($file && $file->getError() === 0) {
                $filename = time() . '_' . $file->getClientFilename();
                $targetPath = WWW_ROOT . 'img' . DS . 'logos' . DS . $filename;
                $file->moveTo($targetPath);
                $data['logo'] = $filename;
            } else {
                unset($data['logo']); // ne pas écraser l'ancien si pas de nouveau logo
            }

            $societe = $this->Societes->patchEntity($societe, $data);
            if ($this->Societes->save($societe)) {
                $this->Flash->success(__('تم Edit Company Information.'));
                return $this->redirect(['action' => 'societestable']);
            }
            $this->Flash->error(__('تعذر الEdit. حاول مجددًا.'));
        }

        $this->set(compact('societe'));
        $this->viewBuilder()->setLayout('dashboard');
    }

    // ❌ Delete
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $societe = $this->Societes->get($id);
        if ($this->Societes->delete($societe)) {
            // tu peux aussi supprimer l'ancien fichier logo ici si tu veux
        } else {
            $this->Flash->error(__('تعذر الDelete. حاول مجددًا.'));
        }

        return $this->redirect(['action' => 'societestable']);
    }

    // 📊 Dashboard
    public function dashboard()
    {
        $user = $this->request->getSession()->read('User');
        $this->set(compact('user'));

        $societes = $this->paginate($this->Societes);
        $this->set(compact('societes'));

        $this->viewBuilder()->setLayout('dashboard');
    }

    // 📑 Table view
    public function societestable()
    {
        $user = $this->request->getSession()->read('User');
        $societes = $this->paginate($this->Societes);

        $this->set(compact('user', 'societes'));
        $this->viewBuilder()->setLayout('dashboard');
    }
}
