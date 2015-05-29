<?php
App::uses('AppController', 'Controller');
App::uses('ConnectionManager', 'Model');
/**
 * Spielers Controller
 *
 */
class SpielersController extends AppController {

	/**
	 * Scaffold
	 *
	 * @var mixed
	 */
	public $scaffold;

	public $components = array('Session', 'RequestHandler');

	public function addmember($teamid, $member, $playernumber) {
	  
    $gender = ($member["gender"] == "f") ? "w" : "m";
    
		$db = ConnectionManager::getDataSource('default');

		$memberGerman = new stdClass;
		$memberGerman -> team_id = $teamid;
		$memberGerman -> spielernummer = $playernumber;
		$memberGerman -> vorname = $member["firstname"];
		$memberGerman -> nachname = $member["secondname"];
		$memberGerman -> geburtsdatum = $member["dateofbirth"];
		$memberGerman -> telefon = $member["phone"];
		$memberGerman -> strasse = $member["address"];
		$memberGerman -> plz = $member["zip"];
		$memberGerman -> ort = $member["location"];
		$memberGerman -> email = $member["email"];
		$memberGerman -> geschlecht = $gender;
		$memberGerman -> shirt = $member["tshirt"];
		$memberGerman -> oeamtc = json_decode($member["oeamtc"]);
		
		$this -> Spieler -> create();
		if ($this -> Spieler -> save($memberGerman)) {
			$this -> Session -> setFlash('Member saved');
		} else {
			//TODO error
			$this -> Session -> setFlash('Member not saved');
		}

		$this -> set('teams', 0);
		$this -> set(array('teams'));

	}

}
