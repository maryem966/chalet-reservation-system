<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Typechalet $typechalet
 */
?>

<div class="user-form-box">
    <h2 class="form-box-title">Add New Chalet Type</h2>

    <?= $this->Form->create($typechalet, ['class' => 'styled-typechalet-form']) ?>

    <div class="form-row">
        <?= $this->Form->label('name', 'Type Name') ?>
        <?= $this->Form->control('name', [
            'type' => 'text',
            'label' => false,
            'class' => 'form-input',
            'placeholder' => 'أدخل اسم Chalet Type'
        ]) ?>
    </div>

    <div class="form-actions">
        <?= $this->Form->button('Add', ['class' => 'form-submit-btn']) ?>
    </div>

    <?= $this->Form->end() ?>
</div>
