<div class="user-table-section">
    <div class="top-bar">
        <h3 class="text-primary mb-0"><?= __('Company Management') ?></h3>
        <?= $this->Html->link(__('+ New Company'), ['action' => 'add'], ['class' => 'btn-add-user']) ?>
    </div>

    <div class="table-responsive shadow-sm rounded">
        <table class="table table-striped table-bordered align-middle mb-0">
            <thead class="table-dark">
                <tr>
                    <th><?= $this->Paginator->sort('id', 'ID') ?></th>
                    <th><?= $this->Paginator->sort('nom', 'Name') ?></th>
                    <th><?= __('Logo') ?></th> <!-- ✅ Colonne ajoutée -->
                    <th><?= $this->Paginator->sort('adresse', 'Address') ?></th>
                    <th><?= $this->Paginator->sort('telephone', 'Phone') ?></th>
                    <th><?= $this->Paginator->sort('fax', 'Fax') ?></th>
                    <th><?= $this->Paginator->sort('email', 'Email') ?></th>
                    <th class="text-center"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($societes as $societe): ?>
                <tr>
                    <td><?= $this->Number->format($societe->id) ?></td>
                    <td><?= h($societe->nom) ?></td>

                    <!-- ✅ Affichage du logo -->
                    <td>
                        <?php if (!empty($societe->logo)) : ?>
                            <?= $this->Html->image('logos/' . $societe->logo, [
                                'alt' => 'Logo',
                                'style' => 'max-height: 50px; max-width: 80px;',
                                'class' => 'img-thumbnail'
                            ]) ?>
                        <?php else : ?>
                            <span class="text-muted">No logo available</span>
                        <?php endif; ?>
                    </td>

                    <td><?= h($societe->adresse) ?></td>
                    <td><?= h($societe->telephone) ?></td>
                    <td><?= h($societe->fax) ?></td>
                    <td><?= h($societe->email) ?></td>
                    <td class="text-center">
                        <?= $this->Html->link(
                            '<i class="fas fa-eye"></i> View',
                            ['action' => 'view', $societe->id],
                            ['class' => 'btn-action btn-view', 'escape' => false]
                        ) ?>

                        <?= $this->Html->link(
                            '<i class="fas fa-edit"></i> Edit',
                            ['action' => 'edit', $societe->id],
                            ['class' => 'btn-action btn-edit', 'escape' => false]
                        ) ?>

                        <?= $this->Form->postLink(
                            '<i class="fas fa-trash-alt"></i> Delete',
                            ['action' => 'delete', $societe->id],
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
