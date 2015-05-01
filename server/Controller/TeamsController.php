<?php
App::uses('AppController', 'Controller');
App::uses('ConnectionManager', 'Model');
App::uses('SpielersController', 'Controller');
App::uses('RefereesController', 'Controller');

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

	public $components = array('Session', 'RequestHandler', 'Auth');

	public function beforeFilter() {
		parent::beforeFilter();
		$this -> Auth -> allow();
	}

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
			$error = "registerTeamNameMissing";
		} else if ($team -> schule == "") {
			$error = "registerSchoolNameMissing";
			http_response_code(400);
		} else if (count($this -> request -> data["members"]) < 4 || count($this -> request -> data["members"]) > 7) {
			$error = "registerWrongPlayerCount";
			debug("Wrong number of players");
			http_response_code(400);
		} else if ($this -> checkMembers($this -> request -> data["members"]) == 1) {
			$error = "registerWrongPlayerData";
			debug("Wrong player data!!!");
			http_response_code(400);
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
			else if ($value["dateofbirth"] == "" || $this -> checkDateOfBirth($value["dateofbirth"]) == 1)
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

	public function login() {
		$return = "unknownError";
		$name = $this -> request -> data["username"];

		$this -> Session -> destroy();

		if ($name == "") {
			http_response_code(400);
			$return = "loginNameMissing";
		}

		//echo json_encode($this -> request);

		$foundTeam = $this -> Team -> find('all', array('conditions' => array('LOWER(teamname)' => strtolower($name))));
		if (count($foundTeam) == 1) {
			$return = $foundTeam[0];
			$this -> Session -> write('Team', $return);
		} else if (count($foundTeam) > 1) {
			http_response_code(400);
			$return = "loginFoundMoreThanOneTeam";
		} else {
			$refereesController = new RefereesController;
			$refereesController -> constructClasses();
			if ($refereesController -> refereeExists($name)) {
				$return = "thisIsReferee";
			}
		}
		$this -> set('teams', $return);
	}

}
