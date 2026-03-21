<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Reservation Entity
 *
 * @property int $id
 * @property int $client_id
 * @property \Cake\I18n\DateTime|null $date_reservation
 *
 * @property \App\Model\Entity\Client $client
 * @property \App\Model\Entity\ReservationDetail[] $reservation_details
 */
class Reservation extends Entity
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
    '*' => true,
    'id' => false,
    'reservationsdetails' => true,
    'overall_total' => true, // ✅
    'numero' => true,



];

}
