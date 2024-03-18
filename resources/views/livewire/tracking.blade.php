<style>
    #map {
            flex: 1;
            height: 75vh; /* Full height of the viewport */
        }
</style>




<div class="w-auto px-3 overflow-auto">
    <div class="flex flex-row overflow-auto">
        <div class="pr-3 hidden sm:block">
            @include('includes.supv-sidebar.tracking')
        </div>
        <div>
            @forelse ($locations as $userlocation)
                <div>
                    <div class="w-[240px] h-[545px] bg-white rounded-3xl">
                        <div>
                            <div class="w-full mx-auto">
                                <div class="p-4 bg-gradient-to-r from-blue-400 to-blue-300 overflow-hidden shadow-sm rounded-t-xl">
                                    <div class="flex items-center justify-between font-bold text-white">
                                        Vehicle Locations
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="w-11/12 mx-auto">
                                <div class="p-3h bg-white rounded overflow-hidden shadow-sm">
                                    <div class="flex items-center justify-between font-bold text-gray-900 employee-id" 
                                    data-lat="{{ $userlocation->latitude }}" 
                                    data-lng="{{ $userlocation->longitude }}"
                                    data-employee-id="{{ $userlocation->employee_id }}"
                                    data-first_name="{{ $userlocation->first_name }}">
                                    <div><p>{{ $userlocation->first_name }} {{ $userlocation->last_name }}</p>
                                   <span>Plate#:{{ $userlocation->plate }}</span></div>
                               </div>
                               
                                        

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
                <div class="w-full pl-3">
                    <div class="h-[545px] bg-white rounded-3xl p-4">
                        <div id="map" class="p-1"></div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    var map;
    var userMarker;

    $(document).ready(function() {
        // Initialize map
        map = L.map('map').setView([0, 0], 2); // Set initial view

        // Add tile layer
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        // Retrieve and set initial real-time location
        navigator.geolocation.getCurrentPosition(initialPositionSuccess, errorCallback);

        // Add click event to each employee-id
        $('.employee-id').click(function() {
            var lat = $(this).data('lat');
            var lng = $(this).data('lng');
            var first_name = $(this).data('first_name');

            // Remove existing markers
            clearMarkers();

            // Create marker
            var marker = L.marker([lat, lng]).addTo(map);
            marker.bindPopup(`<b>Name:</b> ${first_name}`).openPopup();

            // Center map to marker
            map.setView([lat, lng], 15);

            // Call simulateMovement every second, passing the marker object
            setInterval(() => simulateMovement(marker), 1000);
        });
    });
 
    // Function to update user's position and simulate movement
    function simulateMovement(marker) {
        // Parameters for movement simulation (adjust as needed)
        var movementSpeed = 0.0001; // Adjust the speed of movement
        var movementAngle = Math.random() * 360; // Random movement direction

        // Calculate new position based on movement parameters
        var lat = marker.getLatLng().lat + (movementSpeed * Math.cos(movementAngle));
        var lng = marker.getLatLng().lng + (movementSpeed * Math.sin(movementAngle));

        // Update marker with new position
        marker.setLatLng([lat, lng]);
        marker.bindPopup('<b>Your Real-time Location</b>').openPopup();

        // Center map to updated position
        map.setView([lat, lng], 15);
    }

    // Function to clear all markers from the map
    function clearMarkers() {
        if (userMarker) {
            map.removeLayer(userMarker);
        }
    }

    function initialPositionSuccess(position) {
        const { latitude, longitude } = position.coords;

        // Set real-time location on map
        map.setView([latitude, longitude], 15);

        // Create marker for real-time location
        userMarker = L.marker([latitude, longitude]).addTo(map);
        userMarker.bindPopup('<b>Your Real-time Location</b>').openPopup();

        // Watch for changes in the user's position
        navigator.geolocation.watchPosition(positionUpdateSuccess, errorCallback);
    }

    function positionUpdateSuccess(position) {
        const { latitude, longitude } = position.coords;

        // Update marker position
        userMarker.setLatLng([latitude, longitude]);
    }

    function errorCallback(error) {
        console.error('Error getting geolocation:', error.code, error.message);

        document.getElementById('error-message').innerText =
            'Error getting geolocation. Please enable location services and try again.';

        if (error.code === 1 || error.code === 3) { 
            navigator.geolocation.clearWatch(watchID);
        }
    }
</script>



