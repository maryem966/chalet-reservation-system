<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Societe $societe
 */
?>

<div class="user-form-box">
    <h2 class="form-box-title">Edit Company Information</h2>

    <?= $this->Form->create($societe, ['class' => 'styled-user-form']) ?>

    <div class="form-row">
        <?= $this->Form->label('nom', 'Name') ?>
        <?= $this->Form->control('nom', ['label' => false, 'class' => 'form-input']) ?>
    </div>

    <div class="form-row">
        <?= $this->Form->label('adresse', 'Address') ?>
        <?= $this->Form->control('adresse', ['label' => false, 'class' => 'form-input']) ?>
    </div>

    <div class="form-row">
        <?= $this->Form->label('telephone', 'Phone') ?>
        <?= $this->Form->control('telephone', ['label' => false, 'class' => 'form-input']) ?>
    </div>

    <div class="form-row">
        <?= $this->Form->label('fax', 'Fax') ?>
        <?= $this->Form->control('fax', ['label' => false, 'class' => 'form-input']) ?>
    </div>

    <div class="form-row">
        <?= $this->Form->label('email', 'Email') ?>
        <?= $this->Form->control('email', ['label' => false, 'class' => 'form-input']) ?>
    </div>

    <div class="form-row">
        <?= $this->Form->label('adress', 'Detailed Address') ?>
        <?= $this->Form->control('adress', ['label' => false, 'class' => 'form-input']) ?>
    </div>

    <div class="form-actions">
        <?= $this->Html->link('Back', ['action' => 'societestable'], ['class' => 'btn-back']) ?>
        <?= $this->Form->button('Save Changes', ['class' => 'form-submit-btn']) ?>
    </div>

    <?= $this->Form->end() ?>
</div>
