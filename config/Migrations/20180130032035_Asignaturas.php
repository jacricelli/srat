<?php

use Cake\ORM\TableRegistry;
use Migrations\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

/**
 * Asignaturas
 */
// @codingStandardsIgnoreLine
class Asignaturas extends AbstractMigration
{
    /**
     * Incorpora cambios
     *
     * @return void
     */
    public function up()
    {
        $table = $this->table('asignatura_carreras', [
            'collation' => 'utf8_unicode_ci',
            'id' => false,
            'primary_key' => ['id']
        ]);
        $table->addColumn('id', 'integer', ['length' => MysqlAdapter::INT_TINY, 'identity' => true, 'signed' => false])
            ->addColumn('nombre', 'string', ['length' => 50])
            ->addColumn('obs', 'string', ['length' => 255, 'null' => true])
            ->addIndex(['nombre'], ['unique' => true])
            ->create();

        $table = $this->table('asignatura_materias', [
            'collation' => 'utf8_unicode_ci',
            'id' => false,
            'primary_key' => ['id']
        ]);
        $table->addColumn('id', 'integer', ['length' => MysqlAdapter::INT_TINY, 'identity' => true, 'signed' => false])
            ->addColumn('nombre', 'string', ['length' => 50])
            ->addColumn('obs', 'string', ['length' => 255, 'null' => true])
            ->addIndex(['nombre'], ['unique' => true])
            ->create();

        $table = $this->table('asignatura_niveles', [
            'collation' => 'utf8_unicode_ci',
            'id' => false,
            'primary_key' => ['id']
        ]);
        $table->addColumn('id', 'integer', ['length' => MysqlAdapter::INT_TINY, 'identity' => true, 'signed' => false])
            ->addColumn('nombre', 'string', ['length' => 50])
            ->addColumn('obs', 'string', ['length' => 255, 'null' => true])
            ->addIndex(['nombre'], ['unique' => true])
            ->create();

        $table = TableRegistry::get('AsignaturaNiveles');
        foreach (['Primero', 'Segundo', 'Tercero', 'Cuarto', 'Quinto', 'General'] as $nombre) {
            $entity = $table->newEntity(compact('nombre'));
            $table->save($entity);
        }

        $table = $this->table('asignaturas', [
            'collation' => 'utf8_unicode_ci',
            'id' => false,
            'primary_key' => ['id']
        ]);
        $table->addColumn('id', 'integer', ['identity' => true, 'signed' => false])
            ->addColumn('asignatura_carrera_id', 'integer', ['length' => MysqlAdapter::INT_TINY, 'signed' => false])
            ->addColumn('asignatura_materia_id', 'integer', ['length' => MysqlAdapter::INT_TINY, 'signed' => false])
            ->addColumn('asignatura_nivel_id', 'integer', ['length' => MysqlAdapter::INT_TINY, 'signed' => false])
            ->addIndex(['asignatura_carrera_id', 'asignatura_materia_id', 'asignatura_nivel_id'], ['unique' => true])
            ->addIndex(['asignatura_carrera_id'])
            ->addIndex(['asignatura_nivel_id'])
            ->addForeignKey('asignatura_carrera_id', 'asignatura_carreras', 'id')
            ->addForeignKey('asignatura_materia_id', 'asignatura_materias', 'id')
            ->addForeignKey('asignatura_nivel_id', 'asignatura_niveles', 'id')
            ->create();
    }

    /**
     * Deshace cambios
     *
     * @return void
     */
    public function down()
    {
        $this->dropTable('asignaturas');
        $this->dropTable('asignatura_carreras');
        $this->dropTable('asignatura_materias');
        $this->dropTable('asignatura_niveles');
    }
}
