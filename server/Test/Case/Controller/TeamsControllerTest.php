<?php
App::uses('TeamsController', 'Controller');

/**
 * TeamsController Test Case
 *
 */
class TeamsControllerTest extends ControllerTestCase {

	/**
	 * Fixtures
	 *
	 * @var array
	 */
	public $fixtures = array('app.team');

	public function setUp() {
		parent::setUp();

		// Load Contact Model
		$this -> Team = ClassRegistry::init('Team');
		$this -> Spieler = ClassRegistry::init('Spieler');
	}

	/**
	 * testAddteam method
	 *
	 * @return void
	 */
	public function testAddTeam() {
		$team = "blub";
		$school = "bluuub";
		$data = array('name' => $team, 'school' => $school, 'members' => array());
		$before = $this -> Team -> find('count', array('conditions' => array('Team.teamname' => $team, 'Team.schule' => $school)));
		$this -> testAction('/Teams/addteam.json', array('data' => $data, 'method' => 'post'));
		$after = $this -> Team -> find('count', array('conditions' => array('Team.teamname' => $team, 'Team.schule' => $school)));

		$this -> assertEqual($after - $before, 1);
	}

	public function testAddTeamNoTeamName() {
		$team = "";
		$school = "bluuub";
		$data = array('name' => $team, 'school' => $school, 'members' => array());
		$before = $this -> Team -> find('count', array('conditions' => array('Team.teamname' => $team, 'Team.schule' => $school)));
		$this -> testAction('/Teams/addteam.json', array('data' => $data, 'method' => 'post'));
		$after = $this -> Team -> find('count', array('conditions' => array('Team.teamname' => $team, 'Team.schule' => $school)));

		$this -> assertEqual($after - $before, 0);
	}

	public function testAddTeamNoSchoolName() {
		$team = "blub";
		$school = "";
		$data = array('name' => $team, 'school' => $school, 'members' => array());
		$before = $this -> Team -> find('count', array('conditions' => array('Team.teamname' => $team, 'Team.schule' => $school)));
		$this -> testAction('/Teams/addteam.json', array('data' => $data, 'method' => 'post'));
		$after = $this -> Team -> find('count', array('conditions' => array('Team.teamname' => $team, 'Team.schule' => $school)));

		$this -> assertEqual($after - $before, 0);
	}

	public function testAddTeamWrongDateOfBirth() {
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
		$data_of_players = array( array('firstname' => $firstname, 'secondname' => $lastname, 'dateofbirth' => $dateofbirth, 'phone' => $phone, 'address' => $address, 'zip' => $zip, 'location' => $location, 'email' => $email, 'gender' => $gender, 'tshirt' => $tshirt));

		$team = "blub";
		$school = "bluuub";
		$data = array('name' => $team, 'school' => $school, 'members' => $data_of_players);

		$this -> assertEqual($this -> insertTeam($data), 0);
	}

	public function testAddTeamEmptyName() {
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
		$data_of_players = array( array('firstname' => $firstname, 'secondname' => $lastname, 'dateofbirth' => $dateofbirth, 'phone' => $phone, 'address' => $address, 'zip' => $zip, 'location' => $location, 'email' => $email, 'gender' => $gender, 'tshirt' => $tshirt));

		$team = "blub";
		$school = "bluuub";
		$data = array('name' => $team, 'school' => $school, 'members' => $data_of_players);
		
		$this -> assertEqual($this -> insertTeam($data), 0);
	}

	public function testAddTeamEmptyEmailCaptain() {
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
		$data_of_players = array( array('firstname' => $firstname, 'secondname' => $lastname, 'dateofbirth' => $dateofbirth, 'phone' => $phone, 'address' => $address, 'zip' => $zip, 'location' => $location, 'email' => $email, 'gender' => $gender, 'tshirt' => $tshirt));

		$team = "blub";
		$school = "bluuub";
		$data = array('name' => $team, 'school' => $school, 'members' => $data_of_players);
		
		$this -> assertEqual($this -> insertTeam($data), 0);
	}

	public function testAddTeamEmptyEmailNonCaptain() {
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
		$data_of_players = array( array('firstname' => $firstname, 'secondname' => $lastname, 'dateofbirth' => $dateofbirth, 'phone' => $phone, 'address' => $address, 'zip' => $zip, 'location' => $location, 'email' => $email, 'gender' => $gender, 'tshirt' => $tshirt));

		$team = "blub";
		$school = "bluuub";
		$data = array('name' => $team, 'school' => $school, 'members' => $data_of_players);
		
		$this -> assertEqual($this -> insertTeam($data), 0);
	}

	public function testAddTeamEmptyPhone() {
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
		$data_of_players = array( array('firstname' => $firstname, 'secondname' => $lastname, 'dateofbirth' => $dateofbirth, 'phone' => $phone, 'address' => $address, 'zip' => $zip, 'location' => $location, 'email' => $email, 'gender' => $gender, 'tshirt' => $tshirt));

		$team = "blub";
		$school = "bluuub";
		$data = array('name' => $team, 'school' => $school, 'members' => $data_of_players);
		
		$this -> assertEqual($this -> insertTeam($data), 0);
	}

	private function insertTeam($data) {

		$before = $this -> Team -> find('count', array('conditions' => array('Team.teamname' => $data['name'], 'Team.schule' => $data['school'])));

		foreach ($data['members'] as $member) {
			$query = array('Spieler.vorname' => $member['firstname'], 'Spieler.nachname' => $member['secondname'], 'Spieler.geburtsdatum' => $member['dateofbirth'], 'Spieler.telefon' => $member['phone'], 'Spieler.strasse' => $member['address'], 'Spieler.plz' => $member['zip'], 'Spieler.ort' => $member['location'], 'Spieler.email' => $member['email'], 'Spieler.geschlecht' => $member['gender'], 'Spieler.shirt' => $member['tshirt']);
			$before = $before + $this -> Spieler -> find('count', array('conditions' => $query));
		}
		$this -> testAction('/Teams/addteam.json', array('data' => $data, 'method' => 'post'));
		$after = $this -> Team -> find('count', array('conditions' => array('Team.teamname' => $data['name'], 'Team.schule' => $data['school'])));

		foreach ($data['members'] as $member) {
			$query = array('Spieler.vorname' => $member['firstname'], 'Spieler.nachname' => $member['secondname'], 'Spieler.geburtsdatum' => $member['dateofbirth'], 'Spieler.telefon' => $member['phone'], 'Spieler.strasse' => $member['address'], 'Spieler.plz' => $member['zip'], 'Spieler.ort' => $member['location'], 'Spieler.email' => $member['email'], 'Spieler.geschlecht' => $member['gender'], 'Spieler.shirt' => $member['tshirt']);
			$after = $after + $this -> Spieler -> find('count', array('conditions' => $query));
		}
		return $after - $before;
	}

}
