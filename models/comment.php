<?php
class Comment extends AppModel {
	var $name = 'Comment';
	var $displayField = 'name';
	var $validate = array(
		'recette_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),

			'email' => array(
					'rule' => 'email',
					'required' => true,
					'allowEmpty' => false,
					'message' => "Vous devez saisir une adresse email valide."
			),
				
		'text' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Recette' => array(
			'className' => 'Recette',
			'foreignKey' => 'recette_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
?>