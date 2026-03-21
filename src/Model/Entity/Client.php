<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Client Entity
 *
 * @property int $id
 * @property string $name
 * @property \Cake\I18n\Date|null $birth_date
 * @property string $email
 * @property string|null $whatsapp
 * @property string|null $phone
 * @property string|null $passport_number
 * @property string|null $nationality
 * @property \Cake\I18n\Date|null $arrival_date
 * @property \Cake\I18n\Date|null $departure_date
 * @property int|null $cottage_number
 * @property string|null $payment_status
 */
class Client extends Entity
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
        'name' => true,
        'birth_date' => true,
        'email' => true,
        'whatsapp' => true,
        'phone' => true,
        'passport_number' => true,
        'nationality' => true,
        'password' => true,
    ];
}
