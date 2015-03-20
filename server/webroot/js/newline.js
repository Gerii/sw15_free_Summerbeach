function format(value) {
	return '<div id="expandedMap"></div>';
}

$("#addlineBtn").addClass("active");

$(document).ready(function() {
	
	editedMyself = false;
	$('.alert').hide();
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
			"width" : "45%"
		}, {
			"targets" : [2],
			"width" : "20%"
		}, {
			"targets" : [3],
			"width" : "20%"
		}, {
			"targets" : [4],
			"width" : "15%"
		}],
		"order" : [[1, 'asc']],
		"language" : {
			"decimal" : "."
		}
	});
	$('#newlinetable').DataTable({
		//responsive: true,
		"autoWidth" : false,
		"columnDefs" : [{
			"targets" : [0],
			"visible" : false,
			"searchable" : false
		}, {
			"targets" : [1],
			"width" : "45%"
		}, {
			"targets" : [2],
			"width" : "15%"
		}, {
			"targets" : [3],
			"width" : "15%"
		}, {
			"targets" : [4],
			"width" : "15%"
		}, {
			"targets" : [5],
			"width" : "10%",
			"searchable" : false,
			"sortable" : false
		}],
		"order" : [[1, 'asc']],
		"language" : {
			"decimal" : "."
		}
	});

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
	//console.log($(myTable.fnGetNodes()));
	$(myTable.fnGetNodes()).draggable({
		scroll : false,
		//opacity: 0.7,
		helper : function(event) {
			console.log(this.children[1]);
			var text = this.children[0].textContent || this.children[0].innerText;
			//innerText not supported by firefox
			console.log(this.children[1]);
			console.log(text);
			var result = "<p>" + text + "</p>";
			//result = "<table><tbody><tr>";
			//result += $(event.target).closest('tr')[0].innerHTML;
			//result += "</tr></tbody></table>";
			//result = $('<div class="drag-cart-item"><table></table></div>').find('table').append($(event.target).closest('tr').clone()).end();
			console.log(result);
			var ret = $(this).clone().appendTo("body").css("zIndex", 5);
			ret[0].innerHTML = result;
			ret[0].latlong = {
				lat : 47.066,
				long : 15.4
			};
			console.log(ret);
			return ret.show();
		}
	});

	mapping = new Mapping();
	mapping.init("newlinemap");

	var start, end;
	$("#newlinetableDropArea tbody").sortable({
		cursor : "move",
		start : function(event, ui) {
			start = ui.item.prevAll().length + 1;
		},

		update : function(event, ui) {
			end = ui.item.prevAll().length + 1;
			var id = ui.item.context.children[0].innerHTML;
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

	$("#newlinetableDropArea").droppable({
		activeClass : "ui-state-hover",
		hoverClass : "ui-state-active",
		drop : function(event, ui) {
			console.log("dropped on table");
			$('.alert').hide();
			var existingRows = $('#newlinetable').DataTable().rows().data();
			var existingType;

			if ($(existingRows).length > 0) {
				existingType = $(existingRows)[0][4];
			}

			var row = $('#stopstable').DataTable().row(ui.draggable);
			var newRowArray = new Array();
			newRowArray = newRowArray.concat(row.data());
			console.log(newRowArray);
			newRowArray.push("<div id='btnArea'><button class='delete' id='" + newRowArray[0] + "'>Remove</button></div>");
			if (newRowArray[0] !== undefined && (newRowArray[4] === existingType || existingType === undefined)) {
				console.log("adding new row");
				//check if already exists
				var alreadyExists = false;
				$('#newlinetable').DataTable().rows().data().each(function(element, index) {
					if (element[0] === newRowArray[0]) {
						$("#cantaddalreadyaddedmessage").show();
						alreadyExists = true;
						return false;
						//break
					}
				});
				if (alreadyExists) {
					return;
				}
				$('#newlinetable').DataTable().row.add(newRowArray).draw(false);
				mapping.addMarker(newRowArray[3], newRowArray[2], newRowArray[1], newRowArray[4]);
				mapping.fitToAllMarker();
			} else if (newRowArray[0] === undefined) {
				return;
			} else if (newRowArray[4] !== existingType) {
				$('#cantaddmessage').show();
				$('#type').text(existingType);
			}
			$('.delete').on('click', function() {
				$('#newlinetable').DataTable().row($(this).parents('tr')).remove().draw(false);
			});

		}
	});
});
