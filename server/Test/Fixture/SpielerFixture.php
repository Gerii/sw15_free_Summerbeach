<?php
/**
 * SpielerFixture
 *
 */
class SpielerFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'spieler';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => false, 'key' => 'primary'),
		'team_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => false),
		'spielernummer' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 1, 'unsigned' => false),
		'vorname' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 100, 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'nachname' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 100, 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'geburtsdatum' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 100, 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'telefon' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 100, 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'strasse' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 100, 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'plz' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 4, 'unsigned' => false),
		'ort' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 100, 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'email' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 100, 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'schulsprecher' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'checkin' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'spark7' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'team_id' => 1,
			'spielernummer' => 1,
			'vorname' => 'Lorem ipsum dolor sit amet',
			'nachname' => 'Lorem ipsum dolor sit amet',
			'geburtsdatum' => 'Lorem ipsum dolor sit amet',
			'telefon' => 'Lorem ipsum dolor sit amet',
			'strasse' => 'Lorem ipsum dolor sit amet',
			'plz' => 1,
			'ort' => 'Lorem ipsum dolor sit amet',
			'email' => 'Lorem ipsum dolor sit amet',
			'schulsprecher' => 1,
			'checkin' => 1,
			'spark7' => 1
		),
	);

}
