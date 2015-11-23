<?php
namespace App\Model\Table;

use App\Model\Entity\ModeCuisson;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ModeCuissons Model
 *
 * @property \Cake\ORM\Association\HasMany $Recettes
 * @property \Cake\ORM\Association\HasMany $Recettes00
 */
class ModeCuissonsTable extends Table
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
        

        $this->table('mode_cuissons');
        $this->displayField('lib');
        $this->primaryKey('id');

        $this->hasMany('Recettes', [
            'foreignKey' => 'mode_cuisson_id'
        ]);
        $this->hasMany('Recettes00', [
            'foreignKey' => 'mode_cuisson_id'
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
            ->add('parent', 'valid', ['rule' => 'numeric'])
            ->requirePresence('parent', 'create')
            ->notEmpty('parent');

        $validator
            ->requirePresence('lib', 'create')
            ->notEmpty('lib');

        $validator
            ->requirePresence('rem', 'create')
            ->notEmpty('rem');

        $validator
            ->requirePresence('img', 'create')
            ->notEmpty('img');

        return $validator;
    }
}
