<?php
App::uses('AppController', 'Controller');
App::uses('RefereesController', 'Controller');
/**
 * Teamnames Controller
 *
 * @property Teamname $Teamname
 * //@property PaginatorComponent $Paginator
 */
class TeamnamesController extends AppController {

	public $components = array('Session', 'RequestHandler', 'Auth');

	/*public function login() {
	 echo json_encode($this -> request);
	 $teamname = $this -> request -> data["username"];

	 echo json_encode($teamname);

	 $this -> Session -> destroy();

	 if ($teamname == "") {
	 http_response_code(400);
	 $return = "loginNameMissing";
	 }

	 //echo json_encode($this-> request);

	 $foundTeam = $this -> Team -> find('all', array('conditions' => array('LOWER(teamname)' => strtolower($teamname))));
	 if (count($foundTeam) == 1) {
	 $return = $foundTeam[0];
	 $this -> Session -> write('Team', $return);
	 } else if (count($foundTeam) > 1) {
	 http_response_code(400);
	 $return = "loginFoundMoreThanOneTeam";
	 } else {
	 $refereesController = new RefereesController;
	 $refereesController -> constructClasses();

	 $refereesController -> login($name);

	 }

	 $this -> set('teams', $return);
	 }*/

	public function beforeFilter() {
		parent::beforeFilter();
		// Allow users to register and logout.
		//Security::setHash("Blowfish");
		$this -> Auth -> allow('add', 'logout');
	}

	public function login() {
		$this -> Session -> destroy();
		if ($this -> request -> is('post')) {
			if ($this -> Auth -> login()) {
				$this -> Session -> setFlash(__('I am in the if3'));
				return $this -> redirect($this -> Auth -> redirectUrl());
			}
			$this -> Session -> setFlash(__('Invalid username or password, try again'));
		}
	}

	public function logout() {
		return $this -> redirect($this -> Auth -> logout());
	}

	public function index() {
		$this -> Teamname -> recursive = 0;
		$this -> set('teamnames', $this -> paginate());
	}

	public function view($id = null) {
		$this -> Teamname -> id = $id;
		if (!$this -> Teamname -> exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this -> set('teamnames', $this -> Teamnames -> read(null, $id));
	}

	public function add() {
		if ($this -> request -> is('post')) {
			$this -> Teamname -> create();
			if ($this -> Teamname -> save($this -> request -> data)) {
				$this -> Session -> setFlash(__('The user has been saved'));
				return $this -> redirect(array('action' => 'index'));
			}
			$this -> Session -> setFlash(__('The user could not be saved. Please, try again.'));
		}
	}

	public function edit($id = null) {
		$this -> Teamname -> id = $id;
		if (!$this -> Teamname -> exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this -> request -> is('post') || $this -> request -> is('put')) {
			if ($this -> Teamname -> save($this -> request -> data)) {
				$this -> Session -> setFlash(__('The user has been saved'));
				return $this -> redirect(array('action' => 'index'));
			}
			$this -> Session -> setFlash(__('The user could not be saved. Please, try again.'));
		} else {
			$this -> request -> data = $this -> Teamname -> read(null, $id);
			unset($this -> request -> data['Teamname']['password']);
		}
	}

	public function delete($id = null) {
		// Prior to 2.5 use
		// $this->request->onlyAllow('post');

		$this -> request -> allowMethod('post');

		$this -> Teamname -> id = $id;
		if (!$this -> Teamname -> exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this -> Teamname -> delete()) {
			$this -> Session -> setFlash(__('User deleted'));
			return $this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('User was not deleted'));
		return $this -> redirect(array('action' => 'index'));
	}

}
