<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * HorariosFixture
 *
 */
class HorariosFixture extends TestFixture
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
        'dia' => ['type' => 'tinyinteger', 'length' => 3, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'entrada' => ['type' => 'time', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'salida' => ['type' => 'time', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'asignatura_id_2' => ['type' => 'index', 'columns' => ['asignatura_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'asignatura_id' => ['type' => 'unique', 'columns' => ['asignatura_id', 'dia'], 'length' => []],
            'horarios_ibfk_1' => ['type' => 'foreign', 'columns' => ['asignatura_id'], 'references' => ['asignaturas', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
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
            'dia' => 1,
            'entrada' => '15:55:28',
            'salida' => '15:55:28'
        ],
    ];
}
