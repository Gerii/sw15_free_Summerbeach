<?php
App::uses('AppController', 'Controller');
App::uses('ConnectionManager', 'Model');
/**
 * Referees Controller
 *
 * @property Referee $Referee
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class RefereesController extends AppController {

	/**
	 * Components
	 *
	 * @var array
	 */
	public $components = array('Session', 'RequestHandler', 'Auth');

	public function refereeExists($name) {
		$foundReferee = $this -> Referee -> find('all', array('conditions' => array('LOWER(username)' => strtolower($name))));
		if (count($foundReferee) == 1) {
			return true;
		}
		return false;
	}

	/**
	 * Proxy for Controller::redirect() to handle AJAX redirects
	 *
	 * @param string $url
	 * @param int $status
	 * @param bool $exit
	 * @return void
	 */
	public function redirect($url, $status = null, $exit = true) {
		// this statement catches not authenticated or not authorized ajax requests
		// AuthComponent will call Controller::redirect(null, 403) in those cases.
		// with this we're making sure that we return valid JSON responses in all cases
		if ($this -> request -> is('ajax') && $url == null && $status == 403) {
			$this -> response = new CakeResponse( array('code' => 'code'));
			$this -> response -> send();
			return $this -> _stop();
		}
		return parent::redirect($url, $status, $exit);
	}

	public function beforeFilter() {
		parent::beforeFilter();
		// Allow users to register and logout.
		//Security::setHash("Blowfish");
		$this -> Auth -> allow('add', 'logout', 'login');
		$this -> Auth -> autoRedirect = false;
	}

	public function login() {
		$return = "failedToLogIn";
		$this -> Session -> destroy();
		if ($this -> request -> is('post')) {
			if ($this -> Auth -> login()) {
				$return = "successfullyLoggedIn";
				$this -> Session -> setFlash(__('Valid username or password, dont try again'));
				$this->response->statusCode(201);
			} else {
				$this -> Session -> setFlash(__('Invalid username or password, try again'));
				$this->response->statusCode(400);
			}
		}
		$this -> set('teams', $return);
	}

	public function logout() {
		$this -> Auth -> logout();
		$this -> Session -> destroy();
		$this -> set('teams', "successfullyloggedout");
		
		//return $this -> redirect($this -> Auth -> logout());
	}

	public function index() {
		$this -> Referee -> recursive = 0;
		$this -> set('referees', $this -> paginate());
	}

	public function view($id = null) {
		$this -> Referee -> id = $id;
		if (!$this -> Referee -> exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this -> set('referees', $this -> Referee -> read(null, $id));
	}

	public function add() {
		if ($this -> request -> is('post')) {
			$this -> Referee -> create();
			if ($this -> Referee -> save($this -> request -> data)) {
				$this -> Session -> setFlash(__('The user has been saved'));
				return $this -> redirect(array('action' => 'index'));
			}
			$this -> Session -> setFlash(__('The user could not be saved. Please, try again.'));
		}
	}

	public function edit($id = null) {
		$this -> Referee -> id = $id;
		if (!$this -> Referee -> exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this -> request -> is('post') || $this -> request -> is('put')) {
			if ($this -> Referee -> save($this -> request -> data)) {
				$this -> Session -> setFlash(__('The user has been saved'));
				return $this -> redirect(array('action' => 'index'));
			}
			$this -> Session -> setFlash(__('The user could not be saved. Please, try again.'));
		} else {
			$this -> request -> data = $this -> Referee -> read(null, $id);
			unset($this -> request -> data['Referee']['password']);
		}
	}

	public function delete($id = null) {
		// Prior to 2.5 use
		// $this->request->onlyAllow('post');

		$this -> request -> allowMethod('post');

		$this -> Referee -> id = $id;
		if (!$this -> Referee -> exists()) {
			throw new NotFoundException(__('Invalid Referee'));
		}
		if ($this -> Referee -> delete()) {
			$this -> Session -> setFlash(__('Referee deleted'));
			return $this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Referee was not deleted'));
		return $this -> redirect(array('action' => 'index'));
	}

}
