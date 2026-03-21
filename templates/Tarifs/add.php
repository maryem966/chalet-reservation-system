<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Tarif $tarif
 * @var \Cake\Collection\CollectionInterface|string[] $chalets
 */
?>

<div class="user-form-box">
    <h2 class="form-box-title">Add New Tariff</h2>

    <?= $this->Form->create($tarif, ['class' => 'styled-tarif-form']) ?>

    <div class="form-row">
        <?= $this->Form->label('chalet_id', 'Chalet') ?>
        <?= $this->Form->control('chalet_id', [
            'options' => $chalets,
            'empty' => '-- Select شاليه --',
            'label' => false,
            'class' => 'form-input'
        ]) ?>
    </div>

    <div class="form-row">
        <?= $this->Form->label('date_debut', 'Start Date') ?>
        <?= $this->Form->control('date_debut', [
            'type' => 'date',
            'label' => false,
            'class' => 'form-input'
        ]) ?>
    </div>

    <div class="form-row">
        <?= $this->Form->label('date_fin', 'End Date') ?>
        <?= $this->Form->control('date_fin', [
            'type' => 'date',
            'label' => false,
            'class' => 'form-input'
        ]) ?>
    </div>

    <div class="form-row">
        <?= $this->Form->label('prix', 'Price') ?>
        <?= $this->Form->control('prix', [
            'type' => 'number',
            'step' => '0.01',
            'label' => false,
            'class' => 'form-input'
        ]) ?>
    </div>

    <div class="form-actions">
        <?= $this->Form->button('Add', ['class' => 'form-submit-btn']) ?>
    </div>

    <?= $this->Form->end() ?>
</div>
