<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Asignaturas Model
 *
 * @property \App\Model\Table\AsignaturaCarrerasTable|\Cake\ORM\Association\BelongsTo $AsignaturaCarreras
 * @property \App\Model\Table\AsignaturaMateriasTable|\Cake\ORM\Association\BelongsTo $AsignaturaMaterias
 * @property \App\Model\Table\AsignaturaNivelesTable|\Cake\ORM\Association\BelongsTo $AsignaturaNiveles
 *
 * @method \App\Model\Entity\Asignatura get($primaryKey, $options = [])
 * @method \App\Model\Entity\Asignatura newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Asignatura[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Asignatura|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Asignatura patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Asignatura[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Asignatura findOrCreate($search, callable $callback = null, $options = [])
 */
class AsignaturasTable extends Table
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

        $this->setTable('asignaturas');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('AsignaturaCarreras', [
            'foreignKey' => 'asignatura_carrera_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('AsignaturaMaterias', [
            'foreignKey' => 'asignatura_materia_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('AsignaturaNiveles', [
            'foreignKey' => 'asignatura_nivel_id',
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
        $rules->add($rules->existsIn(['asignatura_carrera_id'], 'AsignaturaCarreras'));
        $rules->add($rules->existsIn(['asignatura_materia_id'], 'AsignaturaMaterias'));
        $rules->add($rules->existsIn(['asignatura_nivel_id'], 'AsignaturaNiveles'));

        $rules->add($rules->isUnique(['asignatura_carrera_id', 'asignatura_materia_id', 'asignatura_nivel_id']));

        return $rules;
    }
}
