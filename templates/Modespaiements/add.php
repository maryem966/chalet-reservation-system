<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Modespaiement $modespaiement
 */
?>

<div class="user-form-box">
    <h2 class="form-box-title">Add New Payment Method</h2>

    <?= $this->Form->create($modespaiement, ['class' => 'styled-user-form']) ?>

    <div class="form-row">
        <?= $this->Form->label('nom', 'اسم Payment Method') ?>
        <?= $this->Form->control('nom', [
            'label' => false,
            'placeholder' => 'أدخل اسم الطريقة (مثال: نقداً، بطاقة، تحويل...)',
            'class' => 'form-input'
        ]) ?>
    </div>

    <div class="form-actions">
        <?= $this->Form->button('Add', ['class' => 'form-submit-btn']) ?>
    </div>

    <?= $this->Form->end() ?>
</div>
