<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Chalet Entity
 *
 * @property int $id_chalet
 * @property string $nom_chalet
 * @property string $type
 * @property int $capacite
 * @property string $prix_par_nuit
 * @property string|null $statut
 * @property string|null $description
 * @property string|null $photo
 */
class Chalet extends Entity
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
        'nom_chalet' => true,
        'typechalet_id' => true,
        'capacite' => true,
        'prix_par_nuit' => true,
        'statut' => true,
        'description' => true,
        'photo' => true,
        'code' => true,
    ];
}
