function findOpponent() {
	console.log("find opponent");
	$.ajax({
		type : "POST",
		url : "http://" + $(location).attr('host') + "/Cakephp/Spielplan128s/getopponent",
		dataType : "json",
		async : false,
		success : function(opponent) {
			console.log(opponent);
			if (opponent === "alreadylost") {
				$('#teamsite').html("Du bist leider bereits ausgeschieden.");
				return;
			}
			$('#nextGame').html(opponent.name);
			if (opponent.location == 1) {
				$('#grammar').html(" in ");
				$('#nextLocation').html("Eggenberg");
			} else {
				$('#grammar').html(" am ");
				$('#nextLocation').html("Murbeach");
			}
		},
		error : function(err) {
			console.log("error");
			console.log(err);
		}
	});
}


$(document).ready(function() {
	console.log("team.js");
	$("#login\\.html").hide();
	$("#registration\\.html").hide();
	$("#logout\\.html").show();
	$("#team\\.html").show();
	findOpponent();

});

