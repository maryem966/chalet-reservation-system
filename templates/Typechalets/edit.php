<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Typechalet $typechalet
 */
?>

<div class="user-form-box">
    <h2 class="form-box-title">Edit Chalet Type</h2>

    <?= $this->Form->create($typechalet, ['class' => 'styled-typechalet-form']) ?>

    <div class="form-row">
        <?= $this->Form->label('name', 'Name') ?>
        <?= $this->Form->control('name', [
            'label' => false,
            'class' => 'form-input',
            'placeholder' => 'أدخل اسم Chalet Type'
        ]) ?>
    </div>

    <div class="form-actions">
        <?= $this->Form->button('Update', ['class' => 'form-submit-btn']) ?>
    </div>

    <?= $this->Form->end() ?>
</div>
