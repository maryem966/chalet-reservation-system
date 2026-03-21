<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Reglement $reglement
 */
?>

<div class="user-view-box">
    <h2 class="view-title">Payment Information</h2>

    <div class="reglement-info">

        <p><strong>Client:</strong>
            <?= $reglement->has('client') ? h($reglement->client->name) : '—' ?>
        </p>

        <p><strong>Amount:</strong> <?= h($reglement->montant) ?></p>

        <p><strong>Payment Date:</strong> <?= h($reglement->date_reglement) ?></p>

        <?php if (!empty($reglement->piecesreglements)): ?>
            <?php $piece = $reglement->piecesreglements[0]; ?>

            <p><strong>Payment Method:</strong>
                <?= $piece->has('modespaiement') ? h($piece->modespaiement->nom) : '—' ?>
            </p>

            <?php if ($piece->modespaiement && $piece->modespaiement->nom === 'Bank Transfer'): ?>
                <p><strong>Account Holder Name:</strong> <?= h($piece->account_holder) ?></p>
                <p><strong>Bank Name:</strong> <?= h($piece->bank_name) ?></p>
                <p><strong>Account Number or IBAN:</strong> <?= h($piece->iban_number) ?></p>
                <p><strong>Transfer Receipt:</strong> <?= h($piece->proof_file) ?></p>

            <?php elseif (in_array($piece->modespaiement->nom, ['Bank Card', 'Credit Card', 'Online Card Payment'])): ?>
                <p><strong>Name on Card:</strong> <?= h($piece->card_holder_name) ?></p>
                <p><strong>Card Number:</strong> <?= h($piece->card_number) ?></p>
<p><strong>Expiry Date:</strong>
    <?= !empty($piece->card_expiry) ? h($piece->card_expiry) : '—' ?>
</p>

                <p><strong>CVV Code:</strong> <?= h($piece->card_cvv) ?></p>

            <?php elseif ($piece->modespaiement->nom === 'Cheque'): ?>
                <p><strong>Cheque Number:</strong> <?= h($piece->cheque_number) ?></p>
                <p><strong>Bank Name:</strong> <?= h($piece->cheque_bank_name) ?></p>
                <p><strong>Cheque Holder Name:</strong> <?= h($piece->cheque_holder) ?></p>
            <?php endif; ?>
        <?php else: ?>
            <p><strong>Payment Method:</strong> —</p>
        <?php endif; ?>

    </div>

    <div class="view-actions">
        <?= $this->Html->link('Back', ['action' => 'reglementstable'], ['class' => 'btn-back']) ?>
    </div>
</div>
