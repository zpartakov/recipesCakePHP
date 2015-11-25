<?php
namespace App\Model\Table;

use App\Model\Entity\VinsMillesime;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * VinsMillesimes Model
 *
 * @property \Cake\ORM\Association\BelongsTo $VinTypes
 */
class VinsMillesimesTable extends Table
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

        $this->table('vins_millesimes');

        $this->belongsTo('VinTypes', [
            'foreignKey' => 'vin_type_id',
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
            ->requirePresence('an', 'create')
            ->notEmpty('an');

        $validator
            ->add('millesime', 'valid', ['rule' => 'numeric'])
            ->requirePresence('millesime', 'create')
            ->notEmpty('millesime');

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
        $rules->add($rules->existsIn(['vin_type_id'], 'VinTypes'));
        return $rules;
    }
}
