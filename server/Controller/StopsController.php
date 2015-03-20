<?php
App::uses('AppController', 'Controller');
App::uses('ConnectionManager', 'Model');
/**
 * Stops Controller
 *
 * @property Stop $Stop
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class StopsController extends AppController {

	/**
	 * Components
	 *
	 * @var array
	 */
	public $helpers = array('Js');
	public $components = array('Paginator', 'Session', 'RequestHandler');

	public function editstopsdata() {
		$id = $_REQUEST['id'];
		$value = $_REQUEST['value'];
		$column = $_REQUEST['columnName'];
		$columnPosition = $_REQUEST['columnPosition'];
		$columnId = $_REQUEST['columnId'];
		$rowId = $_REQUEST['rowId'];

		$db = ConnectionManager::getDataSource('default');
		$queryData = "Update `stops` SET `" . $column . "` = '" . $value . "' WHERE `id` = '" . $id . "'";
		$result = $db -> query($queryData);
		$this -> set("stop", $value);
	}

	public function getstations() {
		$db = ConnectionManager::getDataSource('default');
		$queryID = "";
		if (isset($_POST["id"]) && !empty($_POST["id"])) {//if id is set
			$id = $_POST["id"];
			$queryID = " WHERE `LineStop`.`line_id` = '" . $id . "'";
		}
		$queryData = "SELECT `LineStop`.`stop_id` FROM `sa`.`line_stops` AS `LineStop`" . $queryID;
		$result = $db -> execute($queryData, array(), array(), 1);
		$result_array1 = $result -> fetchAll(PDO::FETCH_ASSOC);
		$linearray = array();
		foreach ($result_array1 as $row) {
			$linearray[] = $row['stop_id'];
		}

		$this -> set('stop', $this -> Stop -> find('all', array('fields' => array('Stop.id', 'Stop.name', 'Stop.lon', 'Stop.lat', 'Stop.tram', 'Stop.bus'), 'conditions' => array('Stop.id' => $linearray), 'recursive' => 0, 'order' => array('Stop.id' => 'ASC'))));

		$this -> set(array('stop'));
	}

	public function getallstations() {
		$this -> Stop -> recursive = 0;
		if (isset($_POST["id"]) && !empty($_POST["id"])) {
			$db = ConnectionManager::getDataSource('default');
			$queryData = "SELECT `Lines`.`type` FROM `sa`.`lines` AS `Lines` WHERE `id` = '" . $_POST["id"] . "'";
			$result = $db -> execute($queryData, array(), array(), 1);
			$result_array1 = $result -> fetchAll(PDO::FETCH_ASSOC);

			if ($result_array1['0']['type'] == 1) {
				$this -> set('stop', $this -> Stop -> find('all', array('conditions' => array('Stop.tram' => 1))));
			} elseif ($result_array1['0']['type'] == 2) {
				$this -> set('stop', $this -> Stop -> find('all', array('conditions' => array('Stop.bus' => 1))));
			} else {
				$this -> set('stop', $this -> Stop -> find('all'));
			}
		} else {
			$this -> set('stop', $this -> Stop -> find('all'));
		}
		$this -> set(array('stop'));
	}

	/**
	 * index method
	 *
	 * @return void
	 */
	public function index() {
		$this -> Stop -> recursive = 0;
		$this -> set('stops', $this -> Paginator -> paginate());
	}

	public function name($gllong = null, $long = null, $gllat = null, $lat = null, $name = null) {
		// debug($this->params);
		// $db = ConnectionManager::getDataSource('default');
		// $queryData = "SELECT `id` FROM `lines` ORDER BY `id` DESC LIMIT 1 ";
		// $result = $db->execute($queryData,array(),array(),1);
		// $result_array = $result->fetchAll(PDO::FETCH_ASSOC);
		// debug($name);
		if ($gllong == '/glon/lon/glat/lat/name') {
			return $this -> redirect('/stops/name/glon/lon/glat/lat/name');
		}

		$long = substr($long, 3);
		$lat = substr($lat, 3);

		if ($gllong == "glon1") {
			$lon1 = $long;
			$lon2 = 360;
		} else {
			$lon1 = -360;
			$lon2 = $long;
		}
		if ($gllat == "glat1") {
			$lat1 = $lat;
			$lat2 = 360;
		} else {
			$lat1 = -360;
			$lat2 = $lat;
		}

		if ($long == null) {
			$lon1 = -360;
			$lon2 = 360;
		}

		if ($lat == null) {
			$lat1 = -360;
			$lat2 = 360;
		}

		if ($name !== "name") {
			$name = substr($name, 4);
			$this -> set('stops', $this -> Stop -> find('all', array('fields' => array('Stop.id', 'Stop.name', 'Stop.lon', 'Stop.lat', 'Stop.tram', 'Stop.bus'), 'conditions' => array('Stop.name' => $name, 'Stop.lon BETWEEN ? AND ?' => array($lon1, $lon2), 'Stop.lat BETWEEN ? AND ?' => array($lat1, $lat2)), 'recursive' => 0, 'order' => array('Stop.id' => 'ASC'))));
		} else {
			$this -> set('stops', $this -> Stop -> find('all', array('fields' => array('Stop.id', 'Stop.name', 'Stop.lon', 'Stop.lat', 'Stop.tram', 'Stop.bus'), 'conditions' => array('Stop.lon BETWEEN ? AND ?' => array($lon1, $lon2), 'Stop.lat BETWEEN ? AND ?' => array($lat1, $lat2)), 'recursive' => 0, 'order' => array('Stop.id' => 'ASC'))));
		}
		// if (!$this->Stop->exists($name)) {
		// throw new NotFoundException(__('Invalid name'));
		// }
		//$this->set('stop', $this->Stop->find('first', array('conditions' => array('Stop.name' => $name))));
	}

	public function addline() {
		$lon2 = 360;
		$lon1 = -360;
		$lat2 = 360;
		$lat1 = -360;
		$lon1 = -360;
		$lon2 = 360;
		$lat1 = -360;
		$lat2 = 360;
		$this -> set('stops', $this -> Stop -> find('all', array('fields' => array('Stop.id', 'Stop.name', 'Stop.lon', 'Stop.lat', 'Stop.tram', 'Stop.bus'), 'conditions' => array('Stop.lon BETWEEN ? AND ?' => array($lon1, $lon2), 'Stop.lat BETWEEN ? AND ?' => array($lat1, $lat2)), 'recursive' => 0, 'order' => array('Stop.id' => 'ASC'))));
	}

	/**
	 * view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function view($id = null) {
		if (!$this -> Stop -> exists($id)) {
			throw new NotFoundException(__('Invalid stop'));
		}
		$options = array('conditions' => array('Stop.' . $this -> Stop -> primaryKey => $id));
		$this -> set('stop', $this -> Stop -> find('first', $options));
	}

	/**
	 * add method
	 *
	 * @return void
	 */
	public function add() {
		if ($this -> request -> is('post')) {
			$this -> Stop -> create();
			if ($this -> Stop -> save($this -> request -> data)) {
				$this -> Session -> setFlash(__('The stop has been saved.'));
				return $this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The stop could not be saved. Please, try again.'));
			}
		}
	}

	/**
	 * edit method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function edit($id = null) {
		if (!$this -> Stop -> exists($id)) {
			throw new NotFoundException(__('Invalid stop'));
		}
		if ($this -> request -> is(array('post', 'put'))) {
			if ($this -> Stop -> save($this -> request -> data)) {
				$this -> Session -> setFlash(__('The stop has been saved.'));
				return $this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The stop could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Stop.' . $this -> Stop -> primaryKey => $id));
			$this -> request -> data = $this -> Stop -> find('first', $options);
		}
	}

	/**
	 * delete method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function delete($id = null) {
		$this -> Stop -> id = $id;
		if (!$this -> Stop -> exists()) {
			throw new NotFoundException(__('Invalid stop'));
		}
		$this -> request -> allowMethod('post', 'delete');
		if ($this -> Stop -> delete()) {
			$this -> Session -> setFlash(__('The stop has been deleted.'));
		} else {
			$this -> Session -> setFlash(__('The stop could not be deleted. Please, try again.'));
		}
		return $this -> redirect(array('action' => 'index'));
	}

}
