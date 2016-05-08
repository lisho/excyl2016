<?php
namespace App\Model\Table;

use App\Model\Entity\Candidato;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Candidatos Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Ceas
 * @property \Cake\ORM\Association\BelongsTo $Clasificados
 */
class CandidatosTable extends Table
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

        $this->table('candidatos');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Ceas', [
            'foreignKey' => 'cea_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Clasificados', [
            'foreignKey' => 'clasificado_id',
            'joinType' => 'INNER'
        ]);
        $this->hasOne('Diagnosticos', [
            
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
            ->requirePresence('dni', 'create')
            ->notEmpty('dni')
            ->add('dni', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->requirePresence('nombre', 'create')
            ->notEmpty('nombre');

        $validator
            ->requirePresence('apellidos', 'create')
            ->notEmpty('apellidos');

        $validator
            ->requirePresence('direccion', 'create')
            ->notEmpty('direccion');

        $validator
            ->requirePresence('expediente', 'create')
            ->notEmpty('expediente');

        $validator
            ->date('nacimiento')
            ->requirePresence('nacimiento', 'create')
            ->notEmpty('nacimiento');

        $validator
            ->requirePresence('tipo', 'create')
            ->notEmpty('tipo');

        $validator
            ->requirePresence('estudios', 'create')
            ->notEmpty('estudios');

        $validator
            ->requirePresence('telefono', 'create')
            ->notEmpty('telefono');

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
        $rules->add($rules->isUnique(['dni']));
        $rules->add($rules->existsIn(['cea_id'], 'Ceas'));
        $rules->add($rules->existsIn(['clasificado_id'], 'Clasificados'));
        return $rules;
    }
}
