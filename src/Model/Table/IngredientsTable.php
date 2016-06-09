<?php
namespace App\Model\Table;

use App\Model\Entity\Ingredient;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Ingredients Model
 *
 */
class IngredientsTable extends Table
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

        $this->table('ingredients');
        $this->displayField('id');
        $this->primaryKey('id');

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
            ->requirePresence('libelle', 'create')
            ->notEmpty('libelle')
            ->add('libelle', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

/*
        $validator
            ->requirePresence('typ', 'create')
            ->notEmpty('typ');

        $validator
            ->requirePresence('unit', 'create')
            ->notEmpty('unit');

        $validator
            ->add('kcal', 'valid', ['rule' => 'numeric'])
            ->requirePresence('kcal', 'create')
            ->notEmpty('kcal');

        $validator
            ->add('price', 'valid', ['rule' => 'decimal'])
            ->requirePresence('price', 'create')
            ->notEmpty('price');

        $validator
            ->requirePresence('img', 'create')
            ->notEmpty('img');

        $validator
            ->requirePresence('commissions', 'create')
            ->notEmpty('commissions');
*/
        return $validator;
    }
}
