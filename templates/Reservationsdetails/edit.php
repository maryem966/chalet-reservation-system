<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Reservationsdetail $reservationsdetail
 * @var \Cake\Collection\CollectionInterface|string[] $reservations
 * @var \Cake\Collection\CollectionInterface|string[] $chalets
 * @var \Cake\Collection\CollectionInterface|string[] $tarifs
 */
?>

<div class="reservationsdetails form content">
    <?= $this->Form->create($reservationsdetail) ?>
    <fieldset>
        <legend><?= __('Modifier les Détails de Réservation') ?></legend>

        <?php
            echo $this->Form->control('reservation_id', [
                'label' => 'Réservation',
                'options' => $reservations,
                'empty' => '-- Sélectionner --'
            ]);
            echo $this->Form->control('chalet_id', [
                'label' => 'Chalet',
                'options' => $chalets,
                'empty' => '-- Sélectionner --'
            ]);
            echo $this->Form->control('tarif_id', [
                'label' => 'Tarif',
                'options' => $tarifs,
                'empty' => '-- Sélectionner --'
            ]);
            echo $this->Form->control('date_debut', [
                'label' => 'Date de début',
                'type' => 'date'
            ]);
            echo $this->Form->control('date_fin', [
                'label' => 'Date de fin',
                'type' => 'date'
            ]);
            echo $this->Form->control('nbr_personnes', [
                'label' => 'Nombre de personnes',
                'type' => 'number'
            ]);
        ?>
    </fieldset>

    <?= $this->Form->button(__('Enregistrer les modifications')) ?>
    <?= $this->Form->end() ?>
</div>
