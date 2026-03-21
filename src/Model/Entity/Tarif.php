<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Tarif Entity
 *
 * @property int $id
 * @property int $chalet_id
 * @property \Cake\I18n\Date $date_debut
 * @property \Cake\I18n\Date $date_fin
 * @property string $prix
 *
 * @property \App\Model\Entity\Chalet $chalet
 */
class Tarif extends Entity
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
        'chalet_id' => true,
        'date_debut' => true,
        'date_fin' => true,
        'prix' => true,
        'chalet' => true,
    ];
}
