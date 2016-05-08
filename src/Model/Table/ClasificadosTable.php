<?php
namespace App\Model\Table;

use App\Model\Entity\Clasificado;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Clasificados Model
 *
 * @property \Cake\ORM\Association\HasMany $Candidatos
 */
class ClasificadosTable extends Table
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

        $this->table('clasificados');
        $this->displayField('clasificacion');
        $this->primaryKey('id');

        $this->hasMany('Candidatos', [
            'foreignKey' => 'clasificado_id',
         
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
            ->requirePresence('clasificacion', 'create')
            ->notEmpty('clasificacion');

        return $validator;
    }
}
