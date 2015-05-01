function login(){
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
			if(msg === "thisIsReferee") {
				var nav = new Navigation();
				loginName = $("#teamname").val();
				nav.loadPage("referee.html");
			}
			else if (msg !== "noerror") {
				handleError(msg);
			}
		},
		error : function(err) {
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