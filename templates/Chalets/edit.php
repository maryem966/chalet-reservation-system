<div class="user-form-box">
    <h2 class="form-box-title">Edit Chalet Information</h2>

    <?= $this->Form->create($chalet, ['type' => 'file', 'class' => 'styled-user-form']) ?>

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
            'min' => 0,
            'step' => '0.01'
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
        <?= $this->Form->label('photo_file', 'New Image (Optional)') ?>
        <?= $this->Form->control('photo_file', [
            'type' => 'file',
            'label' => false,
            'class' => 'form-input',
            'accept' => 'image/*'
        ]) ?>
        <?php if (!empty($chalet->photo)): ?>
            <p>Current Image:</p>
            <img src="/img/chalets/<?= h($chalet->photo) ?>" alt="Chalet Image" width="200" style="border-radius: 10px; object-fit: cover;">
        <?php endif; ?>
    </div>

    <div class="form-actions">
        <?= $this->Form->button('Save Changes', ['class' => 'form-submit-btn']) ?>
        <?= $this->Html->link('Back', ['action' => 'chaletstable'], ['class' => 'btn-back']) ?>
    </div>

    <?= $this->Form->end() ?>
</div>
