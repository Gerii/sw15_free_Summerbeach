<?php
App::uses('ErgebnissesController', 'Controller');

/**
 * ErgebnissesController Test Case
 *
 */
class ErgebnissesControllerTest extends ControllerTestCase {

	/**
	 * Fixtures
	 *
	 * @var array
	 */
	public $fixtures = array('app.ergebnisse');
	public function setUp() {
		parent::setUp();
		$this -> Ergebniss = ClassRegistry::init('Ergebniss');
	}
	
	public function testSaveNewResult() {
		$game_number = 110;
		$winner = 1;
		$data = array('gamenumber' => $game_number, 'winner' => $winner);

		$this -> assertEqual($this -> insertResult($data), 1);
	}
		public function testUpdateResult() {
		$game_number = 100;
		$winner = 2;
		$data = array('gamenumber' => $game_number, 'winner' => $winner);

		$this -> assertEqual($this -> insertResult($data), 0);
	}

	private function insertResult($data) {
		$query = array('Ergebniss.spielnummer' => $data['gamenumber'], 'Ergebniss.gewinner' => $data['winner']);
		$before = $this -> Ergebniss -> find('count', array('conditions' => $query));
		$this -> testAction('/Ergebnisses/saveresult.json', array('data' => $data, 'method' => 'post'));
		$after = $this -> Ergebniss -> find('count', array('conditions' => $query));
		debug($before);
		debug($after);
		return $after - $before;
	}

}
