<?php
App::uses('Spielplan128', 'Model');

/**
 * Spielplan128 Test Case
 *
 */
class Spielplan128Test extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.spielplan128'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Spielplan128 = ClassRegistry::init('Spielplan128');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Spielplan128);

		parent::tearDown();
	}

}
