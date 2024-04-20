<x-app-layout>
    <div class="flex">
        {{-- <livewire:tracking /> --}}
        <div>

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
                        @forelse ($userLocs as $userLoc)
                        <div class="w-full mx-auto">
                            <div class="m-2 bg-gray-100 rounded overflow-hidden shadow-sm">
                                <div class="flex items-center justify-between font-bold text-gray-900 userId p-2"
                                data-lat="{{ $userLoc->latitude }}"
                                data-lng="{{ $userLoc->longitude }}"
                                data-userId="{{ $userLoc->userId }}"
                                data-accuracy="{{$userLoc->accuracy}}"
                                data-image="{{$userLoc->image}}"
                                data-model="{{$userLoc->model}}"
                                data-plate="{{$userLoc->plate}}"
                                data-brand="{{$userLoc->brand}}"

                                {{-- data-first_name="{{ $userlocation->first_name }}"
                                data-last_name="{{ $userlocation->last_name }}" --}}
                                >
                                <div>
                                    <p>{{ $userLoc->model }}</p>
                                    <p>{{ $userLoc->plate }}</p>
                                    <span>sample :{{ $userLoc->user->name }}</span>
                            </div>
                           </div>
                            </div>
                        </div>
                        @empty
                         <div class="w-full mx-auto">
                            <div class="m-2 bg-gray-100 rounded overflow-hidden shadow-sm">
                                 <div class="flex items-center justify-between font-bold text-gray-900 employee-id p-2">
                                     <span class="p-2">No Vehicle is currenly being used.</span>
                                 </div>
                           </div>
                        </div>

                        @endforelse
                    </div>
                </div>
            </div>
    </div>
        <div id="map" class="h-[350px] w-11/12 mx-auto border border-blue-400"></div>
    </div>
    <script>

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
            maxZoom: 19,
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

            marker.bindPopup(`${plate}`).openPopup();
            
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

            marker.bindPopup("{{Auth()->user()->name}}").openPopup();

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
    </script>
</x-app-layout>
