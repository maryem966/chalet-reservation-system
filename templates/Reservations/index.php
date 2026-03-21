<div class="user-table-section">
    <div class="top-bar">
        <h3 class="text-primary mb-0"><?= __('Reservation Management') ?></h3>
        <?= $this->Html->link(__('+ New Reservation'), ['action' => 'add'], ['class' => 'btn-add-user']) ?>
    </div>

    <div class="table-responsive shadow-sm rounded">
        <table class="table table-striped table-bordered align-middle mb-0">
            <thead class="table-dark">
                <tr>
                    <th><?= $this->Paginator->sort('id', 'ID') ?></th>
                    <th><?= $this->Paginator->sort('client_id', 'Client ID') ?></th>
                    <th><?= $this->Paginator->sort('date_reservation', 'Reservation Date') ?></th>
                    <th class="text-center"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reservations as $reservation): ?>
                <tr>
                    <td><?= $this->Number->format($reservation->id) ?></td>
                    <td><?= h($reservation->client_id) ?></td>
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
