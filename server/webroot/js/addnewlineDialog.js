$(function() {
	var dialog, form, name = $("#name"), number = $("#number"), allFields = $([]).add(name).add(number), tips = $(".validateTips");

	function updateTips(t) {
		tips.text(t).addClass("ui-state-highlight");
		setTimeout(function() {
			tips.removeClass("ui-state-highlight", 1500);
		}, 500);
	}

	function checkLength(o, n, min, max) {
		if (o.val().length > max || o.val().length < min) {
			o.addClass("ui-state-error");
			updateTips("Length of " + n + " must be between " + min + " and " + max + ".");
			return false;
		} else {
			return true;
		}
	}

	function checkRegexp(o, regexp, n) {
		if (!( regexp.test(o.val()) )) {
			o.addClass("ui-state-error");
			updateTips(n);
			return false;
		} else {
			return true;
		}
	}

	function addLine() {
		var valid = true;
		allFields.removeClass("ui-state-error");

		valid = valid && checkLength(name, "name", 3, 30);
		valid = valid && checkLength(number, "number", 1, 30);

		valid = valid && checkRegexp(name, /^[a-zäöüß]([0-9äöüßa-z_\s])+$/i, "Name may consist of a-z (including umlauts), 0-9, underscores, spaces and must begin with a letter.");
		valid = valid && checkRegexp(number, /([0-9äöüßa-z_\s])+$/i, "Number may consist of a-z (including umlauts), 0-9, underscores or spaces.");

		if (valid) {
			/*$( "#users tbody" ).append( "<tr>" +
			 "<td>" + name.val() + "</td>" +
			 "<td>" + number.val() + "</td>" +
			 "</tr>" );*/
			console.log(name.val(), number.val());
			saveToServer(name.val(), "bus", number.val());
			dialog.dialog("close");
		}

		return valid;
	}

	dialog = $("#dialog-form").dialog({
		autoOpen : false,
		height : 300,
		width : 350,
		modal : true,
		hide: {effect: "clip", duration: 250 },
		buttons : {
			"Create line" : addLine,
			Cancel : function() {
				dialog.dialog("close");
			}
		},
		close : function() {
			form[0].reset();
			allFields.removeClass("ui-state-error");
		}
	});

	function saveToServer(name, type, number) {
		//?name=Vvvg&type=bus&number=test&stationids=265182289+265182313+265182318+265614336+265614356
		var tableData = $('#newlinetable').DataTable().data();
		console.log(tableData.length);
		var tableDataArrayOnly = {};
		//= new Array();

		var request = "http://" + $(location).attr('host') + "/map/lines/addline?name=" + name + "&type=" + type + "&number=" + number + "&stationids=";
		tableData.each(function(element, index) {
			request += element[0] + "+";
			//tableDataArrayOnly.push(element);
		});
		tableDataArrayOnly.name = name;
		tableDataArrayOnly.type = type;
		tableDataArrayOnly.number = number;

		request = request.substr(0, request.length - 1);
		console.log(request);

		$.ajax({
			type : "POST",
			url : request,
			dataType : "json",
			success : function(data) {
				tableDataArrayOnly.id = data[0][0].id;
				console.log("added, now sending to others");
				$('#newlinetable').DataTable().clear().draw();
				$('#linesavedmessage').show();
				socket.emit('newlineadded', tableDataArrayOnly);
			}//TODO on failure
		});
	}

	form = dialog.find("form").on("submit", function(event) {
		event.preventDefault();
		addLine();
	});
	$('#saveButton').on('click', function() {
		var data = $('#newlinetable').DataTable().data();
		console.log(data.length);

		if (data.length <= 1) {
			$("#cantcreatemessage").show();
			return;
		}
		dialog.dialog("open");

	});
});
