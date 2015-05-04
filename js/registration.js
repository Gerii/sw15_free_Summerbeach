function register() {
	console.log("call register");
	if (!addMember(false)) {
		return;
	}
	$.ajax({
		type : "POST",
		url : "http://" + $(location).attr('host') + "/Cakephp/Teams/addteam",
		dataType : "json",
		data : {
			"name" : team.name,
			"school" : team.school,
			"members" : team.members
		},
		async : false,
		success : function(msg) {
			console.log(msg);
			if (msg !== "noerror") {
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
	var nav = new Navigation();
	nav.loadPage("registration.html");
	switch(errorMsg) {
	case errorCodes.registerSchoolNameMissing:
		alert(errorMessages.registerSchoolNameMissing);
		break;
	case errorCodes.registerTeamNameMissing:
		alert(errorMessages.registerTeamNameMissing);
		break;
	case errorCodes.registerWrongPlayerData:
		alert(errorMessages.registerWrongPlayerData);
		break;
	case errorCodes.registerWrongPlayerCount:
		alert(errorMessages.registerWrongPlayerCount);
		break;
	default:
		alert(errorMessages.unknownError);
		break;
	}
}

$(document).ready(function() {
	if (team.members.length === 0) {
		$("#captainCaption").show();
		$("#email").show();
	} else {
		$("#email").removeAttr("required");
	}

	if (team.members.length < 7) {
		$("#addMemberArea").show();
	} else {
		$("#addMemberArea").hide();
	}

	if (team.members.length >= 3) {
		$("#registerTeamArea").show();
	}

	$("#addAnotherMember").click(addAnotherMember);
	$("#registerTeam").click(register);
	
	
	//Safari hack
	if (navigator.userAgent.indexOf('Safari') != -1 && navigator.userAgent.indexOf('Chrome') == -1) {

		var forms = document.getElementsByTagName('form');
		for (var i = 0; i < forms.length; i++) {
			//alert("Apple hack");
			//confirm("apple hack");
			forms[i].noValidate = true;
			forms[i].addEventListener('submit', function(event) {
				//Prevent submission if checkValidity on the form returns false.
				if (!event.target.checkValidity()) {
					event.preventDefault();
					alert("Bitte fülle alle benötigten Felder aus!");
				}
			}, false);
		}
	}
});

function addTeam() {
	team.name = $("#teamname").val();
	team.school = $("#schule").val();
	var nav = new Navigation();
	nav.loadPage("addplayer.html");
}

function getMember() {
	return {
		firstname : $("#firstname").val(),
		secondname : $("#secondname").val(),
		dateofbirth : $("#dateofbirth").val(),
		gender : $("#gender").val(),
		address : $("#address").val(),
		zip : $("#zip").val(),
		location : $("#location").val(),
		phone : $("#phone").val(),
		email : $("#email").val(),
		tshirt : $("#tshirt").val()
	};
}

function addAnotherMember() {
	team.members[team.members.length] = getMember();
	var nav = new Navigation();
	nav.loadPage("addplayer.html");
}

function addMember(loadAddPlayerPage) {
	if ($("#zip").val().length > 4) {
		alert("PLZ ist zu lang.");
		$("#zip").focus();
	} else if (isNaN($("#zip").val())) {
		alert("Die PLZ sollte eine Zahl sein.");
		$("#zip").focus();
	} else if (team.members.length >= 3 && team.members.length < 7) {
		console.log("popup");
		$("#addAnotherMember").show();
		$("#popupDialog").popup("open");
	} else if (team.members.length === 7) {
		$("#popupDialog").popup("open");
	} else if (team.members.length < 7) {
		console.log("addMember");
		team.members[team.members.length] = getMember();
		if (loadAddPlayerPage) {
			var nav = new Navigation();
			nav.loadPage("addplayer.html");
		}
		return true;
	} else {

	}
	return false;
}

//Firefox hack
function addMemberTrue() {
	addMember(true);
}

function nothing() {

}
