<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ClientsFixture
 */
class ClientsFixture extends TestFixture
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
                'name' => 'Lorem ipsum dolor sit amet',
                'birth_date' => '2025-07-07',
                'email' => 'Lorem ipsum dolor sit amet',
                'whatsapp' => 'Lorem ipsum dolor ',
                'phone' => 'Lorem ipsum dolor ',
                'passport_number' => 'Lorem ipsum dolor sit amet',
                'nationality' => 'Lorem ipsum dolor sit amet',
                'arrival_date' => '2025-07-07',
                'departure_date' => '2025-07-07',
                'cottage_number' => 1,
                'payment_status' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
