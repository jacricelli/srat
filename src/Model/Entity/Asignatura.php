<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Asignatura Entity
 *
 * @property int $id
 * @property int $asignatura_carrera_id
 * @property int $asignatura_materia_id
 * @property int $asignatura_nivel_id
 *
 * @property \App\Model\Entity\AsignaturaCarrera $asignatura_carrera
 * @property \App\Model\Entity\AsignaturaMateria $asignatura_materia
 * @property \App\Model\Entity\AsignaturaNivel $asignatura_nivel
 */
class Asignatura extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'asignatura_carrera_id' => true,
        'asignatura_materia_id' => true,
        'asignatura_nivel_id' => true,
        'asignatura_carrera' => true,
        'asignatura_materia' => true,
        'asignatura_nivel' => true
    ];
}
