<?php
App::uses('Standorte', 'Model');

/**
 * Standorte Test Case
 *
 */
class StandorteTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.standorte'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Standorte = ClassRegistry::init('Standorte');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Standorte);

		parent::tearDown();
	}

}
