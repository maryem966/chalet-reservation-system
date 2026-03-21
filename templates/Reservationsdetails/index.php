<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Reservationsdetail> $reservationsdetails
 */
?>
<div class="reservationsdetails index content">
    <?= $this->Html->link(__('New Reservationsdetail'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Reservationsdetails') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('reservation_id') ?></th>
                    <th><?= $this->Paginator->sort('chalet_id') ?></th>
                    <th><?= $this->Paginator->sort('tarif_id') ?></th>
                    <th><?= $this->Paginator->sort('date_debut') ?></th>
                    <th><?= $this->Paginator->sort('date_fin') ?></th>
                    <th><?= $this->Paginator->sort('prix') ?></th>
                    <th><?= $this->Paginator->sort('statut') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reservationsdetails as $reservationsdetail): ?>
                <tr>
                    <td><?= $this->Number->format($reservationsdetail->id) ?></td>
                    <td><?= $reservationsdetail->hasValue('reservation') ? $this->Html->link($reservationsdetail->reservation->id, ['controller' => 'Reservations', 'action' => 'view', $reservationsdetail->reservation->id]) : '' ?></td>
                    <td><?= $reservationsdetail->hasValue('chalet') ? $this->Html->link($reservationsdetail->chalet->nom_chalet, ['controller' => 'Chalets', 'action' => 'view', $reservationsdetail->chalet->id_chalet]) : '' ?></td>
                    <td><?= $reservationsdetail->hasValue('tarif') ? $this->Html->link($reservationsdetail->tarif->id, ['controller' => 'Tarifs', 'action' => 'view', $reservationsdetail->tarif->id]) : '' ?></td>
                    <td><?= h($reservationsdetail->date_debut) ?></td>
                    <td><?= h($reservationsdetail->date_fin) ?></td>
                    <td><?= $this->Number->format($reservationsdetail->prix) ?></td>
                    <td><?= h($reservationsdetail->statut) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $reservationsdetail->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $reservationsdetail->id]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $reservationsdetail->id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $reservationsdetail->id),
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