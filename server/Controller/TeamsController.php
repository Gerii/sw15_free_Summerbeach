<?php
App::uses('AppController', 'Controller');
App::uses('ConnectionManager', 'Model');
App::uses('SpielersController', 'Controller');
/**
 * Teams Controller
 *
 */
class TeamsController extends AppController {

	/**
	 * Scaffold
	 *
	 * @var mixed
	 */
	public $scaffold;

	public $components = array('Session', 'RequestHandler');

	public function addteam() {
		$teamid = 0;
		$team = new stdClass;
		$team -> teamname = $this -> request -> data["name"];
		$team -> schule = $this -> request -> data["school"];
		$spielersController = new SpielersController;
		$spielersController -> constructClasses();

		$error = "noerror";

		if ($team -> teamname == "") {
			http_response_code(400);
			$error = "TeamNameMissing";
		} else if ($team -> schule == "") {
			$error = "SchoolNameMissing";
			http_response_code(400);
		} else if ($this -> checkMembers($this -> request -> data["members"]) == 1) {
			$error = "WrongPlayerData";
			debug("Wrong player data!!!");
			http_response_code(201);
		} else {

			//foreach ($this -> request ->data["members"] as $value)
			//$spielersController -> checkMember($value);

			if ($this -> Team -> save($team)) {
				$this -> Session -> setFlash('Team saved');
			} else {
				$this -> Session -> setFlash('Team not saved');
			}

			$counter = 0;
			foreach ($this -> request ->data["members"] as $value) {
				$counter++;
				$spielersController -> addMember($this -> Team -> getLastInsertID(), $value, $counter);
			}

			http_response_code(201);
		}
		$this -> set('teams', $error);
		$this -> set(array('teams'));

	}

	function checkMembers($members) {
		debug("checking member");
		$counter = 0;
		foreach ($members as $value) {
			$counter++;
			if ($value["firstname"] == "")
				return 1;
			else if ($value["secondname"] == "")
				return 1;
			else if (($counter == 1) && (($value["email"] == "") || !filter_var($value["email"], FILTER_VALIDATE_EMAIL)))
				return 1;
			else if ($value["phone"] == "")
				return 1;
			else if ($value["dateofbirth"] == "" || $this->checkDateOfBirth($value["dateofbirth"]) == 1)
				return 1;
		}

		return 0;
	}

	function checkDateOfBirth($player_date) {
		$start_date = strtotime('1960-01-01');
		$end_date = strtotime('2001-12-31');
		$player_date = strtotime($player_date);

		if ($player_date >= $end_date || $player_date <= $start_date)
			return 1;
		return 0;
	}

}
