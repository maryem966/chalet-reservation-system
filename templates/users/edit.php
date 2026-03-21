<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>

<div class="user-form-box">
    <h2 class="form-box-title">Edit User Information</h2>

    <?= $this->Form->create($user, ['class' => 'styled-user-form']) ?>

    <div class="form-row">
        <?= $this->Form->label('name', 'Name') ?>
        <?= $this->Form->control('name', ['label' => false, 'class' => 'form-input']) ?>
    </div>

    <div class="form-row">
        <?= $this->Form->label('email', 'Email') ?>
        <?= $this->Form->control('email', ['label' => false, 'class' => 'form-input']) ?>
    </div>

    <div class="form-row">
        <?= $this->Form->label('password', 'Password (leave blank if unchanged)') ?>
        <?= $this->Form->control('password', ['label' => false, 'class' => 'form-input', 'required' => false]) ?>
    </div>

    <div class="form-actions">
        <?= $this->Html->link('Back', ['action' => 'table'], ['class' => 'btn-back']) ?>
        <?= $this->Form->button('Save Changes', ['class' => 'form-submit-btn']) ?>

    </div>

    <?= $this->Form->end() ?>
</div>
