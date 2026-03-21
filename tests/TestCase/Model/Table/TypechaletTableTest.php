<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TypechaletTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TypechaletTable Test Case
 */
class TypechaletTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TypechaletTable
     */
    protected $Typechalet;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.Typechalet',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Typechalet') ? [] : ['className' => TypechaletTable::class];
        $this->Typechalet = $this->getTableLocator()->get('Typechalet', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Typechalet);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\TypechaletTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
