<div class="user-table-section">
    <div class="top-bar">
        <h3 class="text-primary mb-0"><?= __('Tariff Management') /* Gestion des tarifs */ ?></h3>
        <?= $this->Html->link(__('+ New Tariff'), ['action' => 'add'], ['class' => 'btn-add-user']) ?>
    </div>

    <div class="table-responsive shadow-sm rounded">
        <table class="table table-striped table-bordered align-middle mb-0">
            <thead class="table-dark">
                <tr>
                    <th><?= $this->Paginator->sort('chalet_id', 'Chalet') ?></th>
                    <th><?= $this->Paginator->sort('date_debut', 'Start Date') ?></th>
                    <th><?= $this->Paginator->sort('date_fin', 'End Date') ?></th>
                    <th><?= $this->Paginator->sort('prix', 'Price') ?></th>
                    <th class="text-center"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tarifs as $tarif): ?>
                <tr>
                    <td><?= h($tarif->chalet_id) /* Ou si tu as la relation : $tarif->chalet->nom */ ?></td>
                    <td><?= h($tarif->date_debut->format('Y-m-d')) ?></td>
                    <td><?= h($tarif->date_fin->format('Y-m-d')) ?></td>
                    <td><?= $this->Number->format($tarif->prix, ['places' => 2]) ?></td>
                    <td class="text-center">
                        <?= $this->Html->link(
                            '<i class="fas fa-eye"></i> View',
                            ['action' => 'view', $tarif->id],
                            ['class' => 'btn-action btn-view', 'escape' => false]
                        ) ?>

                        <?= $this->Html->link(
                            '<i class="fas fa-edit"></i> Edit',
                            ['action' => 'edit', $tarif->id],
                            ['class' => 'btn-action btn-edit', 'escape' => false]
                        ) ?>

                        <?= $this->Form->postLink(
                            '<i class="fas fa-trash-alt"></i> Delete',
                            ['action' => 'delete', $tarif->id],
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
