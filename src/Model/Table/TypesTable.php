<?php
namespace App\Model\Table;

use App\Model\Entity\Type;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Types Model
 *
 * @property \Cake\ORM\Association\HasMany $Recettes
 * @property \Cake\ORM\Association\HasMany $Recettes00
 */
class TypesTable extends Table
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

        $this->table('types');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->hasMany('Recettes', [
            'foreignKey' => 'type_id'
        ]);
        $this->hasMany('Recettes00', [
            'foreignKey' => 'type_id'
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
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->add('order', 'valid', ['rule' => 'numeric'])
            ->requirePresence('order', 'create')
            ->notEmpty('order')
            ->add('order', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        return $validator;
    }
}
