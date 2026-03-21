<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Piecesreglement extends Entity
{
    // ✅ Correct: $_accessible must be an array
    protected array $_accessible = [
        '*' => true,
        'id' => false,
    'account_holder' => true,
    'bank_name' => true,
    'iban_number' => true,
    'proof_file' => true,
    'card_holder_name' => true,
    'card_number' => true,
    'card_expiry' => true,
    'card_cvv' => true,
    'cheque_number' => true,
    'cheque_bank_name' => true,
    'cheque_holder' => true,

    ];
}
