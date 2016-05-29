<?php
namespace App\Model\Table;

use App\Model\Entity\Recette;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Recettes Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Types
 * @property \Cake\ORM\Association\BelongsTo $ModeCuissons
 * @property \Cake\ORM\Association\BelongsTo $Diets
 * @property \Cake\ORM\Association\HasMany $Comments
 * @property \Cake\ORM\Association\HasMany $Menus
 * @property \Cake\ORM\Association\HasMany $RecetteUser
 * @property \Cake\ORM\Association\HasMany $Stats
 * @property \Cake\ORM\Association\HasMany $UsersTags
 * @property \Cake\ORM\Association\BelongsToMany $Tags
 */
class RecettesTable extends Table
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
        
        $this->table('recettes');

        $this->primaryKey('id');

        $this->belongsTo('Types', [
            'foreignKey' => 'type_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('ModeCuissons', [
            'foreignKey' => 'mode_cuisson_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Diets', [
            'foreignKey' => 'diet_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Comments', [
            'foreignKey' => 'recette_id'
        ]);
        $this->hasMany('Menus', [
            'foreignKey' => 'recette_id'
        ]);
        $this->hasMany('RecetteUser', [
            'foreignKey' => 'recette_id'
        ]);
        $this->hasMany('Stats', [
            'foreignKey' => 'recette_id'
        ]);
        $this->hasMany('UsersTags', [
            'foreignKey' => 'recette_id'
        ]);
        $this->belongsToMany('Tags', [
            'foreignKey' => 'recette_id',
            'targetForeignKey' => 'tag_id',
            'joinTable' => 'recettes_tags'
        ]);
        
		$this->hasOne('RIngrs', [
            'foreignKey' => 'recette_id',
			$this->displayField('ingr')

        ]);
        
         $this->hasOne('RPreps', [
            'foreignKey' => 'recette_id',
			$this->displayField('prep')

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
            ->requirePresence('prov', 'create')
            ->notEmpty('prov');

        $validator
            //->allowEmpty('titre')
            //->requirePresence('titre', 'create')
            //->notEmpty('titre');
            ->add('titre', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);
/*
$validator->add('titre', 'unique', [
    'rule' => 'uniqueTitre',
    'provider' => 'table'
]);
*/

        $validator
            ->requirePresence('temps', 'create')
            ->notEmpty('temps');

      /*  $validator
            ->requirePresence('ingr', 'create')
            ->notEmpty('ingr'); */

        $validator
            ->add('pers', 'valid', ['rule' => 'numeric'])
            ->requirePresence('pers', 'create')
            ->notEmpty('pers');

/*        $validator
            ->requirePresence('prep', 'create')
            ->notEmpty('prep'); */

        $validator
            ->add('date', 'valid', ['rule' => 'date'])
            ->requirePresence('date', 'create')
            ->notEmpty('date');

        $validator
            ->add('score', 'valid', ['rule' => 'numeric'])
            ->requirePresence('score', 'create')
            ->notEmpty('score');

        $validator
            ->requirePresence('source', 'create')
            ->notEmpty('source');

        $validator
            ->requirePresence('pict', 'create')
            ->notEmpty('pict');

        $validator
            ->add('private', 'valid', ['rule' => 'boolean'])
            ->requirePresence('private', 'create')
            ->notEmpty('private');

        $validator
            ->add('time', 'valid', ['rule' => 'numeric'])
            ->requirePresence('time', 'create')
            ->notEmpty('time');

        $validator
            ->add('difficulty', 'valid', ['rule' => 'numeric'])
            ->requirePresence('difficulty', 'create')
            ->notEmpty('difficulty');

        $validator
            ->add('price', 'valid', ['rule' => 'numeric'])
            ->requirePresence('price', 'create')
            ->notEmpty('price');

        return $validator;
    }
    
/*
public function beforeMarshal(Event $event, ArrayObject $data, ArrayObject $options)
{
   if (isset($data['username'])) {
	   //remove double blank lines
       $data['RIngrs.ingr'] = preg_replace('/[\n\n]+/', '\n', $data['RIngrs.ingr']);
       $data['RIngrs.ingr'] = preg_replace('/[\r\r]+/', '\n', $data['RIngrs.ingr']);
       $data['RPreps.prep'] = preg_replace('/[\n\n]+/', '\n', $data['RPreps.prep']);
       $data['RPreps.prep'] = preg_replace('/[\r\r]+/', '\n', $data['RPreps.prep']);
       
              $data['RIngrs.ingr'] = preg_replace('/<p>/', '', $data['RIngrs.ingr']);
              $data['RIngrs.ingr'] = preg_replace('/<\/p>/', '<br />', $data['RIngrs.ingr']);

              $data['RPreps.prep'] = preg_replace('/<p>/', '', $data['RPreps.prep']);
              $data['RPreps.prep'] = preg_replace('/<\/p>/', '<br />', $data['RPreps.prep']);

   }
}
*/
    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['type_id'], 'Types'));
        $rules->add($rules->existsIn(['mode_cuisson_id'], 'ModeCuissons'));
        $rules->add($rules->existsIn(['diet_id'], 'Diets'));
        return $rules;
    }
}
