<div>
    <div class="pt-24">
        <div class="w-11/12 mx-auto">
            <div class="p-4 bg-gradient-to-r from-blue-400 to-blue-300 overflow-hidden shadow-sm rounded-t-xl">
                <div class=" flex items-center justify-between font-bold text-white">
                    <label for="name"> Hello, {{ Auth::user()->name }} </label>
                    <img src="{{ Auth::user()->image }}" alt="" class="rounded-full w-10">
                </div>
            </div>
        </div>
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
                <button onclick="startScanner()">
                    <div
                        class="flex flex-col items-center justify-center px-4 p-1 hover:bg-blue-600 bg-blue-200 rounded-lg">
                        <i class="ri-qr-scan-2-line text-blue-800 text-6xl"></i>
                        <span class="text-blue-800">Scan</span>
                    </div>
                </button>
                <div
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
                    {{$ok->plate}} | {{$ok->brand}} | {{$ok->model}}
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="">
        <div class="w-11/12 mx-auto">
            <div class="p-4 bg-gradient-to-r from-blue-400 to-blue-300 overflow-hidden shadow-sm rounded-t-xl">
                <div class=" flex items-center justify-between font-bold text-white">
                   No Available Vehicles.
                </div>
            </div>
        </div>
    </div>
    @endforelse


    {{-- <div class="pt-5 w-11/12 mx-auto">
        <div class="p-4 bg-red-300 overflow-hidden shadow-sm rounded-xl">
            <span class="text-blue-800 flex justify-center">Camera and Map will show here.</span>

            <video id="preview" width="100%" class="p-2 rounded-md" style="border-radius: 25px;"></video>
        </div>

        <div class="col-md-6">
            <button onclick="startScanner()">Open Camera</button>
            <button onclick="stopScanner()">Close Camera</button><br>

            <form action="{{ route('vehicles.borrow') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div>
                    <div class="grid gap-4 mb-4 sm:grid-cols-2">

                        <div>
                            <label>Plate Number: </label>
                            <input type="text" name="plate" id="plate" readonly=""
                                placeholder="Plate Number" class="text-black">
                        </div>

                        <div>
                            <label>Model: </label>
                            <input type="text" name="model" id="model" readonly=""
                                placeholder="Model" class="text-black">
                        </div>
                        <div>
                            <label>Brand: </label>
                            <input type="text" name="brand" id="brand" readonly=""
                                placeholder="Brand" class="text-black">
                        </div>
                        <div>
                            <label>VIN: </label>
                            <input type="text" name="vin" id="vin" readonly=""
                                placeholder="vin" class="text-black">
                        </div>
                        <div>
                            <input type="hidden" name="last_name" id="last_name" readonly=""
                                class="text-black" value="{{ Auth::user()->last_name }}">
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
                    Use
                </button>
            </form>
        </div>


        <div id="sidebar">
            <div id="details"></div>
        </div>
        <div id="map"></div>
        <button onclick="stopMap()">Close Camera</button><br>



    </div> --}}

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
{{--
    <script>
        navigator.geolocation.getCurrentPosition(position => {
            const {
                latitude,
                longitude
            } = position.coords;
            // Show a map centered at latitude / longitude.
            document.getElementById('map').innerHTML =
                '<iframe width="100%" height="100%" src="https://maps.google.com/maps?q=' + latitude + ',' +
                longitude + '&amp;z=15&amp;output=embed"></iframe>';
        });

        var reqcount = 0;

        navigator.geolocation.watchPosition(successCallback, errorCallback, options);

        function successCallback(position) {
            const {
                accuracy,
                latitude,
                longitude,
                altitude,
                heading,
                speed
            } = position.coords;

            reqcount++;
            details.innerHTML = "Accuracy: <br>" + accuracy + "<br>";
            details.innerHTML += "Latitude: <br>" + latitude + "<br>Longitude: " + longitude + "<br>";
            details.innerHTML += "Altitude: <br>" + altitude + "<br>";
            details.innerHTML += "Heading: <br>" + heading + "<br>";
            details.innerHTML += "Speed: <br>" + speed + "<br>";
            details.innerHTML += "reqcount: <br>" + reqcount;
        }


        function errorCallback(error) {

        }

        var options = {
            enableHighAccuracy: false,
            timeout: 1000,
            maximumAge: 0
        }

        function stopMap() {
            // Cancel the updates when the user clicks a button.
            navigator.geolocation.clearWatch(watchId);
        }
    </script> --}}
</div>
