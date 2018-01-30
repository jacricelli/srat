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
            'collation' => 'utf8_unicode_ci',
            'id' => false,
            'primary_key' => ['id']
        ]);
        $table->addColumn('id', 'integer', ['identity' => true, 'signed' => false])
            ->addColumn('admin', 'boolean', ['default' => false, 'signed' => false])
            ->addColumn('legajo', 'integer', ['length' => MysqlAdapter::INT_MEDIUM, 'signed' => false])
            ->addColumn('password', 'char', ['length' => 60])
            ->addColumn('habilitado', 'boolean', ['default' => true, 'signed' => false])
            ->addColumn('apellido', 'string', ['length' => 30])
            ->addColumn('nombre', 'string', ['length' => 40])
            ->addIndex(['legajo'], ['unique' => true])
            ->addIndex(['legajo', 'habilitado'])
            ->create();

        $usuarios = TableRegistry::get('Usuarios');
        $entidad = $usuarios->newEntity([
            'admin' => true,
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
