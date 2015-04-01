function register() {
	console.log("call register");

	$.ajax({
		type : "POST",
		url : "http://" + $(location).attr('host') + "/Cakephp/Teams/addteam",
		dataType : "json",
		data : {
			"name": team.name,
			"school": team.school,
			"members": team.members
		},
		async : false,
		success : function(msg) {
			console.log("success");
		},
		error : function(err) {
			console.log("error");
			console.log(err);
		}
	});
	
	/*$.ajax({
		type : "POST",
		url : "http://" + $(location).attr('host') + "/Cakephp/Spielers/addmember",
		dataType : "json",
		data : {
			"firstname": team.members[0].firstname,
			"secondname": team.members[0].secondname,
			"dateofbirth": team.members[0].dateofbirth,
			"address": team.members[0].address,
			"zip": team.members[0].zip,
			"location": team.members[0].location,
			"phone": team.members[0].phone,
			"tshirt": team.members[0].tshirt,
			"email": team.members[0].email,
			"gender": team.members[0].gender
		},
		async : false,
		success : function(msg) {
			console.log("success");
		},
		error : function(err) {
			console.log("error");
			console.log(err);
		}
	});*/
}

$("#registerTeam").on("click", function() {
	console.log("registering");
	register();
});


$(document).ready(function() {

	if (team.members.length === 0) {
		$("#captainCaption").show();
		$("#email").show();
	} else {
		$("#email").removeAttr("required");
	}

	if (team.members.length < 7) {
		$("#addMember").show();
	}

	if (team.members.length > 3) {
		$("#registerTeam").show();
	}

	//Safari hack
	if (navigator.userAgent.indexOf('Safari') != -1 && navigator.userAgent.indexOf('Chrome') == -1) {
		var forms = document.getElementsByTagName('form');
		for (var i = 0; i < forms.length; i++) {
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

function addMember() {
	if (team.members.length < 7) {
		console.log("addMember");
		team.members[team.members.length] = getMember();
		var nav = new Navigation();
		nav.loadPage("addplayer.html");
	} else {

	}
}