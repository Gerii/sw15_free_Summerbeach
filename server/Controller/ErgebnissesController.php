<?php
App::uses('AppController', 'Controller');
/**
 * Ergebnisses Controller
 *
 */
class ErgebnissesController extends AppController {

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

	public function checkIfResultExists($game_number) {
		$foundResult = $this -> Ergebniss -> find('all', array('conditions' => array('spielnummer' => $game_number)));
		if (count($foundResult) == 0) {
			return 0;
		} else if ($foundResult[0]['Ergebniss']['gewinner'] == 1) {
			return 1;
		} else if ($foundResult[0]['Ergebniss']['gewinner'] == 2) {
			return 2;
		}

		return 0;
	}

	public function saveresult() {
		//$this -> Ergebniss -> create();
		$error = "noerror";
		$resultGerman = new stdClass;
		$resultGerman -> spielnummer = $this -> request -> data["gamenumber"];
		$resultGerman -> gewinner = $this -> request -> data["winner"];

		$foundResult = $this -> Ergebniss -> find('all', array('conditions' => array('spielnummer' => $this -> request -> data["gamenumber"])));
		if(count($foundResult) > 0) {
			$resultGerman -> id = $foundResult[0]['Ergebniss']["id"];
		}
		if ($this -> Ergebniss -> save($resultGerman)) {
			$this -> Session -> setFlash('Member saved');
		} else {
			//TODO error
			$this -> Session -> setFlash('Member not saved');
			$error = "error";
		}

		$this -> set('error', $error);
	}

}
