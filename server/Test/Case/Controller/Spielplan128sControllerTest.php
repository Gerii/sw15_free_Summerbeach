<?php
App::uses('Spielplan128sController', 'Controller');

/**
 * Spielplan128sController Test Case
 *
 */
class Spielplan128sControllerTest extends ControllerTestCase {

	/**
	 * Fixtures
	 *
	 * @var array
	 */
	public $fixtures = array('app.spielplan128');

	public function setUp() {
		parent::setUp();
		$this -> Spielplan128 = ClassRegistry::init('Spielplan128');
	}

	public function testFindOpponentFirstGame() {
		$result = $this -> generate("Spielplan128s") ->  findOpponent("T", 1, false);
		$this -> assertEqual($result["name"], "KeinTeamSystemAdmin01");
		$this -> assertEqual($result["location"], "1");
	}

}
