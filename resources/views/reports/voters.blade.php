@extends('layouts.guest')

@section('head-links')
    <script src="{{ asset('storage/assets/vendor/echarts/echarts.min.js') }}"></script>

    <style>
        .img-obj-fill {
            object-fit: cover;
        }

        .img-fluid {
            max-width: 100%;
            height: auto;
            object-fit: cover;
        }

        .slide-top {
            -webkit-animation: slide-top 0.5s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
            animation: slide-top 0.5s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
        }

        @-webkit-keyframes slide-top {
            0% {
                opacity: 0;
                -webkit-transform: translateY(100px);
                transform: translateY(100px);
            }

            100% {
                opacity: 1;
                -webkit-transform: translateY(-0);
                transform: translateY(0);
            }
        }

        @keyframes slide-top {
            0% {
                opacity: 0;
                -webkit-transform: translateY(100px);
                transform: translateY(100px);
            }

            100% {
                opacity: 1;
                -webkit-transform: translateY(0);
                transform: translateY(0);
            }
        }

        .timer-counter {
            position: fixed;
            /* visibility: hidden; */
            right: 15px;
            bottom: 15px;
            z-index: 99999;
            /* background: #4154f1; */
            /* width: 30px;
                                                                                        height: 30px; */
            color: white;
            border-radius: 4px;
            /* transition: all 0.4s; */
        }

        circle-progress::part(base) {
            width: 50px;
            height: auto;
        }

        circle-progress::part(circle) {
            stroke-width: 2px;
        }

        circle-progress::part(value) {
            stroke-width: 6px;
            stroke: rgb(37, 37, 37);
            stroke-linecap: round;
        }
    </style>

    <link href="{{ asset('storage/assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">
@endsection

@section('body-content')
    <section class="section dashboard h-100">
        <div class="row align-items-center h-100" id="data_show_area">
            @include('components.voters-result-elements')
        </div>
    </section>
@endsection

@section('body-links')
    <div class="timer-counter">
        <circle-progress id="timer_counter" value="50" max="100"></circle-progress>
    </div>

    <script src="{{ asset('storage/assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
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
            }
        }, milisec);




        // ajax get function
        function get_update_data() {
            $.ajax({
                url: "{{ url('getvotersReports') }}",
                type: "GET",
                data: {
                    // 'key': $search_key,
                    // 'despensed_list': true,
                },
                success: function(data) {
                    $('#data_show_area').html(data);
                }
            })
        }
    </script>
@endsection
