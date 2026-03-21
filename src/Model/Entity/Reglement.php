<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Reglement Entity
 *
 * @property int $id
 * @property int $reservation_id
 * @property int $client_id
 * @property string $montant
 * @property \Cake\I18n\DateTime $date_reglement
 *
 * @property \App\Model\Entity\Reservation $reservation
 * @property \App\Model\Entity\Client $client
 */
class Reglement extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'reservation_id' => true,
        'client_id' => true,
        'montant' => true,
        'date_reglement' => true,
        'reservation' => true,
        'client' => true,

        'modespaiement_id' => true,





    ];
}
