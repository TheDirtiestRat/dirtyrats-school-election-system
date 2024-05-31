@extends('layouts.app')

@section('head-links')
    <link href="{{ asset('storage/assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">
@endsection

@section('body-content')
    <div class="container">
        <div class="pagetitle">
            <h1>Remaining Voters</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Voters</a></li>
                    <li class="breadcrumb-item active">Remaining List</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body overflow-auto">
                            <h5 class="card-title">Remaining</h5>

                            <div class="row">
                                <div class="col">
                                    <p>This are the list of Voters Remaining in the System that not have voted yet.</p>
                                </div>
                                <div class="col-md-auto">
                                    <a href="{{ url('printRemaingVoters') }}" class="btn btn-outline-primary" target="_blank">
                                        Print List
                                    </a>
                                </div>
                            </div>

                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>USN / LRN</th>
                                        <th>
                                            <b>N</b>ame
                                        </th>
                                        <th>Strand/Course</th>
                                        <th>School Level</th>
                                        <th>Section</th>
                                        {{-- <th data-type="date" data-format="YYYY/DD/MM">Voted</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($remaining as $voter)
                                        <tr>
                                            <td>
                                                <a href="{{ route('voters.show', $voter->id) }}"
                                                    class="btn btn-primary btn-sm text-center w-100">{{ $voter->usn_or_lrn }}</a>
                                            </td>
                                            <td>{{ $voter->first_name }} {{ $voter->mid_name }} {{ $voter->last_name }}</td>
                                            <td>{{ $voter->strand_or_course }}</td>
                                            <td>{{ $voter->school_level }}</td>
                                            <td>{{ $voter->section }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td>
                                                0000
                                            </td>
                                            <td>None Voted yet</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    @endforelse
                                    {{-- @for ($i = 0; $i < 50; $i++)
                                        <tr>
                                            <td>
                                                9958
                                            </td>
                                            <td>Unity Pugh</td>
                                            <td>Curicó</td>
                                            <td>Col 3rd</td>
                                            <td>B</td>
                                            <td>2005/02/11</td>
                                        </tr>
                                        <tr>
                                            <td>65434</td>
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
