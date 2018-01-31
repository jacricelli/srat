<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Calendarios Model
 *
 * @property \App\Model\Table\CiclosTable|\Cake\ORM\Association\BelongsTo $Ciclos
 *
 * @method \App\Model\Entity\Calendario get($primaryKey, $options = [])
 * @method \App\Model\Entity\Calendario newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Calendario[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Calendario|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Calendario patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Calendario[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Calendario findOrCreate($search, callable $callback = null, $options = [])
 */
class CalendariosTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('calendarios');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Ciclos', [
            'foreignKey' => 'ciclo_id',
            'joinType' => 'INNER'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->date('fecha')
            ->requirePresence('fecha', 'create')
            ->notEmpty('fecha');

        $validator
            ->requirePresence('anio', 'create')
            ->notEmpty('anio');

        $validator
            ->requirePresence('mes', 'create')
            ->notEmpty('mes');

        $validator
            ->requirePresence('dia', 'create')
            ->notEmpty('dia');

        $validator
            ->requirePresence('trimestre', 'create')
            ->notEmpty('trimestre');

        $validator
            ->requirePresence('semana', 'create')
            ->notEmpty('semana');

        $validator
            ->boolean('fin_semana')
            ->requirePresence('fin_semana', 'create')
            ->notEmpty('fin_semana');

        $validator
            ->boolean('feriado')
            ->requirePresence('feriado', 'create')
            ->notEmpty('feriado');

        $validator
            ->scalar('evento')
            ->maxLength('evento', 255)
            ->allowEmpty('evento');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['fecha']));

        $rules->add($rules->existsIn(['ciclo_id'], 'Ciclos'));

        return $rules;
    }
}
