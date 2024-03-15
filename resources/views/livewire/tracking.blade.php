<div class="w-auto px-3 overflow-auto">
    <div class="flex flex-row overflow-auto">
        <div class="pr-3 hidden sm:block">
            @include('includes.supv-sidebar.tracking')
        </div>

       
        <div>
            <div class="w-[240px] h-[545px] bg-white rounded-3xl">
                <div>
                    <div class="w-full mx-auto">
                        <div class="p-4 bg-gradient-to-r from-blue-400 to-blue-300 overflow-hidden shadow-sm rounded-t-xl">
                            <div class=" flex items-center justify-between font-bold text-white">
                                Vehicle Locations
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    @forelse ($locations as $loc)
                    <div class="w-11/12 mx-auto">
                        <div class="p-4 bg-white rounded overflow-hidden shadow-sm">
                            <div class=" flex items-center justify-between font-bold text-gray-900">
                               Plate number: {{ $loc->employee_id }}
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="w-11/12 mx-auto">
                        <div class="p-4 bg-white rounded overflow-hidden shadow-sm">
                            <div class=" flex items-center justify-between font-bold text-gray-900">
                                No vehicle is being used.
                            </div>
                        </div>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
        <div class="w-full pl-3">
            <div class="h-[545px] bg-white rounded-3xl p-4">
                <div id="map" class="p-1"></div>
                <div id="details">

                    <h2>Location Details</h2>
                    <p id="accuracy"></p>
                    <p id="latitude"></p>
                    <p id="longitude"></p>
                    <p id="reqCount"></p>
                    <hr>
                </div>
        
                <div id="error-message"></div>
            </div>
        </div>
    </div>

    {{-- <script>
        var reqcount = 0;
        var watchID; // Variable to store the watch position ID
        var employeeId = {{ auth()->user()->employee_id }};

        var options = {
            enableHighAccuracy: true,
            timeout: 10000,
            maximumAge: 0
        };

        navigator.geolocation.getCurrentPosition(initialPositionSuccess, errorCallback, options);

        function initialPositionSuccess(position) {
            const {
                latitude,
                longitude
            } = position.coords;
            document.getElementById('map').innerHTML =
                `<iframe width="100%" height="100%" src="https://maps.google.com/maps?q=${latitude},${longitude}&amp;z=15&amp;output=embed&iwloc=near"></iframe>`;

            watchID = navigator.geolocation.watchPosition(successCallback, errorCallback, options);
        }

        function successCallback(position) {
            const {
                accuracy,
                latitude,
                longitude
            } = position.coords;

            reqcount++;
            document.getElementById('accuracy').innerText = "Accuracy: " + accuracy;
            document.getElementById('latitude').innerText = "Latitude: " + latitude;
            document.getElementById('longitude').innerText = "Longitude: " + longitude;
            document.getElementById('reqCount').innerText = "Req Count: " + reqcount;

            // Update the map URL dynamically
            updateMap(latitude, longitude);

            // Save geolocation data to the server
            saveGeolocation(position.coords);
        }

        function errorCallback(error) {
            console.error('Error getting geolocation:', error.code, error.message);

            // Display a user-friendly message on the page
            document.getElementById('error-message').innerText =
                'Error getting geolocation. Please enable location services and try again.';

            // Optionally, stop watching for geolocation updates on specific errors
            if (error.code === 1 || error.code === 3) { // Permission denied or timeout
                navigator.geolocation.clearWatch(watchID);
            }
        }

        function updateMap(latitude, longitude) {
            // Update the map URL with the new coordinates
            const mapElement = document.getElementById('map');
            mapElement.innerHTML =
                `<iframe width="100%" height="100%" src="https://maps.google.com/maps?q=${latitude},${longitude}&amp;z=15&amp;output=embed&iwloc=near"></iframe>`;
        }


        function saveGeolocation(coords) {
            const {
                latitude,
                longitude,
                accuracy
            } = coords;

            $.ajax({
                url: '/geolocations/update',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    latitude: latitude,
                    longitude: longitude,
                    accuracy: accuracy,
                    employee_id: employeeId,
                },
                success: function(response) {
                    console.log(response.message);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }
    </script> --}}


    <script>
        var locations = @json($locations);
    
        var map = L.map('map').setView([51.505, -0.09], 13);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);
    
        locations.forEach(function(location) {
            L.marker([location.latitude, location.longitude])
                .bindPopup(`<b>${location.vehicle_name}</b><br>${location.vehiclePlate}`)
                .addTo(map);
        });
    
    
            let marker, circle, zoomed;
    
            navigator.geolocation.getCurrentPosition(success, error);
    
            function success(pos) {
                const lat = pos.coords.latitude;
                const lng = pos.coords.longitude;
                const accuracy = pos.coords.accuracy;
    
                if (marker) {
                    map.removeLayer(marker);
                    map.removeLayer(circle);
                }
    
                marker = L.marker([lat, lng]).addTo(map);
                circle = L.circle([lat, lng], { radius: accuracy }).addTo(map);
    
                if (!zoomed) {
                    zoomed = map.fitBounds(circle.getBounds());
                }
    
                map.setView([lat, lng]);
            }
    
            function error(err) {
                if (err.code === 1) {
                    alert("Please allow geolocation access");
                } else {
                    alert("Cannot get current location");
                }
            }
    
            document.getElementById('searchInput').addEventListener('click', function () {
                const query = document.getElementById('searchInput').value;
                searchLocation(query);
            });
    
            function searchLocation(query) {
                fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${query}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data && data.length > 0) {
                            const lat = parseFloat(data[0].lat);
                            const lon = parseFloat(data[0].lon);
                            const displayName = data[0].display_name;
    
                            if (marker) {
                                map.removeLayer(marker);
                            }
    
                            marker = L.marker([lat, lon]).addTo(map);
                            marker.bindPopup(displayName).openPopup();
                            map.setView([lat, lon], 13);
                        } else {
                            alert("Location not found");
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert("Error fetching location data");
                    });
    
    
                }
    
    
            </script>
            <script>
    
                document.getElementById('side-container').addEventListener('click', function(event) {
            if (event.target.tagName === 'P') {
                var selectedName = event.target.textContent.trim();
                var selectedLocation = locations.find(function(location) {
                    return location.vehiclePlate === selectedName;
                });
                if (selectedLocation) {
                    updateMarker(selectedLocation);
                }
                    }
                });
    
                function updateMarker(selectedLocation) {
            map.setView([selectedLocation.latitude, selectedLocation.longitude], 13);
            marker.setLatLng([selectedLocation.latitude, selectedLocation.longitude]);
            marker.bindPopup(`<b>${selectedLocation.vehicle_name}</b><br>${selectedLocation.vehiclePlate}`).openPopup();
        }
    </script>

</div>
