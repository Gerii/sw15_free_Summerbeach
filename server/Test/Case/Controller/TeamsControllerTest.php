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
		
				$team_id = 1;
		$playernumber1 = 1;
		$firstname1 = "Johann";
		$lastname1 = "Mustermann";
		$dateofbirth1 = "05.10.2000";
		$phone1 = "2342564";
		$address1 = "Inffeldgasse";
		$zip1 = 8010;
		$location1 = "Graz";
		$email1 = "johann.mustermann@email.at";
		$gender1 = "m";
		$tshirt1 = "s";
		
		$playernumber2 = 2;
		$firstname2 = "Frank";
		$lastname2 = "Musterfraun";
		$dateofbirth2 = "05.10.1999";
		$phone2 = "2342564";
		$address2 = "Inffeldgasse";
		$zip2 = 8010;
		$location2 = "Graz";
		$email2 = "johann.mustermann@email.at";
		$gender2 = "w";
		$tshirt2 = "s";
		
		
		$playernumber3 = 3;
		$firstname3 = "Johann";
		$lastname3 = "Mustermann";
		$dateofbirth3 = "05.10.1998";
		$phone3 = "2342564";
		$address3 = "Inffeldgasse";
		$zip3 = 8010;
		$location3 = "Graz";
		$email3 = "johann.mustermann@email.at";
		$gender3 = "m";
		$tshirt3 = "s";
		
		
		$team_id4 = 1;
		$playernumber4 = 4;
		$firstname4 = "Johann";
		$lastname4 = "Mustermann";
		$dateofbirth4 = "05.10.1998";
		$phone4 = "2342564";
		$address4 = "Inffeldgasse";
		$zip4 = 8010;
		$location4 = "Graz";
		$email4 = "johann.mustermann@email.at";
		$gender4 = "m";
		$tshirt4 = "s";
		$data_of_players = array( array('firstname' => $firstname1, 'secondname' => $lastname1, 'dateofbirth' => $dateofbirth1, 'phone' => $phone1, 'address' => $address1, 'zip' => $zip1, 'location' => $location1, 'email' => $email1, 'gender' => $gender1, 'tshirt' => $tshirt1),
							array('firstname' => $firstname2, 'secondname' => $lastname2, 'dateofbirth' => $dateofbirth2, 'phone' => $phone2, 'address' => $address2, 'zip' => $zip2, 'location' => $location2, 'email' => $email2, 'gender' => $gender2, 'tshirt' => $tshirt2),
							array('firstname' => $firstname3, 'secondname' => $lastname3, 'dateofbirth' => $dateofbirth3, 'phone' => $phone3, 'address' => $address3, 'zip' => $zip3, 'location' => $location3, 'email' => $email3, 'gender' => $gender3, 'tshirt' => $tshirt3),
							array('firstname' => $firstname4, 'secondname' => $lastname4, 'dateofbirth' => $dateofbirth4, 'phone' => $phone4, 'address' => $address4, 'zip' => $zip4, 'location' => $location4, 'email' => $email4, 'gender' => $gender4, 'tshirt' => $tshirt4));
		
		
		
		
		$data = array('name' => $team, 'school' => $school, 'members' => $data_of_players);
		$before = $this -> Team -> find('count', array('conditions' => array('Team.teamname' => $team, 'Team.schule' => $school)));
		$this -> testAction('/Teams/addteam.json', array('data' => $data, 'method' => 'post'));
		$after = $this -> Team -> find('count', array('conditions' => array('Team.teamname' => $team, 'Team.schule' => $school)));

		$this -> assertEqual($after - $before, 1);
	}
	 
	 
	 
	 
	 
	public function testAddTeamWithoutPlayers() {
		$team = "blub";
		$school = "bluuub";
		$data = array('name' => $team, 'school' => $school, 'members' => array());
		$before = $this -> Team -> find('count', array('conditions' => array('Team.teamname' => $team, 'Team.schule' => $school)));
		$this -> testAction('/Teams/addteam.json', array('data' => $data, 'method' => 'post'));
		$after = $this -> Team -> find('count', array('conditions' => array('Team.teamname' => $team, 'Team.schule' => $school)));

		$this -> assertEqual($after - $before, 0);
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
