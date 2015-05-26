team = {
	name : "",
	school : "",
	members : [],
	reset : function() {
		this.name = "";
		this.school = "";
		this.members.length = 0;
	}
};

loginName = "";

errorCodes = {
	registerSchoolNameMissing : "registerSchoolNameMissing",
	registerTeamNameMissing : "registerTeamNameMissing",
	registerWrongPlayerData: "registerWrongPlayerData",
	registerWrongPlayerCount: "registerWrongPlayerCount",
	loginNameMissing: "loginNameMissing",
	loginFoundMoreThanOneTeam: "loginFoundMoreThanOneTeam",
	loginWrongTeamName: "wrongTeamName",
	loginFailedToLoginReferee: "failedToLogIn",
	noOpponentFound: "noOpponentFound",
	noGameFound: "noGameFound",
	unknownError: "unknownError"
};
errorMessages = {
	registerSchoolNameMissing : "Dein Team konnte nicht gespeichert werden da der Name deiner Schule fehlt. Bitte probiere es erneut!",
	registerTeamNameMissing : "Dein Team konnte nicht gespeichert werden da der Name deines Teams fehlt. Bitte probiere es erneut!",
	registerWrongPlayerData: "Du hast bei mindestens einem Spieler keine oder falsche Daten eingegeben. Bitte probiere es erneut!",
	registerWrongPlayerCount: "Du hast nicht die richtige Anzahl an Spielern eingegeben. Bitte probiere es erneut!",
	loginNameMissing: "Du hast keinen Namen eingegeben. Bitte probiere es erneut!",
	loginFoundMoreThanOneTeam: "DU SOLLTEST DRINGEND ZUR SPIELLEITUNG GEHEN. Bitte probiere es nicht erneut!", //TODO email schicken
	loginWrongTeamName: "Es existiert kein Team mit diesem Namen!",
	loginNoPasswordEntered: "Bitte gib ein Passwort ein!",
	loginFailedToLoginReferee: "Benutzername oder Passwort sind nicht korrekt!",
	noOpponentFound: "Von diesem Spiel sind noch nicht alle Kontrahenten bekannt.",
	noGameFound: "Es existiert kein Spiel mit dieser Nummer.",
	unknownError: "Ein unbekannter Fehler ist aufgetreten :( Bitte probiere es erneut!"
};

test_team = {
  "name": "testteam",
  "school": "awefawe",
  "members": [
    {
      "firstname": "1weawe",
      "secondname": "asda",
      "dateofbirth": "2001-12-12",
      "gender": "m",
      "address": "awegaw",
      "zip": "4575",
      "location": "sdfaeg",
      "phone": "34657",
      "email": "asdasdf@gasdgewf.at",
      "tshirt": "keines"
    },
    {
      "firstname": "2awgeawefa",
      "secondname": "wefawe",
      "dateofbirth": "2001-12-19",
      "gender": "m",
      "address": "awegawe",
      "zip": "34654",
      "location": "dsafgewe",
      "phone": "4325626",
      "email": "",
      "tshirt": "keines"
    },
    {
      "firstname": "3agaewgawe",
      "secondname": "agregaew",
      "dateofbirth": "2001-12-09",
      "gender": "m",
      "address": "ageawe",
      "zip": "435654",
      "location": "dsfage",
      "phone": "346276",
      "email": "",
      "tshirt": "keines"
    },
    {
      "firstname": "4egawea",
      "secondname": "agerawe",
      "dateofbirth": "2001-12-13",
      "gender": "m",
      "address": "afwegawe",
      "zip": "346546",
      "location": "asgdwae",
      "phone": "435246",
      "email": "",
      "tshirt": "keines"
    },
    {
      "firstname": "5egawea",
      "secondname": "agerawe",
      "dateofbirth": "2001-12-13",
      "gender": "m",
      "address": "afwegawe",
      "zip": "346546",
      "location": "asgdwae",
      "phone": "435246",
      "email": "",
      "tshirt": "keines"
    },
    {
      "firstname": "6egawea",
      "secondname": "agerawe",
      "dateofbirth": "2001-12-13",
      "gender": "m",
      "address": "afwegawe",
      "zip": "346546",
      "location": "asgdwae",
      "phone": "435246",
      "email": "",
      "tshirt": "keines"
    }
  ],
  reset : function() {
		this.name = "";
		this.school = "";
		this.members.length = 0;
	}
};