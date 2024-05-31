
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> --}}
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>QR code ID</title>

    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    {{-- html head links --}}
    <script src="{{ asset('storage/assets/js/qrcode.js') }}"></script>
    <script src="{{ asset('storage/assets/js/html2canvas.min.js') }}"></script>

    @vite(['resources/js/app.js', 'resources/css/app.css'])

    <!-- Vendor CSS Files -->
    <link href="{{ asset('storage/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">

    {{-- custom styles --}}
    <style>
        .bg {
            background-image: linear-gradient(180deg,  #37598fc9 55%, #d8c4b6c7),
                url("{{ asset('storage/assets/img/aclc_building_1.png') }}");
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
    </style>
</head>

<body>
    <main class="d-flex justify-content-center p-3">
        {{-- qr code card --}}
        <div>
            <button type="button" class="btn btn-primary btn-lg w-100 mb-4" onclick="downloadBarcodeImg()">Download ID</button>

            <div id="id_card" class="p-3">
                <div class="bg text-light rounded-5 p-4 pt-5 text-center" style="width: 638px; height: 1012px">
                    <div class="row g-3 justify-content-center">
                        <div class="col-auto">
                            <div class="bg-light rounded-circle" style="width: 30px; height: 30px">
                            </div>
                        </div>
                        <div class="col-12 mt-4">
                            <h1 class="m-0">YOUR QR CODE</h1>
                        </div>
                        <div class="col-12 m-0">
                            <h3>Voter's ID: {{ $voter->voter_id }}</h3>
                        </div>
                        <div class="col-auto">
                            {{-- qr code --}}
                            <div id="qrcode" class="p-4 bg-light rounded-4"></div>
                        </div>
                        <div class="col-12 text-center mt-4">
                            {{-- name --}}
                            <h1 class=" display-3 text-wrap m-0">{{ $voter->first_name }} {{ $voter->mid_name }}
                                {{ $voter->last_name }}
                            </h1>
    
                        </div>
                        <div class="col-12 m-0">
                            <hr class="mb-1" style="border: 3px solid white;">
                        </div>
                        <div class="col-12">
                            <h1>
                                USN or LRN: {{ $voter->usn_or_lrn }}
                            </h1>
                        </div>
                        <div class="col-6">
                            <h2>{{ $voter->strand_or_course }} {{ $voter->section }}</h2>
                        </div>
                        <div class="col-6">
                            <h2>{{ $voter->school_level }} {{ $voter->year }}</h2>
                        </div>

                        <div class="col-12 m-0">
                            <hr style="border: 2px solid white;">
                        </div>
                        <div class="col-12">
                            <p>Develop by <a href="https://www.tiktok.com/@thedirtiestrat" class=" text-decoration-none text-light">Mr. Dirtiest Rat (LEAL)</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Vendor JS Files -->
    <script src="{{ asset('storage/assets/vendor/tinymce/tinymce.min.js') }}"></script>
    {{-- qr code script --}}
    <script type="text/javascript">
        var qrcode = new QRCode(document.getElementById("qrcode"), {
            width: 330,
            height: 330
        });

        function makeCode() {
            // var elText = {{ $voter->voter_id }};

            // if (!elText.value) {
            //     alert("Input a text");
            //     elText.focus();
            //     return;
            // }
            qrcode.makeCode('{{ $voter->voter_id }}');
            // qrcode.makeCode(elText.value);
        }

        makeCode();
    </script>
    {{-- download id script --}}
    <script>
        function downloadBarcodeImg() {

            html2canvas(document.getElementById("id_card")).then(canvas => {
                // document.body.appendChild(canvas);
                var img = canvas.toDataURL();
                downloadURI(img, '{{ $voter->voter_id }}' + ".png");

            });
        }

        function downloadURI(uri, name) {
            var link = document.createElement("a");

            link.download = name;
            link.href = uri;
            document.body.appendChild(link);
            link.click();
            link.remove();
            // document.getElementById("box").innerHTML = ""
        }
    </script>
</body>

</html>
