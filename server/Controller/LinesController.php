<?php
App::uses('AppController', 'Controller');
App::uses('ConnectionManager', 'Model');
/**
 * Lines Controller
 *
 * @property Line $Line
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class LinesController extends AppController {

	/**
	 * Components
	 *
	 * @var array
	 */
	public $components = array('Paginator', 'Session', 'RequestHandler');

	/*public function editdata() {
	 $id = $_REQUEST['id'] ;
	 $value = $_REQUEST['value'] ;
	 $column = $_REQUEST['columnName'] ;
	 $columnPosition = $_REQUEST['columnPosition'] ;
	 $columnId = $_REQUEST['columnId'] ;
	 $rowId = $_REQUEST['rowId'] ;

	 $db = ConnectionManager::getDataSource('default');
	 $queryData = "Update `lines` SET `".$column."` = '".$value."' WHERE ´id´ = '".$id."')";
	 $result = $db->query($queryData);
	 echo $value;
	 }*/

	/**
	 * index method
	 *
	 * @return void
	 */
	public function index() {
		// $this->Line->recursive = 0;
		$this -> set('lines', $this -> Line -> find('all'));
	}

	public function deletestops() {
		if (isset($_POST["lid"]) && !empty($_POST["lid"]) && isset($_POST["sid"]) && !empty($_POST["sid"])) {
			$db = ConnectionManager::getDataSource('default');
			$queryData = "DELETE FROM `line_stops` WHERE `line_id` = '" . $_POST["lid"] . "' and `stop_id` = '" . $_POST["sid"] . "' LIMIT 1";
			$result = $db -> query($queryData);
			$this -> redirect(array('controller' => 'lines', 'action' => 'index'));
		}
	}

	public function editlinesdata() {
		$id = $_REQUEST['id'];
		$value = $_REQUEST['value'];
		$column = $_REQUEST['columnName'];
		$columnPosition = $_REQUEST['columnPosition'];
		$columnId = $_REQUEST['columnId'];
		$rowId = $_REQUEST['rowId'];

		$db = ConnectionManager::getDataSource('default');
		$queryData = "Update `lines` SET `" . $column . "` = '" . $value . "' WHERE `id` = '" . $id . "'";
		$result = $db -> query($queryData);
		$this -> set("line", $value);
	}

	public function addline() {
		$lastid = 0;
		$db = ConnectionManager::getDataSource('default');
		if (isset($_POST["id"]) && !empty($_POST["id"])) {
			$stops = $this -> params['url']['stationids'];
			$stopids = explode(" ", $stops);
			$result = "";
			foreach ($stopids as $row) {
				// debug($row);
				$queryData = "INSERT INTO `line_stops`(`line_id`, `stop_id`) VALUES ('" . $_POST["id"] . "','" . $row . "')";
				$lastid = $_POST["id"];
				$result = $db -> query($queryData);
			}
		} else {
			$linie = $this -> params['url']['name'];
			$type = $this -> params['url']['type'];
			$typeid = 0;
			if ($type == 'bim') {
				$typeid = 1;
			} elseif ($type == 'bus') {
				$typeid = 2;
			}
			$number = $this -> params['url']['number'];
			$stops = $this -> params['url']['stationids'];
			$stopids = explode(" ", $stops);
			$queryData = "INSERT INTO `lines`(`name`, `type`, `number`) VALUES ('" . $linie . "','" . $typeid . "','" . $number . "')";
			$result = $db -> query($queryData);
			$lastid = $db -> query("SELECT LAST_INSERT_ID() AS id");
			$queryData = "SELECT `id` FROM `lines` ORDER BY `id` DESC LIMIT 1 ";
			$result = $db -> execute($queryData, array(), array(), 1);
			$result_array = $result -> fetchAll(PDO::FETCH_ASSOC);
			$lineid = $result_array['0']['id'];
			// debug($result_array['0']['id']);
			foreach ($stopids as $row) {
				$queryData = "INSERT INTO `line_stops`(`line_id`, `stop_id`) VALUES ('" . $lineid . "','" . $row . "')";
				$result = $db -> query($queryData);
			}
		}

		$this -> set('line', $lastid);
		$this -> set(array('line'));
	}

	public function find($name1 = null, $name2 = null) {
		if (isset($name1) && isset($name2)) {
			$name1 = base64_decode($name1);
			$name2 = base64_decode($name2);

			$id1 = 0;
			$id2 = 0;
			$db = ConnectionManager::getDataSource('default');
			$queryData = "SELECT `Stop`.`id` FROM `sa`.`stops` AS `Stop` WHERE `Stop`.`name` like '" . $name1 . "%'";
			$result = $db -> execute($queryData, array(), array(), 1);
			$result_id1 = $result -> fetchAll(PDO::FETCH_ASSOC);

			$queryData = "SELECT `Stop`.`id` FROM `sa`.`stops` AS `Stop` WHERE `Stop`.`name` like '" . $name2 . "%'";
			$result = $db -> execute($queryData, array(), array(), 1);
			$result_id2 = $result -> fetchAll(PDO::FETCH_ASSOC);

			$id1 = "";
			if (isset($result_id1['0']['id'])) {
				$id1 = "(";
				foreach ($result_id1 as $rid) {
					$id1 = $id1 . $rid['id'] . ", ";
				}
				$id1 = substr($id1, 0, -2);
				$id1 = $id1 . ")";
			}
			$id2 = "";
			if (isset($result_id2['0']['id'])) {
				$id2 = "(";
				foreach ($result_id2 as $rid) {
					$id2 = $id2 . $rid['id'] . ", ";
				}
				$id2 = substr($id2, 0, -2);
				$id2 = $id2 . ")";
			}

			
			if ($id1 == "" || $id2 == "") {
				$message = array();
				$this -> set('lines', $message);
				return;
			}

			$queryData = "SELECT `LineStop`.`line_id` FROM `sa`.`line_stops` AS `LineStop` WHERE `LineStop`.`stop_id` IN " . $id1;
			$result = $db -> execute($queryData, array(), array(), 1);
			$result_array1 = $result -> fetchAll(PDO::FETCH_ASSOC);
			$queryData = "SELECT `LineStop`.`line_id` FROM `sa`.`line_stops` AS `LineStop` WHERE `LineStop`.`stop_id` IN " . $id2;
			$result = $db -> execute($queryData, array(), array(), 1);
			$result_array2 = $result -> fetchAll(PDO::FETCH_ASSOC);
			$linearray = array();
			foreach ($result_array1 as $row) {
				foreach ($result_array2 as $row2) {
					if ($row['line_id'] == $row2['line_id']) {
						$linearray[] = $row['line_id'];
					}
				}
			}

			$this -> set('lines', $this -> Line -> find('all', array('fields' => array('Line.id', 'Line.name', 'Line.type', 'Line.number'), 'conditions' => array('Line.id' => $linearray), 'recursive' => 0, 'order' => array('Line.id' => 'ASC'))));
			$this -> set('_serialize', array('line'));
		}
		else if(isset($name1) || isset($name2)) {
		  $message = array();
		  $this -> set('lines', $message);
		}
		else {
			$this -> set('lines', $this -> Line -> find('all'));

		}

		//$this->Line->recursive = 0;
		//$this->set('lines', $this->Paginator->paginate());
	}

	/**
	 * view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function view($id = null) {
		if (!$this -> Line -> exists($id)) {
			throw new NotFoundException(__('Invalid line'));
		}
		$options = array('conditions' => array('Line.' . $this -> Line -> primaryKey => $id));
		$this -> set('line', $this -> Line -> find('first', $options));
	}

	/**
	 * add method
	 *
	 * @return void
	 */
	public function add() {
		if ($this -> request -> is('post')) {
			$this -> Line -> create();
			if ($this -> Line -> save($this -> request -> data)) {
				$this -> Session -> setFlash(__('The line has been saved.'));
				return $this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The line could not be saved. Please, try again.'));
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
		if (!$this -> Line -> exists($id)) {
			throw new NotFoundException(__('Invalid line'));
		}
		if ($this -> request -> is(array('post', 'put'))) {
			if ($this -> Line -> save($this -> request -> data)) {
				$this -> Session -> setFlash(__('The line has been saved.'));
				return $this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The line could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Line.' . $this -> Line -> primaryKey => $id));
			$this -> request -> data = $this -> Line -> find('first', $options);
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
		$this -> Line -> id = $id;
		if (!$this -> Line -> exists()) {
			throw new NotFoundException(__('Invalid line'));
		}
		$this -> request -> allowMethod('post', 'delete');
		if ($this -> Line -> delete()) {
			$this -> Session -> setFlash(__('The line has been deleted.'));
		} else {
			$this -> Session -> setFlash(__('The line could not be deleted. Please, try again.'));
		}
		return $this -> redirect(array('action' => 'index'));
	}

}
