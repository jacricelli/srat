<?php
use Migrations\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

/**
 * Horarios
 */
// @codingStandardsIgnoreLine
class Horarios extends AbstractMigration
{
    /**
     * Incorpora o deshace cambios
     *
     * @return void
     */
    public function change()
    {
        $table = $this->table('horarios', [
            'collation' => 'utf8_unicode_ci',
            'id' => false,
            'primary_key' => ['id']
        ]);
        $table->addColumn('id', 'integer', ['identity' => true, 'signed' => false])
            ->addColumn('asignatura_id', 'integer', ['signed' => false])
            ->addColumn('dia', 'integer', ['length' => MysqlAdapter::INT_TINY, 'signed' => false])
            ->addColumn('entrada', 'time')
            ->addColumn('salida', 'time')
            ->addIndex(['asignatura_id', 'dia'], ['unique' => true])
            ->addIndex(['asignatura_id'])
            ->addForeignKey('asignatura_id', 'asignaturas', 'id')
            ->create();
    }
}
