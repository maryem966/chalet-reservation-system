<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ReglementsFixture
 */
class ReglementsFixture extends TestFixture
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
                'client_id' => 1,
                'montant' => 1.5,
                'date_reglement' => '2025-07-19 20:55:09',
            ],
        ];
        parent::init();
    }
}
