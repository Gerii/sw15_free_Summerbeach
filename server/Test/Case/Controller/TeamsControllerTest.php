<?php
App::uses('TeamsController', 'Controller');

/**
 * TeamsController Test Case
 *
 */
class TeamsControllerTest extends ControllerTestCase {

	/**
	 * Fixtures
	 *
	 * @var array
	 */
	public $fixtures = array('app.team');

	public function setUp() {
		parent::setUp();

		// Load Contact Model
		$this -> Team = ClassRegistry::init('Team');
	}

	/**
	 * testAddteam method
	 *
	 * @return void
	 */
	public function testAddTeam() {
		$team = "blub";
		$school = "bluuub";
		$data = array('name' => $team, 'school' => $school, 'members' => array());
		$before = $this -> Team -> find('count', array('conditions' => array('Team.teamname' => $team, 'Team.schule' => $school)));
		$this -> testAction('/Teams/addteam.json', array('data' => $data, 'method' => 'post'));
		$after = $this -> Team -> find('count', array('conditions' => array('Team.teamname' => $team, 'Team.schule' => $school)));

		// Test DB entry
		$this -> assertEqual($after - $before, 1);
	}

}
