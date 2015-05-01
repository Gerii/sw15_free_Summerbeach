function login(){
		if(loginName === "") {
			var nav = new Navigation();
			alert(errorMessages.unknownError);
			nav.loadPage("home.html");
		}
		$.ajax({
		type : "POST",
		url : "http://" + $(location).attr('host') + "/Cakephp/Referees/ath",
		dataType : "json",
		data : {
			"username": loginName,
			"password" : $("#password").val()
		},
		async : false,
		success : function(msg) {
			console.log(msg);
			if (msg !== "noerror") {
				handleError(msg);
			}
			loginName = "";
		},
		error : function(err) {
			loginName = "";
			console.log("error");
			console.log(err);
			handleError(err);
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
	default:
		alert(errorMessages.unknownError);
		break;
	}
}