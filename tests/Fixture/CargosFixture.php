<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CargosFixture
 *
 */
class CargosFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'asignatura_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'usuario_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'cargo_tipo_id' => ['type' => 'tinyinteger', 'length' => 3, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'asignatura_id_2' => ['type' => 'index', 'columns' => ['asignatura_id'], 'length' => []],
            'usuario_id' => ['type' => 'index', 'columns' => ['usuario_id'], 'length' => []],
            'cargo_tipo_id' => ['type' => 'index', 'columns' => ['cargo_tipo_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'asignatura_id' => ['type' => 'unique', 'columns' => ['asignatura_id', 'usuario_id'], 'length' => []],
            'cargos_ibfk_1' => ['type' => 'foreign', 'columns' => ['asignatura_id'], 'references' => ['asignaturas', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'cargos_ibfk_2' => ['type' => 'foreign', 'columns' => ['usuario_id'], 'references' => ['usuarios', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'cargos_ibfk_3' => ['type' => 'foreign', 'columns' => ['cargo_tipo_id'], 'references' => ['cargo_tipos', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_unicode_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 1,
            'asignatura_id' => 1,
            'usuario_id' => 1,
            'cargo_tipo_id' => 1
        ],
    ];
}
