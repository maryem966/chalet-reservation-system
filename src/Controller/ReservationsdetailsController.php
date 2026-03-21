<?php
declare(strict_types=1);

namespace App\Controller;

class ReservationsdetailsController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('Flash');

        $this->Reservationsdetails = $this->getTableLocator()->get('Reservationsdetails');
        $this->Reservations = $this->getTableLocator()->get('Reservations');
        $this->Chalets = $this->getTableLocator()->get('Chalets');
        $this->Tarifs = $this->getTableLocator()->get('Tarifs');
    }

    public function index()
    {
        $query = $this->Reservationsdetails->find()
            ->contain(['Reservations' => ['Clients'], 'Chalets', 'Tarifs']);
        $reservationsdetails = $this->paginate($query);

        $this->set(compact('reservationsdetails'));
    }


    public function add()
{
    $reservationsdetail = $this->Reservationsdetails->newEmptyEntity();

    if ($this->request->is('post')) {
        $reservationsdetail = $this->Reservationsdetails->patchEntity($reservationsdetail, $this->request->getData());

        if ($this->Reservationsdetails->save($reservationsdetail)) {
            $this->Flash->success(__('The reservation detail has been saved.'));

            // Redirect to reservation details table or index
            return $this->redirect(['action' => 'reservationsdetailstable', $reservationsdetail->reservation_id]);
        }

        $this->Flash->error(__('The reservation detail could not be saved. Please, try again.'));
    }

    $reservations = $this->Reservationsdetails->Reservations->find('list', ['limit' => 200])->all();
    $chalets = $this->Reservationsdetails->Chalets->find('list', ['limit' => 200])->all();
    $tarifs = $this->Reservationsdetails->Tarifs->find('list', ['limit' => 200])->all();

    $this->set(compact('reservationsdetail', 'reservations', 'chalets', 'tarifs'));
    $this->viewBuilder()->setLayout('dashboard'); // Optional: if you want dashboard layout
}


    public function edit($id = null)
    {
        $reservationsdetail = $this->Reservationsdetails->get($id, ['contain' => []]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $reservationsdetail = $this->Reservationsdetails->patchEntity($reservationsdetail, $this->request->getData());
            if ($this->Reservationsdetails->save($reservationsdetail)) {
                $this->Flash->success(__('The reservationsdetail has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The reservationsdetail could not be saved. Please, try again.'));
        }
        $reservations = $this->Reservationsdetails->Reservations->find('list', ['limit' => 200])->all();
        $chalets = $this->Reservationsdetails->Chalets->find('list', ['limit' => 200])->all();
        $tarifs = $this->Reservationsdetails->Tarifs->find('list', ['limit' => 200])->all();
        $this->set(compact('reservationsdetail', 'reservations', 'chalets', 'tarifs'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $reservationsdetail = $this->Reservationsdetails->get($id);
        if ($this->Reservationsdetails->delete($reservationsdetail)) {
            $this->Flash->success(__('The reservationsdetail has been deleted.'));
        } else {
            $this->Flash->error(__('The reservationsdetail could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function reservationsdetailstable($reservationId = null)
    {
        $details = $this->Reservationsdetails->find()
            ->where(['reservation_id' => $reservationId])
            ->contain(['Chalets', 'Tarifs', 'Reservations' => ['Clients']])
            ->all();

        $this->set(compact('details', 'reservationId'));
        $this->viewBuilder()->setLayout('dashboard');
    }

}
