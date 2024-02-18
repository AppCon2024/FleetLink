<?php
$sname = "localhost";
$uname = "root";
$password = "";
$db_name = "laravel";

$conn = mysqli_connect($sname, $uname, $password, $db_name);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


$sql = "SELECT * FROM locations";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Error: " . mysqli_error($conn));
}


$rows = array();
while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
}
$encodedRows = json_encode($rows);

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Live Map with Leaflet</title>
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
  <style>
     body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }
    #map-container {
        position: relative;
    }

    .container {
        display: flex;
        height: 100vh;
    }

    .map-container {
        width: 250px;
        background-color: #f4f4f4;
        padding: 20px;
        box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        float: left;
        box-sizing: border-box;
    }

    .main-content {
        flex-grow: 1;
        padding: 20px;
    }
  </style>
</head>
<body>
<div id="side-container">
  <div id="map" style="height: 500px;"></div>
  <script>
    var map = L.map('map').setView([14.6711, 120.9485], 13);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    var databaseResponse = <?php echo $encodedRows; ?>;
    var markers = [];

    for (var i = 0; i < databaseResponse.length; i++) {
        var data = databaseResponse[i];
        var marker = L.marker([data.latitude, data.longitude])
            .bindPopup(<b>${data.name}</b><br>Vehicle Plate: ${data.vehiclePlate})
            .addTo(map);
        markers.push(marker);
    }

    function updateMarker(index) {
        for (var i = 0; i < markers.length; i++) {
            if (i === index) {
                markers[i].openPopup();
                map.setView([databaseResponse[i].latitude, databaseResponse[i].longitude], 13);
            } else {
                markers[i].closePopup();
            }
        }
    }

    document.getElementById('side-container').addEventListener('click', function(event) {
        if (event.target.tagName === 'P') {
            var selectedName = event.target.textContent.trim();
            var selectedRow = databaseResponse.find(function(row) {
                return row.name === selectedName;
            });
            if (selectedRow) {
                var selectedIndex = databaseResponse.indexOf(selectedRow);
                updateMarker(selectedIndex);
            }
        }

    });
  </script>

  <input type="text" id="searchInput" placeholder="Search by name or plate number">
  <?php
  foreach ($rows as $row) {
      echo "<p>{$row['name']}</p>";
      echo "<p>{$row['vehiclePlate']}</p>";
  }

  ?>

</div>
</body>
</html>
