function register() {

	console.log("call register");
	var teamname = $("#teamname").val();
	var schule = $("#schule").val();

	console.log("team: " + teamname + " schule: " + schule);

	$.ajax({
		type : "POST",
		url : "http://" + $(location).attr('host') + "/Cakephp/Teams/addteam",
		dataType : "json",
		data : {
			"teamname" : teamname,
			"schule" : schule
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
}


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
		shirt : $("#tshirt").val()
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