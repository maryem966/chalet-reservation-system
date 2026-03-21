<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\ORM\TableRegistry;

class ReservationsController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('Flash');
        $this->Clients = $this->getTableLocator()->get('Clients');
        $this->Reservationsdetails = $this->getTableLocator()->get('Reservationsdetails');
        $this->Chalets = $this->getTableLocator()->get('Chalets');
    }

    public function index()
    {
        $query = $this->Reservations->find()
            ->contain(['Clients', 'Reservationsdetails' => ['Chalets']]);

        $reservations = $this->paginate(
            $this->Reservations->find()->contain(['Clients']));

        $this->set(compact('reservations'));
        $this->viewBuilder()->setLayout('dashboard');
    }

    public function view($id = null)
    {
        if (!$id) {
            $this->Flash->error('ID مفقود.');
            return $this->redirect(['action' => 'index']);
        }

        $reservation = $this->Reservations->get($id, [
            'contain' => ['Clients', 'Reservationsdetails' => ['Chalets', 'Tarifs']]
        ]);

        $this->set(compact('reservation'));
        $this->viewBuilder()->setLayout('dashboard');
    }

    public function add()
    {
        $localTimezone = new \DateTimeZone('Africa/Tunis');
        $utcTimezone = new \DateTimeZone('UTC');

        $reservation = $this->Reservations->newEmptyEntity();

            $lastReservation = $this->Reservations->find()
        ->select(['numero'])
        ->order(['numero' => 'DESC'])
        ->first();

    $nextNumero = $lastReservation ? $lastReservation->numero + 1 : 1;
    $reservation->numero = $nextNumero; 

        if ($this->request->is('post')) {
            $data = $this->request->getData();

            if (!empty($data['date_reservation'])) {
                $dt = new \DateTime($data['date_reservation'], $localTimezone);
                $dt->setTimezone($utcTimezone);
                $data['date_reservation'] = $dt->format('Y-m-d H:i:s');
            }

            $reservation = $this->Reservations->patchEntity($reservation, $data, [
                'associated' => ['Reservationsdetails']
            ]);

            if ($this->Reservations->save($reservation)) {
                $this->Flash->success(__('تم Save الحجز بنجاح.'));
                return $this->redirect(['action' => 'reservationstable']);
            }

            $this->Flash->error(__('فشل في Save الحجز. حاول مرة أخرى.'));
        }

        $currentDateTime = new \DateTime('now', $localTimezone);
        $reservation->date_reservation = $currentDateTime->format('Y-m-d\TH:i');
        $reservation->overall_total = $this->request->getData('overall_total');

        $clients = $this->Reservations->Clients->find('list', ['limit' => 200]);

        $reservationsDetailsTable = TableRegistry::getTableLocator()->get('Reservationsdetails');

        $chalets = $reservationsDetailsTable->Chalets->find('list', [
            'keyField' => 'id_chalet',
            'valueField' => 'nom_chalet'
        ])->toArray();

        $chaletPrices = $reservationsDetailsTable->Chalets->find('list', [
            'keyField' => 'id_chalet',
            'valueField' => 'prix_par_nuit'
        ])->toArray();

        $tarifEntities = $reservationsDetailsTable->Tarifs->find()->toArray();

        $tarifs = [];
        foreach ($tarifEntities as $tarif) {
            $tarifs[] = [
                'chalet_id' => $tarif->chalet_id,
                'date_debut' => $tarif->date_debut->format('Y-m-d'),
                'date_fin' => $tarif->date_fin->format('Y-m-d'),
                'prix' => $tarif->prix
            ];
        }

        $this->set(compact(
            'reservation',
            'clients',
            'chalets',
            'chaletPrices',
            'tarifs'
        ));

        $this->viewBuilder()->setLayout('dashboard');
    }

    public function edit($id = null)
    {
        $localTimezone = new \DateTimeZone('Africa/Tunis');
        $utcTimezone = new \DateTimeZone('UTC');

        $reservation = $this->Reservations->get($id, [
            'contain' => ['Reservationsdetails']
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();

            if (!empty($data['date_reservation'])) {
                $dt = new \DateTime($data['date_reservation'], $localTimezone);
                $dt->setTimezone($utcTimezone);
                $data['date_reservation'] = $dt->format('Y-m-d H:i:s');
            }

            $reservation = $this->Reservations->patchEntity($reservation, $data);

            if ($this->Reservations->save($reservation)) {
                $reservationsDetailsTable = TableRegistry::getTableLocator()->get('Reservationsdetails');
                $reservationsDetailsTable->deleteAll(['reservation_id' => $reservation->id]);

                if (!empty($data['reservationsdetails'])) {
                    foreach ($data['reservationsdetails'] as $detail) {
                        $detail['reservation_id'] = $reservation->id;
                        $detailEntity = $reservationsDetailsTable->newEmptyEntity();
                        $detailEntity = $reservationsDetailsTable->patchEntity($detailEntity, $detail);
                        $reservationsDetailsTable->save($detailEntity);
                    }
                }

                return $this->redirect(['action' => 'reservationstable']);
            }

            $this->Flash->error(__('فشل في Update الحجز. حاول مرة أخرى.'));
        }

        if ($reservation->date_reservation) {
            $reservation->date_reservation = $reservation->date_reservation
                ->setTimezone($localTimezone)
                ->format('Y-m-d\TH:i');
        }

        $clients = $this->Reservations->Clients->find('list', ['limit' => 200]);

        $reservationsDetailsTable = TableRegistry::getTableLocator()->get('Reservationsdetails');

        $chalets = $reservationsDetailsTable->Chalets->find('list', [
            'keyField' => 'id_chalet',
            'valueField' => 'nom_chalet'
        ])->toArray();

        $tarifEntities = $reservationsDetailsTable->Tarifs->find()->toArray();

        $tarifs = [];
        foreach ($tarifEntities as $tarif) {
            $tarifs[] = [
                'chalet_id' => $tarif->chalet_id,
                'date_debut' => $tarif->date_debut->format('Y-m-d'),
                'date_fin' => $tarif->date_fin->format('Y-m-d'),
                'prix' => $tarif->prix
            ];
        }

        $this->set(compact('reservation', 'clients', 'chalets', 'tarifs'));
        $this->viewBuilder()->setLayout('dashboard');
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $reservation = $this->Reservations->get($id);

        if (!$this->Reservations->delete($reservation)) {
            $this->Flash->error(__('تعذر Delete الحجز. حاول مرة أخرى.'));
        }

        return $this->redirect(['action' => 'reservationstable']);
    }

    public function reservationstable()
    {
        $query = $this->Reservations->find()
            ->contain(['Clients', 'Reservationsdetails' => ['Chalets']]);

        // Apply filters if available
        $clientName = $this->request->getQuery('client_name');
        $dateReservation = $this->request->getQuery('date_reservation');

        if (!empty($clientName)) {
            $query->matching('Clients', function ($q) use ($clientName) {
                return $q->where(['Clients.name LIKE' => '%' . $clientName . '%']);
            });
        }

        if (!empty($dateReservation)) {
            $query->where(function ($exp, $q) use ($dateReservation) {
                return $exp->like('Reservations.date_reservation', $dateReservation . '%');
            });
        }

        $reservations = $this->paginate($query);

        $user = $this->request->getSession()->read('User');
        $this->set(compact('reservations', 'user'));
        $this->viewBuilder()->setLayout('dashboard');
    }

}
