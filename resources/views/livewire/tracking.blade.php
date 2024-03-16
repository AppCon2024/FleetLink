<div class="w-auto px-3 overflow-auto">
    <div class="flex flex-row overflow-auto">
        <div class="pr-3 hidden sm:block">
            @include('includes.supv-sidebar.tracking')
        </div>

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
                        <div class="p-4 bg-white rounded overflow-hidden shadow-sm">
                            <div class="flex items-center justify-between font-bold text-gray-900">
                                <span class="employee-id" data-lat="{{ $userlocation->latitude }}" data-lng="{{ $userlocation->longitude }}">
                                   Plate number: {{ $userlocation->employee_id }}
                                </span>
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
        @empty
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
                    <div class="p-4 bg-white rounded overflow-hidden shadow-sm">
                        <div class="flex items-center justify-between font-bold text-gray-900">
                            No vehicle is being used.
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
        
        @endforelse
    </div>
    <script>
        // Add event listener to all elements with the class 'employee-id'
        document.querySelectorAll('.employee-id').forEach(item => {
            item.addEventListener('click', event => {
                const latitude = item.getAttribute('data-lat');
                const longitude = item.getAttribute('data-lng');
                const plate = item.textContent.trim().split(': ')[1]; // Extract plate number from text
                alert(`Plate Number: ${plate}`); // Show alert with plate number
                updateMap(latitude, longitude); // Update map with clicked employee's location
            });
        });
    </script>
</div>


    <script>
        var reqcount = 0;
        var watchID; // Variable to store the watch position ID
      

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
                type: 'GET',
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
    </script>
   