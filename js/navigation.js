
$(document).on("pagebeforeshow", function() {
	var nav = new Navigation();
	$(".navbtn").on("click", function() {
		nav.loadPage($(this).attr("id"));
	});

	$("#logout\\.html").click(function() {
		console.log("logout called");
		$("#login\\.html").show();
		$("#registration\\.html").show();
		$("#logout\\.html").hide();
		$("#team\\.html").hide();
		$("#referee\\.html").hide();
		logout();
	});
});

$(document).on({
  ajaxStart: function() { 
    $.mobile.loading('show');
  },
  ajaxStop: function() {
    $.mobile.loading('hide');
  }    
});

function logout() {
	$.ajax({
		type : "POST",
		url : "http://" + $(location).attr('host') + "/Cakephp/Referees/logout",
		dataType : "json",
		data : {
			"referee" : {
				"username" : loginName,
				"password" : $("#passwordReferee").val()
			}
		},
		async : false,
		success : function(msg) {
			console.log(msg);
			var nav = new Navigation();
			nav.loadPage("home.html");
		},
		error : function(err) {
			console.log("error");
			console.log(err);
			//handleError(err.responseJSON);
		}
	});
}

Navigation = function() {
	//	this.loadPage("home.html");
	if (arguments.callee._singletonInstance)
		return arguments.callee._singletonInstance;
	this.loadPage("home.html");
	arguments.callee._singletonInstance = this;
};

Navigation.prototype.splitUrl = function(url) {
	console.log(url);
	if (url == undefined) {
		return "";
	}
	var urls = url.split(".");
	var tag = "";
	for (var i = 0; i < urls.length - 1; i++) {
		tag += urls[i];
	}
	console.log(tag);
	return urls.length === 1 ? urls[0] : tag;
};

Navigation.prototype.loadPage = function(url) {
	var site = this.splitUrl(url);
	var tag = "#" + site;
	if (tag === "#registration") {
		team.reset();
	}
	$("#heading").html(headings[site]);
	currentUrlTag = tag;
	jQuery.mobile.navigate(tag);
	$.ajax({
		type : "GET",
		url : url,
		success : function(result) {
			$("#content").html(result);
			$("#content").trigger("create");
			$(".focused").focus();
		},
		async : true
	});
	/*
	 $.post(url, function(result) {
	 console.log(result);
	 $("#content").html(result);
	 }, "html");*/
};

Navigation.prototype.buildUrl = function(hash) {
	return hash.substr(1, hash.length) + ".html";
};

function teamEmpty() {
	if (team.name === "" && team.school === "" && team.members.length === 0) {
		return true;
	}
	return false;
}


$(window).on("navigate", function(event, data) {
	var hash = window.location.hash;
	if (hash !== "#addplayer" && currentUrlTag === "#addplayer" && !teamEmpty() && !confirm(cancelRegistrationMessage)) {
		window.history.forward();
		return;
	}
	if (data.state.direction === "back") {
		var nav = new Navigation();

		if (hash === "#registration") {
			team.reset();
		}

		$.post(nav.buildUrl(hash), {
			sort : "",
			page : ""
		}, function(result) {
			console.log(result);
			$("#content").html(result);
			$("#content").trigger("create");
	//		$(".focused").focus();
		}, "html");
		console.log(data.state.info);
		console.log(data.state.direction);
		console.log(data.state.url);
		console.log(data.state.hash);
	}
});
