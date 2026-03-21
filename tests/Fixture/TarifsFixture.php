<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TarifsFixture
 */
class TarifsFixture extends TestFixture
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
                'chalet_id' => 1,
                'date_debut' => '2025-07-09',
                'date_fin' => '2025-07-09',
                'prix' => 1.5,
            ],
        ];
        parent::init();
    }
}
