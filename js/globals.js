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

errorCodes = {
	schoolNameMissing : "SchoolNameMissing",
	teamNameMissing : "TeamNameMissing",
	wrongPlayerData: "WrongPlayerData",
	wrongPlayerCount: "WrongPlayerCount",
	unknownError: "UnknownError"
};
errorMessages = {
	schoolNameMissing : "Dein Team konnte nicht gespeichert werden da der Name deiner Schule fehlt. Bitte probiere es erneut!",
	teamNameMissing : "Dein Team konnte nicht gespeichert werden da der Name deines Teams fehlt. Bitte probiere es erneut!",
	wrongPlayerData: "Du hast bei mindestens einem Spieler keine oder falsche Daten eingegeben. Bitte probiere es erneut!",
	wrongPlayerCount: "Du hast nicht die richtige Anzahl an Spielern eingegeben. Bitte probiere es erneut!",
	unknownError: "Ein unbekannter Fehler ist aufgetreten :( Bitte probiere es erneut!"
};

test_team = {
  "name": "awegawe",
  "school": "awefawe",
  "members": [
    {
      "firstname": "weawe",
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
      "firstname": "awgeawefa",
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
      "firstname": "agaewgawe",
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
      "firstname": "egawea",
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