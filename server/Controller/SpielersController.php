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
		$memberGerman -> geschlecht = $member["gender"];
		$memberGerman -> shirt = $member["tshirt"];
		

		//echo json_encode($memberGerman);

		//$memberDict = array("firstname" => "vorname", "secondname" => "nachname", "dateofbirth" => "geburtsdatum", "phone" => "telefon", "address" => "strasse", "zip" => "plz", "location" => "ort", "email" => "email", "gender" => "geschlecht", "tshirt" => "shirt");

		// echo "add member test not empty";

		$this -> Spieler -> create();
		if ($this -> Spieler -> save($memberGerman)) {
			$this -> Session -> setFlash('Member saved');
		} else {
			$this -> Session -> setFlash('Member not saved');
		}

		$result = "";
		$i = 1;
		/*$queryData = "INSERT INTO `spieler` (`id`, `team_id`, `spielernummer`, `vorname`, `nachname`, `geburtsdatum`, `telefon`,
		 `strasse`, `plz`, `ort`, `email`, `geschlecht`, `shirt`) VALUES
		 ('NULL','" . $team_id . "','" . $i . "','" . $member -> firstname . "','" . $member -> secondname . "','" . $member -> dateofbirth . "','" . $member -> phone . "','" . $member -> address . "','" . $member -> zip . "','" . $member -> location . "','" . $member -> email . "','" . $member -> gender . "','" . $member -> tshirt . "')";
		 $result = $db -> query($queryData);
		 */
		//echo $result;
		//$queryData = "SELECT `id` FROM `teams` where ";
		//echo $queryData;
		//$lastid = $db->query($queryData);
		//$obj->result = "success"; //TODO check if succeeded*/

		$this -> set('teams', 0);
		$this -> set(array('teams'));

	}

}
