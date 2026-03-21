<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>

<div class="user-form-box">
    <h2 class="form-box-title">Add New User</h2>

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
        <?= $this->Form->label('password', 'Password') ?>
        <?= $this->Form->control('password', ['label' => false, 'class' => 'form-input']) ?>
    </div>

    <div class="form-actions">
        <?= $this->Form->button('Add', ['class' => 'form-submit-btn']) ?>
    </div>



    <?= $this->Form->end() ?>
</div>
