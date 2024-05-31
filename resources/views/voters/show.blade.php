@extends('layouts.app')

@section('head-links')
    <style>
        .img-obj-fill {
            object-fit: cover;
        }
    </style>
    <script src="{{ asset('storage/assets/js/qrcode.js') }}"></script>
@endsection

@section('body-content')
    <div class="pagetitle">
        <h1>Voter</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Voter</a></li>
                <li class="breadcrumb-item active">Voter Details</li>
            </ol>
        </nav>
    </div>

    {{-- alert --}}
    @include('components.alert')

    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">

                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column text-center align-items-center">

                        {{-- <img src="{{ asset('storage/voter img/' . $voter->photo) }}" alt="Profile"
                            class="rounded-4 img-obj-fill"> --}}
                        <h2 class="">{{ $voter->first_name }} {{ $voter->mid_name }} {{ $voter->last_name }}</h2>
                        <h3>{{ $voter->voter_id }}</h3>
                        <p class="text-muted text-center">
                            Username: {{ $voter->name }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-xl-8">

                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">

                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab"
                                    data-bs-target="#profile-overview">Overview</button>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('qrcodeID',  $voter->id) }}" class="nav-link" target="_blank">QR Code ID</a>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#voted-candidates">Voted
                                    Candidates</button>
                            </li>

                            <li class="nav-item">
                                <form action="{{ route('voters.destroy', $voter->id) }}" method="post"
                                    class=" text-decoration-none">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger float-end">Remove</button>
                                </form>
                                {{-- <a href="{{ route('voter.edit', $voter->id) }}" class=" text-decoration-none">
                                    <button class="nav-link">Remove Voter</button>
                                </a> --}}
                            </li>

                        </ul>
                        <div class="tab-content pt-2">

                            <div class="tab-pane fade show active profile-overview" id="profile-overview">

                                <h5 class="card-title">Voter Details</h5>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">USN or LRN</div>
                                    <div class="col-lg-9 col-md-8">{{ $voter->usn_or_lrn }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Full Name</div>
                                    <div class="col-lg-9 col-md-8">{{ $voter->first_name }} {{ $voter->mid_name }}
                                        {{ $voter->last_name }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Strand or Course</div>
                                    <div class="col-lg-9 col-md-8">{{ $voter->strand_or_course }} {{ $voter->section }}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">School Level</div>
                                    <div class="col-lg-9 col-md-8">{{ $voter->school_level }} {{ $voter->year }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Email</div>
                                    <div class="col-lg-9 col-md-8">{{ $voter->email }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Created at</div>
                                    <div class="col-lg-9 col-md-8">{{ $voter->created_at }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Updated at</div>
                                    <div class="col-lg-9 col-md-8">{{ $voter->updated_at }}</div>
                                </div>
                            </div>

                            <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                                <form class="row g-3 needs-validation" action="{{ route('voters.update', $voter->id) }}"
                                    method="POST" novalidate>
                                    {{-- for validation --}}
                                    @csrf
                                    @method('PUT')

                                    <div class="col-md-6">
                                        <label for="voter_id" class="form-label">Voter Id</label>
                                        <input type="text" class="form-control" name="voter_id" id="voter_id"
                                            value="{{ $voter->voter_id }}" required readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="usn_or_lrn" class="form-label">USN or LRN</label>
                                        <input type="text" class="form-control" id="usn_or_lrn" name="usn_or_lrn"
                                            value="{{ $voter->usn_or_lrn }}" required readonly>
                                        <div class="invalid-feedback">
                                            Please provide a valid USN or LRN.
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="first_name" class="form-label">First name</label>
                                        <input type="text" class="form-control" id="first_name" name="first_name"
                                            value="{{ $voter->first_name }}" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="mid_name" class="form-label">Middle name</label>
                                        <input type="text" class="form-control" id="mid_name" name="mid_name"
                                            value="{{ $voter->mid_name }}">
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="last_name" class="form-label">Last name</label>
                                        <input type="text" class="form-control" id="last_name" name="last_name"
                                            value="{{ $voter->last_name }}" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <label for="validationCustomUsername" class="form-label">Username</label>
                                        <div class="input-group has-validation">
                                            <span class="input-group-text" id="inputGroupPrepend">@</span>
                                            <input type="text" class="form-control" id="validationCustomUsername"
                                                aria-describedby="inputGroupPrepend" name="username"
                                                value="{{ $voter->name }}" required readonly>
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
                                                aria-describedby="basic-addon2" value="{{ $voter->email }}">
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
                                            <option selected value="COLLEGE">COLLEGE</option>
                                            <option value="SENIOR HIGH">SENIOR HIGH</option>
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

                                    <div class="col-12 w-100 ">
                                        <button class="btn btn-primary" type="submit">Update</button>
                                    </div>
                                </form>

                            </div>

                            <div class="tab-pane fade pt-3" id="voted-candidates">

                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Candidate</th>
                                            <th scope="col">Position</th>
                                            <th scope="col">Party List</th>
                                            <th scope="col">Vote Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @forelse ($voted_candidates as $candidate)
                                            <tr>
                                                <th scope="row">{{ $i++ }}</th>
                                                <td>{{ $candidate->name }}</td>
                                                <td>{{ $candidate->position }}</td>
                                                <td>{{ $candidate->partylist }}</td>
                                                <td>{{ $candidate->created_at }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5">Not voted yet</td>
                                            </tr>
                                        @endforelse
                                        {{-- <tr>
                                            <th scope="row">1</th>
                                            <td>Brandon Jacob</td>
                                            <td>Designer</td>
                                            <td>28</td>
                                            <td>2016-05-25</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">2</th>
                                            <td>Bridie Kessler</td>
                                            <td>Developer</td>
                                            <td>35</td>
                                            <td>2014-12-05</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">3</th>
                                            <td>Ashleigh Langosh</td>
                                            <td>Finance</td>
                                            <td>45</td>
                                            <td>2011-08-12</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">4</th>
                                            <td>Angus Grady</td>
                                            <td>HR</td>
                                            <td>34</td>
                                            <td>2012-06-11</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">5</th>
                                            <td>Raheem Lehner</td>
                                            <td>Dynamic Division Officer</td>
                                            <td>47</td>
                                            <td>2011-04-19</td>
                                        </tr> --}}
                                    </tbody>
                                </table>

                            </div>
                        </div><!-- End Bordered Tabs -->
                    </div>
                </div>

                {{-- if its a voter, add the information here --}}
            </div>

            {{-- <div class="col-12 d-flex justify-content-center">
                <div class="text-bg-secondary rounded-4 p-2" style="width: 638px; height: 1012px">

                </div>
            </div> --}}
        </div>
    </section>

    {{-- select input values --}}
    <script>
        var sch_yr = document.getElementById('school_level');
        sch_yr.value = "{{ $voter->school_level }}";

        var sel_A = document.getElementById('stcA');

        var sel_yA = document.getElementById('yearA');

        document.getElementById('validationCustom07').value = "{{ $voter->section }}";

        // call it first
        on_school_year();

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
                    <option value="HUMSS">HUMSS</option>
                    <option value="ABM">ABM</option>
                    <option value="HE">HE</option>
                    <option value="CSS">CSS</option>
                    <option value="PROGRAMING">PROGRAMING</option>
                    <option value="ANIMATION">ANIMATION</option>
                    <option value="GAS">GAS</option>`;
                sel_yA.innerHTML =
                    `<option selected disabled value="">Choose...</option>
                    <option value="GRD 11">GRD 11</option>
                    <option value="GRD 12">GRD 12</option>`;
            }

            // call it after the set
            sel_yA.value = "{{ $voter->year }}";
            sel_A.value = "{{ $voter->strand_or_course }}";
        }

        var inp_frst = document.getElementById('first_name');
        var inp_usr = document.getElementById('validationCustomUsername');

        function on_username() {
            inp_usr.value = "{{ $voter->voter_id }}" + "_" + inp_frst.value;
            // window.alert(inp_frst.value);
        }
    </script>
@endsection
