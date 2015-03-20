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

	
            
	public function addteam() {
		$lastid = 0;
		$db = ConnectionManager::getDataSource('default');
		if (!empty($_POST["teamname"]) && !empty($_POST["schule"])) {
			$result = "";
			$queryData = "INSERT INTO `teams`(`id`, `teamname`, `schule`) VALUES ('','" . $_POST['teamname'] . "','" . $_POST['schule'] . "')";
			$result = $db -> query($queryData);
			$lastid = $queryData;
			}
		

		$this -> set('teams', $lastid);
		$this -> set(array('teams'));

		}
}