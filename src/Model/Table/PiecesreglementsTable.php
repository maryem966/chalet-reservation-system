<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class PiecesreglementsTable extends Table
{
    public function initialize(array $config): void
    {
$this->belongsTo('Modespaiements', [
    'foreignKey' => 'modespaiement_id',
    'joinType' => 'LEFT',
]);

    }
}
