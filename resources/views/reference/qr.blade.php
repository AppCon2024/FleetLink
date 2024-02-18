<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FleetLink</title>
    <style>
        body {
            margin: 0;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .container {
            display: none;
            flex: 1;
        }

        #video-container {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 10px;
        }

        #video-preview {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 20px;
            border: 10px solid #3498db;
        }

        @media (max-width: 768px) {
            #video-container {
                margin: 5px;
            }
        }
    </style>
</head>

<body>
    <div class="container" id="video-container">
        <video id="video-preview" playsinline autoplay></video>
    </div>

    <script src="https://rawgit.com/zxing-js/library/master/docs/examples/multi-camera/src/zxing.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            openDefaultCamera();
        });

        async function openDefaultCamera() {
            try {
                const stream = await navigator.mediaDevices.getUserMedia({ video: true });

                const videoContainer = document.querySelector('.container');
                videoContainer.style.display = 'flex';

                const videoElement = document.getElementById('video-preview');
                videoElement.srcObject = stream;

                const codeReader = new ZXing.BrowserQRCodeReader();
                codeReader.decodeFromVideoDevice(undefined, 'video-preview', (result, err) => {
                    if (result) {
                        alert('QR Code Scanned: ' + result.text);
                        // Do something with the scanned result

                        const tracks = stream.getTracks();
                        tracks.forEach(track => track.stop());

                        videoContainer.style.display = 'none';
                    }
                    if (err && !(err instanceof ZXing.NotFoundException)) {
                        console.error(err);
                    }
                });
            } catch (error) {
                console.error('Error opening camera:', error);
            }
        }
    </script>
</body>

</html>
