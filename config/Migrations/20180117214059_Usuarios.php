<?php
use Cake\ORM\TableRegistry;
use Migrations\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

/**
 * Usuarios
 */
// @codingStandardsIgnoreLine
class Usuarios extends AbstractMigration
{
    /**
     * Incorpora cambios
     *
     * @return void
     */
    public function up()
    {
        $table = $this->table('usuarios', [
            'id' => false,
            'primary_key' => ['id']
        ]);
        $table->addColumn('id', 'integer', ['identity' => true, 'signed' => false])
            ->addColumn('legajo', 'integer', ['length' => MysqlAdapter::INT_MEDIUM, 'signed' => false])
            ->addColumn('password', 'char', ['length' => 60])
            ->addColumn('habilitado', 'boolean', ['default' => true, 'signed' => false])
            ->addColumn('apellido', 'string', ['length' => 30])
            ->addColumn('nombre', 'string', ['length' => 40])
            ->addIndex(['legajo'], ['unique' => true, 'name' => 'uk_legajo'])
            ->addIndex(['legajo', 'habilitado'], ['name' => 'ik_legajo'])
            ->create();

        $usuarios = TableRegistry::get('usuarios');
        $entidad = $usuarios->newEntity([
            'legajo' => 1,
            'password' => 'admin',
            'habilitado' => true,
            'apellido' => '-',
            'nombre' => 'Administrador'
        ]);
        $usuarios->save($entidad);
    }

    /**
     * Deshace cambios
     *
     * @return void
     */
    public function down()
    {
        $this->dropTable('usuarios');
    }
}
