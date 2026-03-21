<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Societe Entity
 *
 * @property int $id
 * @property string|null $nom
 * @property string|null $adresse
 * @property string|null $telephone
 * @property string|null $fax
 * @property string|null $email
 * @property string|null $adress
 */
class Societe extends Entity
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
        'nom' => true,
        'adresse' => true,
        'telephone' => true,
        'fax' => true,
        'email' => true,
        'adress' => true,
        'logo' => true, // ✅ obligatoire

    ];
}
