<?php
App::uses('Ergebnisse', 'Model');

/**
 * Ergebnisse Test Case
 *
 */
class ErgebnisseTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.ergebnisse'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Ergebnisse = ClassRegistry::init('Ergebnisse');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Ergebnisse);

		parent::tearDown();
	}

}
