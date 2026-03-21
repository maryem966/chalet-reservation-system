<?php
declare(strict_types=1);

namespace App\Controller;

class ReglementsController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('Flash');
    }

    /**
     * Index method - paginated list
     */
    public function index()
    {
        $query = $this->Reglements->find('all')->contain(['Clients', 'Reservations']);
        $reglements = $this->paginate($query);
        $this->set(compact('reglements'));
        $this->viewBuilder()->setLayout('dashboard');
    }

    /**
     * View method - view single reglement
     */
    public function view($id = null)
    {
        
    $reglement = $this->Reglements->get($id, [
    'contain' => ['Clients', 'Piecesreglements' => ['Modespaiements']]
]);

        $this->set(compact('reglement'));
        $this->viewBuilder()->setLayout('dashboard');
    }

    /**
     * Add method - add new reglement */
public function add()
{
    $localTimezone = new \DateTimeZone('Africa/Tunis');
    $utcTimezone = new \DateTimeZone('UTC');

    $reglement = $this->Reglements->newEmptyEntity();

    // Pré-remplissage si réservation liée
    $reservationId = $this->request->getQuery('reservation_id');
    if ($reservationId) {
        $reservation = $this->Reglements->Reservations->get($reservationId, ['contain' => ['Clients']]);
        $reglement->reservation_id = $reservation->id;
        $reglement->client_id = $reservation->client_id;
    }

    if ($this->request->is('post')) {
        $data = $this->request->getData();

        // Convertir la date en UTC
        if (!empty($data['date_reglement'])) {
            $dt = new \DateTime($data['date_reglement'], $localTimezone);
            $dt->setTimezone($utcTimezone);
            $data['date_reglement'] = $dt->format('Y-m-d H:i:s');
        }

        $reglement = $this->Reglements->patchEntity($reglement, $data);

        if ($this->Reglements->save($reglement)) {
            $piecesData = $data['piecesreglements'][0] ?? [];

            $piecesreglementsTable = $this->fetchTable('Piecesreglements');
            $piecesreglement = $piecesreglementsTable->newEmptyEntity();

            $piecesreglement->reglement_id = $reglement->id;
            $piecesreglement->montant = $reglement->montant;
            $piecesreglement->modespaiement_id = $piecesData['modespaiement_id'] ?? null;

            // Champs optionnels
            $piecesreglement->proof_file = $piecesData['proof_file'] ?? null;
            $piecesreglement->account_holder = $piecesData['account_holder'] ?? null;
            $piecesreglement->bank_name = $piecesData['bank_name'] ?? null;
            $piecesreglement->iban_number = $piecesData['iban_number'] ?? null;
            $piecesreglement->card_holder_name = $piecesData['card_holder_name'] ?? null;
            $piecesreglement->card_number = $piecesData['card_number'] ?? null;
            $piecesreglement->card_expiry = $piecesData['card_expiry'] ?? null;
            $piecesreglement->card_cvv = $piecesData['card_cvv'] ?? null;
            $piecesreglement->cheque_number = $piecesData['cheque_number'] ?? null;
            $piecesreglement->cheque_bank_name = $piecesData['cheque_bank_name'] ?? null;
            $piecesreglement->cheque_holder = $piecesData['cheque_holder'] ?? null;

            if ($piecesreglementsTable->save($piecesreglement)) {
                return $this->redirect(['action' => 'reglementstable']);
            } else {
                $this->Flash->error(__('فشل Save تفاصيل وسيلة Payment.'));
            }
        } else {
            $this->Flash->error(__('فشل Save Paymentة.'));
            debug($reglement->getErrors());
        }
    }

    // Définir date actuelle (Tunis timezone)
    $now = new \DateTime('now', $localTimezone);
    $reglement->date_reglement = $now->format('Y-m-d\TH:i');

    $clients = $this->Reglements->Clients->find('list')->toArray();
    $reservations = $this->Reglements->Reservations->find('list')->toArray();
    $modespaiements = $this->Reglements->Modespaiements->find('list')->toArray();

    $this->set(compact('reglement', 'clients', 'reservations', 'modespaiements'));
    $this->viewBuilder()->setLayout('dashboard');
}


    /**
     * Edit method - modify existing reglement
     */
public function edit($id = null)
{
    $localTimezone = new \DateTimeZone('Africa/Tunis');
    $utcTimezone = new \DateTimeZone('UTC');

    // Charger le règlement avec sa pièce de règlement associée
    $reglement = $this->Reglements->get($id, [
        'contain' => ['Piecesreglements']
    ]);

    if ($this->request->is(['patch', 'post', 'put'])) {
        $data = $this->request->getData();

        // Convertir la date de paiement en UTC
        if (!empty($data['date_reglement'])) {
            $dt = new \DateTime($data['date_reglement'], $localTimezone);
            $dt->setTimezone($utcTimezone);
            $data['date_reglement'] = $dt->format('Y-m-d H:i:s');
        }

        $reglement = $this->Reglements->patchEntity($reglement, $data);

        if ($this->Reglements->save($reglement)) {
            $piecesData = $data['piecesreglements'][0] ?? [];

            $piecesreglementsTable = $this->fetchTable('Piecesreglements');

            // Modifier l'existante ou en créer une nouvelle
            $existingPiece = $reglement->piecesreglements[0] ?? $piecesreglementsTable->newEmptyEntity();

            $existingPiece->reglement_id = $reglement->id;
            $existingPiece->montant = $reglement->montant;
            $existingPiece->modespaiement_id = $piecesData['modespaiement_id'] ?? null;

            // Champs supplémentaires
            $existingPiece->proof_file = $piecesData['proof_file'] ?? null;
            $existingPiece->account_holder = $piecesData['account_holder'] ?? null;
            $existingPiece->bank_name = $piecesData['bank_name'] ?? null;
            $existingPiece->iban_number = $piecesData['iban_number'] ?? null;
            $existingPiece->card_holder_name = $piecesData['card_holder_name'] ?? null;
            $existingPiece->card_number = $piecesData['card_number'] ?? null;
            $existingPiece->card_expiry = $piecesData['card_expiry'] ?? null;
            $existingPiece->card_cvv = $piecesData['card_cvv'] ?? null;
            $existingPiece->cheque_number = $piecesData['cheque_number'] ?? null;
            $existingPiece->cheque_bank_name = $piecesData['cheque_bank_name'] ?? null;
            $existingPiece->cheque_holder = $piecesData['cheque_holder'] ?? null;

            if ($piecesreglementsTable->save($existingPiece)) {
                return $this->redirect(['action' => 'reglementstable']);
            } else {
                $this->Flash->error(__('فشل Save تفاصيل وسيلة Payment.'));
            }
        } else {
            $this->Flash->error(__('فشل Save Paymentة.'));
        }
    }

    // Préparer la date en format pour input type datetime-local
    if ($reglement->date_reglement instanceof \Cake\I18n\FrozenTime) {
        $reglement->date_reglement = $reglement->date_reglement
            ->setTimezone($localTimezone)
            ->format('Y-m-d\TH:i');
    }

    $clients = $this->Reglements->Clients->find('list')->toArray();
    $reservations = $this->Reglements->Reservations->find('list')->toArray();
    $modespaiements = $this->Reglements->Modespaiements->find('list')->toArray();

    $this->set(compact('reglement', 'clients', 'reservations', 'modespaiements'));
    $this->viewBuilder()->setLayout('dashboard');
}


    /**
     * Delete method - remove reglement
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $reglement = $this->Reglements->get($id);
        if (!$this->Reglements->delete($reglement)) {
            $this->Flash->error(__('لم يتم Delete Payment. حاول مرة أخرى.'));
        }
        return $this->redirect(['action' => 'reglementstable']);
    }

    /**
     * Dashboard method
     */
    public function dashboard()
    {
        if (!$this->request->getSession()->check('User')) {
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }

        $user = $this->request->getSession()->read('User');
        $reglements = $this->paginate($this->Reglements->find()->contain(['Clients', 'Reservations']));
        
        $this->set(compact('user', 'reglements'));
        $this->viewBuilder()->setLayout('dashboard');
    }

    /**
     * Reglement Table view
     */
    public function reglementstable()
    {
        $user = $this->request->getSession()->read('User');
        $reglements = $this->paginate($this->Reglements->find()->contain(['Clients', 'Reservations' ]));

        $this->set(compact('user', 'reglements'));
        $this->viewBuilder()->setLayout('dashboard');
    }
    
    
    public function print($id)
    {
    $reglement = $this->Reglements->get($id, [
        'contain' => ['Clients', 'Piecesreglements.Modespaiements']
    ]);

    $this->set(compact('reglement'));
    $this->viewBuilder()->setLayout('dashboard');
     }



public function adding()
{
    $localTimezone = new \DateTimeZone('Africa/Tunis');
    $utcTimezone = new \DateTimeZone('UTC');

    // Create new empty Reglement entity
    $reglement = $this->Reglements->newEmptyEntity();

    // Read GET parameters for pre-filling the form
    $reservationId = $this->request->getQuery('reservation_id');
    $clientId = $this->request->getQuery('client_id');
    $montant = $this->request->getQuery('montant');

    // Use fetchTable to access Reservations without loadModel
    $ReservationsTable = $this->fetchTable('Reservations');

    // Pre-fill reservation_id and client_id and montant if possible
    if ($reservationId) {
        $reservation = $ReservationsTable->get($reservationId, [
            'contain' => ['Clients']
        ]);
        $reglement->reservation_id = $reservation->id;
        $reglement->client_id = $reservation->client_id;

        if ($montant === null) {
            $montant = $reservation->overall_total;
        }
    } elseif ($clientId) {
        $reglement->client_id = $clientId;

        // Try to get last reservation for this client to get montant if not provided
        if ($montant === null) {
            $reservation = $ReservationsTable->find()
                ->where(['client_id' => $clientId])
                ->order(['date_reservation' => 'DESC'])
                ->first();

            if ($reservation) {
                $reglement->reservation_id = $reservation->id;
                $montant = $reservation->overall_total;
            }
        }
    }

    // Set montant if available, cast to float
    if ($montant !== null) {
        $reglement->montant = (float)$montant;
    }

    if ($this->request->is('post')) {
        $data = $this->request->getData();



        

        // Convert local date_reglement to UTC for saving
        if (!empty($data['date_reglement'])) {
            $dt = new \DateTime($data['date_reglement'], $localTimezone);
            $dt->setTimezone($utcTimezone);
            $data['date_reglement'] = $dt->format('Y-m-d H:i:s');
        }

         $reglement = $this->Reglements->patchEntity($reglement, $data);

        if ($this->Reglements->save($reglement)) {
            $piecesData = $data['piecesreglements'][0] ?? [];

            $piecesreglementsTable = $this->fetchTable('Piecesreglements');
            $piecesreglement = $piecesreglementsTable->newEmptyEntity();

            $piecesreglement->reglement_id = $reglement->id;
            $piecesreglement->montant = $reglement->montant;
            $piecesreglement->modespaiement_id = $piecesData['modespaiement_id'] ?? null;

            // Champs optionnels
            $piecesreglement->proof_file = $piecesData['proof_file'] ?? null;
            $piecesreglement->account_holder = $piecesData['account_holder'] ?? null;
            $piecesreglement->bank_name = $piecesData['bank_name'] ?? null;
            $piecesreglement->iban_number = $piecesData['iban_number'] ?? null;
            $piecesreglement->card_holder_name = $piecesData['card_holder_name'] ?? null;
            $piecesreglement->card_number = $piecesData['card_number'] ?? null;
            $piecesreglement->card_expiry = $piecesData['card_expiry'] ?? null;
            $piecesreglement->card_cvv = $piecesData['card_cvv'] ?? null;
            $piecesreglement->cheque_number = $piecesData['cheque_number'] ?? null;
            $piecesreglement->cheque_bank_name = $piecesData['cheque_bank_name'] ?? null;
            $piecesreglement->cheque_holder = $piecesData['cheque_holder'] ?? null;

            if ($piecesreglementsTable->save($piecesreglement)) {
                return $this->redirect(['action' => 'reglementstable']);
            } else {
                $this->Flash->error(__('فشل Save تفاصيل وسيلة Payment.'));
            }
        } else {
            $this->Flash->error(__('فشل Save Paymentة.'));
            debug($reglement->getErrors());
        }
    }

    // Définir date actuelle (Tunis timezone)
    $now = new \DateTime('now', $localTimezone);
    $reglement->date_reglement = $now->format('Y-m-d\TH:i');

    $clients = $this->Reglements->Clients->find('list')->toArray();
    $reservations = $this->Reglements->Reservations->find('list')->toArray();
    $modespaiements = $this->Reglements->Modespaiements->find('list')->toArray();

    $this->set(compact('reglement', 'clients', 'reservations', 'modespaiements'));
    $this->viewBuilder()->setLayout('dashboard');
}







}