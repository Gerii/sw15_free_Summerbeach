var Mapping = function() {
	this.map = undefined;
	this.marker = new Array();
	this.polylines = new Array();
}

Mapping.prototype.init = function(mapId) {
	console.log("init called");
	this.map = L.map(mapId).setView([47.0666667, 15.45], 13);
	L.tileLayer('http://{s}.tiles.mapbox.com/v3/sa2014.klkgp015/{z}/{x}/{y}.png', {
		attribution : 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://mapbox.com">Mapbox</a>',
		maxZoom : 180
	}).addTo(this.map);
}

Mapping.prototype.addMarker = function(lat, long, name, type, openPopup) {
	var newMarker = L.marker([lat, long]).addTo(this.map);
	var text = "<b> " + name + "</b><br>" + type;
	var popup = newMarker.bindPopup(text);
	if (openPopup || openPopup === undefined) {
		popup.openPopup();
	}
	this.marker.push(newMarker);
}

Mapping.prototype.fitToAllMarker = function() {
	if (this.marker !== undefined && this.marker.length > 1) {
		var group = new L.featureGroup(this.marker);
		console.log();
		var bounds = group.getBounds();
		if (bounds._northEast.lat === bounds._southWest.lat && bounds._northEast.lng === bounds._southWest.lng) {
			return;
			//Otherwise leaflet will freeze the browser
		}
		this.map.fitBounds(bounds.pad(.2));
	}
}

Mapping.prototype.deleteMarker = function() {
	//TODO delete
}

Mapping.prototype.clearAll = function() {
	this.deleteAllMarker();
	this.deleteAllPolylines();
}

Mapping.prototype.deleteAllMarker = function() {

	if (this.marker === undefined) {
		console.log("no markers");
		return;
	}
	this.marker.forEach(function(element, index) {
		this.map.removeLayer(element);
	}, this);
	this.marker = new Array();
}

Mapping.prototype.addPolyline = function(latLongArray) {
	latLongArray.forEach(function(element, index) {
		this.addMarker(element[0], element[1]);
	}, this);
	//this an callback uebergeben

	var polyline = L.polyline(latLongArray, {
		color : 'red'
	}).addTo(this.map);
	this.polylines.push(polyline);

	// zoom the map to the polyline
	console.log(polyline.getBounds());
	this.map.fitBounds(polyline.getBounds().pad(0.5));
}

Mapping.prototype.deletePolyline = function() {
	//TODO
}

Mapping.prototype.deleteAllPolylines = function() {
	if (this.polylines == undefined) {
		return;
	}
	this.polylines.forEach(function(element, index) {
		this.map.removeLayer(element);
	}, this);
	this.polylines = new Array();
}

