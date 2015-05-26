function loadGame() {
	$("#errorArea").hide();
	$("#btnArea").hide();
	$("#team1Wins").removeAttr("style");
	$("#team2Wins").removeAttr("style");
	var gameNumber = $("#gameNumber").val();
	$.ajax({
		type : "POST",
		url : "http://" + $(location).attr('host') + "/Cakephp/Spielplan128s/getteamsofgame",
		dataType : "json",
		async : false,
		data : {
			"gamenumber" : gameNumber
		},
		success : function(gameInfo) {
			console.log(gameInfo);
			globalGameNumber = gameNumber;
			if (gameInfo.first_team === "" || gameInfo.second_team === "") {
				handleError("noOpponentFound");
			}
			$("#team1Wins").text(gameInfo.first_team);
			$("#team2Wins").text(gameInfo.second_team);
			if (gameInfo.winner !== 0) {
				$("#team" + gameInfo.winner + "Wins").css("background", "green");
			}
			$("#btnArea").show();
		},
		error : function(err) {
			console.log(err);
			handleError(err.responseJSON);
		}
	});
}


$("#team1Wins").click(function() {
	saveResult(1);
});

$("#team2Wins").click(function() {
	saveResult(2);
});

function saveResult(winner) {
	$.ajax({
		type : "POST",
		url : "http://" + $(location).attr('host') + "/Cakephp/Ergebnisses/saveresult",
		dataType : "json",
		async : false,
		data : {
			"gamenumber" : globalGameNumber,
			"winner" : winner
		},
		success : function(result) {
			console.log(result);
			loadGame();
		},
		error : function(err) {
			console.log(err);
			handleError(err.responseJSON);
		}
	});
}

function handleError(errorMsg) {
	switch(errorMsg) {
	case errorCodes.noOpponentFound:
		$("#errorArea").html(errorMessages.noOpponentFound);
		$("#errorArea").show();
		break;
	case errorCodes.noGameFound:
		$("#errorArea").html(errorMessages.noGameFound);
		$("#errorArea").show();
		break;
	default:
		alert(errorMessages.unknownError);
		break;
	}
}
