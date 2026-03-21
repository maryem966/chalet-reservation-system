<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Societe> $societes
 */
?>
<div class="societes index content">
    <?= $this->Html->link(__('New Societe'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Societes') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('nom') ?></th>
                    <th><?= $this->Paginator->sort('telephone') ?></th>
                    <th><?= $this->Paginator->sort('fax') ?></th>
                    <th><?= $this->Paginator->sort('email') ?></th>
                    <th><?= $this->Paginator->sort('adress') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($societes as $societe): ?>
                <tr>
                    <td><?= $this->Number->format($societe->id) ?></td>
                    <td><?= h($societe->nom) ?></td>
                    <td><?= h($societe->telephone) ?></td>
                    <td><?= h($societe->fax) ?></td>
                    <td><?= h($societe->email) ?></td>
                    <td><?= h($societe->adress) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $societe->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $societe->id]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $societe->id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $societe->id),
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