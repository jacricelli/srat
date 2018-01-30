<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AsignaturaMateriasTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AsignaturaMateriasTable Test Case
 */
class AsignaturaMateriasTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AsignaturaMateriasTable
     */
    public $AsignaturaMaterias;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.asignatura_materias',
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
        $config = TableRegistry::exists('AsignaturaMaterias') ? [] : ['className' => AsignaturaMateriasTable::class];
        $this->AsignaturaMaterias = TableRegistry::get('AsignaturaMaterias', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AsignaturaMaterias);

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
