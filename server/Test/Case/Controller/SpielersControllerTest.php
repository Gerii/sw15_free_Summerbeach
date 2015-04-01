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
		$playernumber = 1;
		$firstname = "Johann";
		$secondname = "Mustermann";
		$dateofbirth = "05.10.1995";
		$phone = "2342564";
		$address = "Inffeldgasse";
		$zip = 8010;
		$location = "Graz";
		$email = "johann.mustermann@email.at";
		$gender = "m";
		$tshirt = "s";
		$data = array('firstname' => $firstname, 'secondname' => $secondname, 'dateofbirth' => $dateofbirth, 'phone' => $phone, 'address' => $address, 'zip' => $zip, 'location' => $location, 'email' => $email, 'gender' => $gender, 'tshirt' => $tshirt);

		$this -> assertEqual($this -> insertMember($team_id, $data, $playernumber), 1);
	}

	private function insertMember($team_id, $data, $playernumber) {
		$query = array('Spieler.team_id' => $team_id, 'Spieler.spielernummer' => $playernumber, 'Spieler.vorname' => $data["firstname"], 'Spieler.nachname' => $data["secondname"], 'Spieler.geburtsdatum' => $data["dateofbirth"], 'Spieler.telefon' => $data["phone"], 'Spieler.strasse' => $data["address"], 'Spieler.plz' => $data["zip"], 'Spieler.ort' => $data["location"], 'Spieler.email' => $data["email"], 'Spieler.geschlecht' => $data["gender"], 'Spieler.shirt' => $data["tshirt"]);
		$before = $this -> Spieler -> find('count', array('conditions' => $query));
		$this -> generate("Spielers") -> addmember($team_id, $data, $playernumber);
		$after = $this -> Spieler -> find('count', array('conditions' => $query));
		return $after - $before;
	}

	public function testAddMemberWrongDateOfBirth() {
		$team_id = 1;
		$playernumber = 1;
		$firstname = "Johann";
		$lastname = "Mustermann";
		$dateofbirth = "05.10.2736";
		$phone = "2342564";
		$address = "Inffeldgasse";
		$zip = 8010;
		$location = "Graz";
		$email = "johann.mustermann@email.at";
		$gender = "m";
		$tshirt = "s";
		$data = array('firstname' => $firstname, 'secondname' => $lastname, 'dateofbirth' => $dateofbirth, 'phone' => $phone, 'address' => $address, 'zip' => $zip, 'location' => $location, 'email' => $email, 'gender' => $gender, 'tshirt' => $tshirt);

		$this -> assertEqual($this -> insertMember($team_id, $data, $playernumber), 0);
	}

	public function testAddMemberEmptyName() {
		$team_id = 1;
		$playernumber = 1;
		$firstname = "";
		$lastname = "";
		$dateofbirth = "05.10.1992";
		$phone = "2342564";
		$address = "Inffeldgasse";
		$zip = 8010;
		$location = "Graz";
		$email = "johann.mustermann@email.at";
		$gender = "m";
		$tshirt = "s";
		$data = array('firstname' => $firstname, 'secondname' => $lastname, 'dateofbirth' => $dateofbirth, 'phone' => $phone, 'address' => $address, 'zip' => $zip, 'location' => $location, 'email' => $email, 'gender' => $gender, 'tshirt' => $tshirt);

		$this -> assertEqual($this -> insertMember($team_id, $data, $playernumber), 0);
	}

	public function testAddMemberEmptyEmailCaptain() {
		$team_id = 1;
		$playernumber = 1;
		$firstname = "Cpt";
		$lastname = "blub";
		$dateofbirth = "05.10.1992";
		$phone = "2342564";
		$address = "Inffeldgasse";
		$zip = 8010;
		$location = "Graz";
		$email = "";
		$gender = "m";
		$tshirt = "s";
		$data = array('firstname' => $firstname, 'secondname' => $lastname, 'dateofbirth' => $dateofbirth, 'phone' => $phone, 'address' => $address, 'zip' => $zip, 'location' => $location, 'email' => $email, 'gender' => $gender, 'tshirt' => $tshirt);

		$this -> assertEqual($this -> insertMember($team_id, $data, $playernumber), 0);
	}

	public function testAddMemberEmptyEmailNonCaptain() {
		$team_id = 1;
		$playernumber = 2;
		$firstname = "bla";
		$lastname = "blub";
		$dateofbirth = "05.10.1992";
		$phone = "2342564";
		$address = "Inffeldgasse";
		$zip = 8010;
		$location = "Graz";
		$email = "";
		$gender = "m";
		$tshirt = "s";
		$data = array('firstname' => $firstname, 'secondname' => $lastname, 'dateofbirth' => $dateofbirth, 'phone' => $phone, 'address' => $address, 'zip' => $zip, 'location' => $location, 'email' => $email, 'gender' => $gender, 'tshirt' => $tshirt);

		$this -> assertEqual($this -> insertMember($team_id, $data, $playernumber), 1);
	}

	public function testAddMemberEmptyPhone() {
		$team_id = 1;
		$playernumber = 2;
		$firstname = "bla";
		$lastname = "blub";
		$dateofbirth = "05.10.1992";
		$phone = "";
		$address = "Inffeldgasse";
		$zip = 8010;
		$location = "Graz";
		$email = "";
		$gender = "m";
		$tshirt = "s";
		$data = array('firstname' => $firstname, 'secondname' => $lastname, 'dateofbirth' => $dateofbirth, 'phone' => $phone, 'address' => $address, 'zip' => $zip, 'location' => $location, 'email' => $email, 'gender' => $gender, 'tshirt' => $tshirt);

		$this -> assertEqual($this -> insertMember($team_id, $data, $playernumber), 0);
	}

}
