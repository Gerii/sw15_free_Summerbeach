<?php
App::uses('Spieler', 'Model');

/**
 * Spieler Test Case
 *
 */
class SpielerTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.spieler'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Spieler = ClassRegistry::init('Spieler');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Spieler);

		parent::tearDown();
	}

}
