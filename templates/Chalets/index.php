<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Chalet> $chalets
 */
?>
<div class="chalets index content">
    <?= $this->Html->link(__('New Chalet'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Chalets') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id_chalet') ?></th>
                    <th><?= $this->Paginator->sort('nom_chalet') ?></th>
                    <th><?= $this->Paginator->sort('type') ?></th>
                    <th><?= $this->Paginator->sort('capacite') ?></th>
                    <th><?= $this->Paginator->sort('prix_par_nuit') ?></th>
                    <th><?= $this->Paginator->sort('statut') ?></th>
                    <th><?= $this->Paginator->sort('photo') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($chalets as $chalet): ?>
                <tr>
                    <td><?= $this->Number->format($chalet->id_chalet) ?></td>
                    <td><?= h($chalet->nom_chalet) ?></td>
                    <td><?= h($chalet->type) ?></td>
                    <td><?= $this->Number->format($chalet->capacite) ?></td>
                    <td><?= $this->Number->format($chalet->prix_par_nuit) ?></td>
                    <td><?= h($chalet->statut) ?></td>
                    <td><?= h($chalet->photo) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $chalet->id_chalet]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $chalet->id_chalet]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $chalet->id_chalet],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $chalet->id_chalet),
                            ]
                        ) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>