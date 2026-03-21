<div id="chalet-management-section" class="user-table-section">
    <div class="top-bar">
        <h3 class="text-primary mb-0"><?= __('Chalet Management') ?></h3>
        <?= $this->Html->link(__('+ New Chalet'), ['action' => 'add'], ['class' => 'btn-add-user']) ?>
    </div>

    <div class="table-responsive shadow-sm rounded">
        <table class="table table-striped table-bordered align-middle mb-0">
            <thead class="table-dark">
                <tr>
                    <th><?= $this->Paginator->sort('nom_chalet', 'Chalet Name') ?></th>
                    <th><?= $this->Paginator->sort('code', 'Chalet Code') ?></th> <!-- ✅ Nouvelle colonne -->
                    <th><?= $this->Paginator->sort('typechalet_id', 'Type') ?></th>
                    <th><?= $this->Paginator->sort('capacite', 'Capacity') ?></th>
                    <th><?= $this->Paginator->sort('prix_par_nuit', 'Price/Night') ?></th>
                    <th><?= $this->Paginator->sort('statut', 'Status') ?></th>
                    <th><?= $this->Paginator->sort('description', 'Description') ?></th>
                    <th><?= __('Image') ?></th>
                    <th class="text-center"><?= __('Actions') ?></th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($chalets as $chalet): ?>
                <tr>
                    <td><?= h($chalet->nom_chalet) ?></td>
                    <td><?= h($chalet->code) ?></td> <!-- ✅ Affichage du code -->
                    <td><?= h($chalet->typechalet->name ?? 'Unspecified') ?></td>
                    <td><?= h($chalet->capacite) ?></td>
                    <td><?= h($chalet->prix_par_nuit) ?> د.م</td>
                    <td>
                        <?php
                            $statutDisplay = [
                                'Disponible' => 'Available',
                                'Réservé' => 'Reserved',
                                'Maintenance' => 'Under Maintenance'
                            ];
                        ?>
                        <span class="badge bg-secondary"><?= h($statutDisplay[$chalet->statut] ?? $chalet->statut) ?></span>
                    </td>
                    <td><?= h($chalet->description) ?></td>
                    <td>
                        <?php if (!empty($chalet->photo)): ?>
                            <?= $this->Html->image('chalets/' . $chalet->photo, [
                                'alt' => 'photo',
                                'style' => 'max-height: 50px; max-width: 80px;',
                                'class' => 'img-thumbnail'
                            ]) ?>
                        <?php else: ?>
                            <span class="text-muted">No image available</span>
                        <?php endif; ?>
                    </td>
                    <td class="text-center">
                        <?= $this->Html->link(
                            '<i class="fas fa-eye"></i> View',
                            ['action' => 'view', $chalet->id_chalet],
                            ['class' => 'btn-action btn-view', 'escape' => false]
                        ) ?>

                        <?= $this->Html->link(
                            '<i class="fas fa-edit"></i> Edit',
                            ['action' => 'edit', $chalet->id_chalet],
                            ['class' => 'btn-action btn-edit', 'escape' => false]
                        ) ?>

                        <?= $this->Form->postLink(
                            '<i class="fas fa-trash-alt"></i> Delete',
                            ['action' => 'delete', $chalet->id_chalet],
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
