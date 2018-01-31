<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CiclosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CiclosTable Test Case
 */
class CiclosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CiclosTable
     */
    public $Ciclos;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ciclos'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Ciclos') ? [] : ['className' => CiclosTable::class];
        $this->Ciclos = TableRegistry::get('Ciclos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Ciclos);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
