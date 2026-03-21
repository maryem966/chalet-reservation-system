<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ModespaiementsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ModespaiementsTable Test Case
 */
class ModespaiementsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ModespaiementsTable
     */
    protected $Modespaiements;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.Modespaiements',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Modespaiements') ? [] : ['className' => ModespaiementsTable::class];
        $this->Modespaiements = $this->getTableLocator()->get('Modespaiements', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Modespaiements);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ModespaiementsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
