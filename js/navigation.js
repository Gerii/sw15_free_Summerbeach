$(document).on("mobileinit", function() {

});

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
		nav.loadPage("home.html");
<<<<<<< .merge_file_TLyZWq

=======
>>>>>>> .merge_file_CVHrvq
	});
});

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
	var tag = "#" + this.splitUrl(url);
	if (tag === "#registration") {
		team.reset();
	}
	currentUrlTag = tag;
	jQuery.mobile.navigate(tag);
	$.ajax({
		type : "GET",
		url : url,
		success : function(result) {
			console.log(result);
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
			$(".focused").focus();
		}, "html");
		console.log(data.state.info);
		console.log(data.state.direction);
		console.log(data.state.url);
		console.log(data.state.hash);
	}
});
