<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Horario Entity
 *
 * @property int $id
 * @property int $asignatura_id
 * @property int $dia
 * @property \Cake\I18n\FrozenTime $entrada
 * @property \Cake\I18n\FrozenTime $salida
 *
 * @property \App\Model\Entity\Asignatura $asignatura
 */
class Horario extends Entity
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
        'asignatura_id' => true,
        'dia' => true,
        'entrada' => true,
        'salida' => true,
        'asignatura' => true
    ];
}
