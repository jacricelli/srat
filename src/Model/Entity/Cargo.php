<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Cargo Entity
 *
 * @property int $id
 * @property int $asignatura_id
 * @property int $usuario_id
 * @property int $cargo_tipo_id
 *
 * @property \App\Model\Entity\Asignatura $asignatura
 * @property \App\Model\Entity\Usuario $usuario
 * @property \App\Model\Entity\CargoTipo $cargo_tipo
 */
class Cargo extends Entity
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
        'usuario_id' => true,
        'cargo_tipo_id' => true,
        'asignatura' => true,
        'usuario' => true,
        'cargo_tipo' => true
    ];
}
