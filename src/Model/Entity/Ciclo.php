<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Ciclo Entity
 *
 * @property int $id
 * @property int $anio
 * @property \Cake\I18n\FrozenDate $inicio
 * @property \Cake\I18n\FrozenDate $fin
 *
 * @property \App\Model\Entity\Calendario[] $calendarios
 */
class Ciclo extends Entity
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
        'anio' => true,
        'inicio' => true,
        'fin' => true,
        'calendarios' => true
    ];
}
