function login() {
	var nav = new Navigation();
	$.ajax({
		type : "POST",
		url : "http://" + $(location).attr('host') + "/Cakephp/Teams/login",
		dataType : "json",
		data : {
			"username" : $("#teamname").val()
		},
		async : false,
		success : function(msg) {
			console.log(msg);
			if (msg === "thisIsReferee") {

				loginName = $("#teamname").val();
				nav.loadPage("refereelogin.html");
			} else if (msg === "foundTeam") {
				nav.loadPage("team.html");
			} else if (msg !== "noerror") {
				handleError(msg);
			}
		},
		error : function(err) {
			console.log("error");
			console.log(err);
			handleError(err.responseJSON);
		}
	});
}

function handleError(errorMsg) {
	switch(errorMsg) {
	case errorCodes.loginNameMissing:
		alert(errorMessages.loginNameMissing);
		break;
	case errorCodes.loginFoundMoreThanOneTeam:
		alert(errorMessages.loginFoundMoreThanOneTeam);
		break;
	case errorCodes.loginWrongTeamName:
		alert(errorMessages.loginWrongTeamName);
		break;
	default:
		alert(errorMessages.unknownError);
		break;
	}
}