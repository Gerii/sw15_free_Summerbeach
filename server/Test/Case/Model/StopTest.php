<?php
App::uses('Stop', 'Model');

/**
 * Stop Test Case
 *
 */
class StopTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.stop'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Stop = ClassRegistry::init('Stop');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Stop);

		parent::tearDown();
	}

}
