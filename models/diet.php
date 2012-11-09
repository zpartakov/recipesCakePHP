<?php
class Diet extends AppModel {
	var $name = 'Diet';
	var $displayField = 'lib';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasMany = array(
		'Recette' => array(
			'className' => 'Recette',
			'foreignKey' => 'diet_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
?>