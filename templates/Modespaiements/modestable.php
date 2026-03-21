<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Collection\CollectionInterface $modespaiements
 */
?>
<div class="user-table-section">
    <div class="top-bar">
        <h3 class="text-primary mb-0"><?= __('Payment Methods Management') /* Gestion des modes de paiement */ ?></h3>
        <?= $this->Html->link(__('+ New Method'), ['action' => 'add'], ['class' => 'btn-add-user']) ?>
    </div>

    <div class="table-responsive shadow-sm rounded">
        <table class="table table-striped table-bordered align-middle mb-0">
            <thead class="table-dark">
                <tr>
                    <th> Payment Method</th>
                    <th class="text-center"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($modespaiements as $mode): ?>
                <tr>
                    <td><?= h($mode->nom) ?></td>
                    <td class="text-center">
                        <?= $this->Html->link(
                            '<i class="fas fa-eye"></i> View',
                            ['action' => 'view', $mode->id],
                            ['class' => 'btn-action btn-view', 'escape' => false]
                        ) ?>

                        <?= $this->Html->link(
                            '<i class="fas fa-edit"></i> Edit',
                            ['action' => 'edit', $mode->id],
                            ['class' => 'btn-action btn-edit', 'escape' => false]
                        ) ?>

                        <?= $this->Form->postLink(
                            '<i class="fas fa-trash-alt"></i> Delete',
                            ['action' => 'delete', $mode->id],
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
