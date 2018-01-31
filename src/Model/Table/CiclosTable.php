<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Ciclos Model
 *
 * @method \App\Model\Entity\Ciclo get($primaryKey, $options = [])
 * @method \App\Model\Entity\Ciclo newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Ciclo[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Ciclo|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Ciclo patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Ciclo[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Ciclo findOrCreate($search, callable $callback = null, $options = [])
 */
class CiclosTable extends Table
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

        $this->setTable('ciclos');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
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
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('anio', 'create')
            ->notEmpty('anio')
            ->add('anio', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->date('inicio')
            ->requirePresence('inicio', 'create')
            ->notEmpty('inicio');

        $validator
            ->date('fin')
            ->requirePresence('fin', 'create')
            ->notEmpty('fin');

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
        $rules->add($rules->isUnique(['anio']));

        return $rules;
    }
}
