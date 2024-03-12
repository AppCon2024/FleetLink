<x-app-layout>
<style>
    #map {
        margin-top: 54%;
            width:100%;
            height: 40vh; /* Adjust the height as needed */
        }
/* CSS for mobile screens */
@media (max-width: 768px) {
    /* Hide the web menu on smaller screens */
    .md\:block {
        display: none;
    }


      

    /* Show the mobile menu */
    .md\:hidden {
        display: block;
    }

    /* Adjust styles for mobile menu */
    /* ... (your responsive styles for mobile) ... */
}
</style>

    @if (Auth::user()->role == 'admin')
    @include('includes.sidebar.dashboard')
        <main
            class="fixed top-[86px] w-full md:w-[calc(100%-256px)] md:ml-64 bg-gray-50 min-h-screen transition-all main">
            <!-- START DASHBOARD -->
            <div class="bg-slate-200 h-screen w-full overflow-y-auto rounded-2xl ml-2 pb-[100px]">
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
                                            Supervisor accounts
                                        </h6>
                                        <span class="text-xl hover:text-2xl font-semibold">{{ $countSupervisor }}</span>
                                        {{-- <span class="inline-block px-2 py-px ml-2 text-xs text-green-500 bg-green-100 rounded-md">
                            +4.14%
                            </span> --}}
                                    </div>
                                    <div>
                                        <span>
                                            <i
                                                class="ri-shield-user-fill ml-3 text-6xl text-blue-500"></i>
                                        </span>
                                    </div>
                                </div>
                            </a>
                            <!-- Users card -->
                            <a href="{{ asset('accounts') }}">
                                <div
                                    class="flex items-center justify-between p-4 bg-white hover:bg-blue-200 rounded-md dark:bg-darker">



                                    <div class="ml-1">

                                        <h6
                                            class="text-xs font-medium leading-none tracking-wider text-gray-500 uppercase dark:text-primary-light">
                                            Officer Accounts
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
                                <div
                                    class="flex items-center justify-between p-4 bg-white hover:bg-blue-200 rounded-md dark:bg-darker">
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
                                            <i class="ri-steering-2-line ml-3 text-6xl text-blue-500"></i>
                                        </span>
                                    </div>
                                </div>
                            </a>
                            <!-- Tickets card -->
                            <a href="{{ asset('vehicles') }}">
                                <div
                                    class="flex items-center justify-between p-4 bg-white hover:bg-blue-200 rounded-md dark:bg-darker">



                                    <div class="ml-1">

                                        <h6
                                            class="text-xs font-medium leading-none tracking-wider text-gray-500 uppercase dark:text-primary-light">
                                            Available Vehicle
                                        </h6>
                                        <span class="ml-4 text-xl font-semibold">{{ $countAvailable }}</span>
                                        {{-- <span class="inline-block px-2 py-px ml-2 text-xs text-green-500 bg-green-100 rounded-md">
                            +3.1%
                            </span> --}}
                                    </div>
                                    <div>
                                        <span>
                                            <i class="ri-checkbox-circle-line ml-3 text-6xl text-blue-500"></i>
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
                                    <h4 class="text-lg font-semibold text-gray-500 dark:text-light">Total Enabled Users</h4>
                                    <div class="flex items-center space-x-2">

                                    </div>
                                </div>

                                <!-- BarChart //relative p-4 h-72-->
                                <div class="p-2">
                                    <div class="w-[100%] h-[100%] flex justify-center items-center">
                                        <canvas id="myBarChart" class="w-[100%] h-[100%]"></canvas>
                                    </div>

                                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

                                    <script>
                                        const barchart = document.getElementById('myBarChart');

                                        new Chart(barchart, {
                                            type: 'bar',
                                            data: {
                                                labels: ['Administrators', 'Supervisors', 'Officers'],
                                                datasets: [{
                                                    label: 'Enabled Users',
                                                    data: [
                                                        {{ $enabledAdmin }},
                                                        {{ $enabledSupervisor }},
                                                        {{ $enabledAccount }},
                                                    ],
                                                    backgroundColor: [
                                                        'rgba(255, 99, 132, 0.2)',
                                                        'rgba(255, 159, 64, 0.2)',
                                                        'rgba(255, 205, 86, 0.2)',

                                                    ],
                                                    borderColor: [
                                                        'rgb(255, 99, 132)',
                                                        'rgb(255, 159, 64)',
                                                        'rgb(255, 205, 86)',

                                                    ],
                                                    borderWidth: 1
                                                }]
                                            },
                                            options: {
                                                scales: {
                                                    y: {
                                                        beginAtZero: true
                                                    }
                                                }
                                            }
                                        });
                                    </script>
                                </div>
                            </div>

                            <!-- Doughnut chart card -->
                            <div class="bg-white rounded-md dark:bg-darker" x-data="{ isOn: false }">
                                <!-- Card header -->
                                <div class="flex items-center justify-between p-4 border-b dark:border-primary">
                                    <h4 class="text-lg font-semibold text-gray-500 dark:text-light">Polar Area Chart
                                    </h4>
                                    <div class="flex items-center">

                                    </div>
                                </div>
                                {{-- Doughnut Chart --}}
                                <div>
                                    <canvas id="myChart" class="w-[70%] h-[20%]"></canvas>
                                </div>

                                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

                                <script>
                                    const ctx = document.getElementById('myChart');

                                    new Chart(ctx, {
                                        type: 'polarArea',
                                        data: {
                                            labels: ['Supervisors', 'Police', 'Vehicles'],
                                            datasets: [{
                                                label: 'Number of Users',
                                                data: [
                                                    {{ $countSupervisor }},
                                                    {{ $countAccount }},
                                                    {{ $countVehicle }}
                                                ],
                                                borderWidth: 1
                                            }]
                                        },
                                        options: {
                                            scales: {
                                                y: {
                                                    beginAtZero: true
                                                }
                                            }
                                        }
                                    });
                                </script>
                            </div>
                            {{-- Doughnut Chart --}}
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
                                            :class="{
                                                'translate-x-0  bg-white dark:bg-primary-100': !
                                                    isOn,
                                                'translate-x-6 bg-primary-light dark:bg-primary': isOn
                                            }">
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
        @include('includes.supv-sidebar.dashboard')

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
                            <div class="flex items-center justify-between p-4 bg-white rounded-md dark:bg-darker">
                                <div class="ml-4">
                                    <h6
                                        class="text-xs font-medium leading-none tracking-wider text-gray-500 uppercase dark:text-primary-light">
                                        Supervisors
                                    </h6>
                                    <span class="text-xl font-semibold">{{ $countSupervisor }}</span>
                                    {{-- <span class="inline-block px-2 py-px ml-2 text-xs text-green-500 bg-green-100 rounded-md">
                                +4.14%
                                </span> --}}
                                </div>
                                <div>
                                    <span>
                                        <i
                                            class="ri-shield-user-fill ml-3 text-6xl text-blue-500 hover:odd:text-black"></i>
                                    </span>
                                </div>
                            </div>

                            <!-- Users card -->
                            <a href="{{ asset('accounts') }}">
                                <div
                                    class="flex items-center justify-between p-4 bg-white hover:bg-blue-200 rounded-md dark:bg-darker">



                                    <div class="ml-1">

                                        <h6
                                            class="text-xs font-medium leading-none tracking-wider text-gray-500 uppercase dark:text-primary-light">
                                            Officer Accounts
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
                            <div class="flex items-center justify-between p-4 bg-white rounded-md dark:bg-darker">
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
                                        <i class="ri-steering-2-line ml-3 text-6xl text-blue-500"></i>
                                    </span>
                                </div>
                            </div>

                            <!-- Tickets card -->
                            <div class="flex items-center justify-between p-4 bg-white rounded-md dark:bg-darker">
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
                                        <i class="ri-checkbox-circle-line ml-3 text-6xl text-green-500"></i>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Charts -->
                        <div class="grid grid-cols-1 p-4 space-y-8 lg:gap-8 lg:space-y-0 lg:grid-cols-3">
                            <!-- Bar chart card -->
                            <div class="col-span-2 bg-white rounded-md dark:bg-darker" x-data="{ isOn: false }">
                                <!-- Card header -->
                                <div class="flex items-center justify-between p-4 border-b dark:border-primary">
                                    <h4 class="text-lg font-semibold text-gray-500 dark:text-light">Bar Chart</h4>

                                </div>

                                <div class="p-2">
                                    <div class="w-[100%] h-[100%] flex justify-center items-center">
                                        <canvas id="myBarChart" class="w-[100%] h-[100%]"></canvas>
                                    </div>

                                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

                                    <script>
                                        const barchart = document.getElementById('myBarChart');

                                        new Chart(barchart, {
                                            type: 'bar',
                                            data: {
                                                labels: ['Supervisors', 'Administrators', 'Officers'],
                                                datasets: [{
                                                    label: 'Admin',
                                                    data: [
                                                        {{ $countSupervisor }},
                                                        {{ $countAccount }},
                                                        {{ $countVehicle }}
                                                    ],
                                                    backgroundColor: [
                                                        'rgba(255, 99, 132, 0.2)',
                                                        'rgba(255, 159, 64, 0.2)',
                                                        'rgba(255, 205, 86, 0.2)',

                                                    ],
                                                    borderColor: [
                                                        'rgb(255, 99, 132)',
                                                        'rgb(255, 159, 64)',
                                                        'rgb(255, 205, 86)',

                                                    ],
                                                    borderWidth: 1
                                                }]
                                            },
                                            options: {
                                                scales: {
                                                    y: {
                                                        beginAtZero: true
                                                    }
                                                }
                                            }
                                        });
                                    </script>
                                </div>

                            </div>

                            <!-- Doughnut chart card -->
                            <div class="bg-white rounded-md dark:bg-darker" x-data="{ isOn: false }">
                                <!-- Card header -->
                                <div class="flex items-center justify-between p-4 border-b dark:border-primary">
                                    <h4 class="text-lg font-semibold text-gray-500 dark:text-light">Polar Area Chart
                                    </h4>
                                    <div class="flex items-center">

                                    </div>
                                </div>
                                {{-- Doughnut Chart --}}
                                <div>
                                    <canvas id="myChart" class="w-[70%] h-[20%]"></canvas>
                                </div>

                                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

                                <script>
                                    const ctx = document.getElementById('myChart');

                                    new Chart(ctx, {
                                        type: 'polarArea',
                                        data: {
                                            labels: ['Supervisors', 'Police', 'Vehicles'],
                                            datasets: [{
                                                label: 'Number of Users',
                                                data: [
                                                    {{ $countSupervisor }},
                                                    {{ $countAccount }},
                                                    {{ $countVehicle }}
                                                ],
                                                borderWidth: 1
                                            }]
                                        },
                                        options: {
                                            scales: {
                                                y: {
                                                    beginAtZero: true
                                                }
                                            }
                                        }
                                    });
                                </script>
                            </div>
                            {{-- Doughnut Chart --}}
                        </div </div>

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
                                                :class="{
                                                    'translate-x-0  bg-white dark:bg-primary-100': !
                                                        isOn,
                                                    'translate-x-6 bg-primary-light dark:bg-primary': isOn
                                                }">
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

    @if (Auth::user()->role == 'police')
    <div class="fixed left-1/2 transform -translate-x-1/2 top-[97px] md:top-[120px] w-full md:w-[100%] max-w-[280px] flex justify-center flex-col items-center">
        <div class="flex justify-between gap-2 w-full">
            <div class="flex flex-col items-center justify-center bg-blue-200 rounded-lg shadow-xl min-h-[80px] w-full p-4">
                <img src="{{ asset('images/telephone.png') }}" alt="Your Image" class="w-10 h-auto rounded-lg">
                <span>Call</span>
            </div>
            <div class="flex flex-col items-center justify-center bg-blue-200 rounded-lg shadow-xl min-h-[80px] w-full p-4">
            <button onclick="startScanner()" id="scanButton" type="button" class="flex flex-col items-center justify-center bg-blue-200 rounded-lg shadow-xl min-h-[80px]">
                <img src="{{ asset('images/qr (1).png') }}" alt="Your Image" class="w-10 h-auto rounded-lg">
                Scan
            </button>
            </div>
            <div class="flex flex-col items-center justify-center bg-blue-200 rounded-lg shadow-xl min-h-[80px] w-full p-4">
                <img src="{{ asset('images/comment.png') }}" alt="Your Image" class="w-10 h-auto rounded-lg">
                <span>Message</span>
            </div>
        </div>

        <div class="mt-4 relative w-full md:w-80">
            <div class="flex items-center justify-center">
                <input
                    type="text"
                    placeholder="Search..."
                    class="w-full px-5 py-2 border-gray-300 focus:outline-none focus:border-blue-500"
                >
                <button
                    type="button"
                    class="bg-blue-500 group-hover:bg-blue-300 px-2 py-2 hidden md:block"
                >
                    <i class="fas fa-search text-white"></i>
                </button>
            </div>
            <button
                type="button"
                class="bg-blue-500 group-hover:bg-blue-300 px-2 py-2 block md:hidden absolute top-[50%] right-0 transform translate-y-[-50%]"
            >
                <i class="fas fa-search text-white"></i>
            </button>
        </div>

        <div class="container" id="video-container" style="display: none;">
            <video id="video-preview" playsinline autoplay></video>
        </div>

        <div>
            <label>Plate Number: </label>
            <input type="text" name="plate" id="plate" readonly=""
                placeholder="Plate Number" class="form-control">
            </div>
            <div id="map"></div>
            


            <div id="details">
                {{-- style="display: none; --}}
                <h2>Location Details</h2>
                <p id="accuracy"></p>
                <p id="latitude"></p>
                <p id="longitude"></p>
                <p id="reqCount"></p>
                <hr>
            </div>
            
            <div id="error-message"></div>
            
            <script>
                var reqcount = 0;
                var watchID;  // Variable to store the watch position ID
                var employeeId = {{ auth()->user()->employee_id }};
            
                var options = {
                    enableHighAccuracy: true,
                    timeout: 10000,
                    maximumAge: 0
                    
                };
            
                navigator.geolocation.getCurrentPosition(initialPositionSuccess, errorCallback, options);
            
                function initialPositionSuccess(position) {
                    const { latitude, longitude } = position.coords;
                    document.getElementById('map').innerHTML = `<iframe width="100%" height="100%" src="https://maps.google.com/maps?q=${latitude},${longitude}&amp;z=15&amp;output=embed&iwloc=near"></iframe>`;
            
                    watchID = navigator.geolocation.watchPosition(successCallback, errorCallback, options);
                }
            
                function successCallback(position) {
                    const { accuracy, latitude, longitude } = position.coords;
            
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
                    document.getElementById('error-message').innerText = 'Error getting geolocation. Please enable location services and try again.';
            
                    // Optionally, stop watching for geolocation updates on specific errors
                    if (error.code === 1 || error.code === 3) {  // Permission denied or timeout
                        navigator.geolocation.clearWatch(watchID);
                    }
                }
            
                function updateMap(latitude, longitude) {
                    // Update the map URL with the new coordinates
                    const mapElement = document.getElementById('map');
                    mapElement.innerHTML = `<iframe width="100%" height="100%" src="https://maps.google.com/maps?q=${latitude},${longitude}&amp;z=15&amp;output=embed&iwloc=near"></iframe>`;
                }
            
              
                function saveGeolocation(coords) {
    const { latitude, longitude, accuracy } = coords;

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
        success: function (response) {
            console.log(response.message);
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}

                
           
            </script>
        </div>
          
    
    <!----Resize mobile----->
    <nav id="mobileMenu" class="block fixed bottom-5 w-full">
        <div class="flex flex-col">
            <!-- First layer of icons -->
            <div class="flex justify-center items-center py-3 gap-5 md:gap-10">
                <!-- Icon 1 -->
                <div class="bg-blue-400 bg-opacity-50 rounded p-3">
                    <div class="text-blue-200 flex flex-col items-center p-2">
                        <div class="rounded bg-white bg-opacity-50 backdrop-blur-md m-2 w-6 h-6 flex items-center justify-center">
                            <i class="fas fa-inbox text-blue-600"></i>
                        </div>
                        <span style="font-size: 0.75rem; margin-top: -0.4rem;" class="text-black font-bold">Inbox</span>
                    </div>
                </div>
                <!-- Icon 2 -->
		<a href="{{ asset('maps') }}">
                <div class="bg-blue-400 bg-opacity-50 rounded p-3">
                    <div class="text-blue-200 flex flex-col items-center p-2">
                        <div class="rounded bg-white bg-opacity-50 backdrop-blur-md m-2 w-6 h-6 flex items-center justify-center">
                            <i class="fas fa-map-marker-alt text-blue-600"></i>
                        </div>
                        <span style="font-size: 0.75rem; margin-top: -0.4rem;" class="text-black font-bold">Maps</span>
                    </div>
                </div>
		</a>
		<a href="{{ asset('chatify') }}">
                <div class="bg-blue-400 bg-opacity-50 rounded p-3">
                    <div class="text-blue-200 flex flex-col items-center p-2">
                        <div class="rounded bg-white bg-opacity-50 backdrop-blur-md m-2 w-6 h-6 flex items-center justify-center">
                            <i class="fas fa-comments text-blue-600"></i>
                        </div>
                        <span style="font-size: 0.75rem; margin-top: -0.4rem;" class="text-black font-bold">Chats</span>
                    </div>
                </div>
		</a>
                <div class="bg-blue-400 bg-opacity-50 rounded p-3">
                    <div class="text-blue-200 flex flex-col items-center p-2">
                        <div class="rounded bg-white bg-opacity-50 backdrop-blur-md m-2 w-6 h-6 flex items-center justify-center">
                            <i class="fas fa-cog text-blue-600"></i>
                        </div>
                        <span style="font-size: 0.75rem; margin-top: -0.4rem;" class="text-black font-bold">Settings</span>
                    </div>

                <!-- Add other icons and text similarly -->
            </div>
        </div>
    </nav>

    </div>
@endif
</x-app-layout>


