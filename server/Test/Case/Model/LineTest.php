<?php
App::uses('Line', 'Model');

/**
 * Line Test Case
 *
 */
class LineTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.line',
		'app.line_stop'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Line = ClassRegistry::init('Line');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Line);

		parent::tearDown();
	}

}
