    <!DOCTYPE html>
    <html>

    <head>
        <title>Leaflet Map Example</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Load Leaflet from CDN -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/leaflet/1.7.1/leaflet.css" />
        <script src="https://cdn.jsdelivr.net/leaflet/1.7.1/leaflet.js"></script>
    </head>

    <body>

        <div>
            <label for="location">Location:</label>
            <input type="text" id="location" placeholder="Enter a location" />
            <button id="search">Search</button>
            <br />
            <label for="latitude">Latitude:</label>
            <input type="text" id="latitude" readonly />
            <label for="longitude">Longitude:</label>
            <input type="text" id="longitude" readonly />
        </div>

        <div id="map" style="height: 500px;"></div>

        <script>
        var map = L.map('map').setView([51.505, -0.09], 13);
        var marker;

        // Add a tile layer
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
            maxZoom: 18,
        }).addTo(map);
        L.Control.geocoder().addTo(map);

        // Add an event listener to the search button to update the map view and marker when a location is entered
        var searchButton = document.getElementById('search');
        searchButton.addEventListener('click', function() {
            // Get the user input from the input tag
            var userInput = document.getElementById('location').value;

            // Use Leaflet's geocoding API to get the latitude and longitude of the location
            L.Control.Geocoder.nominatim().geocode(userInput, function(result) {
                // Set the view of the map to the location that was entered
                map.setView(result[0].center, 13);

                // Remove the existing marker, if any
                if (marker) {
                    map.removeLayer(marker);
                }

                // Add a new marker at the location that was entered
                marker = L.marker(result[0].center, {
                    draggable: true
                }).addTo(map);

                // Update the latitude and longitude input tags with the coordinates of the marker
                document.getElementById('latitude').value = marker.getLatLng().lat;
                document.getElementById('longitude').value = marker.getLatLng().lng;

                // Add an event listener to the marker for the dragend event, which is fired when the marker is dragged
                marker.on('dragend', function() {
                    // Update the latitude and longitude input tags with the new coordinates of the marker
                    document.getElementById('latitude').value = marker.getLatLng().lat;
                    document.getElementById('longitude').value = marker.getLatLng().lng;
                });
            });
        });
        </script>
        <!-- Load Leaflet geocoder plugin from CDN -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
        <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>