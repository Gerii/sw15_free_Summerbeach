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
		console.log("call addplayer.html");
		var nav = new Navigation();
		nav.loadPage("addplayer.html");
	});

	/*$("#addMember").on("click", function() {
		addMembers();
		var nav = new Navigation();
		nav.loadPage("addplayer.html");

		if (team.members.length < 7) {
			$("#addMember").show();
		}

	});*/

	if (team.members.length < 7) {
		$("#addMember").show();
	}

});

function addTeam() {
	team.name = $("#teamname").val();
	team.school = $("#schule").val();
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