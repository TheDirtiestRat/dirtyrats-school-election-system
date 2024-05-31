@extends('layouts.app')

@section('head-links')
    <link href="{{ asset('storage/assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('storage/assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">
@endsection

@section('body-content')
    {{-- test page --}}

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-8">
                <div class="row">

                    <!-- Sales Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card sales-card">

                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                        class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#">Today</a></li>
                                    <li><a class="dropdown-item" href="#">This Month</a></li>
                                    <li><a class="dropdown-item" href="#">This Year</a></li>
                                </ul>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">Voters <span>| Today</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-people"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $registered_voters }}</h6>
                                        {{-- <span class="text-success small pt-1 fw-bold">12%</span> <span
                                            class="text-muted small pt-2 ps-1">increase</span> --}}

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Sales Card -->

                    <!-- Revenue Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card revenue-card">

                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                        class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#">Today</a></li>
                                    <li><a class="dropdown-item" href="#">This Month</a></li>
                                    <li><a class="dropdown-item" href="#">This Year</a></li>
                                </ul>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">Signed <span>| Today</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-people"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $signed_voters }}</h6>
                                        {{-- <span class="text-success small pt-1 fw-bold">8%</span> <span
                                            class="text-muted small pt-2 ps-1">increase</span> --}}

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Revenue Card -->

                    <!-- Customers Card -->
                    <div class="col-xxl-4 col-xl-12">

                        <div class="card info-card customers-card">

                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                        class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#">Today</a></li>
                                    <li><a class="dropdown-item" href="#">This Month</a></li>
                                    <li><a class="dropdown-item" href="#">This Year</a></li>
                                </ul>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">Voted <span>| Today</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-people"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $voted_voters }}</h6>
                                        {{-- <span class="text-danger small pt-1 fw-bold">12%</span> <span
                                            class="text-muted small pt-2 ps-1">decrease</span> --}}

                                    </div>
                                </div>

                            </div>
                        </div>

                    </div><!-- End Customers Card -->

                    <!-- Reports -->
                    <div class="col-12">
                        <div class="card">

                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                        class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#">Today</a></li>
                                    <li><a class="dropdown-item" href="#">This Month</a></li>
                                    <li><a class="dropdown-item" href="#">This Year</a></li>
                                </ul>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">Reports <span>/Today</span></h5>

                                <!-- Line Chart -->
                                <div id="reportsChart"></div>

                                <script>
                                    document.addEventListener("DOMContentLoaded", () => {
                                        new ApexCharts(document.querySelector("#reportsChart"), {
                                            series: [{
                                                name: 'Registered',
                                                data: [
                                                    @forelse ($reg_by_day as $reg)
                                                        {{ $reg->total }},
                                                    @empty
                                                        0,
                                                    @endforelse
                                                    // 31,
                                                    // 40,
                                                    // 28,
                                                    // 51,
                                                    // 42,
                                                    // 82,
                                                    // 56
                                                ],
                                            }, {
                                                name: 'Signed',
                                                data: [
                                                    @forelse ($sig_by_day as $sig)
                                                        {{ $sig->total }},
                                                    @empty
                                                        0,
                                                    @endforelse
                                                ]
                                            }, {
                                                name: 'Voted',
                                                data: [
                                                    @forelse ($vot_by_day as $vot)
                                                        {{ $vot->total }},
                                                    @empty
                                                        0,
                                                    @endforelse
                                                ]
                                            }],
                                            chart: {
                                                height: 350,
                                                type: 'area',
                                                toolbar: {
                                                    show: false
                                                },
                                            },
                                            markers: {
                                                size: 4
                                            },
                                            colors: ['#4154f1', '#2eca6a', '#ff771d'],
                                            fill: {
                                                type: "gradient",
                                                gradient: {
                                                    shadeIntensity: 1,
                                                    opacityFrom: 0.3,
                                                    opacityTo: 0.4,
                                                    stops: [0, 90, 100]
                                                }
                                            },
                                            dataLabels: {
                                                enabled: false
                                            },
                                            stroke: {
                                                curve: 'smooth',
                                                width: 2
                                            },
                                            xaxis: {
                                                type: 'datetime',
                                                categories: [
                                                    "2018-09-19T00:00:00.000Z",
                                                    "2018-09-19T01:30:00.000Z",
                                                    "2018-09-19T02:30:00.000Z",
                                                    "2018-09-19T03:30:00.000Z",
                                                    "2018-09-19T04:30:00.000Z",
                                                    "2018-09-19T05:30:00.000Z",
                                                    "2018-09-19T06:30:00.000Z"
                                                ]
                                            },
                                            tooltip: {
                                                x: {
                                                    format: 'dd/MM/yy HH:mm'
                                                },
                                            }
                                        }).render();
                                    });
                                </script>
                                <!-- End Line Chart -->

                            </div>

                        </div>
                    </div><!-- End Reports -->

                    <!-- Recent Sales -->
                    <div class="col-12">
                        <div class="card recent-sales overflow-auto">

                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                        class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#">Today</a></li>
                                    <li><a class="dropdown-item" href="#">This Month</a></li>
                                    <li><a class="dropdown-item" href="#">This Year</a></li>
                                </ul>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">Recent Voters <span>| Today</span></h5>

                                <table class="table table-borderless datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">Usn/Lrn</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Strand/Course</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- list of recent voters --}}
                                        @forelse ($recent_voters as $voter)
                                            <tr>
                                                <th scope="row"><a href="#">{{ $voter->voter_id }}</a></th>
                                                <td>{{ $voter->first_name }} {{ $voter->mid_name }}
                                                    {{ $voter->last_name }}</td>
                                                <td><a href="#" class="text-primary">{{ $voter->strand_or_course }}
                                                        {{ $voter->school_level }}{{ $voter->year }}</a></td>
                                                <td><span class="badge bg-success">Voted</span></td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td></td>
                                                <td>None voted yet</td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>

                            </div>

                        </div>
                    </div><!-- End Recent Sales -->



                </div>
            </div><!-- End Left side columns -->

            <!-- Right side columns -->
            <div class="col-lg-4">

                <!-- Budget Report -->
                <div class="card">
                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                                <h6>Filter</h6>
                            </li>

                            <li><a class="dropdown-item" href="#">Today</a></li>
                            <li><a class="dropdown-item" href="#">This Month</a></li>
                            <li><a class="dropdown-item" href="#">This Year</a></li>
                        </ul>
                    </div>

                    <div class="card-body pb-0">
                        <h5 class="card-title">Voted Report <span>| Today</span></h5>

                        <div id="budgetChart" style="min-height: 400px;" class="echart"></div>

                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                var budgetChart = echarts.init(document.querySelector("#budgetChart")).setOption({
                                    legend: {
                                        data: ['Voted', 'Actual Spending']
                                    },
                                    radar: {
                                        // shape: 'circle',
                                        indicator: [
                                            @forelse ($voted_positions as $position)
                                                {
                                                    name: '{{ $position->position }}',
                                                    max: {{ $total_votes }}
                                                },
                                            @empty
                                                {
                                                    name: '',
                                                    max: {{ $total_votes }}
                                                }
                                            @endforelse
                                        ]
                                    },
                                    series: [{
                                        name: 'Voted',
                                        type: 'radar',
                                        data: [{
                                                // value: [4200, 3000, 20000, 35000, 50000, 18000],
                                                value: [
                                                    @forelse ($voted_positions as $position)
                                                        {{ $position->total }},
                                                    @empty
                                                        0000,
                                                    @endforelse
                                                ],
                                                name: 'Voted'
                                            },
                                            // {
                                            //     value: [5000, 14000, 28000, 26000, 42000, 21000],
                                            //     name: 'Actual Spending'
                                            // }
                                        ]
                                    }]
                                });
                            });
                        </script>

                    </div>
                </div><!-- End Budget Report -->

                <!-- Website Traffic -->
                <div class="card">
                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                                <h6>Filter</h6>
                            </li>

                            <li><a class="dropdown-item" href="#">Today</a></li>
                            <li><a class="dropdown-item" href="#">This Month</a></li>
                            <li><a class="dropdown-item" href="#">This Year</a></li>
                        </ul>
                    </div>

                    <div class="card-body pb-0">
                        <h5 class="card-title">Voters Strand/Course <span>| Today</span></h5>

                        <div id="trafficChart" style="min-height: 400px;" class="echart"></div>

                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                echarts.init(document.querySelector("#trafficChart")).setOption({
                                    tooltip: {
                                        trigger: 'item'
                                    },
                                    legend: {
                                        top: '5%',
                                        left: 'center'
                                    },
                                    series: [{
                                        name: 'Access From',
                                        type: 'pie',
                                        radius: ['40%', '70%'],
                                        avoidLabelOverlap: false,
                                        label: {
                                            show: false,
                                            position: 'center'
                                        },
                                        emphasis: {
                                            label: {
                                                show: true,
                                                fontSize: '18',
                                                fontWeight: 'bold'
                                            }
                                        },
                                        labelLine: {
                                            show: false
                                        },
                                        data: [
                                            @forelse ($voters_by_course as $voter)
                                            {
                                                value: {{ $voter->total }},
                                                name: '{{ $voter->strand_or_course }}'
                                            },
                                            @empty
                                            {
                                                value: 0,
                                                name: 'None'
                                            },
                                            @endforelse
                                            
                                            // {
                                            //     value: 735,
                                            //     name: 'Group2'
                                            // },
                                            // {
                                            //     value: 580,
                                            //     name: 'Group3'
                                            // },
                                            // {
                                            //     value: 484,
                                            //     name: 'Group4'
                                            // },
                                            // {
                                            //     value: 300,
                                            //     name: 'Group5'
                                            // }
                                        ]
                                    }]
                                });
                            });
                        </script>

                    </div>
                </div><!-- End Website Traffic -->

            </div><!-- End Right side columns -->

            <div class="col-lg-12">
                <div class="row">
                    <div class="col">
                        <!-- Top Selling -->
                        <div class="col-12">
                            <div class="card top-selling overflow-auto">

                                <div class="filter">
                                    <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                            class="bi bi-three-dots"></i></a>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                        <li class="dropdown-header text-start">
                                            <h6>Filter</h6>
                                        </li>

                                        <li><a class="dropdown-item" href="#">Today</a></li>
                                        <li><a class="dropdown-item" href="#">This Month</a></li>
                                        <li><a class="dropdown-item" href="#">This Year</a></li>
                                    </ul>
                                </div>

                                <div class="card-body pb-0">
                                    <h5 class="card-title">Top Candidates <span>| Today</span></h5>

                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th scope="col">Preview</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Position</th>
                                                <th scope="col">Voted</th>
                                                <th scope="col">%</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($top_candidates as $candidate)
                                            <tr>
                                                <th scope="row"><a href="#"><img
                                                            src="{{ asset('storage/candidate img/' . $candidate->photo) }}"
                                                            alt=""></a></th>
                                                <td><a href="#" class="text-primary fw-bold">{{ $candidate->name }}</a></td>
                                                <td>{{ $candidate->position }}</td>
                                                <td class="fw-bold">{{ $candidate->total }}</td>
                                                <td>%{{ round(($candidate->total/$registered_voters) * 100, 2) }}</td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <th scope="row"></th>
                                                <td>No top yet</td>
                                                <td></td>
                                                <td class="fw-bold"></td>
                                                <td></td>
                                            </tr>
                                            @endforelse
                                            
                                            
                                            {{-- <tr>
                                                <th scope="row"><a href="#"><img
                                                            src="{{ asset('storage/assets/img/product-3.jpg') }}"
                                                            alt=""></a></th>
                                                <td><a href="#" class="text-primary fw-bold">Doloribus nisi
                                                        exercitationem</a></td>
                                                <td>Position 3</td>
                                                <td class="fw-bold">74</td>
                                                <td>4,366</td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><a href="#"><img
                                                            src="{{ asset('storage/assets/img/product-4.jpg') }}"
                                                            alt=""></a></th>
                                                <td><a href="#" class="text-primary fw-bold">Officiis quaerat
                                                        sint
                                                        rerum error</a></td>
                                                <td>Position 4</td>
                                                <td class="fw-bold">63</td>
                                                <td>2,016</td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><a href="#"><img
                                                            src="{{ asset('storage/assets/img/product-5.jpg') }}"
                                                            alt=""></a></th>
                                                <td><a href="#" class="text-primary fw-bold">Sit unde debitis
                                                        delectus repellendus</a></td>
                                                <td>Position 5</td>
                                                <td class="fw-bold">41</td>
                                                <td>3,239</td>
                                            </tr> --}}
                                        </tbody>
                                    </table>

                                </div>

                            </div>
                        </div><!-- End Top Selling -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('body-links')
    <script src="{{ asset('storage/assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('storage/assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('storage/assets/vendor/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('storage/assets/vendor/echarts/echarts.min.js') }}"></script>
@endsection
