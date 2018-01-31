<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CargoTipos Model
 *
 * @property \App\Model\Table\CargosTable|\Cake\ORM\Association\HasMany $Cargos
 *
 * @method \App\Model\Entity\CargoTipo get($primaryKey, $options = [])
 * @method \App\Model\Entity\CargoTipo newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CargoTipo[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CargoTipo|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CargoTipo patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CargoTipo[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CargoTipo findOrCreate($search, callable $callback = null, $options = [])
 */
class CargoTiposTable extends Table
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

        $this->setTable('cargo_tipos');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('Cargos', [
            'foreignKey' => 'cargo_tipo_id'
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
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('nombre')
            ->maxLength('nombre', 50)
            ->requirePresence('nombre', 'create')
            ->notEmpty('nombre')
            ->add('nombre', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('obs')
            ->maxLength('obs', 255)
            ->allowEmpty('obs');

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
        $rules->add($rules->isUnique(['nombre']));

        return $rules;
    }
}
