<?php
App::uses('AppModel', 'Model');
/**
 * Spieler Model
 *
 */
class Spieler extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'spieler';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'vorname';

}
