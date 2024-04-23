<x-app-layout>
    <div class="w-auto px-3 overflow-auto">
        <div class="flex overflow-auto">
            <div class="pr-3 hidden sm:block">
                @include('includes.supv-sidebar.tracking')
            </div>
            <div class="flex-1">
                <div class="flex">
                    <div>
                        <div>
                            <div class="w-[240px] h-[580px] mr-3 bg-white rounded-3xl border border-blue-300">
                                <div>
                                    <div class="w-full mx-auto">
                                        <div
                                            class="p-4 bg-gradient-to-r from-blue-400 to-blue-300 overflow-hidden shadow-sm rounded-t-xl">
                                            <div class="flex items-center justify-between font-bold text-white">
                                                Vehicle Locations
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    @forelse ($userLocs as $userLoc)
                                        <div class="w-full mx-auto">
                                            <div class="m-2 bg-gray-100 rounded overflow-hidden shadow-sm hover:bg-gray-200">
                                                <div class="flex items-center justify-between font-bold text-gray-900 userId p-2"
                                                    data-lat="{{ $userLoc->latitude }}" data-lng="{{ $userLoc->longitude }}"
                                                    data-userId="{{ $userLoc->userId }}" data-accuracy="{{ $userLoc->accuracy }}"
                                                    data-image="{{ $userLoc->image }}" data-model="{{ $userLoc->model }}"
                                                    data-plate="{{ $userLoc->plate }}" data-brand="{{ $userLoc->brand }}"
                                                    data-name="{{ $userLoc->user->name }}"
                                                    data-station="{{ $userLoc->user->station }}">
                                                    <div>
                                                        <span>Officer: {{ $userLoc->user->name }}</span>
                                                        <p>PlateNo.: {{ $userLoc->plate }}</p>
                                                        <p>{{ $userLoc->brand }} | {{ $userLoc->model }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="w-full mx-auto">
                                            <div class="m-2 bg-gray-100 rounded overflow-hidden shadow-sm">
                                                <div
                                                    class="flex items-center justify-between font-bold text-gray-900 employee-id p-2">
                                                    <span class="p-2">No Vehicle is currenly being used.</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="map" class="h-[580px] w-11/12 mx-auto border border-blue-400"></div>
                </div>
            </div>
        </div>
    </div>
    
    {{-- <div id="latitude">123</div>
    <div id="longitude">123</div> --}}

    {{-- <script>

        var img = $(this).data('image');
        var officerIcon = L.icon({
            iconUrl: 'img/officer.png',
            iconSize: [32, 32],
            iconAnchor: [15, 20],
            popupAnchor: [0, -20]
        });
        var stationIcon = L.icon({
            iconUrl: 'img/pin.png',
            iconSize: [50, 50],
            iconAnchor: [15, 20],
            popupAnchor: [9, -20]
        });

        var map = L.map('map').setView([14.7508947, 121.059609], 15);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 15,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        navigator.geolocation.watchPosition(success, error);

        let marker, circle, zoomed;


        $('.userId').click(function() {
            console.log("Hello, world!");
            var lat = $(this).data('lat');
            var lng = $(this).data('lng');
            var accuracy = $(this).data('accuracy');
            var plate = $(this).data('plate');
            var name = $(this).data('name');
            var station = $(this).data('station');

            if (marker[plate]) {
                map.removeLayer(marker);
                map.removeLayer(circle);
            }

            marker = L.marker([lat, lng], {icon: officerIcon}).addTo(map);
            circle = L.circle([lat, lng], { radius: accuracy }).addTo(map);

            if (!zoomed) {
                zoomed = map.fitBounds(circle.getBounds());
            }

            map.setView([lat, lng]);

            marker.bindPopup(`Plate#: ${plate}<br>
                            Officer: ${name}<br>
                            ${station}`).openPopup();

        });

        const stationLat = 14.750956664768104;
        const stationLng = 121.05376006756651;

        const station1Marker = L.marker([stationLat, stationLng], {icon: stationIcon}).addTo(map);
        const station2Marker = L.marker([14.7508947, 121.059609], {icon: stationIcon}).addTo(map);

        station1Marker.bindPopup("Station 1").openPopup().addTo(map);
        station2Marker.bindPopup("Station 2").addTo(map);


        function success(pos) {
            const lat = pos.coords.latitude;
            const lng = pos.coords.longitude;
            const accuracy = pos.coords.accuracy;

            if (marker) {
                map.removeLayer(marker);
                map.removeLayer(circle);
            }

            marker = L.marker([lat, lng], {icon: officerIcon}).addTo(map);
            circle = L.circle([lat, lng], { radius: accuracy }).addTo(map);

            if (!zoomed) {
                zoomed = map.fitBounds(circle.getBounds());
            }

            map.setView([lat, lng]);

            marker.bindPopup("You are here.").openPopup();

            station1Marker.addTo(map);
            station2Marker.addTo(map);
        }

        function error(err) {
            if (err.code === 1) {
                alert("Please allow geolocation acces");
            } else {
                // alert("Cannot get current location");
            }
        }
    </script> --}}

    {{-- <script>
        var map = L.map('map').setView([0, 0], 2);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors'
        }).addTo(map);

        @foreach ($userLocs as $user)
            L.marker([{{ $user->location['lat'] }}, {{ $user->location['lng'] }}]).addTo(map);
        @endforeach


        setInterval(function() {
            $.get('/api/user-locations', function(data) {
                // remove existing markers
                map.eachLayer(function(layer) {
                    if (layer instanceof L.Marker) {
                        map.removeLayer(layer);
                    }
                });

                // add new markers
                data.forEach(function(location) {
                    L.marker([location.lat, location.lng]).addTo(map);
                });
            });
        }, 10000);
    </script> --}}

    <script>
        var officerIcon = L.icon({
            iconUrl: 'img/officer.png',
            iconSize: [32, 32],
            iconAnchor: [15, 20],
            popupAnchor: [0, -20]
        });
        var stationIcon = L.icon({
            iconUrl: 'img/pin.png',
            iconSize: [50, 50],
            iconAnchor: [15, 20],
            popupAnchor: [9, -20]
        });

        var map = L.map('map').setView([14.669307819471186, 120.99638656890184], 15);
        var markers = [];

        const station1Marker = L.marker([14.669307819471186, 120.99638656890184], {
                icon: stationIcon
            }).addTo(map);

            const station2Marker = L.marker([14.644566831083793, 120.98993556756545], {
                icon: stationIcon
            }).addTo(map);

            const station3Marker = L.marker([14.648782330303616, 120.97685627576048], {
                icon: stationIcon
            }).addTo(map);

            const station4Marker = L.marker([14.658446598876315, 120.97083955592072], {
                icon: stationIcon
            }).addTo(map);

            const station5Marker = L.marker([14.661919775219591, 120.9948767982496], {
                icon: stationIcon
            }).addTo(map);

            const station6Marker = L.marker([14.751761867500361, 121.0385315143921], {
                icon: stationIcon
            }).addTo(map);

            const station7Marker = L.marker([14.731107485609826, 121.01919736941495], {
                icon: stationIcon
            }).addTo(map);

            const station9Marker = L.marker([14.749909380617469, 121.0331439490799], {
                icon: stationIcon
            }).addTo(map);

            const station10Marker = L.marker([14.753505299601459, 121.05330615649922], {
                icon: stationIcon
            }).addTo(map);

            const station11Marker = L.marker([14.767508425781163, 121.04377045407323], {
                icon: stationIcon
            }).addTo(map);

            const station12Marker = L.marker([14.774623766057518, 121.04467445564566], {
                icon: stationIcon
            }).addTo(map);


            station1Marker.bindPopup("Station 1").openPopup().addTo(map);
            station2Marker.bindPopup("Station 2").addTo(map);
            station3Marker.bindPopup("Station 3").addTo(map);
            station4Marker.bindPopup("Station 4").addTo(map);
            station5Marker.bindPopup("Station 5").addTo(map);
            station6Marker.bindPopup("Station 6").addTo(map);
            station7Marker.bindPopup("Station 7").addTo(map);
            station9Marker.bindPopup("Station 9").addTo(map);
            station10Marker.bindPopup("Station 10").addTo(map);
            station11Marker.bindPopup("Station 11").addTo(map);
            station12Marker.bindPopup("Station 12").addTo(map);
    
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 20,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);
    
        function fetchLat() {
            $.get('/user-location', function(locs) {
                // Remove all existing markers
                markers.forEach(function(marker) {
                    map.removeLayer(marker);
                });
                markers = [];
    
                // Add a marker for each location
                locs.forEach(function(loc) {
                    var newMarker = L.marker([parseFloat(loc.lat), parseFloat(loc.lng)], {icon: officerIcon}).addTo(map);
                    newMarker.bindPopup("<b>" + loc.name + "</b><br>"
                                                        + loc.brand + " | " + loc.model + "<br>"
                                                        + loc.plate + "<br>"
                                                        + loc.station);
                    markers.push(newMarker);
                });
            });
        }

        $('.userId').click(function() {
            var lat = $(this).data('lat');
            var lng = $(this).data('lng');
            map.setView([lat, lng]);
        });
    
        // Update the value every 2 seconds
        setInterval(fetchLat, 2000);
    
        // Call the function initially to display the current value
        fetchLat();
    </script>
</x-app-layout>
