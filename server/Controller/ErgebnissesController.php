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
  public function checkIfResultExists($game_number)
  {
      $foundResult = $this -> Ergebnisse -> find('all', array('conditions' => array('spielnummer' => $game_number)));
      if(count(foundResult) == 0)
      {
        return 0;
      }
      else if($foundResult[0]['Ergebnisse']['gewinner'] == 1)
      {
        return 1;
      }
      else if($foundResult[0]['Ergebnisse']['gewinner'] == 2)
      {
        return 2;
      }
      
      return 0;
     }



}
