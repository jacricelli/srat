<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AsignaturaCarrerasTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AsignaturaCarrerasTable Test Case
 */
class AsignaturaCarrerasTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AsignaturaCarrerasTable
     */
    public $AsignaturaCarreras;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.asignatura_carreras',
        'app.asignaturas'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('AsignaturaCarreras') ? [] : ['className' => AsignaturaCarrerasTable::class];
        $this->AsignaturaCarreras = TableRegistry::get('AsignaturaCarreras', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AsignaturaCarreras);

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
