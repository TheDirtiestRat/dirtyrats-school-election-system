@extends('layouts.app')

@section('head-links')
    <!-- <link href="{{ asset('storage/assets/vendor/simple-datatables/style.css') }}" rel="stylesheet"> -->
    <script src="{{ asset('storage/assets/vendor/html5-qrcode/html5-qrcode.min.js') }}"></script>
@endsection

@section('body-content')
    <div class="container-fluid p-2">
        {{-- content body --}}
        <!-- the scanner -->
        <div class="d-flex justify-content-center">
            <div id="reader" class="text-center rounded-3 mb-3 shadow w-100" style="max-width: 350px">
                <div class="spinner-border" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>
        <!-- beep scanner audio -->
        <audio id="audioBeepsound">
            <source src="{{ asset('storage/assets/audio/Barcode-scanner-beep-sound.mp3') }}" type="audio/mp3">
        </audio>

        <div class="d-flex justify-content-center">
            <div class="row g-3  w-100" style="max-width: 350px">
                <div class="col-12">
                    <div class="form-floating shadow w-100">
                        <input type="text" class="form-control w-100" id="voter_id" placeholder="Voters Id"
                            name="voter_id" required>
                        <label for="voter_id">Voters Id</label>
                    </div>
                </div>
                <div class="col-12">
                    <button type="button" class="btn btn-primary w-100" id="liveToastBtn">Submit
                        Id</button>
                </div>
            </div>
        </div>

        {{-- <button type="button" class="btn btn-primary mt-2" id="liveToastBtn">Show live toast</button> --}}
    </div>

    {{-- toast --}}
    <div class="toast-container position-fixed bottom-0 end-0 p-3" id="toast_area">
        {{-- <div id="liveToast" class="toast align-items-center text-bg-primary border-0" role="alert"
            aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body" id="toast_body">
                    Hello, world! This is a toast message.
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div> --}}
    </div>

    <!-- barcode scanner script -->
    <script>
        // voter id input
        const voter_id_input = document.getElementById("voter_id");
        // gets the reader element
        const html5QrCode = new Html5Qrcode( /* element id */ "reader");
        // get the audio beepsound
        const audioBeepSound = document.getElementById('audioBeepsound');

        // variable
        // var barcode = "";
        var cameraId;
        var scanStop = false;
        let canScan = true;

        // start the scanner on load

        window.onload = loadscanner();

        function loadscanner() {
            // This method will trigger user permissions
            Html5Qrcode.getCameras().then(devices => {
                /**
                 * devices would be an array of objects of type:
                 * { id: "id", label: "label" }
                 */
                if (devices && devices.length) {
                    cameraId = devices[0].id;
                    startScanning();
                }
            }).catch(err => {
                // handle err
                document.getElementById("reader").innerHTML =
                    "Can't get device camera. Please make sure the device has a camera connected."
            });
        }

        function startScanning() {
            // reset the stop scanning
            scanStop = false
            // .. use this to start scanning.
            html5QrCode.start(
                    cameraId, {
                        fps: 24, // Optional, frame per seconds for qr code scanning
                        qrbox: {
                            width: 250,
                            height: 250
                        }, // Optional, if you want bounded box UI
                        aspectRatio: 1.0,
                        formatsToSupport: [Html5QrcodeSupportedFormats.QR_CODE]
                    },
                    (decodedText, decodedResult) => {
                        // do something when code is read
                        // barcode = decodedText

                        // scannedOutput.innerHTML = decodedText;

                        if (canScan == true) {
                            // console.log("is scanned")
                            voter_id_input.value = decodedText;
                            audioBeepSound.play();
                            setTimeout(can_scan_again, 4000);
                            document.getElementById('liveToastBtn').click();
                            canScan = false;
                        }

                        // stopScanning();
                    },
                    (errorMessage) => {
                        // parse error, ignore it.
                    })
                .catch((err) => {
                    // Start failed, handle it.
                    document.getElementById("reader").innerHTML = "Unable to start scanner"
                });
        }

        function stopScanning() {
            if (scanStop != true) {
                html5QrCode.stop().then((ignore) => {
                    // QR Code scanning is stopped.
                    scanStop = true;
                    console.log("called " + scanStop)
                }).catch((err) => {
                    // Stop failed, handle it.
                });
            }

        }

        function can_scan_again() {
            canScan = true;
        }

        function playbeepsound() {
            audioBeepSound.play();
        }
    </script>

    {{-- search ajax script --}}
    <script type="module">
        // call from start

        $('#liveToastBtn').click(function() {
            var $value = $('#voter_id').val();
            document.getElementById("voter_id").value = '';
            // console.log($value)
            scan_voter($value);
        });

        // $('#voter_id').on('keyup', function() {
        //     var $value = $(this).val();
        //     // console.log($value)
        //     scan_voter($value);
        // });

        // ajax search function
        function scan_voter(key) {
            var $_id = key
            // console.log($_id)
            $.ajax({
                url: "{{ url('scannedVoter') }}",
                type: "GET",
                data: {
                    'voter_id': $_id,
                    'scanner': '{{ Auth::user()->name }}'
                },
                success: function(data) {
                    $('#toast_area').html(data);

                    const toastLiveExample = document.getElementById('liveToast')
                    const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)
                    toastBootstrap.show();
                }
            })
        }
    </script>
@endsection

@section('body-links')
    <!-- <script src="{{ asset('storage/assets/vendor/simple-datatables/simple-datatables.js') }}"></script> -->
@endsection
