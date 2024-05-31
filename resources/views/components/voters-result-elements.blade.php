<div class="col-lg-12">
    <div class="row g-2">
        <div class="col-10 text-center d-flex align-items-center">
            <img src="{{ asset('storage/assets/img/logo.png ') }}" alt="" class="p-2" width="50px">
            <h3 class="mt-2">@include('components.app-name')</h3>
        </div>
        {{-- <div class="col-md-2">
            
        </div> --}}
        <!-- Recent Sales -->
        <div class="col-4">
            <div class="row">
                <!-- Sales Card -->
                <div class="col-12">
                    <div class="card info-card m-1">

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
                        <h1 class="mt-2">Voters <span>| Today</span></h1>
                            <!-- <h1 class="card-title">Voters <span>| Today</span></h1> -->

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-people"></i>
                                </div>
                                <div class="ps-3">
                                    <h1>{{ $registered_voters }}</h1>
                                    {{-- <span class="text-success small pt-1 fw-bold">12%</span> <span
                                        class="text-muted small pt-2 ps-1">increase</span> --}}

                                </div>
                            </div>
                        </div>

                    </div>
                </div><!-- End Sales Card -->

                <!-- Customers Card -->
                <div class="col-12">

                    <div class="card info-card customers-card m-1">

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
                            <h1 class="mt-2">Voted <span>| Today</span></h1>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-people"></i>
                                </div>
                                <div class="ps-3">
                                    <h1>{{ $voted_voters }}</h1>
                                    {{-- <span class="text-danger small pt-1 fw-bold">12%</span> <span
                                        class="text-muted small pt-2 ps-1">decrease</span> --}}

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="card m-1">
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
                    <h5 class="card-title">Leading voters <span>| Today</span></h5>

                    <div id="trafficChart" style="min-height: 275px; width: 100%;" class="echart"></div>
                    {{-- <canvas id="trafficChart" style="min-height: 275px; width: 100%;"></canvas> --}}

                    <script>
                        var data_labels = [
                            @forelse ($votes_candidates as $candidate)
                                '{{ substr($candidate->name, 0, 10) }}...',
                            @empty
                                '',
                            @endforelse
                        ];
                        var data_values = [
                            @forelse ($votes_candidates as $candidate)
                                {{ $candidate->total }},
                            @empty
                                0,
                            @endforelse
                        ];

                        var barcharts = echarts.init(document.getElementById('trafficChart'));

                        barcharts.setOption({
                            tooltip: {},
                            legend: {
                                data: ['votes']
                            },
                            yAxis: {},
                            itemStyle: {
                                borderRadius: [12, 12, 0, 0]
                            },
                            legend: {
                                top: '5%',
                                left: 'center'
                            },
                            xAxis: {
                                // data: ['1', '2', '3', '4', '1', '2', '3', '3',]
                                data: data_labels
                            },
                            series: [{
                                name: 'total votes',
                                type: 'bar',
                                avoidLabelOverlap: false,
                                label: {
                                    show: false,
                                    position: 'center'
                                },
                                data: data_values
                            }]
                        });
                    </script>

                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="row">
                <div class="col">
                    <!-- Top Selling -->
                    <div class="col-12">
                        <div class="card top-selling overflow-auto m-1">

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

                                <table class="table table-striped text-center">
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
                                                <td>
                                                    <h1>
                                                        {{ $candidate->name }}
                                                    </h1>
                                                    <!-- <a href="#"
                                                        class="text-primary fw-bold fs-5">{{ $candidate->name }}</a> -->
                                                </td>
                                                <td>{{ $candidate->position }}</td>
                                                <td class="fw-bold fs-5">
                                                    <h1>
                                                        {{ $candidate->total }}
                                                    </h1>
                                                </td>
                                                <td class="fs-6">
                                                    <h1>
                                                        {{ round(($candidate->total / $registered_voters) * 100, 2) }}%
                                                    </h1>
                                                </td>
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

                                    </tbody>
                                </table>

                            </div>

                        </div>
                    </div><!-- End Top Selling -->
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="copyright">
                &copy; Copyright <strong><span>@include('components.app-name')</span></strong>. All Rights Reserved
            </div>
            <div class="credits">
                Develop by <a href="https://www.tiktok.com/@thedirtiestrat">Mr. Dirtiest Rat (Dunhill Leal)</a>
                Designed in <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div>
        </div>
    </div>
</div><!-- End Left side columns -->
