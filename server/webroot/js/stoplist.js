function format(value) {
	return '<div id="expandedMap"></div>';
}

$("#stopsBtn").addClass("active");

$(document).ready(function() {
	editedMyself = false;
	
	//enable datatable and make editable
	$('#stopstable').DataTable({
		//responsive: true,
		"autoWidth" : false,
		"columnDefs" : [{
			"targets" : [0],
			"visible" : false,
			"searchable" : false
		}, {
			"targets" : [1],
			"width" : "40%"
		}, {
			"targets" : [2],
			"width" : "20%"
		}, {
			"targets" : [3],
			"width" : "20%"
		}, {
			"targets" : [4],
			"width" : "20%"
		}],
		"order" : [[1, 'asc']],
		"language" : {
			"decimal" : "."
		}
	});
	/*"scrollY":        "200px",
	"scrollCollapse": true,
	"paging":         false,
	"columns": [
	{
	"className":      'details-control',
	"orderable":      false,
	"data":           null,
	"defaultContent": ''
	},
	{ "data": "A" },
	{ "data": "Headera" },
	{ "data": "Headerb" },
	{ "data": "Headerc" },
	{ "data": "Headerd" }
	],
	"order": [[1, 'asc']]*/
	//table.page( 'next' ).draw( false );

	var editLine = undefined;
	myTable = $('#stopstable').dataTable().makeEditable({
		sUpdateURL : "http://" + $(location).attr('host') + "/map/stops/editstopsdata",
		sReadOnlyCellClass : "read_only",
		fnOnEditing : function(jInput, oEditableSettings, sOriginalText, id) {
			editLine = id;
			console.log(sOriginalText);
			return true;
		},
		fnOnEdited : function(status) {
			console.log(editLine);
			var row;
			$('#stopstable').DataTable().rows().data().each(function(element, index) {
				if (element[0] == editLine) {
					row = element;
					return false;
					//break
				}
			});
			mapping.addMarker(row[3], row[2], row[1], row[4]);
			console.log("sending edited stop to others");
			editedMyself = true;
			socket.emit('editedstop', row);
		}
	});

	$('#emptytesttable').DataTable({
		"order" : [[1, 'asc']],
		responsive : true
	});
	myEmptyTable = $('#emptytesttable').DataTable();

	//$('#testtable').DataTable();
	//enable inline filter
	$('#stopstable').dataTable().yadcf([{
		column_number : 1,
		text_data_delimiter : ",",
		filter_type : "auto_complete"
	}, //  filter_type: "range_number_slider", filter_container_id: "external_filter_container"},
	{
		column_number : 2,
		ignore_char : "%",
		filter_type : "range_number_slider"
	}, // data: ["Yes", "No"], filter_default_label: "Select Yes/No"},
	{
		column_number : 3,
		filter_type : "range_number_slider",
		ignore_char : " "
	}, {
		column_number : 4
	}]);

	//enable drag and drop
	$(myTable.fnGetNodes()).draggable({
		scroll : false,
		//opacity: 0.7,
		helper : function() {
			var text = this.children[0].textContent || this.children[0].innerText;
			//innerText not supported by firefox
			console.log(this.children[0]);
			console.log(text);
			var result = "<p>" + text + "</p>";
			var ret = $(this).clone().appendTo("body").css("zIndex", 5);
			ret[0].innerHTML = result;
			console.log(ret);
			return ret.show();
		}
	});

	mapping = new Mapping();
	mapping.init("stationmap");

	//click handler
	$('#stopstable tbody').on('click', 'tr', function() {
		mapping.clearAll();
		if ($(this).hasClass('selected')) {
			$(this).removeClass('selected');
		} else {
			$('#stopstable').DataTable().$('tr.selected').removeClass('selected');
			$(this).addClass('selected');
			var row = $('#stopstable').DataTable().row($('tr.selected')).data();
			if (row !== undefined) {
				mapping.addMarker(row[3], row[2], row[1], row[4]);
			}
		}
	});

	// Add event listener for opening and closing details
	var mappi = new Mapping();
	$('#emptytesttable').on('click', 'td.details-control', function() {
		var tr = $(this).closest('tr');
		console.log("tr:");
		var row = $('#emptytesttable').DataTable().row(tr);
		console.log(row.data());

		if (row.child.isShown()) {
			// This row is already open - close it
			row.child.hide();
			tr.removeClass('shown');
		} else {
			// Open this row
			row.child(format(tr.data('child-value'))).show();
			tr.addClass('shown');
			mappi.init("expandedMap");
		}
	});

	$("#site").css("display", "inline");
	//now that datatables is initialized, show site

	//connect to socket
	socket = io("http://localhost:3000");
	socket.on('editedstop', function(editedStop) {
		if (!editedMyself) {
			console.log("got edited stop");
			console.log(editedStop);
			console.log($(":contains(" + editedStop[0] + ")"));
			console.log($('#stopstable').DataTable().row("#" + editedStop[0]));
			$('#stopstable').DataTable().row("#" + editedStop[0]).remove();
			$('#stopstable').DataTable().row.add(editedStop).draw(false);
			try {
				$($("#stopstable tr:not([id])")[1]).attr("id", editedStop[0]);
				//add id manually
			} catch(e) {
			}
		}
		editedMyself = false;
	});
});
$(function() {
	$("#stopstable_filter").droppable({
		activeClass : "ui-state-hover",
		hoverClass : "ui-state-active",
		drop : function(event, ui) {
			console.log("dropped!");
			console.log(ui.helper.text());
			var targetElem = $(this).attr("id");
			$(this).find("input").val(ui.helper.text());
			$(this).find("input").keyup();
		}
	});
	$("#stationmap").droppable({
		activeClass : "ui-state-hover",
		hoverClass : "ui-state-active",
		drop : function(event, ui) {
			console.log("dropped on map");
			var row = $('#stopstable').DataTable().row(ui.draggable).data();
			mapping.addMarker(row[3], row[2], row[1], row[4]);
			mapping.fitToAllMarker();
		}
	});

	$("#emptytesttableDropArea").droppable({
		activeClass : "ui-state-hover",
		hoverClass : "ui-state-active",
		drop : function(event, ui) {
			console.log("dropped on empty table");
			console.log(ui);
			console.log(ui.draggable.text());
			var row = $('#stopstable').DataTable().row(ui.draggable);
			var newRowArray = ['<td class="details-control"></td>'];
			newRowArray = newRowArray.concat(row.data());

			//var tableLine = $.trim(ui.draggable.text()).replace(/\r?\n|\r/g, " ").split(/\b\s+/); //remove whitespaces, replace newlines with " ", split at end of word
			console.log(newRowArray);
			$("#emptytesttable").DataTable().row.add(newRowArray).draw();
			//Access non-jquery instance by calling .DataTable()
		}
	});

});
