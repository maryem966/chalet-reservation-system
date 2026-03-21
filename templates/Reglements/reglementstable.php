<div class="user-table-section">
    <div class="top-bar">
        <h3 class="text-primary mb-0"><?= __('Payments Management') /* Gestion des règlements */ ?></h3>
        <?= $this->Html->link(__('+ New Payment'), ['action' => 'add'], ['class' => 'btn-add-user']) ?>
    </div>

    <div class="table-responsive shadow-sm rounded">
        <table class="table table-striped table-bordered align-middle mb-0">
            <thead class="table-dark">
                <tr>
                    <th>Client Name</th>
                    <th>Paid Amount</th>
                    <th>Payment Date</th>
                    <th class="text-center"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reglements as $reglement): ?>
                <tr>
                    <td><?= h($reglement->client->name ?? 'N/A') ?></td>
                    <td><?= $this->Number->format($reglement->montant, ['places' => 2]) ?> د.ت</td>
                    <td><?= h($reglement->date_reglement->format('Y-m-d H:i')) ?></td>

                    <td class="text-center">
                        <?= $this->Html->link(
                            '<i class="fas fa-eye"></i> View',
                            ['action' => 'view', $reglement->id],
                            ['class' => 'btn-action btn-view', 'escape' => false]
                        ) ?>

                        <?= $this->Html->link(
                            '<i class="fas fa-edit"></i> Edit',
                            ['action' => 'edit', $reglement->id],
                            ['class' => 'btn-action btn-edit', 'escape' => false]
                        ) ?>

                        <?= $this->Form->postLink(
                            '<i class="fas fa-trash-alt"></i> Delete',
                            ['action' => 'delete', $reglement->id],
                            [
                                'class' => 'btn-action btn-delete',
                                'confirm' => 'Are you sure you want to delete?',
                                'escape' => false
                            ]
                        ) ?>
                        <?= $this->Html->link(
                            '<i class="fas fa-print"></i> Print',
                            ['action' => 'print', $reglement->id],
                            ['class' => 'btn-action btn-print', 'escape' => false]
                        ) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<style>.btn-print {
    background-color: #28a745;
    color: white;
    padding: 6px 12px;
    border-radius: 5px;
    text-decoration: none;
}

.btn-print:hover {
    background-color: #218838;
    color: white;
}
</style>
