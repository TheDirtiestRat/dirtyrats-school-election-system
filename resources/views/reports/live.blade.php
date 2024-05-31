<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Live</title>

    <meta content="" name="description">
    <meta content="" name="keywords">

    @vite(['resources/js/app.js', 'resources/css/app.css'])

    <link href="{{ asset('storage/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">

    <style>
        body {
            margin: 0px;
            height: 100vh;
        }

        .img-player {
            /* width: 100%; */
            height: 100%;
            object-fit: cover;
        }

        .timer-counter {
            /* position: fixed; */
            /* visibility: hidden; */
            right: 15px;
            bottom: 15px;
            /* z-index: 99999; */
            /* background: #4154f1; */
            /* width: 30px;
                                                                                        height: 30px; */
            color: white;
            border-radius: 4px;
            /* transition: all 0.4s; */
        }

        circle-progress::part(base) {
            width: 40px;
            height: auto;
        }

        circle-progress::part(circle) {
            stroke-width: 6px;
        }

        circle-progress::part(value) {
            stroke-width: 8px;
            stroke: rgb(37, 37, 37);
            stroke-linecap: round;
        }
    </style>
</head>

<body class=" bg-dark-light">
    {{-- content --}}
    <div id="" class="d-flex flex-column gap-2  h-100 w-100 p-2 ">
        <div class=" text-bg-light shadow rounded-4 p-2 w-100">
            <div class="text-center d-flex align-items-center">
                <img src="{{ asset('storage/assets/img/logo.png ') }}" alt="" class="p-2" width="50px">
                <h3 class="mt-2">@include('components.app-name')</h3>
            </div>
        </div>
        {{-- <div class="text-bg-success shadow rounded-4 p-3 text-muted h-100">

        </div> --}}
        <div class="d-flex gap-2 w-100 h-100" id="resultsArea">
            @include('components.live-elements-result')
        </div>

        <div class="d-flex gap-2">
            <div class="text-bg-light shadow rounded-4 p-3 text-muted w-100">
                <div class="copyright">
                    &copy; Copyright <strong><span>@include('components.app-name')</span></strong>. All Rights Reserved
                </div>
                <div class="credits">
                    Develop by <a href="https://www.tiktok.com/@thedirtiestrat">Mr. Dirtiest Rat (Dunhill Leal)</a>
                    Designed in <a href="https://bootstrapmade.com/">BootstrapMade</a>
                </div>
            </div>
            <div class=" text-bg-light shadow rounded-4 p-3 text-muted ">
                <div class="timer-counter">
                    <circle-progress id="timer_counter" value="50" max="100"></circle-progress>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('storage/assets/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('storage/assets/js/circle-progress.min.js') }}" type="module"></script>
    {{-- tick timer --}}
    <script type="module">
        const timerElem = document.getElementById('timer_counter');

        var max_count = 10
        let milisec = 1000;
        var count = 0;

        timerElem.max = max_count;

        // timer
        let counter = setInterval(() => {
            count++;
            // console.log(count);
            timerElem.value = count;

            if (count == max_count) {
                count = 0;
                get_update_data();
                // location.reload();
            }
        }, milisec);




        // ajax get function
        function get_update_data() {
            $.ajax({
                url: "{{ url('liveElementsResult') }}",
                type: "GET",
                data: {
                    // 'key': $search_key,
                    // 'despensed_list': true,
                },
                success: function(data) {
                    $('#resultsArea').html(data);
                }
            })
        }
    </script>
</body>

</html>
