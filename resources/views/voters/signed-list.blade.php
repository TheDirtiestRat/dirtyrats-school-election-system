@extends('layouts.app')

@section('head-links')
    <link href="{{ asset('storage/assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">
@endsection

@section('body-content')
    <div class="container">
        <div class="pagetitle">
            <h1>Signed Voters</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Voters</a></li>
                    <li class="breadcrumb-item active">Signed List</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body overflow-auto">
                            <h5 class="card-title">Signed</h5>
                            <p>This are the list of Voters Signed in the System.</p>

                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>USN / LRN</th>
                                        <th>
                                            Name
                                        </th>
                                        <th>Scanner In</th>
                                        <th>Scanned In</th>
                                        <th>Scanner Out</th>
                                        <th>Scanned Out</th>
                                        {{-- <th>Section</th>
                                        <th data-type="date" data-format="YYYY/DD/MM">Signed</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($signed as $voter)
                                    <tr>
                                        <td>{{ $voter->usn_or_lrn }}</td>
                                        <td>{{ $voter->first_name }} {{ $voter->mid_name }} {{ $voter->last_name }}</td>
                                        <td>{{ $voter->scanner_in }}</td>
                                        <td>{{ $voter->scan_in }}</td>
                                        <td>{{ $voter->scanner_out }}</td>
                                        <td>{{ $voter->scan_out }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td>
                                        </td>
                                        <td>No scanned voters yet</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                      
                                    </tr>
                                    @endforelse
                                    {{-- @for ($i = 0; $i < 50; $i++)
                                        <tr>
                                            <td>9958</td>
                                            <td>Unity Pugh</td>
                                            <td>Curicó</td>
                                            <td>Col 3rd</td>
                                            <td>B</td>
                                            <td>2005/02/11</td>
                                        </tr>
                                    @endfor --}}
                                </tbody>
                            </table>
                            <!-- End Table with stripped rows -->

                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>
@endsection

@section('body-links')
    <script src="{{ asset('storage/assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
@endsection
