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
			http_response_code(400);
		} else if ($this -> checkMembers($this -> request -> data["members"]) == 1) {
			$error = "registerWrongPlayerData";
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
    
    //sendRegistrationMailTeam($this->request->data["members"], $team->teamname, $team->schule);
    //sendRegistrationMailORG();
    
    
		$this -> set('teams', $error);
		$this -> set(array('teams'));

	}

	function checkMembers($members) {

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
			$return = "foundTeam";
			$this -> Session -> write('Team', $foundTeam[0]);
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

function sendRegistrationMailTeam($members, $teamname, $school)
{
  $subject = "Anmeldebestaetigung Summerbeach 2015";
  
  $title = "Liebe";
  
  if($members[0]["geschlecht"] == "m")
  {
      $title = $title."r";
  }
  
  $year = date("Y");

 $text_start = $title." ".$members[0]["firstname"].",\n\nDanke für Eure Anmeldung.\nAnbei die Daten welche du an uns uebermittelt hast.\n\n";
 $text_end = "Wir freuen uns schon auf ein geniales Summerbeach ".$year." mit euch!\n\nEuer Summerbeach ".$year." - Team";

 $team_text = "Teamname: ".$teamname."\n";
 $team_text .= "Schule: ".$school."\n\n";

 $player_text = listMembersForMail($members);
 
 $team_text .= $player_text;
 
 $email_text = $text_start.$team_text.$text_end;
 
 $from = "From: Summerbeach 2015 <info@summerbeach.at>";
 
 mail($members[0]["email"],$subject,$email_text,$from);
 
}


function sendRegistrationMailORG($members, $teamname, $school)
{
  $subject = "Anmeldung zum Summerbeach 2015 | ".$teamname." / ".$school;
  $text_start = "Lieber Steve,\nschon wieder hat sich jemand angemeldet, anbei die Daten :)!\n\n";
  
 $team_text = "Teamname: ".$teamname."\n";
 $team_text .= "Schule: ".$school."\n\n";

 $player_text = listMembersForMail($members);
 
 $team_text .= $player_text;
 
 $email_text = $text_start.$team_text.$text_end;
 
 $from = "From: Summerbeach 2015 <info@summerbeach.at>";

 $text_end = "Dein Summerbeach-Team!";
 
  
 $email_text = $text_start.$team_text.$text_end;
 
 $from = "From: Summerbeach 2015 <info@summerbeach.at>";
 
 mail("steve@summerbeach.at",$subject,$email_text,$from);
 mail("andrea.pferscher@summerbeach.at",$subject,$email_text,$from);
 

}

function listMembersForMail($members)
{
 
  $player_text = "";
  $counter = 0;
  foreach ($members as $member) {
      $player_text .= "Spieler #".++$counter;
      $player_text .= ($counter == 1) ? " / Teamleiter\n" : "\n" ;
      $player_text .= "Vorname: ".$member["firstname"]."\n";
      $player_text .= "Nachname: ".$member["secondname"]."\n";
      $player_text .= "Geburtsdatum: ".$member["dateofbirth"]."\n";
      $player_text .= "Telefon: ".$member["phone"]."\n";
      $player_text .= "Straße: ".$member["address"]."\n";
      $player_text .= "PLZ: ".$member["zip"]."\n";
      $player_text .= "Ort: ".$member["location"]."\n";
      $player_text .= "Geschlecht: ".$member["gender"]."\n";#
      $player_text .= "Playershirt: ".$member["tshirt"]."\n";
      
  }
          
   return $player_text;
}

/*function checkEmail($email)
{
  $email_valid = filter_var($mail, FILTER_VALIDATE_EMAIL);
  $this -> set('teams', $return);
}*/
