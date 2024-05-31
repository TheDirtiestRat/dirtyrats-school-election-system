@extends('layouts.app')

@section('head-links')
    {{-- <link href="{{ asset('storage/assets/vendor/simple-datatables/style.css') }}" rel="stylesheet"> --}}
@endsection

@section('body-content')
    <div class="container">
        <div class="pagetitle">
            <h1>Voted Candidates</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Voters</a></li>
                    <li class="breadcrumb-item active">Candidates Voted Summary</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body overflow-auto">
                            <h5 class="card-title">Candidates</h5>
                            <p>This are the list of Voted Candidates.</p>

                            <!-- Table with stripped rows -->
                            <table class="table table-striped table-hover ">
                                <thead>
                                    <tr>
                                        <th>Candidate</th>
                                        <th>
                                            Information
                                            {{-- Partylist --}}
                                        </th>
                                        <th>Position</th>
                                        <th data-type="date" data-format="YYYY/DD/MM">Voted</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($voted_candidates as $candidate)
                                        <tr>
                                            <td>{{ $candidate->name }}</td>
                                            <td>{{ $candidate->partylist }}</td>
                                            <td>{{ $candidate->position }}</td>
                                            <td>{{ $candidate->created_at }}</td>
                                        </tr>
                                    @empty
                                        <tr class="text-center">
                                            <td colspan="4">Not Voted yet</td>
                                        </tr>
                                    @endforelse
                                    {{-- @for ($i = 0; $i < 5; $i++)
                                        <tr>
                                            <td>Unity Pugh</td>
                                            <td>Curicó</td>
                                            <td>Col 3rd</td>
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
    {{-- <script src="{{ asset('storage/assets/vendor/simple-datatables/simple-datatables.js') }}"></script> --}}
@endsection
