<?php
namespace App\Model\Table;

use App\Model\Entity\Diagnostico;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Diagnosticos Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Candidatos
 */
class DiagnosticosTable extends Table
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

        $this->table('diagnosticos');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->hasOne('Candidatos']);
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
            ->requirePresence('motivacion', 'create')
            ->notEmpty('motivacion');

        $validator
            ->requirePresence('habitos', 'create')
            ->notEmpty('habitos');

        $validator
            ->requirePresence('habilidades', 'create')
            ->notEmpty('habilidades');

        /*
        $validator
            ->requirePresence('especialidad', 'create')
            ->notEmpty('especialidad');

        $validator
            ->requirePresence('dificultades', 'create')
            ->notEmpty('dificultades');

        $validator
            ->requirePresence('observaciones', 'create')
            ->notEmpty('observaciones');
        */

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
        $rules->add($rules->existsIn(['candidatos_id'], 'Candidatos'));
        return $rules;
    }
}
