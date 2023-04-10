// Mmap = L.map('map').setView([8.7144, 125.7481],8);
const Mmap = L.map('map').setView([14.06724,120.62592], 13);

// google streets
const googleStreets = L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',{
    maxZoom: 21,
    subdomains:['mt0','mt1','mt2','mt3']
 }).addTo(Mmap);

 // Satelite Layer
googleSat = L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}',{
   maxZoom: 20,
   subdomains:['mt0','mt1','mt2','mt3']
 });
googleSat.addTo(Mmap);





// control what layers to see in the map
var baseLayers = {
    "Google Map": googleStreets,
    "Satellite": googleSat,
};

L.control.layers(baseLayers).addTo(Mmap);
var geocoderNominatim = new L.Control.Geocoder.Nominatim();
var geocoder = L.Control.geocoder({
        defaultMarkGeocode: false,
        draggable:true,
        geocoder: geocoderNominatim
    })
    .on('markgeocode', function(e) {
        var box = e.geocode.center;
        var name= e.geocode.name;
        document.getElementById("Latitude").value = box.lat;
        document.getElementById("Longitude").value = box.lng;
        document.getElementById("Location").value = e.geocode.name;
        MarkLayer=L.marker([box.lat,box.lng],{draggable:true}).addTo(Mmap). 
        on('dragend', onDragEnd). 
		bindPopup(e.geocode.name). 
		openPopup(); 
		displayLatLng(box);

        group = new L.featureGroup([MarkLayer]);

        Mmap.fitBounds(group.getBounds());
        
    }).addTo(Mmap); 

    function onDragEnd(event) 
    {
	    var latlng = event.target.getLatLng();
        geocoderNominatim.reverse(latlng, Mmap.options.crs.scale(Mmap.getZoom()),
        function(reverseGeocoded){
            event.target.setPopupContent(reverseGeocoded[0].name).openPopup();
            document.getElementById("Location").value = reverseGeocoded[0].name;
          }, this)
	    displayLatLng(latlng);
        
	}

	function displayLatLng(latlng) {
	    document.getElementById("Latitude").value = latlng.lat;
	    document.getElementById("Longitude").value = latlng.lng;

	}