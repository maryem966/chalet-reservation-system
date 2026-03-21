<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Reglement> $reglements
 */
?>
<div class="reglements index content">
    <?= $this->Html->link(__('New Reglement'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Reglements') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('reservation_id') ?></th>
                    <th><?= $this->Paginator->sort('client_id') ?></th>
                    <th><?= $this->Paginator->sort('montant') ?></th>
                    <th><?= $this->Paginator->sort('date_reglement') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reglements as $reglement): ?>
                <tr>
                    <td><?= $this->Number->format($reglement->id) ?></td>
                    <td><?= $reglement->hasValue('reservation') ? $this->Html->link($reglement->reservation->id, ['controller' => 'Reservations', 'action' => 'view', $reglement->reservation->id]) : '' ?></td>
                    <td><?= $reglement->hasValue('client') ? $this->Html->link($reglement->client->name, ['controller' => 'Clients', 'action' => 'view', $reglement->client->id]) : '' ?></td>
                    <td><?= $this->Number->format($reglement->montant) ?></td>
                    <td><?= h($reglement->date_reglement) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $reglement->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $reglement->id]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $reglement->id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $reglement->id),
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