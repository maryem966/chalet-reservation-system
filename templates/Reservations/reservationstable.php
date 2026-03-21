
<div class="user-table-section">

    <div class="top-bar">
        <h3 class="text-primary mb-0"><?= __('Reservation Management') ?></h3>
        <?= $this->Html->link(__('+ New Reservation'), ['action' => 'add'], ['class' => 'btn-add-user']) ?>
    </div>
<div class="search-bar">
    <?= $this->Form->create(null, ['type' => 'get', 'class' => 'search-form']) ?>
    
    <div class="form-row">


        <div class="form-group">
            <label for="client-name" class="nowrap-label">Client Name:</label>
            <?= $this->Form->text('client_name', [
                'id' => 'client-name',
                'value' => $this->request->getQuery('client_name'),
                'class' => 'form-input'
            ]) ?>
        </div>

        <div class="form-group">
            <label for="reservation-date">Reservation Date:</label>
            <?= $this->Form->control('date_reservation', [
                'type' => 'date',
                'label' => false,
                'id' => 'reservation-date',
                'value' => $this->request->getQuery('date_reservation'),
                'class' => 'form-input'
            ]) ?>
        </div>

        <div class="form-group">
            <label style="visibility:hidden">Search</label>
            <?= $this->Form->button('🔍 Search', ['class' => 'form-submit-btn']) ?>
        </div>
    </div>

    <?= $this->Form->end() ?>
</div> <br><br>



    <div class="table-responsive shadow-sm rounded">
        <table class="table table-striped table-bordered align-middle mb-0">
            <thead class="table-dark">
                <tr>
                    <th>Reservation Number</th> 

                    <th>Client Name</th>
                    <th><?= $this->Paginator->sort('date_reservation', 'Reservation Date') ?></th>
                    <th class="text-center"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reservations as $reservation): ?>
                <tr>
                    <td><?= h($reservation->numero) ?></td> 

                    <td><?= h($reservation->client->name ?? 'N/A') ?></td>

                    <?php
                    $localTimezone = new \DateTimeZone('Africa/Tunis');
                    $date = new \DateTime($reservation->date_reservation);
                    $date->setTimezone($localTimezone);
                    ?>
                    <td><?= h($date->format('Y-m-d H:i')) ?></td>
                    <td class="text-center">
                        <?= $this->Html->link(
                            '<i class="fas fa-eye"></i> View Details',
                            ['action' => 'view', $reservation->id], 
                            ['class' => 'btn-action btn-view', 'escape' => false]
                        ) ?>

                        <?= $this->Html->link(
                            '<i class="fas fa-edit"></i> Edit',
                            ['action' => 'edit', $reservation->id],
                            ['class' => 'btn-action btn-edit', 'escape' => false]
                        ) ?>

                        <?= $this->Html->link(
                            '<i class="fas fa-money-check-alt"></i> Payment',
                            [
                            'controller' => 'Reglements',
                            'action' => 'adding',
                            '?' => [
                            'client_id' => $reservation->client_id,
                            'montant' => $reservation->prix  // ✅ remplace "prix" si ton champ est nommé autrement
                            ]
                            ],
                            ['class' => 'btn-action btn-pay', 'escape' => false]
                            ) ?>


                        <?= $this->Form->postLink(
                            '<i class="fas fa-trash-alt"></i> Delete',
                            ['action' => 'delete', $reservation->id],
                            [
                                'class' => 'btn-action btn-delete',
                                'confirm' => 'Are you sure you want to delete?',
                                'escape' => false
                            ]
                        ) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<style>
.form-row {
    display: flex;
    gap: 2rem;
    align-items: center;
    flex-wrap: wrap;
}

.form-group {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.nowrap-label {
    white-space: nowrap;
}

.btn-pay {
    background-color: #28a745;
    color: white;
    padding: 6px 12px;
    border-radius: 5px;
    text-decoration: none;
}

.btn-pay:hover {
    background-color: #218838;
    color: white;
}

</style>