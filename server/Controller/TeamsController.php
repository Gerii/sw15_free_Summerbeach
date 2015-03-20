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
		if (!empty($_POST["teamname"]) && !empty($_POST["schule"])) {
			$result = "";
			$queryData = "INSERT INTO `teams`(`id`, `teamname`, `schule`) VALUES ('','" . $_POST['teamname'] . "','" . $_POST['schule'] . "')";
			$result = $db -> query($queryData);
      //echo $result;
			$queryData = "SELECT * FROM `teams`";
      //echo $queryData;
			$lastid = $db->query($queryData);
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
