<?php
use Cake\ORM\TableRegistry;
use Migrations\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

/**
 * Cargos
 */
// @codingStandardsIgnoreLine
class Cargos extends AbstractMigration
{
    /**
     * Incorpora cambios
     *
     * @return void
     */
    public function up()
    {
        $table = $this->table('cargo_tipos', [
            'collation' => 'utf8_unicode_ci',
            'id' => false,
            'primary_key' => ['id']
        ]);
        $table->addColumn('id', 'integer', ['length' => MysqlAdapter::INT_TINY, 'identity' => true, 'signed' => false])
            ->addColumn('nombre', 'string', ['length' => 50])
            ->addColumn('obs', 'string', ['length' => 255, 'null' => true])
            ->addIndex(['nombre'], ['unique' => true])
            ->create();

        $cargos = [
            'Profesor Titular',
            'Profesor Asociado',
            'Profesor Adjunto',
            'Jefe de Trabajos Prácticos',
            'Ayudante Primera',
            'Ayudante Segunda'
        ];
        $table = TableRegistry::get('CargoTipos');
        foreach ($cargos as $nombre) {
            $entity = $table->newEntity(compact('nombre'));
            $table->save($entity);
        }

        $table = $this->table('cargos', [
            'collation' => 'utf8_unicode_ci',
            'id' => false,
            'primary_key' => ['id']
        ]);
        $table->addColumn('id', 'integer', ['identity' => true, 'signed' => false])
            ->addColumn('asignatura_id', 'integer', ['signed' => false])
            ->addColumn('usuario_id', 'integer', ['signed' => false])
            ->addColumn('cargo_tipo_id', 'integer', ['length' => MysqlAdapter::INT_TINY, 'signed' => false])
            ->addIndex(['asignatura_id', 'usuario_id'], ['unique' => true])
            ->addIndex(['asignatura_id'])
            ->addIndex(['usuario_id'])
            ->addIndex(['cargo_tipo_id'])
            ->addForeignKey('asignatura_id', 'asignaturas', 'id')
            ->addForeignKey('usuario_id', 'usuarios', 'id')
            ->addForeignKey('cargo_tipo_id', 'cargo_tipos', 'id')
            ->create();
    }

    /**
     * Deshace cambios
     *
     * @return void
     */
    public function down()
    {
        $this->dropTable('cargos');
        $this->dropTable('cargo_tipos');
    }
}
