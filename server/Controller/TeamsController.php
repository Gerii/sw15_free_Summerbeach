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

		//foreach ($this -> request ->data["members"] as $value)
			//$spielersController -> checkMember($value);

		$db = ConnectionManager::getDataSource('default');
		if (!empty($_POST["name"]) && !empty($_POST["school"])) {
			$result = "";
			//echo json_encode($this -> Team -> find('all'));
			//echo json_encode($this -> request -> data);
			if ($this -> Team -> save($team)) {
				$this -> Session -> setFlash('Team saved');
			} else {
				$this -> Session -> setFlash('Team not saved');
			}
			//$queryData = "INSERT INTO `teams`(`id`, `teamname`, `schule`) VALUES ('NULL','" . $_POST['name'] . "','" . $_POST['school'] . "')";
			//$result = $db -> query($queryData);

			//$teamid = $db -> query("SELECT LAST_INSERT_ID() AS id");
			//echo mysql_insert_id();
			//echo json_encode($teamid);

			$counter = 0;
			foreach ($this -> request ->data["members"] as $value) {
				$counter++;
				$spielersController -> addMember($this -> Team -> getLastInsertID(), $value, $counter);
			}
			//echo $result;
			//$queryData = "SELECT `id` FROM `teams` where ";
			//echo $queryData;
			//$lastid = $db->query($queryData);
			$obj = new stdClass();
			//$obj->result = "success"; //TODO check if succeeded
			http_response_code(201);
		} else {
			http_response_code(400);
		}
		$this -> set('teams', 0);
		$this -> set(array('teams'));

	}

}
