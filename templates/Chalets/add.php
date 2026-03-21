<div class="user-form-box">
    <h2 class="form-box-title">Add New Chalet</h2>

    <?= $this->Form->create($chalet, ['class' => 'styled-user-form', 'type' => 'file']) ?>

    <div class="form-row">
        <?= $this->Form->label('code', 'Chalet Code') ?>
        <?= $this->Form->control('code', ['label' => false, 'class' => 'form-input', 'required' => true]) ?>
    </div>

    <div class="form-row">
        <?= $this->Form->label('nom_chalet', 'Chalet Name') ?>
        <?= $this->Form->control('nom_chalet', ['label' => false, 'class' => 'form-input', 'required' => true]) ?>
    </div>

    <div class="form-row">
        <?= $this->Form->label('typechalet_id', 'Chalet Type') ?>
        <?= $this->Form->control('typechalet_id', [
            'type' => 'select',
            'options' => $typechalets,
            'empty' => 'Select Chalet Type',
            'label' => false,
            'class' => 'form-input',
            'required' => true
        ]) ?>
    </div>

    <div class="form-row">
        <?= $this->Form->label('prix_par_nuit', 'Price') ?>
        <?= $this->Form->control('prix_par_nuit', [
            'label' => false,
            'class' => 'form-input',
            'type' => 'number',
            'required' => true,
            'min' => 0
        ]) ?>
    </div>

    <div class="form-row">
        <?= $this->Form->label('capacite', 'Capacity') ?>
        <?= $this->Form->control('capacite', [
            'label' => false,
            'class' => 'form-input',
            'type' => 'number',
            'required' => true,
            'min' => 1
        ]) ?>
    </div>

    <div class="form-row">
        <?= $this->Form->label('statut', 'Chalet Status') ?>
        <?= $this->Form->control('statut', [
            'label' => false,
            'class' => 'form-input',
            'options' => ['Disponible' => 'Available'],
            'empty' => 'Select Status',
            'required' => true
        ]) ?>
    </div>

    <div class="form-row">
        <?= $this->Form->label('description', 'Description') ?>
        <?= $this->Form->control('description', ['label' => false, 'class' => 'form-input', 'type' => 'textarea']) ?>
    </div>

    <div class="form-row">
        <?= $this->Form->label('photo', 'Chalet Image') ?>
        <?= $this->Form->control('photo', [
            'type' => 'file',
            'label' => false,
            'class' => 'form-input',
            'required' => true
        ]) ?>
    </div>

    <div class="form-actions">
        <?= $this->Form->button('Add', ['class' => 'form-submit-btn']) ?>
    </div>

    <?= $this->Form->end() ?>
</div>
