<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CargosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CargosTable Test Case
 */
class CargosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CargosTable
     */
    public $Cargos;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.cargos',
        'app.asignaturas',
        'app.asignatura_carreras',
        'app.asignatura_materias',
        'app.asignatura_niveles',
        'app.usuarios',
        'app.cargo_tipos'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Cargos') ? [] : ['className' => CargosTable::class];
        $this->Cargos = TableRegistry::get('Cargos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Cargos);

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