<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Modespaiement $modespaiement
 */
?>

<div class="user-form-box">
    <h2 class="form-box-title">Edit Payment Method</h2>

    <?= $this->Form->create($modespaiement, ['class' => 'styled-user-form']) ?>

    <div class="form-row">
        <?= $this->Form->label('name', 'Payment Method') ?>
        <?= $this->Form->control('name', ['label' => false, 'class' => 'form-input']) ?>
    </div>

    <div class="form-actions">
        <?= $this->Form->button('Save Changes', ['class' => 'form-submit-btn']) ?>
        <?= $this->Html->link('Back', ['action' => 'modestable'], ['class' => 'btn-back']) ?>
    </div>

    <?= $this->Form->end() ?>
</div>
