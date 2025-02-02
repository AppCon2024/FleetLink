<x-app-layout>
    <x-message />

    @if (Auth::user()->role == 'admin')
        @include('includes.sidebar.dashboard')
        <main
            class="fixed top-[86px] w-full md:w-[calc(100%-256px)] md:ml-64 bg-gray-50 min-h-screen transition-all main">
            <!-- START DASHBOARD -->
            <div class="bg-slate-200 h-screen w-full overflow-y-auto rounded-2xl ml-2 pb-[100px]">
                <main>
                    <!-- Cards -->
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
                                            <i class="ri-shield-user-fill ml-3 text-6xl text-blue-500"></i>
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
                                    <h4 class="text-lg font-semibold text-gray-500 dark:text-light">Total Number of
                                        Users per Station
                                    </h4>
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
                                                labels: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', ],
                                                datasets: [{
                                                    label: 'Users',
                                                    data: [
                                                        {{ $station1 }},
                                                        {{ $station2 }},
                                                        {{ $station3 }},
                                                        {{ $station4 }},
                                                        {{ $station5 }},
                                                        {{ $station6 }},
                                                        {{ $station7 }},
                                                        {{ $station8 }},
                                                        {{ $station9 }},
                                                        {{ $station10 }},
                                                        {{ $station11 }},
                                                        {{ $station12 }},

                                                    ],
                                                    backgroundColor: [
                                                        'rgb(239,232,231)',
                                                        'rgb(187,231,254)',
                                                        'rgb(211,181,229)',
                                                        'rgb(255,212,219)',
                                                        'rgb(239,241,219)',
                                                        'rgb(243,223,193)',
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
                                    <h4 class="text-lg font-semibold text-gray-500 dark:text-light">Accounts Status
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
                                            labels: ['Enabled', 'Disabled', 'Deleted'],
                                            datasets: [{
                                                label: 'Users',
                                                data: [
                                                    {{ $enabled }},
                                                    {{ $disabled }},
                                                    {{ $deleted }}
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

                        <!-- Doughnut chart card -->
                        <div class="bg-white rounded-md dark:bg-darker" x-data="{ isOn: false }">
                            <!-- Card header -->
                            <div class="flex items-center justify-between p-4 border-b dark:border-primary">
                                <h4 class="text-lg font-semibold text-gray-500 dark:text-light">Vehicle Status
                                </h4>
                                <div class="flex items-center">

                                </div>
                            </div>
                            {{-- Doughnut Chart --}}
                            <div>
                                <canvas id="myVehicles" class="w-[70%] h-[20%]"></canvas>
                            </div>

                            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

                            <script>
                                const vhcl = document.getElementById('myVehicles');

                                new Chart(vhcl, {
                                    type: 'polarArea',
                                    data: {
                                        labels: ['Available', 'Unavailable', 'Deleted'],
                                        datasets: [{
                                            label: 'Vehicle/s',
                                            data: [
                                                {{ $enabledV }},
                                                {{ $disabledV }},
                                                {{ $deletedV }}
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
                        <!-- Bar chart card -->
                        <div class="col-span-2 bg-white rounded-md dark:bg-darker" x-data="{ isOn: false }">
                            <!-- Card header -->
                            <div class="flex items-center justify-between p-4 border-b dark:border-primary">
                                <h4 class="text-lg font-semibold text-gray-500 dark:text-light">Total Number of Vehicles
                                    per Station
                                </h4>
                                <div class="flex items-center space-x-2">

                                </div>
                            </div>

                            <!-- BarChart //relative p-4 h-72-->
                            <div class="p-2">
                                <div class="w-[100%] h-[100%] flex justify-center items-center">
                                    <canvas id="vehicle" class="w-[100%] h-[100%]"></canvas>
                                </div>

                                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

                                <script>
                                    const vehicleChart = document.getElementById('vehicle');

                                    new Chart(vehicleChart, {
                                        type: 'bar',
                                        data: {
                                            labels: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'],
                                            datasets: [{
                                                label: 'Vehicle/s',
                                                data: [
                                                    {{ $vehicle1 }},
                                                    {{ $vehicle2 }},
                                                    {{ $vehicle3 }},
                                                    {{ $vehicle4 }},
                                                    {{ $vehicle5 }},
                                                    {{ $vehicle6 }},
                                                    {{ $vehicle7 }},
                                                    {{ $vehicle8 }},
                                                    {{ $vehicle9 }},
                                                    {{ $vehicle10 }},
                                                    {{ $vehicle11 }},
                                                    {{ $vehicle12 }}
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
        @include('layouts.navigation')
        <div class="pt-2">
            <div class="w-11/12 mx-auto">
                <div class="p-4 bg-gradient-to-r from-blue-400 to-blue-300 overflow-hidden shadow-sm rounded-t-xl">
                    <div class=" flex items-center justify-between font-bold text-white">
                        <label for="user"> Hello, {{ Auth::user()->name }} </label>
                        <img src="{{ Auth::user()->image }}" alt="" class="rounded-full w-10">
                    </div>
                </div>
            </div>
        </div>
        <div id="map" class="h-[350px] w-11/12 mx-auto border border-blue-400" style="display:none;"></div>
        <video id="preview" width="100%" class="p-1 w-11/12 mx-auto" style="display:none;">
        </video>

        <div id="yes" class="w-11/12 mx-auto bg-cyan-100 p-1 flex flex-col justify-center items-center"
            style="display:none;">
            <form action="{{ route('vehicles.borrow') }}" method="post" enctype="multipart/form-data">
                @csrf
                <label class="ml-5">Plate Number: </label>
                <input type="text" name="plate" id="plate" readonly=""
                    class="text-black p-0 border border-transparent">

                <div class="hidden">
                    <div class="grid gap-4 mb-4 sm:grid-cols-2">
                        <div>
                            <label>Model: </label>
                            <input type="text" name="model" id="model" readonly="" placeholder="Model"
                                class="text-black">
                        </div>
                        <div>
                            <label>Brand: </label>
                            <input type="text" name="brand" id="brand" readonly="" placeholder="Brand"
                                class="text-black">
                        </div>
                        <div>
                            <label>VIN: </label>
                            <input type="text" name="vin" id="vin" readonly="" placeholder="vin"
                                class="text-black">
                        </div>
                    </div>
                </div>

                <button type="submit"
                    class="w-full text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Submit
                </button>
            </form>
        </div>

        <div class="rounded-b-xl w-11/12 mx-auto flex items-center justify-center bg-white">
            <div class="p-4 w-full overflow-hidden shadow-sm rounded-xl">
                <div class=" flex items-center justify-between font-bold text-white">
                    <a href="{{ route('chatify') }}">
                        <div
                            class="flex flex-col items-center justify-center px-4 p-1  hover:bg-blue-600 bg-blue-200 rounded-lg">
                            <i class="ri-chat-3-line text-blue-800 text-6xl"></i>
                            <span class="text-blue-800">Msg</span>
                        </div>
                    </a>
                    <button onclick="toggleScanner()">
                        <div
                            class="flex flex-col items-center justify-center px-4 p-1 hover:bg-blue-600 bg-blue-200 rounded-lg">
                            <i class="ri-qr-scan-2-line text-blue-800 text-6xl"></i>
                            <span class="text-blue-800">Scan</span>
                        </div>
                    </button>

                    <button id="show-map">
                        <div
                            class="flex flex-col items-center justify-center px-4 p-1 hover:bg-blue-600 bg-blue-200 rounded-lg">
                            <i class="ri-map-2-line text-blue-800 text-6xl"></i>
                            <span class="text-blue-800">Map</span>
                        </div>
                    </button>
                </div>
            </div>
        </div>

        <div class="pt-5">
            <div class="w-11/12 mx-auto">
                <div class="p-4 bg-gradient-to-r from-blue-400 to-blue-300 overflow-hidden shadow-sm rounded-t-xl">
                    <div class=" flex items-center justify-between font-bold text-white">
                        Available Vehicle/s
                    </div>
                </div>
            </div>
        </div>

        @forelse ($available as $ok)
            <div class="">
                <div class="w-11/12 mx-auto">
                    <div class="p-4 bg-white rounded overflow-hidden shadow-sm">
                        <div class=" flex items-center justify-between font-bold text-gray-900">
                            {{ $ok->plate }} | {{ $ok->brand }} | {{ $ok->model }}
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="">
                <div class="w-11/12 mx-auto">
                    <div class="p-4 bg-white border border-black overflow-hidden shadow-sm">
                        <div class=" flex items-center justify-between font-bold text-black">
                            No Available Vehicles.
                        </div>
                    </div>
                </div>
            </div>
        @endforelse

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

            var videoContainer = document.getElementById('preview');
            var showMapBtn = document.getElementById('show-map');
            showMapBtn.addEventListener('click', function() {
                var mapContainer = document.getElementById('map');
                if (mapContainer.style.display === 'none') {
                    videoContainer.style.display = 'none';
                    mapContainer.style.display = 'block';
                    map
                        .invalidateSize(); // This is important to ensure the map tiles load correctly after being initially hidden
                } else {
                    mapContainer.style.display = 'none';
                }
            });


            var map = L.map('map').setView([14.669307819471186, 120.99638656890184], 15);
            var userId = {{ Auth::User()->id }};

            // var startTrackingBtn = document.getElementById('track');
            //     startTrackingBtn.addEventListener('click', function() {
            //         navigator.geolocation.watchPosition(success, error);
            //     });

            navigator.geolocation.watchPosition(success, error);

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
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);

            let marker, circle, zoomed;

            function success(pos) {
                const lat = pos.coords.latitude;
                const lng = pos.coords.longitude;
                const accuracy = pos.coords.accuracy;

                $.ajax({
                    type: 'POST',
                    url: '/tracking',
                    data: {
                        lat: lat,
                        lng: lng,
                        accuracy: accuracy,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        console.log('Tracking data saved successfully');
                    },
                    error: function(xhr, status, error) {
                        console.error('Error saving tracking data: ' + error.message);
                    }
                });

                if (marker) {
                    map.removeLayer(marker);
                    map.removeLayer(circle);
                }

                marker = L.marker([lat, lng], {
                    icon: officerIcon
                }).addTo(map);
                circle = L.circle([lat, lng], {
                    radius: accuracy
                }).addTo(map);

                if (!zoomed) {
                    zoomed = map.fitBounds(circle.getBounds());
                }

                map.setView([lat, lng], 17);

                marker.bindPopup("This is you.").addTo(map);

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

        <script>
            let scanner;
            let isScannerRunning = false;

            var videoContainer = document.getElementById('preview');
            var mapContainer = document.getElementById('map');
            var btn = document.getElementById('yes');

            function toggleScanner() {
                if (isScannerRunning) {
                    videoContainer.style.display = 'none';
                    btn.style.display = 'none';
                    stopScanner();
                    isScannerRunning = false;
                } else {
                    videoContainer.style.display = 'block';
                    btn.style.display = 'block';
                    mapContainer.style.display = 'none';
                    startScanner();
                    isScannerRunning = true;
                }
            }

            function startScanner() {
                scanner = new Instascan.Scanner({
                    video: document.getElementById('preview')
                });

                Instascan.Camera.getCameras().then(function(cameras) {
                    if (cameras.length > 0) {
                        scanner.start(cameras[1]);
                        document.getElementById('preview').style.display = 'block'; // Show the video
                    } else {
                        alert('No cameras found');
                    }
                }).catch(function(e) {
                    console.error(e);
                });

                scanner.addListener('scan', function(c) {
                    let qrData = c.split(' ');

                    document.getElementById('plate').value = qrData[0] || '';
                    document.getElementById('model').value = qrData[1] || '';
                    document.getElementById('brand').value = qrData[2] || '';
                    document.getElementById('vin').value = qrData[3] || '';

                    updateStatus(qrData[0]);
                });
            }

            function stopScanner() {
                if (scanner) {
                    scanner.stop();
                }
            }
        </script>


        {{-- <div>
            <livewire:db-ofcr />
        <div id="map" class="pt-40"></div>

        <div id="details">

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
        </script>
        </div> --}}
    @endif
</x-app-layout>
