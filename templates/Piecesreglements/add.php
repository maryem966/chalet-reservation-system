<?= $this->Form->create($piecesreglement) ?>
<fieldset>
    <legend>Ajouter Pièce de Règlement</legend>
    
    <?= $this->Form->control('reglement_id', ['options' => $reglements, 'label' => 'Règlement']) ?>
    <?= $this->Form->control('modespaiement_id', ['options' => $modespaiements, 'label' => 'Mode de paiement']) ?>
    <?= $this->Form->control('montant') ?> 
    <?= $this->Form->control('piecesreglement.account_holder', ['label' => 'Account Holder Name']) ?>
    <?= $this->Form->control('piecesreglement.bank_name', ['label' => 'Bank Name']) ?>
    <?= $this->Form->control('piecesreglement.iban_number', ['label' => 'رقم الحساب IBAN']) ?>
    <?= $this->Form->control('piecesreglement.proof_file', ['type' => 'number', 'label' => 'ملف الإثبات']) ?>

    <?= $this->Form->control('piecesreglement.card_holder_name', ['label' => 'اسم حامل البطاقة']) ?>
    <?= $this->Form->control('piecesreglement.card_number', ['label' => 'Card Number']) ?>
    <?= $this->Form->control('piecesreglement.card_expiry', ['label' => 'Card Expiry Date']) ?>
    <?= $this->Form->control('piecesreglement.card_cvv', ['label' => 'CVV Code']) ?>

    <?= $this->Form->control('piecesreglement.cheque_number', ['label' => 'Cheque Number']) ?>
    <?= $this->Form->control('piecesreglement.cheque_bank_name', ['label' => 'Cheque Bank Name']) ?>
    <?= $this->Form->control('piecesreglement.cheque', ['label' => 'Cheque']) ?>
  
</fieldset>
<?= $this->Form->button(__('Enregistrer')) ?>
<?= $this->Form->end() ?>