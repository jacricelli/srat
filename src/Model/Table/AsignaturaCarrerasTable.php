<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AsignaturaCarreras Model
 *
 * @property \App\Model\Table\AsignaturasTable|\Cake\ORM\Association\HasMany $Asignaturas
 *
 * @method \App\Model\Entity\AsignaturaCarrera get($primaryKey, $options = [])
 * @method \App\Model\Entity\AsignaturaCarrera newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\AsignaturaCarrera[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AsignaturaCarrera|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AsignaturaCarrera patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\AsignaturaCarrera[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\AsignaturaCarrera findOrCreate($search, callable $callback = null, $options = [])
 */
class AsignaturaCarrerasTable extends Table
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

        $this->setTable('asignatura_carreras');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('Asignaturas', [
            'foreignKey' => 'asignatura_carrera_id'
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
