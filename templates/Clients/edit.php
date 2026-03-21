<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Client $client
 */
?>

<div class="user-form-box">
    <h2 class="form-box-title">Edit Client Information</h2>

    <?= $this->Form->create($client, ['class' => 'styled-user-form']) ?>

    <div class="form-row">
        <?= $this->Form->label('name', 'Full Name') ?>
        <?= $this->Form->control('name', ['label' => false, 'class' => 'form-input']) ?>
    </div>

    <div class="form-row">
        <?= $this->Form->label('birth_date', 'Date of Birth') ?>
        <?= $this->Form->control('birth_date', ['label' => false, 'type' => 'date', 'class' => 'form-input']) ?>
    </div>

    <div class="form-row">
        <?= $this->Form->label('email', 'Email') ?>
        <?= $this->Form->control('email', ['label' => false, 'class' => 'form-input']) ?>
    </div>
    <div class="form-row">
        <?= $this->Form->label('password', 'Password') ?>
        <?= $this->Form->control('password', ['type' => 'password', 'label' => false, 'class' => 'form-input']) ?>
    </div>

    <div class="form-row">
        <?= $this->Form->label('whatsapp', 'WhatsApp Number') ?>
        <?= $this->Form->control('whatsapp', ['label' => false, 'class' => 'form-input']) ?>
    </div>

    <div class="form-row">
        <?= $this->Form->label('phone', 'Phone Number') ?>
        <?= $this->Form->control('phone', ['label' => false, 'class' => 'form-input']) ?>
    </div>

    <div class="form-row">
        <?= $this->Form->label('passport_number', 'Passport Number') ?>
        <?= $this->Form->control('passport_number', ['label' => false, 'class' => 'form-input']) ?>
    </div>

    <div class="form-row">
        <?= $this->Form->label('nationality', 'Nationality') ?>
        <?= $this->Form->control('nationality', ['label' => false, 'class' => 'form-input']) ?>
    </div>

 



    <div class="form-actions">
        
        <?= $this->Form->button('Save Changes', ['class' => 'form-submit-btn']) ?>
        <?= $this->Html->link('Back', ['action' => 'clientstable'], ['class' => 'btn-back']) ?>
    </div>

    <?= $this->Form->end() ?>
</div>
