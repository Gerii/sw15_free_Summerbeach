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
	$("#addteam").on("click", function() {
		addTeam();
		var nav = new Navigation();
		nav.loadPage("addplayer.html");
	});

	$("#addMember").on("click", function() {
		addMembers();
		var nav = new Navigation();
		nav.loadPage("addplayer.html");

		if (team.members.length < 7) {
			$("#addMember").show();
		}

	});
	
	if (team.members.length < 7) {
			$("#addMember").show();
		}


});

function addTeam() {
	team.name = $("#teamname").val();
	team.school = $("#schule").val();
	;
}

function addMember() {

	return {
		firstname : $("#firstname").val(),
		secondname : $("#secondname").val(),
		dateofbirth : $("#dateofbirth").val(),
		gender : $("#gender").val(),
		address : $("#address").val(),
		zip : $("#zip").val(),
		location : $("#location").val(),
		phone : $("#pone").val(),
		email : $("#email").val(),
		shirt : $("#shirt").val()
	};
}

function addMembers() {
	if (team.members.length < 7) {
		team.members[team.members.length] = addMember();
	} else {

	}
}
