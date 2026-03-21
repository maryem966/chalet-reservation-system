<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Reglement $reglement
 * @var \Cake\Collection\CollectionInterface|string[] $clients
 * @var \Cake\Collection\CollectionInterface|string[] $reservations
 * @var \Cake\Collection\CollectionInterface|string[] $modespaiements
 */
?>

<div class="user-form-box">
    <h2 class="form-box-title">Add New Payment</h2>

    <?= $this->Form->create($reglement, ['class' => 'styled-user-form']) ?>

    <div class="form-row">
        <?= $this->Form->label('client_id', 'Client') ?>
        <?= $this->Form->control('client_id', [
            'label' => false,
            'options' => $clients,
            'empty' => 'Select Client',
            'class' => 'form-input'
        ]) ?>
    </div>

    <div class="form-row">
        <?= $this->Form->label('montant', 'Amount') ?>
        <?= $this->Form->control('montant', [
            'label' => false,
            'class' => 'form-input'
        ]) ?>
    </div>

    <div class="form-row">
        <?= $this->Form->label('piecesreglements.0.modespaiement_id', 'Payment Method') ?>
        <?= $this->Form->control('piecesreglements.0.modespaiement_id', [
            'label' => false,
            'options' => $modespaiements,
            'empty' => 'Select Payment Method',
            'class' => 'form-input',
            'id' => 'modespaiement_id'
        ]) ?>
    </div>

    <!-- Bank Transfer -->
    <div id="bank-transfer-fields" style="display: none; margin-top: 1rem;">
        <div class="form-row">
            <?= $this->Form->label('piecesreglements.0.account_holder', 'Account Holder Name') ?>
            <?= $this->Form->control('piecesreglements.0.account_holder', ['label' => false, 'class' => 'form-input']) ?>
        </div>

        <div class="form-row">
            <?= $this->Form->label('piecesreglements.0.bank_name', 'Bank Name') ?>
            <?= $this->Form->control('piecesreglements.0.bank_name', ['label' => false, 'class' => 'form-input']) ?>
        </div>

        <div class="form-row">
            <?= $this->Form->label('piecesreglements.0.iban_number', 'Account Number or IBAN') ?>
            <?= $this->Form->control('piecesreglements.0.iban_number', ['label' => false, 'class' => 'form-input']) ?>
        </div>

        <div class="form-row">
            <?= $this->Form->label('piecesreglements.0.proof_file', 'Transfer Receipt (Number or File)') ?>
            <?= $this->Form->control('piecesreglements.0.proof_file', ['type' => 'text', 'label' => false, 'class' => 'form-input']) ?>
        </div>
    </div>

    <!-- بطاقة -->
    <div id="card-fields" style="display: none; margin-top: 1rem;">
        <div class="form-row">
            <?= $this->Form->label('piecesreglements.0.card_holder_name', 'Name on Card') ?>
            <?= $this->Form->control('piecesreglements.0.card_holder_name', ['label' => false, 'class' => 'form-input']) ?>
        </div>

        <div class="form-row">
            <?= $this->Form->label('piecesreglements.0.card_number', 'Card Number') ?>
            <?= $this->Form->control('piecesreglements.0.card_number', ['label' => false, 'class' => 'form-input']) ?>
        </div>

        <div class="form-row">
            <?= $this->Form->label('piecesreglements.0.card_expiry', 'Expiry Date') ?>
            <?= $this->Form->control('piecesreglements.0.card_expiry', ['label' => false, 'type' => 'month', 'class' => 'form-input']) ?>
        </div>

        <div class="form-row">
            <?= $this->Form->label('piecesreglements.0.card_cvv', 'CVV Code') ?>
            <?= $this->Form->control('piecesreglements.0.card_cvv', ['label' => false, 'type' => 'password', 'class' => 'form-input']) ?>
        </div>
    </div>

    <!-- Cheque -->
    <div id="cheque-fields" style="display: none; margin-top: 1rem;">
        <div class="form-row">
            <?= $this->Form->label('piecesreglements.0.cheque_number', 'Cheque Number') ?>
            <?= $this->Form->control('piecesreglements.0.cheque_number', ['label' => false, 'class' => 'form-input']) ?>
        </div>

        <div class="form-row">
            <?= $this->Form->label('piecesreglements.0.cheque_bank_name', 'Bank Name') ?>
            <?= $this->Form->control('piecesreglements.0.cheque_bank_name', ['label' => false, 'class' => 'form-input']) ?>
        </div>

        <div class="form-row">
            <?= $this->Form->label('piecesreglements.0.cheque_holder', 'Cheque Holder Name') ?>
            <?= $this->Form->control('piecesreglements.0.cheque_holder', ['label' => false, 'class' => 'form-input']) ?>
        </div>
    </div>

    <div class="form-row">
        <?= $this->Form->label('date_reglement', 'Payment Date') ?>
        <?= $this->Form->control('date_reglement', [
            'label' => false,
            'type' => 'datetime-local',
            'class' => 'form-input'
        ]) ?>
    </div>

    <div class="form-actions">
        <?= $this->Form->button('Add', ['class' => 'form-submit-btn']) ?>
    </div>

    <?= $this->Form->end() ?>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const modeField = document.getElementById('modespaiement_id');
    const bankFields = document.getElementById('bank-transfer-fields');
    const cardFields = document.getElementById('card-fields');
    const chequeFields = document.getElementById('cheque-fields');

    function togglePaymentFields() {
        const selectedOption = modeField?.options[modeField.selectedIndex];
        const selectedText = selectedOption ? selectedOption.text.trim() : '';

        bankFields.style.display = (selectedText === 'Bank Transfer') ? 'block' : 'none';

        const cardModes = ['Bank Card', 'Credit Card', 'Online Card Payment'];
        cardFields.style.display = cardModes.includes(selectedText) ? 'block' : 'none';

        chequeFields.style.display = (selectedText === 'Cheque') ? 'block' : 'none';
    }

    if (modeField) {
        modeField.addEventListener('change', togglePaymentFields);
        togglePaymentFields(); // initial check
    }
});
</script>
