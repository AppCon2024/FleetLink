<!DOCTYPE html>
<html>
<head>
    <title>Map with Current Location</title>
    <link
      rel="stylesheet"
      href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
    />
    <style>
      #map {
        height: 400px;
        width: 100%;
      }
    </style>
</head>
<body>
    <div id="map"></div>

    <script
      src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
    ></script>
    <script>
      var map = L.map('map').setView([0, 0], 13); // Default view

      // Using geolocation API to get current location
      if ('geolocation' in navigator) {
        navigator.geolocation.getCurrentPosition(function (position) {
          var latitude = position.coords.latitude;
          var longitude = position.coords.longitude;

          // Display user's location on the map
          map.setView([latitude, longitude], 13);
          L.marker([latitude, longitude]).addTo(map);
        });
      } else {
        alert('Geolocation is not supported by your browser');
      }

      // Leaflet Tile Layer (e.g., OpenStreetMap)
      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
      }).addTo(map);
    </script>
</body>
</html>
