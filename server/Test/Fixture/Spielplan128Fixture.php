<?php
/**
 * Spielplan128Fixture
 *
 */
class Spielplan128Fixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'spielplan128';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'spielnummer' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 3, 'unsigned' => false, 'key' => 'primary'),
		'kontrahent_1' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 4, 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'kontrahent_2' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 4, 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'ort' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 5, 'unsigned' => false),
		'indexes' => array(
			'PRIMARY' => array('column' => 'spielnummer', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_bin', 'engine' => 'MyISAM')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'spielnummer' => 1,
			'kontrahent_1' => 'Lo',
			'kontrahent_2' => 'Lo',
			'ort' => 1
		),
	);

}
