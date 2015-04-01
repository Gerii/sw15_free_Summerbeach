<?php
App::uses('SpielersController', 'Controller');

/**
 * SpielersController Test Case
 *
 */
class SpielersControllerTest extends ControllerTestCase {

	/**
	 * Fixtures
	 *
	 * @var array
	 */
	public $fixtures = array('app.spieler');

	public function setUp() {
		parent::setUp();

		// Load Contact Model
		$this -> Spieler = ClassRegistry::init('Spieler');

	}

	public function testAddMember() {
		$team_id = 1;
		$spielernummer = 1;
		$firstname = "Johann";
		$lastname = "Mustermann";
		$dateofbirth = "05.10.1995";
		$phone = "2342564";
		$address = "Inffeldgasse";
		$zip = 8010;
		$location = "Graz";
		$email = "johann.mustermann@email.at";
		$gender = "m";
		$tshirt = "s";
		$data = array('firstname' => $firstname, 'secondname' => $lastname, 'dateofbirth' => $dateofbirth, 'phone' => $phone, 'address' => $address, 'zip' => $zip, 'location' => $location, 'email' => $email, 'gender' => $gender, 'tshirt' => $tshirt);
		
		$before = $this -> Spieler -> find('count', array('conditions' => array('Spieler.team_id' => $team_id, 'Spieler.spielernummer' => $spielernummer, 'Spieler.vorname' => $firstname, 'Spieler.nachname' => $lastname, 'Spieler.geburtsdatum' => $dateofbirth, 'Spieler.telefon' => $phone, 'Spieler.strasse' => $address, 'Spieler.plz' => $zip, 'Spieler.ort' => $location, 'Spieler.email' => $email, 'Spieler.geschlecht' => $gender, 'Spieler.shirt' => $tshirt)));
		
		$this -> generate("Spielers") -> addmember($team_id, $data, $spielernummer);
		

		//$this -> testAction('/Spielers/addmember.json', array('data' => $data, 'method' => 'post'));
		$after = $this -> Spieler -> find('count', array('conditions' => array('Spieler.team_id' => $team_id, 'Spieler.spielernummer' => $spielernummer, 'Spieler.vorname' => $firstname, 'Spieler.nachname' => $lastname, 'Spieler.geburtsdatum' => $dateofbirth, 'Spieler.telefon' => $phone, 'Spieler.strasse' => $address, 'Spieler.plz' => $zip, 'Spieler.ort' => $location, 'Spieler.email' => $email, 'Spieler.geschlecht' => $gender, 'Spieler.shirt' => $tshirt)));

		// Test DB entry
		$this -> assertEqual($after - $before, 1);
	}

}
