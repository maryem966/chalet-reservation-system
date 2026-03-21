<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ChaletsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ChaletsTable Test Case
 */
class ChaletsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ChaletsTable
     */
    protected $Chalets;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.Chalets',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Chalets') ? [] : ['className' => ChaletsTable::class];
        $this->Chalets = $this->getTableLocator()->get('Chalets', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Chalets);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ChaletsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
