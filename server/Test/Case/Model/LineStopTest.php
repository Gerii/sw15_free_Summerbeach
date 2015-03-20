<?php
App::uses('LineStop', 'Model');

/**
 * LineStop Test Case
 *
 */
class LineStopTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.line_stop',
		'app.line',
		'app.stop'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->LineStop = ClassRegistry::init('LineStop');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->LineStop);

		parent::tearDown();
	}

}
