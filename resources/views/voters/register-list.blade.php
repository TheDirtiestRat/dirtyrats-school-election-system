@extends('layouts.app')

@section('head-links')
    <link href="{{ asset('storage/assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">
@endsection

@section('body-content')
    <div class="container">
        <div class="pagetitle">
            <h1>Registered Voters</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Voters</a></li>
                    <li class="breadcrumb-item active">Registered List</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        {{-- alert --}}
        @include('components.alert')

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body overflow-auto">
                            <h5 class="card-title">Registered</h5>
                            <div class="row">
                                <div class="col">
                                    <p>This are the list of Voters Registered in the System.</p>
                                </div>
                                <div class="col-md-auto">
                                    <button type="button" class="btn btn-primary"
                                        data-bs-toggle="modal" data-bs-target="#largeModal">
                                        Register New Voter
                                    </button>
                                </div>
                                <div class="col-md-auto">
                                    <a href="{{ route('voters.create') }}" class="btn btn-outline-primary">Register Voter</a>
                                </div>
                                <div class="col-md-auto">
                                    <a href="{{ url('importVoters') }}" class="btn btn-outline-primary"> Import Voter</a>
                                </div>
                                <div class="col-md-auto">
                                    <a href="{{ url('printRegisteredVoters') }}" class="btn btn-outline-primary" target="_blank">
                                        Print List
                                    </a>
                                </div>
                            </div>

                            <!-- Table with stripped rows -->
                            <table class="table datatable align-items-center">
                                <thead>
                                    <tr>
                                        <th>USN / LRN</th>
                                        <th>
                                            Name of the Voter
                                        </th>
                                        <th>Strand/Course</th>
                                        <th>School Level</th>
                                        <th>Section</th>
                                        <th>Year</th>
                                        <th data-type="date" data-format="YYYY/DD/MM">Registered</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- list of voters --}}
                                    @forelse ($voters as $voter)
                                        <tr>
                                            <td>
                                                <a href="{{ route('voters.show', $voter->id) }}" class="btn btn-primary btn-sm text-center w-100">{{ $voter->usn_or_lrn }}</a>
                                                {{-- <button type="button"
                                                    class="btn btn-primary btn-sm text-center w-100">{{ $voter->voter_id }}</button> --}}
                                            </td>
                                            <td>{{ $voter->first_name }} {{ $voter->mid_name }} {{ $voter->last_name }}</td>
                                            <td>{{ $voter->strand_or_course }}</td>
                                            <td>{{ $voter->school_level }}</td>
                                            <td>{{ $voter->section }}</td>
                                            <td>{{ $voter->year }}</td>
                                            <td>{{ $voter->created_at }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td>
                                                <a href="#" class="btn btn-primary btn-sm text-center w-100">00000</a>
                                                {{-- <button type="button"
                                                    class="">00000</button> --}}
                                            </td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            {{-- <td colspan="6">
                                                <h1 class="text-center text-muted">No Voters Registered yet</h1>
                                            </td> --}}
                                        </tr>
                                    @endforelse
                                    {{-- @for ($i = 0; $i < 50; $i++)
                                        <tr>
                                            <td>
                                                <button type="button"
                                                    class="btn btn-primary btn-sm text-center w-100">9958</button>
                                            </td>
                                            <td>Unity Pugh</td>
                                            <td>Curicó</td>
                                            <td>Col 3rd</td>
                                            <td>B</td>
                                            <td>2005/02/11</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <button type="button"
                                                    class="btn btn-primary btn-sm text-center w-100">65434</button>
                                            </td>
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

    <div class="modal fade" id="largeModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <!-- Multi Columns Form -->
            <form class="needs-validation" action="{{ route('voters.store') }}" method="POST" novalidate>
                {{-- for validation --}}
                @csrf

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Register</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h5 class="card-title pt-1">Register New Voter</h5>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="voter_id" class="form-label">Voter Id</label>
                                <input type="text" class="form-control" name="voter_id" id="voter_id"
                                    value="{{ $voter_id }}" required readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="usn_or_lrn" class="form-label">USN or LRN</label>
                                <input type="text" class="form-control" id="usn_or_lrn" name="usn_or_lrn" required>
                                <div class="invalid-feedback">
                                    Please provide a valid USN or LRN.
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label for="first_name" class="form-label">First name</label>
                                <input type="text" class="form-control" id="first_name" name="first_name" value=""
                                    onkeyup="on_username()" required>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="mid_name" class="form-label">Middle name</label>
                                <input type="text" class="form-control" id="mid_name" name="mid_name" value="">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="last_name" class="form-label">Last name</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" value=""
                                    required>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                            <div class="col-md-5">
                                <label for="validationCustomUsername" class="form-label">Username</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend">@</span>
                                    <input type="text" class="form-control" id="validationCustomUsername"
                                        aria-describedby="inputGroupPrepend" name="username" value="{{ $voter_id }}_"
                                        required readonly>
                                    <div class="invalid-feedback">
                                        Please choose a username.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <label for="email" class="form-label">Email</label>
                                <div class="input-group has-validation">
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="Recipient's email" aria-label="Recipient's email"
                                        aria-describedby="basic-addon2">
                                    <span class="input-group-text" id="basic-addon2">@example.com</span>
                                </div>
                                <div class="invalid-feedback">
                                    Please input a email.
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="school_level" class="form-label">School Level</label>
                                <select class="form-select" id="school_level" name="school_level"
                                    onchange="on_school_year()" required>
                                    {{-- <option selected disabled value="">Choose...</option> --}}
                                    <option selected value="College">College</option>
                                    <option value="Senior High">Senior High</option>
                                </select>
                                <div class="invalid-feedback">
                                    Please select a valid Level.
                                </div>
                            </div>

                            <div class="col-md-6" id="year_col">
                                <label for="yearA" class="form-label">Year</label>
                                <select class="form-select" id="yearA" name="year" required>
                                    <option selected disabled value="">Choose...</option>
                                    <option value="1st">1st</option>
                                    <option value="2nd">2nd</option>
                                    <option value="3rd">3rd</option>
                                    <option value="4th">4th</option>
                                </select>
                                <div class="invalid-feedback">
                                    Please select a valid Year.
                                </div>
                            </div>

                            <div class="col-md-6" id="strand_or_courseA">
                                <label for="stcA" class="form-label">Strand or Course</label>
                                <select class="form-select" id="stcA" name="strand_or_course" required>
                                    <option selected disabled value="">Choose...</option>
                                    <option value="BSIT">BSIT</option>
                                    <option value="BSCS">BSCS</option>
                                    <option value="BSHM">HM</option>
                                    <option value="BSBA">BSBA</option>
                                    <option value="WAD">WAD</option>
                                    <option value="ACT">ACT</option>
                                    <option value="OMT">OMT</option>
                                    <option value="OAT">OAT</option>
                                    <option value="HRT">HRT</option>
                                </select>
                                <div class="invalid-feedback">
                                    Please select a valid Strand or Course.
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="validationCustom07" class="form-label">Section</label>
                                <select class="form-select" id="validationCustom07" name="section" required>
                                    <option selected disabled value="">Choose...</option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                    <option value="D">D</option>
                                    <option value="E">E</option>
                                    <option value="F">F</option>
                                    <option value="G">G</option>
                                </select>
                                <div class="invalid-feedback">
                                    Please select a valid Section.
                                </div>
                            </div>
                            {{-- <div class="col-12">
                                <button class="btn btn-primary" type="submit">Register</button>
                            </div> --}}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Register</button>
                    </div>
                </div>
            </form><!-- End Custom Styled Validation -->
        </div>
    </div>

    {{-- submit modal form --}}
    <script>
        function submit() {
            document.getElementById('registerForm').submit();
            window.alert('submitted');
        }
    </script>
    {{-- select input values --}}
    <script>
        var sch_yr = document.getElementById('school_level');
        var sel_A = document.getElementById('stcA');

        var sel_yA = document.getElementById('yearA');

        function on_school_year() {
            if (sch_yr.value == "College") {
                sel_A.innerHTML =
                    `<option selected disabled value="">Choose...</option>
                    <option value="BSIT">BSIT</option>
                    <option value="BSCS">BSCS</option>
                    <option value="BSHM">HM</option>
                    <option value="BSBA">BSBA</option>
                    <option value="WAD">WAD</option>
                    <option value="ACT">ACT</option>
                    <option value="OMT">OMT</option>
                    <option value="OAT">OAT</option>
                    <option value="HRT">HRT</option>`;
                sel_yA.innerHTML =
                    `<option selected disabled value="">Choose...</option>
                <option value="1st">1st</option>
                <option value="2nd">2nd</option>
                <option value="3rd">3rd</option>
                <option value="4th">4th</option>`;
            } else {
                sel_A.innerHTML =
                    `<option value="STEM">STEM</option>
                    <option value="TVL">TVL</option>
                    <option value="I DUNNO THE REST">I DUNNO THE REST</option>`;
                sel_yA.innerHTML =
                    `<option selected disabled value="">Choose...</option>
                    <option value="1st">1st</option>
                    <option value="2nd">2nd</option>`;
            }
        }

        var inp_frst = document.getElementById('first_name');
        var inp_usr = document.getElementById('validationCustomUsername');

        function on_username() {
            inp_usr.value = "{{ $voter_id }}" + "_" + inp_frst.value;
            // window.alert(inp_frst.value);
        }
    </script>
@endsection

@section('body-links')
    <script src="{{ asset('storage/assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
@endsection
