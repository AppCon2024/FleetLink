<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="FleetLink - Your Location and Weather Information">
    <title>FleetLink</title>
    <style>
        /* Your existing styles here */

        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
        }

        #map {
            width: 100%;
            height: 100vh; /* Adjust the height as needed */
        }

        #details {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%; /* Use full width on small screens */
            max-width: 210px; /* Limit the width on larger screens */
            height: 100vh;
            background-color: #f8f8f8;
            padding: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow-y: auto; /* Enable scrolling if the content exceeds the height */
            color: #333;
        }

        #details h2 {
            font-size: 1.5em;
            margin-bottom: 10px;
            color: #555;
        }

        #details p {
            margin-bottom: 8px;
            display: block;
        }

        #details hr {
            border: 0;
            height: 1px;
            background: #ddd;
            margin: 10px 0;
        }

        #weather {
            margin-top: 20px;
        }

        #weather p {
            margin-bottom: 8px;
            display: block;
        }
    </style>
</head>
<body>

<div id="map"></div>
<script>
    navigator.geolocation.getCurrentPosition(position => {
        const { latitude, longitude } = position.coords;
        document.getElementById('map').innerHTML = '<iframe width="100%" height="100%" src="https://maps.google.com/maps?q=' + latitude + ',' + longitude + '&amp;z=15&amp;output=embed&iwloc=near"></iframe>';

        // Fetch weather data based on the current location
        fetchWeather(latitude, longitude);
    });
</script>

<div id="details">
    <h2>Location Details</h2>
    <script>
        var reqcount = 0;

        navigator.geolocation.watchPosition(successCallback, errorCallback, options);

        function successCallback(position) {
            const { accuracy, latitude, longitude, altitude, heading, speed } = position.coords;

            reqcount++;
            details.innerHTML = "<p><strong>Accuracy:</strong><br>" + accuracy + "</p>";
            details.innerHTML += "<p><strong>Latitude:</strong><br>" + latitude + " | <strong>Longitude:</strong><br>" + longitude + "</p>";
            details.innerHTML += "<p><strong>Altitude:</strong><br>" + altitude + "</p>";
            details.innerHTML += "<p><strong>Heading:</strong><br>" + heading + "</p>";
            details.innerHTML += "<p><strong>Speed:</strong><br>" + speed + "</p>";
            details.innerHTML += "<p><strong>Req Count:</strong><br>" + reqcount + "</p>";
            details.innerHTML += "<hr>";

            // Fetch weather data based on the updated location
            fetchWeather(latitude, longitude);
        }

        function errorCallback(error) {

        }

        var options = {
            enableHighAccuracy: false,
            timeout: 5000,
            maximumAge: 0
        }

        function fetchWeather(latitude, longitude) {
            // Replace 'YOUR_API_KEY' with your actual Weatherbit API key
            const apiKey = 'aa47cf0292524e17b436ce4681c5313c';
            const apiUrl = `https://api.weatherbit.io/v2.0/current?lat=${latitude}&lon=${longitude}&key=${apiKey}`;

            fetch(apiUrl)
                .then(response => response.json())
                .then(data => {
                    const temperature = data.data[0].temp;
                    const weatherDescription = data.data[0].weather.description;

                    details.innerHTML += "<div id='weather'><p><strong>Temperature:</strong><br>" + temperature + "°C</p>";
                    details.innerHTML += "<p><strong>Weather:</strong><br>" + weatherDescription + "</p></div>";
                })
                .catch(error => console.log(error));
        }
    </script>
</div>

</body>
</html>
