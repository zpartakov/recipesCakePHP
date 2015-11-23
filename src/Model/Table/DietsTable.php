<?php
namespace App\Model\Table;

use App\Model\Entity\Diet;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Diets Model
 *
 * @property \Cake\ORM\Association\HasMany $Recettes
 * @property \Cake\ORM\Association\HasMany $Recettes00
 */
class DietsTable extends Table
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

        $this->table('diets');
        $this->displayField('lib');
        $this->primaryKey('id');

        $this->hasMany('Recettes', [
            'foreignKey' => 'diet_id'
        ]);
        $this->hasMany('Recettes00', [
            'foreignKey' => 'diet_id'
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
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('lib', 'create')
            ->notEmpty('lib');

        $validator
            ->requirePresence('rem', 'create')
            ->notEmpty('rem');

        $validator
            ->requirePresence('date_mod', 'create')
            ->notEmpty('date_mod');

        return $validator;
    }
}
