<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Reservationsdetail $reservationsdetail
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Reservationsdetail'), ['action' => 'edit', $reservationsdetail->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Reservationsdetail'), ['action' => 'delete', $reservationsdetail->id], ['confirm' => __('Are you sure you want to delete # {0}?', $reservationsdetail->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Reservationsdetails'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Reservationsdetail'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="reservationsdetails view content">
            <h3><?= h($reservationsdetail->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Reservation') ?></th>
                    <td><?= $reservationsdetail->hasValue('reservation') ? $this->Html->link($reservationsdetail->reservation->id, ['controller' => 'Reservations', 'action' => 'view', $reservationsdetail->reservation->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Chalet') ?></th>
                    <td><?= $reservationsdetail->hasValue('chalet') ? $this->Html->link($reservationsdetail->chalet->nom_chalet, ['controller' => 'Chalets', 'action' => 'view', $reservationsdetail->chalet->id_chalet]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Tarif') ?></th>
                    <td><?= $reservationsdetail->hasValue('tarif') ? $this->Html->link($reservationsdetail->tarif->id, ['controller' => 'Tarifs', 'action' => 'view', $reservationsdetail->tarif->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Statut') ?></th>
                    <td><?= h($reservationsdetail->statut) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($reservationsdetail->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Prix') ?></th>
                    <td><?= $this->Number->format($reservationsdetail->prix) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date Debut') ?></th>
                    <td><?= h($reservationsdetail->date_debut) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date Fin') ?></th>
                    <td><?= h($reservationsdetail->date_fin) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>