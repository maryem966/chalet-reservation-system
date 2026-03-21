<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Tarif> $tarifs
 */
?>
<div class="tarifs index content">
    <?= $this->Html->link(__('New Tarif'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Tarifs') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('chalet_id') ?></th>
                    <th><?= $this->Paginator->sort('date_debut') ?></th>
                    <th><?= $this->Paginator->sort('date_fin') ?></th>
                    <th><?= $this->Paginator->sort('prix') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tarifs as $tarif): ?>
                <tr>
                    <td><?= $this->Number->format($tarif->id) ?></td>
                    <td><?= $tarif->hasValue('chalet') ? $this->Html->link($tarif->chalet->nom_chalet, ['controller' => 'Chalets', 'action' => 'view', $tarif->chalet->id_chalet]) : '' ?></td>
                    <td><?= h($tarif->date_debut) ?></td>
                    <td><?= h($tarif->date_fin) ?></td>
                    <td><?= $this->Number->format($tarif->prix) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $tarif->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $tarif->id]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $tarif->id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $tarif->id),
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