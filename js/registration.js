function register() {
	console.log("call register");
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
			} else {
			  var nav = new Navigation();
			  nav.loadPage("thankyoupage.html");
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

	$("#addAnotherMember").click(function() {
    var nav = new Navigation();
    nav.loadPage("addplayer.html");
	});
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

function validateEmail(email) {
  var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
  return re.test(email);
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
		tshirt : $("#tshirt").val(),
		oeamtc: $("#oeamtc").is(':checked')
	};
}

function addMember() {
  if ($("#zip").val().length > 4) {
    alert("PLZ ist zu lang.");
    $("#zip").focus();

  } else if (isNaN($("#zip").val())) {
    alert("Die PLZ sollte eine Zahl sein.");
    $("#zip").focus();

  } else if (team.members.length === 0 && !(validateEmail($('#email').val()))) {
    alert("Die Email ist falsch.");
    $("#email").focus();
    
  } else if (team.members.length < 7) {
    console.log("addMember");
    team.members[team.members.length] = getMember();

    if (team.members.length >= 4) {
      console.log("popup");
      if (team.members.length < 7) {
        $("#addAnotherMemberArea").show();
      }
      $("#popupDialog").popup("open");
    } else {
      var nav = new Navigation();
      nav.loadPage("addplayer.html");
    }

  } else if (team.members.length === 7) {
    $("#popupDialog").popup("open");
  }

}
