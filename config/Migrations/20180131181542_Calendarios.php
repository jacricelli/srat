<?php
use Migrations\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

/**
 * Calendarios
 */
// @codingStandardsIgnoreLine
class Calendarios extends AbstractMigration
{
    /**
     * Incorpora cambios
     *
     * @return void
     */
    public function up()
    {
        $table = $this->table('calendarios', [
            'collation' => 'utf8_unicode_ci',
            'id' => false,
            'primary_key' => ['id']
        ]);
        $table->addColumn('id', 'integer', ['identity' => true, 'signed' => false])
            ->addColumn('ciclo_id', 'integer', ['length' => MysqlAdapter::INT_SMALL, 'signed' => false])
            ->addColumn('fecha', 'date')
            ->addColumn('anio', 'integer', ['length' => MysqlAdapter::INT_SMALL, 'signed' => false])
            ->addColumn('mes', 'integer', ['length' => MysqlAdapter::INT_TINY, 'signed' => false])
            ->addColumn('dia', 'integer', ['length' => MysqlAdapter::INT_TINY, 'signed' => false])
            ->addColumn('trimestre', 'integer', ['length' => MysqlAdapter::INT_TINY, 'signed' => false])
            ->addColumn('semana', 'integer', ['length' => MysqlAdapter::INT_TINY, 'signed' => false])
            ->addColumn('fin_semana', 'boolean', ['default' => false, 'length' => MysqlAdapter::INT_TINY, 'signed' => false])
            ->addColumn('feriado', 'boolean', ['default' => false, 'length' => MysqlAdapter::INT_TINY, 'signed' => false])
            ->addColumn('evento', 'string', ['length' => 255, 'null' => true])
            ->addIndex(['fecha'], ['unique' => true])
            ->addIndex(['ciclo_id'])
            ->addIndex(['anio', 'mes', 'dia'])
            ->addForeignKey('ciclo_id', 'ciclos', 'id', ['delete' => 'CASCADE'])
            ->create();

        $trigger = 'DROP TRIGGER IF EXISTS crea_calendario;
        CREATE TRIGGER crea_calendario AFTER INSERT ON ciclos FOR EACH ROW
        CALL crear_calendario(NEW.id, NEW.inicio, NEW.fin);';

        $procedure = 'DROP PROCEDURE IF EXISTS crear_calendario;
        CREATE PROCEDURE crear_calendario(IN ciclo_id INT, IN fecha_comienzo DATE, IN fecha_fin DATE)
        BEGIN
            DECLARE fecha_actual DATE;
            SET fecha_actual = fecha_comienzo;
            WHILE fecha_actual < fecha_fin DO
                INSERT INTO calendarios (ciclo_id, fecha, anio, mes, dia, trimestre, semana, fin_semana) VALUES (
                    ciclo_id,
                    fecha_actual,
                    YEAR(fecha_actual),
                    MONTH(fecha_actual),
                    DAY(fecha_actual),
                    QUARTER(fecha_actual),
                    WEEKOFYEAR(fecha_actual),
                    CASE DAYOFWEEK(fecha_actual) WHEN 1 THEN 1 WHEN 7 then 1 ELSE 0 END
                );
                SET fecha_actual = ADDDATE(fecha_actual, INTERVAL 1 DAY);
            END WHILE;
        END';

        $this->execute($procedure);
        $this->execute($trigger);
    }

    /**
     * Deshace cambios
     *
     * @return void
     */
    public function down()
    {
        $this->execute('DROP TRIGGER IF EXISTS crea_calendario');
        $this->execute('DROP PROCEDURE IF EXISTS crear_calendario');

        $this->dropTable('calendarios');
    }
}
