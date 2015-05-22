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
  public function checkIfResultExists($game_number)
  {
      $foundResult = $this -> Ergebniss -> find('all', array('conditions' => array('spielnummer' => $game_number)));
      if(count($foundResult) == 0)
      {
        return 0;
      }
      else if($foundResult[0]['Ergebniss']['gewinner'] == 1)
      {
        return 1;
      }
      else if($foundResult[0]['Ergebniss']['gewinner'] == 2)
      {
        return 2;
      }
      
      return 0;
     }



}
