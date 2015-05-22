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
	//public $fixtures = array('app.spielplan128');

	public function setUp() {
		parent::setUp();
		$this -> Spielplan128 = ClassRegistry::init('Spielplan128');
	}

	public function testFindOpponentFirstGame() {
		$result = $this -> generate("Spielplan128s") -> findOpponent("T", 1, false);
		$this -> assertEqual($result["name"], "BibelTV");
		$this -> assertEqual($result["location"], "1");
	}

	public function testFindOpponentSecondGame() {
		$result = $this -> generate("Spielplan128s") -> findOpponent("T", 2, false);
		$this -> assertEqual($result["name"], "Herta 2");
		$this -> assertEqual($result["location"], "2");
	}
	public function testFindOpponentLostTwoTimes() {
		$result = $this -> generate("Spielplan128s") -> findOpponent("T", 29, false);
		$this -> assertEqual($result, "alreadylost");
	}
	public function testFindOpponentFourGames() {
		$result = $this -> generate("Spielplan128s") -> findOpponent("T", 18, false);
		$this -> assertEqual($result["name"], "Herta 1");
		$this -> assertEqual($result["location"], "2");	
	}
}
