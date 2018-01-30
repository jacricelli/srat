<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AsignaturaNivelesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AsignaturaNivelesTable Test Case
 */
class AsignaturaNivelesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AsignaturaNivelesTable
     */
    public $AsignaturaNiveles;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.asignatura_niveles'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('AsignaturaNiveles') ? [] : ['className' => AsignaturaNivelesTable::class];
        $this->AsignaturaNiveles = TableRegistry::get('AsignaturaNiveles', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AsignaturaNiveles);

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
