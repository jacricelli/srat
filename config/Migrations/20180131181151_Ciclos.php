<?php
use Migrations\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

/**
 * Ciclos
 */
// @codingStandardsIgnoreLine
class Ciclos extends AbstractMigration
{
    /**
     * Incorpora o deshace cambios
     *
     * @return void
     */
    public function change()
    {
        $table = $this->table('ciclos', [
            'collation' => 'utf8_unicode_ci',
            'id' => false,
            'primary_key' => ['id']
        ]);
        $table->addColumn('id', 'integer', ['length' => MysqlAdapter::INT_SMALL, 'identity' => true, 'signed' => false])
            ->addColumn('anio', 'integer', ['length' => MysqlAdapter::INT_SMALL, 'signed' => false])
            ->addColumn('inicio', 'date')
            ->addColumn('fin', 'date')
            ->addIndex(['anio'], ['unique' => true])
            ->create();
    }
}
