<div class="w-auto px-3 overflow-auto">
    <div class="flex flex-row overflow-auto">
        <div class="pr-3 hidden sm:block">
            @include('includes.supv-sidebar.tracking')
        </div>
        <div>
            @foreach ($borrows as $borrow)
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
                                    <div class="flex items-center justify-between font-bold text-gray-900">
                                        <p>{{ $borrow->first_name }} {{ $borrow->last_name }}</p>
                                        @foreach ($geoLocations as $geoLocation)
                                            <span class="employee-id" data-employee-id="{{ $geoLocation->employee_id }}" data-lat="{{ $geoLocation->latitude }}" data-lng="{{ $geoLocation->longitude }}">
                                                <p>Employee#{{ $geoLocation->employee_id }}</p>
                                            </span>
                                        @endforeach
                                   
                                        <p>Plate#{{ $borrow->plate }}</p>
                                    
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
    var marker; 

    $(document).ready(function() {
        navigator.geolocation.getCurrentPosition(initialPositionSuccess, errorCallback);

        $('.employee-id').click(function() {
            var employeeId = $(this).data('employee-id');
            var lat = $(this).data('lat');
            var lng = $(this).data('lng');

            updateMap(lat, lng);

            console.log('Clicked employee ID: ' + employeeId);
        });
    });

    function initialPositionSuccess(position) {
        const { latitude, longitude } = position.coords;

        updateMap(latitude, longitude);
    }

    function successCallback(position) {
        const { latitude, longitude } = position.coords;

        updateMap(latitude, longitude);
        
        moveMarker(latitude, longitude);
    }

    function errorCallback(error) {
        console.error('Error getting geolocation:', error.code, error.message);

        document.getElementById('error-message').innerText =
            'Error getting geolocation. Please enable location services and try again.';

        if (error.code === 1 || error.code === 3) { 
            navigator.geolocation.clearWatch(watchID);
        }
    }

    function updateMap(latitude, longitude) {
        const mapElement = document.getElementById('map');
        mapElement.innerHTML =
            `<iframe width="100%" height="100%" src="https://maps.google.com/maps?q=${latitude},${longitude}&amp;z=15&amp;output=embed&iwloc=near"></iframe>`;
    }
    function moveMarker(latitude, longitude) {
        if (!marker) {
            marker = new google.maps.Marker({
                position: { lat: latitude, lng: longitude },
                map: map,
                title: 'User Location'
            });
        } else {
            marker.setPosition({ lat: latitude, lng: longitude });
        }
    }
</script>

