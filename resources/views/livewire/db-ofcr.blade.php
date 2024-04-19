<div>
    <div class="pt-2">
        <div class="w-11/12 mx-auto">
            <div class="p-4 bg-gradient-to-r from-blue-400 to-blue-300 overflow-hidden shadow-sm rounded-t-xl">
                <div class=" flex items-center justify-between font-bold text-white">
                    <label for="name"> Hello, {{ Auth::user()->name }} </label>
                    <img src="{{ Auth::user()->image }}" alt="" class="rounded-full w-10">
                </div>
            </div>
        </div>
    </div>
    @if (session('camera'))
        <div class="flex justify-center text-green-500 text-xl">
            {{ session('message') }}
        </div>
        <div class="w-11/12 mx-auto">
            <div class="p-1 bg-cyan-100 overflow-hidden shadow-sm flex flex-col items-center justify-center">
                {{-- <button class="bg-gray-300 p-2" onclick="stopScanner()">x</button> --}}
                <video id="preview" width="100%" class="p-1" style="border-radius: 25px;">
                </video>
            </div>

            <div class="col-md-6 bg-cyan-100 p-1 flex flex-col justify-center">
                <form action="{{ route('vehicles.borrow') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <label>Plate Number: </label>
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
                            <div>
                                <input type="hidden" name="last_name" id="last_name" readonly="" class="text-black"
                                    value="{{ Auth::user()->last_name }}">
                            </div>
                            <div>
                                <input type="hidden" name="first_name" id="first_name" readonly=""
                                    class="text-black" value="{{ Auth::user()->first_name }}">
                            </div>
                            <div>
                                <input type="hidden" name="employee_id" id="employee_id" readonly=""
                                    value="{{ Auth::user()->employee_id }}" class="text-black">
                            </div>
                            <div>
                                <input type="hidden" name="position" id="position" readonly=""
                                    value="{{ Auth::user()->position }}" class="text-black">
                            </div>
                            <div>
                                <input type="hidden" name="department" id="department" readonly=""
                                    value="{{ Auth::user()->department }}" class="text-black">
                            </div>
                        </div>
                    </div>

                    <button type="submit"
                        class="w-full text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        Submit
                    </button>
                </form>
            </div>
        </div>
    @endif
    @if (session('map'))
        <div class="w-11/12 mx-auto">
            {{-- <div class="flex justify-center text-green-500 text-xl">
                {{ session('map') }}
            </div> --}}
            <div class="p-1 bg-cyan-100 overflow-hidden shadow-sm flex flex-col items-center justify-center">
                <div id="map" class="p-1"></div>

                {{-- <div id="details">
                    <h2>Location Details</h2>
                    <p id="accuracy"></p>
                    <p id="latitude"></p>
                    <p id="longitude"></p>
                    <p id="reqCount"></p>
                    <hr>
                </div> --}}
            </div>
        </div>
    @endif

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
                <button wire:click="show" onclick="startScanner()">
                    <div
                        class="flex flex-col items-center justify-center px-4 p-1 hover:bg-blue-600 bg-blue-200 rounded-lg">
                        <i class="ri-qr-scan-2-line text-blue-800 text-6xl"></i>
                        <span class="text-blue-800">Scan</span>
                    </div>
                </button>
                <div wire:click="showMap"
                    class="flex flex-col items-center justify-center px-4 p-1 hover:bg-blue-600 bg-blue-200 rounded-lg">
                    <i class="ri-map-2-line text-blue-800 text-6xl"></i>
                    <span class="text-blue-800">Map</span>
                </div>
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

    <!--Camera-->
    <script>
        let scanner;

        function startScanner() {
            scanner = new Instascan.Scanner({
                video: document.getElementById('preview')
            });

            Instascan.Camera.getCameras().then(function(cameras) {
                if (cameras.length > 0) {
                    scanner.start(cameras[1]);
                } else {
                    alert('No cameras found');
                }
            }).catch(function(e) {
                console.error(e);
            });

            scanner.addListener('scan', function(c) {
                let qrData = c.split(' ');

                // Set the plate information to the "try" input field
                document.getElementById('plate').value = qrData[0] || '';

                // Set the model information to the "model" input field
                document.getElementById('model').value = qrData[1] || '';

                document.getElementById('brand').value = qrData[2] || '';

                document.getElementById('vin').value = qrData[3] || '';

                updateStatus(qrData[0]);

                let plateDiv = document.createElement('div');
                plateDiv.textContent = 'Plate Number: ' + qrData[0];
                plateDiv.style.backgroundColor = 'lightblue';
                plateDiv.style.padding = '10px';

                // Check if the div already exists, if so, remove it before adding a new one
                let existingPlateDiv = document.getElementById('plateDiv');
                if (existingPlateDiv) {
                    existingPlateDiv.remove();
                }

                plateDiv.id = 'plateDiv';
                document.body.appendChild(plateDiv);

            });
        }

        function stopScanner() {
            if (scanner) {
                scanner.stop();
                document.getElementById('try').value = '';
                document.getElementById('model').value = '';
            }
        }
    </script>

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
                url: '/user-data/update',
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

</div>
