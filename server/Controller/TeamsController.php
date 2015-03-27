<?php
App::uses('AppController', 'Controller');
App::uses('ConnectionManager', 'Model');
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
		$lastid = 0;
		$db = ConnectionManager::getDataSource('default');
		if (!empty($_POST["name"]) && !empty($_POST["school"])) {
			$result = "";
			$queryData = "INSERT INTO `teams`(`id`, `teamname`, `schule`) VALUES ('NULL','" . $_POST['name'] . "','" . $_POST['school'] . "')";
			$result = $db -> query($queryData);			
			$team_id = $mysqli->insert_id;
			echo $team_id;
						
      //echo $result;
			//$queryData = "SELECT `id` FROM `teams` where ";
      //echo $queryData;
			//$lastid = $db->query($queryData);
      $obj = new stdClass();
      //$obj->result = "success"; //TODO check if succeeded
      http_response_code(201);
    }
    else {
      http_response_code(400);
    }
		$this -> set('teams' ,$result);
		$this -> set(array('teams'));

	}

}
