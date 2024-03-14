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
            <div class="p-4 bg-white border border-black overflow-hidden shadow-sm">
                <div class=" flex items-center justify-between font-bold text-black">
                   No Available Vehicles.
                </div>
            </div>
        </div>
    </div>
    @endforelse

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
</div>
