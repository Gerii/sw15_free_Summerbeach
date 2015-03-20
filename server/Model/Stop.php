<?php
App::uses('AppModel', 'Model');
/**
 * Stop Model
 *
 */
class Stop extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

	
	/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'LineStop' => array(
			'className' => 'LineStop',
			'foreignKey' => 'stop_id',
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
