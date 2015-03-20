$(function() {
	var dialog, id

	function editLine() {
		rows = $('#addStopTolineTable').DataTable().rows('.selected').data();
		saveToServer(id, rows);
		dialog.dialog("close");
	}

	dialog = $("#dialog-form").dialog({
		autoOpen : false,
		height : 650,
		width : 'auto',
		modal : true,
        hide: {effect: "clip", duration: 250 },
		buttons : {
			"Add stop" : editLine,
			Cancel : function() {
				dialog.dialog("close");
			}
		},
		close : function() {
			$('#addStopTolineTable').DataTable().clear();
		}
	});

	function saveToServer(id, rows) {
		if (rows.length < 1) {
			return;
		}
		var newStops = {
			id : id,
			stops : new Array()
		};
		var request = "http://" + $(location).attr('host') + "/map/lines/addline?stationids=";
		rows.each(function(element, index) {
			newStops.stops.push(element);
			request += element[0] + "+";
		});
		request = request.substr(0, request.length - 1);
		console.log(request);

		$.ajax({
			type : "POST",
			url : request,
			dataType : "json",
			data : {
				"id" : id
			},
			success : function(data) {
				console.log("added");
				$('#addStopTolineTable').DataTable().clear();
				getStationsOfLine(id);
				editedStopsMyself = true;
				socket.emit('editedlinestops', newStops);

			}//TODO on failure
		});
	}

	function getAllStationsForAdding() {
		console.log("loading all stations");
		$.ajax({
			type : "POST",
			dataType : "json",
			data : {
				"id" : id
			},
			url : "http://" + $(location).attr('host') + "/map/Stops/getallstations",
			success : function(data) {
				console.log("got stations");
				addToAddStopsTable(data);
			}//TODO on failure
		});
	}

	function addToAddStopsTable(data) {
		data.forEach(function(element, index) {
			var arr = new Array();
			arr[0] = element.Stop.id;
			arr[1] = element.Stop.name;
			arr[2] = element.Stop.lon;
			arr[3] = element.Stop.lat;
			arr[4] = (element.Stop.tram == 1) ? "Bim" : "Bus";
			$('#addStopTolineTable').DataTable().row.add(arr);
		});
		$('#addStopTolineTable').DataTable().draw();
	}

	form = dialog.find("form").on("submit", function(event) {
		event.preventDefault();
		addLine();
	});
	$('#addStopToLine').on('click', function() {
		$('#toofewstopserror').hide();
		if (currentRowId === undefined || currentRowId === 0) {
			console.log("no id");
			return;
		}
		id = currentRowId;
		dialog.dialog("open");
		getAllStationsForAdding();
	});
});
