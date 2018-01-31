<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Calendario Entity
 *
 * @property int $id
 * @property int $ciclo_id
 * @property \Cake\I18n\FrozenDate $fecha
 * @property int $anio
 * @property int $mes
 * @property int $dia
 * @property int $trimestre
 * @property int $semana
 * @property bool $fin_semana
 * @property bool $feriado
 * @property string $evento
 *
 * @property \App\Model\Entity\Ciclo $ciclo
 */
class Calendario extends Entity
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
        'ciclo_id' => true,
        'fecha' => true,
        'anio' => true,
        'mes' => true,
        'dia' => true,
        'trimestre' => true,
        'semana' => true,
        'fin_semana' => true,
        'feriado' => true,
        'evento' => true,
        'ciclo' => true
    ];
}
