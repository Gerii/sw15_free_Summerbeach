<?php
App::uses('AppController', 'Controller');
App::uses('TeamsController', 'Controller');
App::uses('ErgebnissesController', 'Controller');
/**
 * Spielplan128s Controller
 *
 */
class Spielplan128sController extends AppController {

	/**
	 * Scaffold
	 *
	 * @var mixed
	 */
	public $scaffold;

	public $components = array('Session', 'RequestHandler', 'Auth');
	public function beforeFilter() {
		parent::beforeFilter();
		// Allow users to register and logout.
		//Security::setHash("Blowfish");
		$this -> Auth -> allow('getopponent');
		$this -> Auth -> autoRedirect = false;
	}

	function getopponent() {
		$current_team_startnumber = $this -> Session -> read('Team.Team.startnummer');
		$opponent = $this -> findOpponent("T", $current_team_startnumber, false);
		$this -> set('opponent', $opponent);
	}

	function findOpponent($prefix, $current_team_startnumber, $lost_once) {
		$teamsController = new TeamsController;
		$teamsController -> constructClasses();
		$weare = 0;
		$game = $this -> Spielplan128 -> find('all', array('conditions' => array('kontrahent_1' => $prefix . $current_team_startnumber)));

		if (count($game) == 0) {
			$game = $this -> Spielplan128 -> find('all', array('conditions' => array('kontrahent_2' => $prefix . $current_team_startnumber)));
			$opponent_number = $game[0]['Spielplan128']['kontrahent_1'];
			$weare = 2;
		} else {
			$opponent_number = $game[0]['Spielplan128']['kontrahent_2'];
			$weare = 1;
		}
		//echo json_encode($opponent_number);
		//echo json_encode($weare);
		$opponent_startnumber = substr($opponent_number, 1);
		$location = $game[0]['Spielplan128']['ort'];
		$game_number = $game[0]['Spielplan128']['spielnummer'];

		$opponent_name = $teamsController -> acquireTeamNameForStartNumber($opponent_number);

		$winner = $this -> getResult($game_number);
		//echo json_encode("Winner");
		//echo json_encode($winner);
		if ($winner != 0) {
			if ($winner == $weare) {
				return $this -> findOpponent("S", $game_number, $lost_once);
			} else {
				if ($lost_once) {
					return 'alreadylost';
				}
				$lost_once = true;
				return $this -> findOpponent("V", $game_number, $lost_once);
			}
		}

		return array('name' => $opponent_name, 'location' => $location);
	}

	public function getResult($game_number) {
		$resultController = new ErgebnissesController;
		$resultController -> constructClasses();
		return $resultController -> checkIfResultExists($game_number);
	}

	public function getteamsofgame() {
		$game_number = $this -> request -> data["gamenumber"];
		$game = $this -> Spielplan128 -> find('all', array('conditions' => array('spielnummer' => $game_number)));
		$teams;
		$error = "";
		if (count($game) == 0) {
			$error = "noGameFound";
			$this->response->statusCode(400);
		} else {
			$teams = new stdClass;
			$teamsController = new TeamsController;
			$teamsController -> constructClasses();
			$teams -> first_team = $teamsController -> acquireTeamNameForStartNumber($game[0]['Spielplan128']["kontrahent_1"]);
			$teams -> second_team = $teamsController -> acquireTeamNameForStartNumber($game[0]['Spielplan128']["kontrahent_2"]);
			if ($teams -> first_team == "noOpponentFound" || $teams -> second_team == "noOpponentFound") {
				$error = "noOpponentFound";
				$this->response->statusCode(400);
			} else {
				$resultsController = new ErgebnissesController;
				$resultsController -> constructClasses();
				$teams -> winner = $resultsController -> checkIfResultExists($game_number);
			}
		}
		$this -> set('teams', ($error == "") ? $teams : $error);
	}

}
