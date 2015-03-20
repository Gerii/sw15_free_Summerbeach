 function getStationsOfLine(id, updateTable) {
   console.log("loading stations at " + $(location).attr('host') + "/map/Stops/getstations id: " + id);
    $.ajax({
      type: "POST",
      dataType: "json",
      url: "http://" + $(location).attr('host') + "/map/Stops/getstations",
      data: {"id" : id},
      success: function(data) {
        addToStopsTable(data, updateTable);
      }
    });
 }
 function addToStopsTable(data, updateTable) {
   //var latLongArray = new Array();
   if(updateTable === undefined) {
     updateTable = true;
   }
   data.forEach(function(element, index) {
    var arr = new Array();
    arr[0] = element.Stop.id;
    arr[1] = element.Stop.name;
    arr[2] = element.Stop.lon;
    arr[3] = element.Stop.lat;
    arr[4] = (element.Stop.tram == 1) ? "Bim" : "Bus";
    arr[5] = "<div id='btnArea'><button class='edit' id='" + arr[0] + "'>Delete</button></div>";
    if(updateTable) {
      $('#stopstable').DataTable().row.add(arr);
    }
    mapping.addMarker(arr[3], arr[2], arr[1], arr[4], false);
    //latLongArray.push([parseFloat(arr[3]), parseFloat(arr[2])]);
   });
   //console.log(latLongArray);
   //mapping.addPolyline(latLongArray);
   if(updateTable) {
    $('#stopstable').DataTable().draw();
   }
   addDeleteHandler();
   mapping.fitToAllMarker();
 }
 deleteNr = 0;
 function addDeleteHandler() {
    $('.edit').on( 'click', function () {
		if(($('#stopstable').DataTable().rows()[0].length - deleteNr) > 2) {
			deleteNr++;
    		deleteStopFromLine($(this).attr("id"), $(this));
     	}
     	else {
     		$('#toofewstopserror').show();
     	}
    });
 }
 
 function deleteStopFromLine(stopId, bttn) {
   $(bttn).prop('disabled', true);
   $(bttn).spin('small');
   
    $.ajax({
      type: "POST",
      url: "http://" + $(location).attr('host') + "/map/lines/deletestops",
      data: {"sid" : stopId, "lid": currentRowId},
      success: function(data) {
        console.log("deleted");
	$('#stopstable').DataTable().row($(bttn).parents('tr')).remove().draw(false);
	deleteNr--;
	mapping.clearAll();
	getStationsOfLine(currentRowId, false);
	socket.emit('deletedlinestop', { "lineid" : currentRowId, "stopid": stopId});
	deletedMyself = true;
      }
    });
 }
 
function getAllStations() {
   console.log("loading all stations");
    $.ajax({
      type: "POST",
      dataType: "json",
      url: "http://" + $(location).attr('host') + "/map/Stops/getallstations",
      success: function(data) {
	console.log("got stations"); 
        addAllStationsToAutocomplete(data);
      }
    });
 }
 function addAllStationsToAutocomplete(data) {
   console.log("adding to autocomplete");
   if(data === undefined) {
     return;
   }
   console.log(data);
   var stationNames = new Array();
   data.forEach(function(element, index) {
    stationNames.push(element.Stop.name);
   });
   //console.log(stationNames);
   $(".stationInput").autocomplete({
     source: stationNames
   });
 }
 
$("#findBtn").addClass("active");

$(document).ready(function(){
  $('.alert').hide();
  editedMyself = false;
  editedStopsMyself = false;
  selectedLineTableRow = undefined;
  deletedMyself = false;
    //enable datatable and make editable
      $('#linesTable').DataTable( {
	  //responsive: true,
	  "autoWidth": false,
	  "columnDefs": [
            {
                "targets": [0],
                "visible": false,
                "searchable": false
            },
	    {
                "targets": [ 1 ],
		"width": "56%"
            },
	    {
                "targets": [ 2 ],
		"width": "20%"
            },
	    {
                "targets": [ 3 ],
		"width": "24%"
            }
        ],
	"order": [[1, 'asc']]
      } );
      //table.page( 'next' ).draw( false );
    
    var editLine = undefined;
    myTable = $('#linesTable').dataTable().makeEditable({
      sUpdateURL: "http://" + $(location).attr('host') + "/map/lines/editlinesdata",
      sReadOnlyCellClass: "read_only",
      fnOnEditing: function(jInput, oEditableSettings, sOriginalText, id)
      {       
	editLine = id;
	console.log(sOriginalText);
	return true;
      },
      fnOnEdited: function(status) {
	console.log(editLine);
	var row;
	$('#linesTable').DataTable().rows().data().each(function(element, index) { 
	  if(element[0] == editLine) {
	   row = element;
	   return false; //break 
	  }
	});
	console.log("sending edited line to others");
	console.log(row);
	editedMyself = true;
	socket.emit('editedlinename', row);
      }
      
      
    });
    
    //enable inline filter
    $('#linesTable').dataTable().yadcf([
	      {column_number : 1, text_data_delimiter: ",", filter_type: "auto_complete"},//  filter_type: "range_number_slider", filter_container_id: "external_filter_container"},
	      {column_number : 2},// data: ["Yes", "No"], filter_default_label: "Select Yes/No"},
	      {column_number : 3, text_data_delimiter: ",", filter_type: "auto_complete"}
    ]);// column_data_type: "html", html_data_type: "text", filter_default_label: "Select tag"}]);  
	    

    $('#stopstable').DataTable( {
      //responsive: true,
      "autoWidth": false,
      "columnDefs": [
            {
                "targets": [ 0 ],
                "visible": false,
                "searchable": false
            },
	    {
                "targets": [ 1 ],
		"width": "50%"
            },
	    {
                "targets": [ 2 ],
		"width": "20%"
            },
	    {
                "targets": [ 3 ],
		"width": "20%"
            },
	    {
                "targets": [ 4 ],
                "visible": false,
                "searchable": false
            },
	    {
                "targets": [ 5 ],
		"width": "10%",
		"sortable": false,
		"searchable": false
            },
        ]
    });
   /*$('#stopstable').dataTable().yadcf([
	    {column_number : 1, text_data_delimiter: ",", filter_type: "auto_complete"},
	    {column_number : 2, ignore_char: "%", filter_type: "range_number_slider"},
	    {column_number : 3, filter_type: "range_number_slider", ignore_char: " "},
	    {column_number : 4}
  ]);*/
    
    
      $('#stopstable tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
        }
        else {
	  $('#stopstable').DataTable().$('tr.selected').removeClass('selected');
	  $(this).addClass('selected');
	  var row = $('#stopstable').DataTable().row($('tr.selected')).data();
	  if(row !== undefined) {
	    mapping.addMarker(row[3], row[2], row[1], row[4]);
	  }
        }
    });
     
    mapping = new Mapping();
    mapping.init("linesMap");
    $('#addStopToLine').hide();
    
    
    //make lines table clickable
    $('#linesTable tbody').on( 'click', 'tr', function () {
      currentRowId = 0;
      $('#stopstable').DataTable().clear().draw();
      mapping.clearAll();
      $('#toofewstopserror').hide();
      
      if ($(this).hasClass('selected')) {
	  $(this).removeClass('selected');
	  selectedLineTableRow = undefined;
	  $('#addStopToLine').hide();
      }
      else {
	$('#linesTable').DataTable().$('tr.selected').removeClass('selected');
	$(this).addClass('selected');
	$('#addStopToLine').show();
	selectedLineTableRow = $('#linesTable').DataTable().row($('tr.selected'))
	var row = $('#linesTable').DataTable().row($('tr.selected')).data();
	if(row !== undefined) {
	  currentRowId = row[0];
	  getStationsOfLine(currentRowId);
	}
      }
    } );

    
    //load auto_complete data
    getAllStations();
    
    $( "#site" ).css( "display", "inline" ); //now that datatables is initialized, show site
 
  $('#addStopTolineTable').DataTable( {
	  //responsive: true,
	    "columnDefs": [
            {
                "targets": [ 0 ],
                "visible": false,
                "searchable": false
            }
        ],
	"order": [[1, 'asc']],
	"language": {
            "decimal": "."
        }
    } );
  
  
    $('#addStopTolineTable tbody').on( 'click', 'tr', function () {
        $(this).toggleClass('selected');
    } );
    
    
    //connect to socket
    socket = io("http://localhost:3000");
        socket.on('editedlinename', function(editedLine){
	if(!editedMyself) {
	  console.log("got edited line");
	  console.log(editedLine);
	  console.log($(":contains(" + editedLine[0] + ")"));
	  console.log($('#linesTable').DataTable().row("#" + editedLine[0]));
	  $('#linesTable').DataTable().row("#" + editedLine[0]).remove();
	  console.log("ger");
	  var row = $('#linesTable').DataTable().row.add(editedLine);
	  $('#linesTable').DataTable().draw(false);
	  console.log(row);
	  try{
	    $($("#linesTable tr:not([id])")[1]).attr("id", editedLine[0]);  //add id manually
	  }
	  catch(e){
	  }
	} else {
	  console.log("edited myself");
	}
	editedMyself = false;
    });
    socket.on('newlineadded', function(newline){
      console.log(newline);
      var arr = new Array();
      arr[0] = newline.id;
      arr[1] = newline.name;
      arr[2] = newline.type;
      arr[3] = newline.number;
      console.log(arr);
      $('#linesTable').DataTable().row.add(arr).draw(false);
      try{
	$($("#linesTable tr:not([id])")[1]).attr("id", arr[0]);  //add id manually
      }
      catch(e){
      }
    });
    socket.on('editedlinestops', function(editedline) {
      console.log(editedline);
      if(editedStopsMyself) {
	editedStopsMyself = false;
	 return;
      }
      console.log(selectedLineTableRow.data()[0]);
      if(selectedLineTableRow.data()[0] === editedline.id) {
	  editedline.stops.forEach(function(element, index) {
	  element.push("<div id='btnArea'><button class='edit' id='" + element[0] + "'>Delete</button></div>");
	});
	$('#stopstable').DataTable().rows.add(editedline.stops).draw(false);
      }
      mapping.clearAll();
      getStationsOfLine(currentRowId, false);
      addDeleteHandler();
    });
    socket.on('deletedlinestop', function(deletedStop) {
      console.log(deletedStop);
      if(deletedMyself) {
	deletedMyself = false;
	return;
      }
      console.log(selectedLineTableRow.data()[0]);
      if(selectedLineTableRow.data()[0] === deletedStop.lineid) {
	console.log($("#" + deletedStop.stopid).parents('tr'));
	$('#stopstable').DataTable().row($("#" + deletedStop.stopid).parents('tr')).remove().draw(false);
      }
      mapping.clearAll();
      getStationsOfLine(currentRowId, false);
      addDeleteHandler();
    });
});