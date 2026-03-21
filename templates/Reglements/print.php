<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Reglement $reglement
 */
?>


<div class="user-view-box">
    <h2>Reservation Receipt</h2>

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
            <p><strong>Expiry Date:</strong> <?= !empty($piece->card_expiry) ? h($piece->card_expiry) : '—' ?></p>
            <p><strong>CVV Code:</strong> <?= h($piece->card_cvv) ?></p>

        <?php elseif ($piece->modespaiement->nom === 'Cheque'): ?>
            <p><strong>Cheque Number:</strong> <?= h($piece->cheque_number) ?></p>
            <p><strong>Bank Name:</strong> <?= h($piece->cheque_bank_name) ?></p>
            <p><strong>Cheque Holder Name:</strong> <?= h($piece->cheque_holder) ?></p>
        <?php endif; ?>
    <?php else: ?>
        <p><strong>Payment Method:</strong> —</p>
    <?php endif; ?>

    <div style="text-align: center;">
        <a href="<?= $this->Url->build(['action' => 'reglementstable']) ?>" class=" btn-back">Back</a>
        <button onclick="window.print()" class=" btn-action btn-print">🖨️ Print</button>
    </div>
</div>
<style>
    body {
        font-family: 'Arial', sans-serif;
        background: white;
        color: #000;
        padding: 30px;
        direction: rtl;
    }

    .print-box {
        max-width: 700px;
        margin: auto;
        border: 1px solid #ccc;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    h2 {
        text-align: center;
        color: #333;
        margin-bottom: 20px;
    }

    p {
        font-size: 16px;
        margin: 8px 0;
        text-align: right;
    }

    .btn-print, .btn-back {
        display: inline-block;
        margin: 10px 10px;
        padding: 10px 25px;
        font-size: 16px;
        border: none;
        border-radius: 6px;
        background-color: #ff0400ff;
        color: #fff;
        text-decoration: none;
        cursor: pointer;
    }


    .btn-action {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 9.5px 16px;
    border: none;
    border-radius: 6px;
    font-size: 15px;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.3s ease;
    text-decoration: none;
    color: white;
}

    .btn-back {
        background-color: #28a745;
    }

    @media print {
        .btn-print, .btn-back {
            display: none !important;
        }





    
    }
</style>