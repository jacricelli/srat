<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * AsignaturasFixture
 *
 */
class AsignaturasFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'asignatura_carrera_id' => ['type' => 'tinyinteger', 'length' => 3, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'asignatura_materia_id' => ['type' => 'tinyinteger', 'length' => 3, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'asignatura_nivel_id' => ['type' => 'tinyinteger', 'length' => 3, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'asignatura_carrera_id_2' => ['type' => 'index', 'columns' => ['asignatura_carrera_id'], 'length' => []],
            'asignatura_nivel_id' => ['type' => 'index', 'columns' => ['asignatura_nivel_id'], 'length' => []],
            'asignatura_materia_id' => ['type' => 'index', 'columns' => ['asignatura_materia_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'asignatura_carrera_id' => ['type' => 'unique', 'columns' => ['asignatura_carrera_id', 'asignatura_materia_id', 'asignatura_nivel_id'], 'length' => []],
            'asignaturas_ibfk_1' => ['type' => 'foreign', 'columns' => ['asignatura_carrera_id'], 'references' => ['asignatura_carreras', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'asignaturas_ibfk_2' => ['type' => 'foreign', 'columns' => ['asignatura_materia_id'], 'references' => ['asignatura_materias', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'asignaturas_ibfk_3' => ['type' => 'foreign', 'columns' => ['asignatura_nivel_id'], 'references' => ['asignatura_niveles', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
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
            'asignatura_carrera_id' => 1,
            'asignatura_materia_id' => 1,
            'asignatura_nivel_id' => 1
        ],
    ];
}
