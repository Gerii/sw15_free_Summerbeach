<?php
App::uses('AppModel', 'Model');
/**
 * Team Model
 *
 */
class Team extends AppModel {

	/**
	 * Use table
	 *
	 * @var mixed False or table name
	 */
	public $name = 'Team';

	//public $validate = array('teamname' => array('required' => array('rule' => array('notEmpty'), 'message' => 'A teamname is required')));

	//public $hasMany = 'spieler';

	/**
	 * Display field
	 *
	 * @var string
	 */
	public $displayField = 'teamname';

}
