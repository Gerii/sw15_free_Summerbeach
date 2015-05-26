function loginReferee() {
	var nav = new Navigation();
	if (loginName === "" || $("#passwordReferee").val() === undefined || $("#passwordReferee").val() === "") {
		alert(errorMessages.loginNoPasswordEntered);
		return;
	}
	$.ajax({
		type : "POST",
		url : "http://" + $(location).attr('host') + "/Cakephp/Referees/login",
		dataType : "json",
		data : {
			"referee" : {
				"username" : loginName,
				"password" : $("#passwordReferee").val()
			}
		},
		async : false,
		success : function(msg) {
			console.log(msg);
			if (msg === "successfullyLoggedIn") {
				nav.loadPage("referee.html");
			} else if (msg !== "noerror") {
				handleError(msg);
			}
			//loginName = "";
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
	case errorCodes.loginFailedToLoginReferee:
		alert(errorMessages.loginFailedToLoginReferee);
		break;
	case errorCodes.loginNameMissing:
		alert(errorMessages.loginNameMissing);
		break;
	case errorCodes.loginFoundMoreThanOneTeam:
		alert(errorMessages.loginFoundMoreThanOneTeam);
		break;
	default:
		alert(errorMessages.unknownError);
		break;
	}
}