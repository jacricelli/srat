<?php
namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;

/**
 * Usuario Entity
 *
 * @property int $id
 * @property bool $admin
 * @property int $legajo
 * @property string $password
 * @property bool $habilitado
 * @property string $apellido
 * @property string $nombre
 */
class Usuario extends Entity
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
        'admin' => true,
        'legajo' => true,
        'password' => true,
        'habilitado' => true,
        'apellido' => true,
        'nombre' => true
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];

    /**
     * Genera el hash de la contraseña
     *
     * @param string $password Contraseña
     *
     * @return string|null
     */
    protected function _setPassword($password)
    {
        if (strlen($password) > 0) {
            return (new DefaultPasswordHasher)->hash($password);
        }

        return null;
    }
}
