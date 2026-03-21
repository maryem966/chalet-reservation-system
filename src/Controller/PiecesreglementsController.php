<?php
declare(strict_types=1);

namespace App\Controller;

class PiecesreglementsController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('Flash'); // Pour les messages flash
    }

    /**
     * Liste des pièces de règlement
     */
    public function index()
    {
        $piecesreglements = $this->Piecesreglements
            ->find()
            ->contain(['Reglements', 'Modespaiements'])
            ->all();

        $this->set(compact('piecesreglements'));
    }

    /**
     * Détails d'une pièce
     */
    public function view($id = null)
    {
        $piecesreglement = $this->Piecesreglements->get($id, [
            'contain' => ['Reglements', 'Modespaiements'],
        ]);

        $this->set(compact('piecesreglement'));
    }

    /**
     * Ajouter une pièce de règlement
     */
    public function add()
    {
        $piecesreglement = $this->Piecesreglements->newEmptyEntity();
        if ($this->request->is('post')) {
            $piecesreglement = $this->Piecesreglements->patchEntity($piecesreglement, $this->request->getData());
            if ($this->Piecesreglements->save($piecesreglement)) {
                $this->Flash->success(__('Pièce de règlement enregistrée.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Erreur lors de l\'enregistrement.'));
        }

        $reglements = $this->Piecesreglements->Reglements->find('list')->toArray();
        $modespaiements = $this->Piecesreglements->Modespaiements->find('list')->toArray();

        $this->set(compact('piecesreglement', 'reglements', 'modespaiements'));
    }

    /**
     * Modifier une pièce de règlement
     */
    public function edit($id = null)
    {
        $piecesreglement = $this->Piecesreglements->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $piecesreglement = $this->Piecesreglements->patchEntity($piecesreglement, $this->request->getData());
            if ($this->Piecesreglements->save($piecesreglement)) {
                $this->Flash->success(__('Modification réussie.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Échec de la modification.'));
        }

        $reglements = $this->Piecesreglements->Reglements->find('list')->toArray();
        $modespaiements = $this->Piecesreglements->Modespaiements->find('list')->toArray();

        $this->set(compact('piecesreglement', 'reglements', 'modespaiements'));
    }

    /**
     * Supprimer une pièce de règlement
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $piecesreglement = $this->Piecesreglements->get($id);
        if ($this->Piecesreglements->delete($piecesreglement)) {
            $this->Flash->success(__('Pièce supprimée.'));
        } else {
            $this->Flash->error(__('La suppression a échoué.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
