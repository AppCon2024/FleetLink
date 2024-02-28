<x-app-layout>

    @if (Auth::user()->role == 'admin')
        <div class="fixed left-3 top-[87px] w-[240px] h-[86%] bg-blue-200 rounded-3xl p-4">
            <ul class="mt-2">
                <li class="mb-1 group active">
                    <a href="{{ asset('dashboard') }}"
                        class="flex items-center py-2 px-4 text-black hover:bg-blue-400 hover:text-gray-100 rounded-md group-[.active]:bg-blue-700 group-[.active]:text-white group-[.selected]:bg-blue-500 group-[.selected]:text-white">
                        <i class="ri-dashboard-fill mr-3 text-lg"></i>
                        <span class="font-poppins">Dashboard</span>
                    </a>
                </li>
                <li class="mb-1 group">
                    <a href="{{ asset('supervisors') }}"
                        class="flex items-center py-2 px-4 text-black hover:bg-blue-400 hover:text-gray-100 rounded-md group-[.active]:bg-blue-700 group-[.active]:text-white group-[.selected]:bg-blue-500 group-[.selected]:text-white">
                        <i class="ri-admin-fill mr-3 text-lg"></i>
                        <span class="font-poppins">Admins</span>
                    </a>
                </li>
                <li class="mb-1 group">
                    <a href="{{ asset('supervisors') }}"
                        class="flex items-center py-2 px-4 text-black hover:bg-blue-400 hover:text-gray-100 rounded-md group-[.active]:bg-blue-700 group-[.active]:text-white group-[.selected]:bg-blue-500 group-[.selected]:text-white">
                        <i class="ri-admin-fill mr-3 text-lg"></i>
                        <span class="font-poppins">Supervisors</span>
                    </a>
                </li>
                <li class="mb-1 group">
                    <a href="{{ asset('accounts') }}"
                        class="flex items-center py-2 px-4 text-black hover:bg-blue-400 hover:text-gray-100 rounded-md group-[.active]:bg-blue-700 group-[.active]:text-white group-[.selected]:bg-blue-500 group-[.selected]:text-white">
                        <i class="ri-account-pin-box-line mr-3 text-lg"></i>
                        <span class="font-poppins">Officers</span>
                    </a>
                </li>
                <li class="mb-1 group">
                    <a href="{{ asset('vehicles') }}"
                        class="flex items-center py-2 px-4 text-black hover:bg-blue-400 hover:text-gray-100 rounded-md group-[.active]:bg-blue-700 group-[.active]:text-white group-[.selected]:bg-blue-500 group-[.selected]:text-white">
                        <i class="ri-user-fill mr-3 text-lg"></i>
                        <span class="font-poppins">Vehicles</span>
                    </a>
                </li>
                <li class="mb-1 group">
                    <a href="{{ asset('chatify') }}"
                        class="flex items-center py-2 px-4 text-black hover:bg-blue-400 hover:text-gray-100 rounded-md group-[.active]:bg-blue-700 group-[.active]:text-white group-[.selected]:bg-blue-500 group-[.selected]:text-white">
                        <i class="ri-calendar-2-fill mr-3 text-lg"></i>
                        <span class="font-poppins">Messages</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- START MAIN -->
        <main
            class="fixed top-[86px] w-full md:w-[calc(100%-256px)] md:ml-64 bg-gray-50 min-h-screen transition-all main">
            <!-- START DASHBOARD -->
            <div class="bg-slate-200 h-screen w-full overflow-y-auto rounded-2xl ml-2">
                <main>
                    <!-- Content -->
                    <div class="mt-2">
                        <!-- State cards -->
                        <div class="grid grid-cols-1 gap-8 p-4 lg:grid-cols-2 xl:grid-cols-4">

                            <!-- Value card -->
                            <a href="{{ asset('supervisors') }}">
                                <div
                                    class="flex items-center justify-between p-4 bg-white hover:bg-blue-200 rounded-md dark:bg-darker">
                                    <div class="ml-4">
                                        <h6
                                            class="text-xs font-medium leading-none tracking-wider text-gray-500 uppercase dark:text-primary-light">
                                            Supervisors
                                        </h6>
                                        <span class="text-xl hover:text-2xl font-semibold">{{ $countSupervisor }}</span>
                                        {{-- <span class="inline-block px-2 py-px ml-2 text-xs text-green-500 bg-green-100 rounded-md">
                            +4.14%
                            </span> --}}
                                    </div>
                                    <div>
                                        <span>
                                            <i
                                                class="ri-shield-user-fill ml-3 text-6xl text-blue-500 hover:text-black hover:text7xl"></i>
                                        </span>
                                    </div>
                                </div>
                            </a>
                            <!-- Users card -->
                            <a href="{{ asset('accounts') }}">
                                <div class="flex items-center justify-between p-4 bg-white hover:bg-blue-200 rounded-md dark:bg-darker">
                                    <div class="ml-4">
                                        <h6
                                            class="text-xs font-medium leading-none tracking-wider text-gray-500 uppercase dark:text-primary-light">
                                            Police Accounts
                                        </h6>
                                        <span class="text-xl font-semibold">{{ $countAccount }}</span>
                                        {{-- <span class="inline-block px-2 py-px ml-2 text-xs text-green-500 bg-green-100 rounded-md">
                            +2.6%
                            </span> --}}
                                    </div>
                                    <div>
                                        <span>
                                            <i class="ri-star-smile-fill ml-3 text-6xl text-blue-500"></i>
                                        </span>
                                    </div>
                                </div>
                            </a>
                            <!-- Orders card -->
                            <a href="{{ asset('vehicles') }}">
                                <div class="flex items-center justify-between p-4 bg-white hover:bg-blue-200 rounded-md dark:bg-darker">
                                    <div class="ml-4">
                                        <h6
                                            class="text-xs font-medium leading-none tracking-wider text-gray-500 uppercase dark:text-primary-light">
                                            Vehicles
                                        </h6>
                                        <span class="text-xl font-semibold">{{ $countVehicle }}</span>
                                        {{-- <span class="inline-block px-2 py-px ml-2 text-xs text-green-500 bg-green-100 rounded-md">
                            +3.1%
                            </span> --}}
                                    </div>
                                    <div>
                                        <span>
                                            <i class="ri-checkbox-circle-line ml-3 text-6xl text-green-500"></i>
                                        </span>
                                    </div>
                                </div>
                            </a>
                            <!-- Tickets card -->
                            <a href="{{ asset('vehicles') }}">
                                <div class="flex items-center justify-between p-4 bg-white hover:bg-blue-200 rounded-md dark:bg-darker">
                                    <div>
                                        <h6
                                            class="text-xs font-medium leading-none tracking-wider text-gray-500 uppercase dark:text-primary-light">
                                            Available Vehicle
                                        </h6>
                                        <span class="ml-4 text-xl font-semibold">{{ $countVehicle }}</span>
                                        {{-- <span class="inline-block px-2 py-px ml-2 text-xs text-green-500 bg-green-100 rounded-md">
                            +3.1%
                            </span> --}}
                                    </div>
                                    <div>
                                        <span>
                                            <i class="ri-steering-2-line ml-3 text-6xl text-blue-500"></i>
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Charts -->
                        <div class="grid grid-cols-1 p-4 space-y-8 lg:gap-8 lg:space-y-0 lg:grid-cols-3">
                            <!-- Bar chart card -->
                            <div class="col-span-2 bg-white rounded-md dark:bg-darker" x-data="{ isOn: false }">
                                <!-- Card header -->
                                <div class="flex items-center justify-between p-4 border-b dark:border-primary">
                                    <h4 class="text-lg font-semibold text-gray-500 dark:text-light">Bar Chart</h4>
                                    <div class="flex items-center space-x-2">

                                    </div>
                                </div>

                                <!-- Chart -->
                                <div class="relative p-4 h-72">
                                    <canvas id="barChart"></canvas>
                                </div>
                            </div>

                            <!-- Doughnut chart card -->
                            <div class="bg-white rounded-md dark:bg-darker" x-data="{ isOn: false }">
                                <!-- Card header -->
                                <div class="flex items-center justify-between p-4 border-b dark:border-primary">
                                    <h4 class="text-lg font-semibold text-gray-500 dark:text-light">Doughnut Chart</h4>
                                    <div class="flex items-center">

                                    </div>
                                </div>
                                <!-- Chart -->
                                <div class="relative p-4 h-72">
                                    <canvas id="doughnutChart"></canvas>
                                </div>
                            </div>
                        </div>

                        <!-- Two grid columns -->
                        <div class="grid grid-cols-1 p-4 space-y-8 lg:gap-8 lg:space-y-0 lg:grid-cols-3">
                            <!-- Active users chart -->
                            <div class="col-span-1 bg-white rounded-md dark:bg-darker">
                                <!-- Card header -->
                                <div class="p-4 border-b dark:border-primary">
                                    <h4 class="text-lg font-semibold text-gray-500 dark:text-light">Active users right
                                        now</h4>
                                </div>
                                <p class="p-4">
                                    <span class="text-2xl font-medium text-gray-500 dark:text-light"
                                        id="usersCount">0</span>
                                    <span class="text-sm font-medium text-gray-500 dark:text-primary">Users</span>
                                </p>
                                <!-- Chart -->
                                <div class="relative p-4">
                                    <canvas id="activeUsersChart"></canvas>
                                </div>
                            </div>

                            <!-- Line chart card -->
                            <div class="col-span-2 bg-white rounded-md dark:bg-darker" x-data="{ isOn: false }">
                                <!-- Card header -->
                                <div class="flex items-center justify-between p-4 border-b dark:border-primary">
                                    <h4 class="text-lg font-semibold text-gray-500 dark:text-light">Line Chart</h4>
                                    <div class="flex items-center">
                                        <button class="relative focus:outline-none" x-cloak
                                            @click="isOn = !isOn; $parent.updateLineChart()">
                                            <div
                                                class="w-12 h-6 transition rounded-full outline-none bg-primary-100 dark:bg-primary-darker">
                                            </div>
                                            <div class="absolute top-0 left-0 inline-flex items-center justify-center w-6 h-6 transition-all duration-200 ease-in-out transform scale-110 rounded-full shadow-sm"
                                                :class="{ 'translate-x-0  bg-white dark:bg-primary-100': !
                                                    isOn, 'translate-x-6 bg-primary-light dark:bg-primary': isOn }">
                                            </div>
                                        </button>
                                    </div>
                                </div>
                                <!-- Chart -->
                                <div class="relative p-4 h-72">
                                    <canvas id="lineChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </main>
    @endif



    @if (Auth::user()->role == 'supervisor')
        <div class="fixed left-3 top-[87px] w-[240px] h-[86%] bg-blue-200 rounded-3xl p-4">
            <ul class="mt-2">
                <li class="mb-1 group">
                    <a href="{{ asset('dashboard') }}"
                        class="flex items-center py-2 px-4 text-black hover:bg-blue-400 hover:text-gray-100 rounded-md group-[.active]:bg-blue-700 group-[.active]:text-white group-[.selected]:bg-blue-500 group-[.selected]:text-white">
                        <i class="ri-dashboard-fill mr-3 text-lg"></i>
                        <span class="font-poppins">Dashboard</span>
                    </a>
                </li>
                <li class="mb-1 group">
                    <a href="{{ asset('accounts') }}"
                        class="flex items-center py-2 px-4 text-black hover:bg-blue-400 hover:text-gray-100 rounded-md group-[.active]:bg-blue-700 group-[.active]:text-white group-[.selected]:bg-blue-500 group-[.selected]:text-white">
                        <i class="ri-admin-fill mr-3 text-lg"></i>
                        <span class="font-poppins">Officers</span>
                    </a>
                </li>
                <li class="mb-1 group active">
                    <a href="{{ asset('tracking') }}"
                        class="flex items-center py-2 px-4 text-black hover:bg-blue-400 hover:text-gray-100 rounded-md group-[.active]:bg-blue-700 group-[.active]:text-white group-[.selected]:bg-blue-500 group-[.selected]:text-white">
                        <i class="ri-account-pin-box-line mr-3 text-lg"></i>
                        <span class="font-poppins">Tracking</span>
                    </a>
                </li>
                {{-- <li class="mb-1 group">
                <a href="{{ asset('calendar')}}" class="flex items-center py-2 px-4 text-black hover:bg-blue-400 hover:text-gray-100 rounded-md group-[.active]:bg-blue-700 group-[.active]:text-white group-[.selected]:bg-blue-500 group-[.selected]:text-white">
                    <i class="ri-user-fill mr-3 text-lg"></i>
                    <span class="font-poppins">Calendar</span>
                </a>
            </li> --}}
                <li class="mb-1 group">
                    <a href="{{ asset('chatify') }}"
                        class="flex items-center py-2 px-4 text-black hover:bg-blue-400 hover:text-gray-100 rounded-md group-[.active]:bg-blue-700 group-[.active]:text-white group-[.selected]:bg-blue-500 group-[.selected]:text-white">
                        <i class="ri-calendar-2-fill mr-3 text-lg"></i>
                        <span class="font-poppins">Messages</span>
                    </a>
                </li>
            </ul>
        </div>
        {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> --}}
        {{-- <div class="fixed py-12 top-[60px] left-[240px]">
        <div class="max-w-5xl sm:px-6 lg:px-8">
            <div class="bg-white mx-auto dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in as Supervisor!") }}
                </div>
            </div>
        </div>
    </div> --}}
    <body>
        <main class="fixed top-[84px] w-full md:w-[calc(100%-256px)] md:ml-64 min-h-screen mt-1 transition-all main">
            <!-- START DASHBOARD -->
            <div class="bg-slate-200 h-screen w-1/6 overflow-y-auto rounded-2xl ml-2">
                <!-- Tailwind UI Search Bar -->
                <div class=" mt-8 mb-4 px-4">
                    <label for="search" class="sr-only">Search</label>
                    <div class="relative text-gray-600 focus-within:text-gray-400">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                            <svg viewBox="0 0 24 24" class="w-5 h-5 fill-current">
                                <path fill="none" d="M0 0h24v24H0z" />
                                <path d="M15.5 14h-.79l-.28-.27a6.5 6.5 0 0 0 1.48-5.34c-.47-2.78-2.79-5-5.59-5.34a6.505 6.505 0 0 0-7.27 7.27c.34 2.8 2.56 5.12 5.34 5.59a6.5 6.5 0 0 0 5.34-1.48l.27.28v.79l4.25 4.25c.41.41 1.08.41 1.49 0 .41-.41.41-1.08 0-1.49L15.5 14zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z" />
                            </svg>
                        </span>
                        <input type="search" id="searchInput" class="py-2 text-base pl-8 pr-2 rounded-md w-full border border-gray-300 focus:outline-none focus:border-blue-500" placeholder="Search...">
                    </div>
                </div>
                <!-- End of Tailwind UI Search Bar -->

                <div id="side-container">
                    <div id="location-details">
                        @foreach($locations as $loc)
                            <p>{{ $loc->vehiclePlate }}</p>
                        @endforeach
                    </div>
                </div>
            </div>
</div>
</div>
</div>
<div id="map" class="fixed"></div>
    @endif

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

</x-app-layout>
