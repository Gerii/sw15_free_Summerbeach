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
	
	unknownError: "UnknownError",
};
errorMessages = {
	schoolNameMissing : "Dein Team konnte nicht gespeichert werden da der Name deiner Schule fehlt. Bitte probiere es erneut!",
	teamNameMissing : "Dein Team konnte nicht gespeichert werden da der Name deines Teams fehlt. Bitte probiere es erneut!",
	wrongPlayerData: "Du hast bei mindestens einem Spieler keine oder falsche Daten eingegeben. Bitte probiere es erneut!",
	unknownError: "Ein unbekannter Fehler ist aufgetreten :( Bitte probiere es erneut!"
};