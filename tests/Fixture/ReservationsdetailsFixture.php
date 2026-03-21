<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ReservationsdetailsFixture
 */
class ReservationsdetailsFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'reservation_id' => 1,
                'chalet_id' => 1,
                'tarif_id' => 1,
                'date_debut' => '2025-07-11',
                'date_fin' => '2025-07-11',
                'prix' => 1.5,
                'statut' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
