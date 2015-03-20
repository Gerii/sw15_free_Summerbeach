<?php
App::uses('AppModel', 'Model');
/**
 * LineStop Model
 *
 * @property Line $Line
 * @property Stop $Stop
 */
class LineStop extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Line' => array(
			'className' => 'Line',
			'foreignKey' => 'line_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Stop' => array(
			'className' => 'Stop',
			'foreignKey' => 'stop_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
