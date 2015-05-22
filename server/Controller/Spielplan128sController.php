<?php
App::uses('AppController', 'Controller');
App::uses('TeamsController', 'Controller');
/**
 * Spielplan128s Controller
 *
 */
class Spielplan128sController extends AppController {

/**
 * Scaffold
 *
 * @var mixed
 */
	public $scaffold;
  
  public $components = array('Session', 'RequestHandler', 'Auth');
  
  function getopponent()
  {
    $current_team_startnumber =  $this -> Session -> read('Team.Team.startnummer');
    
    /*$resultController = new ErgebnissesController;
    $resultController -> constructClasses();
    $resultController -> checkIfResultExists($game_number);*/
    
    $opponent = $this->findOpponent("T", $current_team_startnumber);
    
    //checkResult($resultController)
   
    $this -> set('opponent', $opponent);
  }
  
    public function beforeFilter() {
    parent::beforeFilter();
    // Allow users to register and logout.
    //Security::setHash("Blowfish");
    $this -> Auth -> allow('getopponent');
    $this -> Auth -> autoRedirect = false;
    }
  function findOpponent($prefix = "", $current_team_startnumber) {
    $teamsController = new TeamsController;
    $teamsController -> constructClasses();
     
    $game = $this -> Spielplan128 -> find('all', array('conditions' => array('kontrahent_1' => $prefix.$current_team_startnumber)));
    

    if(count($game) == 0)
     {
       $game = $this -> Spielplan128 -> find('all', array('conditions' => array('kontrahent_2' => $prefix.$current_team_startnumber)));
       $opponent_number = $game[0]['Spielplan128']['kontrahent_1'];
     }
    else
    {
       $opponent_number = $game[0]['Spielplan128']['kontrahent_2'];
    }
    $opponent_startnumber = substr($opponent_number, 1);
    $location = $game[0]['Spielplan128']['ort'];
    $game_number = $game[0]['Spielplan128']['spielnummer'];
    $opponent_name = $teamsController -> acquireTeamNameForStartNumber($opponent_startnumber);
    
    return array('name'=>$opponent_name, 'location'=>$location);
  }
  
  public function checkResult() {
    
    //$game = $this -> Spielplan128 -> find('all', array('conditions' => array('' => $prefix.$current_team_startnumber)));
    
  }

}








