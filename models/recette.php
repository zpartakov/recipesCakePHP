<?php
class Recette extends AppModel {
	var $name = 'Recette';
		var $displayField = 'titre';

	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Type' => array(
			'className' => 'Type',
			'foreignKey' => 'type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'ModeCuisson' => array(
			'className' => 'ModeCuisson',
			'foreignKey' => 'mode_cuisson_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Diet' => array(
			'className' => 'Diet',
			'foreignKey' => 'diet_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	var $hasMany = array('Comment'=>array('className'=>'Comment'));
}
?>
