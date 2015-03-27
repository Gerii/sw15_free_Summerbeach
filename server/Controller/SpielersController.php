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
	
	public function addmember() {
		$lastid = 0;
		$db = ConnectionManager::getDataSource('default');
		
		// echo "add member test";
		
		if (!empty($_POST["firstname"]) && !empty($_POST["secondname"]) && !empty($_POST["dateofbirth"]) && !empty($_POST["phone"])) {
		  
		 // echo "add member test not empty";
		 
	    $result = "";
		$team_id = 1;
		$i = 1;
		$queryData = "INSERT INTO `spieler` (`id`, `team_id`, `spielernummer`, `vorname`, `nachname`, `geburtsdatum`, `telefon`, `strasse`, `plz`, `ort`, `email`, `geschlecht`, `shirt`) VALUES ('NULL','" . $team_id . "','" .$i . "','". $_POST['firstname']."','". $_POST['secondname']."','".$_POST['dateofbirth']."','".$_POST['phone']."','".$_POST['address']."','".$_POST['zip']."','".$_POST['location']."','".$_POST['email']."','".$_POST['gender']."','".$_POST['tshirt']."')";
		$result = $db -> query($queryData);			
			$team_id = $mysqli->insert_id;
			echo $team_id;
						
      //echo $result;
			//$queryData = "SELECT `id` FROM `teams` where ";
      //echo $queryData;
			//$lastid = $db->query($queryData);
      $obj = new stdClass();
      //$obj->result = "success"; //TODO check if succeeded*/
      
      
      http_response_code(201);
    }
    else {
      http_response_code(400);
    }
		$this -> set('teams' ,$result);
		$this -> set(array('teams'));

	}

}
