<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            margin: 0;
            display: flex;
        }

        #map {
            flex: 1;
            height: 100vh; /* Full height of the viewport */
        }

        #sidebar {
            width: 200px; /* Adjust the width as needed */
            background-color: white;
            color: black; /* Text color */
            padding: 20px;
            order: -1; /* Move the sidebar to the left */
            font-family: 'Arial', sans-serif; /* Example font family */
            line-height: 1.6; /* Adjust line height for better readability */
        }
        a.back-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #3490dc;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease-in-out;
        }

        a.back-button:hover {
            background-color: #2779bd;
        }
    </style>
</head>
<body>
    <div id="sidebar">
        <div id="details"> </div>
        {{-- <a href="{{ route('dashboard') }}"class="back-button">Back</a> --}}
    </div>

    <div id="map"> </div>

    <script>
        navigator.geolocation.getCurrentPosition(position => {
            const { latitude, longitude } = position.coords;
            // Show a map centered at latitude / longitude.
            document.getElementById('map').innerHTML = '<iframe width="100%" height="100%" src="https://maps.google.com/maps?q=' + latitude + ',' + longitude + '&amp;z=15&amp;output=embed"></iframe>';
        });

        var reqcount = 0;

        navigator.geolocation.watchPosition(successCallback, errorCallback, options);

        function successCallback(position) {
            const { accuracy, latitude, longitude, altitude, heading, speed } = position.coords;

            reqcount++;
            details.innerHTML = "Accuracy: <br>" + accuracy + "<br>";
            details.innerHTML += "Latitude: <br>" + latitude + "<br>Longitude: " + longitude + "<br>";
            details.innerHTML += "Altitude: <br>" + altitude + "<br>";
            details.innerHTML += "Heading: <br>" + heading + "<br>";
            details.innerHTML += "Speed: <br>" + speed + "<br>";
            details.innerHTML += "reqcount: <br>" + reqcount;
        }


        function errorCallback(error) {

        }

        var options = {
            enableHighAccuracy: true,
            timeout: 1000,
            maximumAge: 0
        }
    </script>
</body>
</html>
