@extends('layouts.guest')

@section('head-links')
@endsection

@section('body-content')
    <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 d-flex flex-column align-items-center justify-content-center">

                    <div class="d-flex justify-content-center py-4">
                        <a href="index.html" class="logo d-flex align-items-center w-auto">
                            <img src="{{ asset('storage/assets/img/logo.png ') }}" alt="">
                            <span class="d-none d-lg-block">@include('components.app-name')</span>
                        </a>
                    </div><!-- End Logo -->

                    <div class="card shadow rounded-4 mb-3">

                        <div class="card-body">

                            @if ($can_register->value == 1)
                                <div class="pt-1 pb-2">
                                    <h5 class="card-title text-center pb-0 fs-4">Register Voter Account</h5>
                                    <p class="text-center small">Enter your credentials</p>
                                </div>

                                {{-- alert --}}
                                @include('components.alert')

                                <form action="{{ route('registerVoter') }}" method="POST" class="row g-3 needs-validation"
                                    novalidate>
                                    {{-- for validation --}}
                                    @csrf

                                    <div class="col-md-12 d-none">
                                        <label for="voter_id" class="form-label">Voter Id</label>
                                        <input type="text" class="form-control" name="voter_id" id="voter_id"
                                            value="{{ $voter_id }}" required readonly>
                                    </div>
                                    {{-- <div class="col-md-6">
                                    <label for="usn_or_lrn" class="form-label">USN or LRN</label>
                                    <input type="text" class="form-control" id="usn_or_lrn" name="usn_or_lrn" required>
                                    <div class="invalid-feedback">
                                        Please provide a valid USN or LRN.
                                    </div>
                                </div> --}}

                                    <div class="col-md-4">
                                        <label for="first_name" class="form-label">First name</label>
                                        <input type="text" class="form-control" id="first_name" name="first_name"
                                            value="" onkeyup="on_username()" autocomplete="true" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="mid_name" class="form-label">Middle name</label>
                                        <input type="text" class="form-control" id="mid_name" name="mid_name"
                                            value="">
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="last_name" class="form-label">Last name</label>
                                        <input type="text" class="form-control" id="last_name" name="last_name"
                                            value="" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="validationCustomUsername" class="form-label">Username</label>
                                        <div class="input-group has-validation">
                                            <span class="input-group-text" id="inputGroupPrepend">@</span>
                                            <input type="text" class="form-control" id="validationCustomUsername"
                                                aria-describedby="inputGroupPrepend" name="username"
                                                value="" autocomplete="true" required>
                                            <div class="invalid-feedback">
                                                Please choose a username.
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-7">
                                        <label for="email" class="form-label">Email</label>
                                        <div class="input-group has-validation">
                                            <input type="email" class="form-control" id="email" name="email"
                                                placeholder="Recipient's email" aria-label="Recipient's email"
                                                aria-describedby="basic-addon2" autocomplete="true" required>
                                            <span class="input-group-text" id="basic-addon2">@example.com</span>
                                        </div>
                                        <div class="invalid-feedback">
                                            Please input a email.
                                        </div>
                                    </div> --}}

                                    <div class="col-md-6">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" class="form-control" name="password" id="password"
                                            value="" required>
                                        <div class="invalid-feedback">
                                            Please input a Password.
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label for="password_confirmation" class="form-label">Confirm Passowrd</label>
                                        <input type="password" class="form-control" id="password_confirmation"
                                            name="password_confirmation" required>
                                        <div class="invalid-feedback">
                                            Confirm the Password.
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="school_level" class="form-label">School</label>
                                        <input type="text" class="form-control" name="school_level" id="school_level"
                                            value="" >
                                    </div>

                                    <div class="col-md-6">
                                        <label for="strand_or_course" class="form-label">Position</label>
                                        <input type="text" class="form-control" name="strand_or_course"
                                            id="strand_or_course" value="" >
                                    </div>

                                    {{-- <div class="col-md-6">
                                    <label for="school_level" class="form-label">School</label>
                                    <select class="form-select" id="school_level" name="school_level" onchange=""
                                        required>
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
                                        <option selected value="1st">1st</option>
                                        <option value="2nd">2nd</option>
                                        <option value="3rd">3rd</option>
                                        <option value="4th">4th</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select a valid Year.
                                    </div>
                                </div>

                                <div class="col-md-6" id="strand_or_courseA">
                                    <label for="stcA" class="form-label">Position</label>
                                    <select class="form-select" id="stcA" name="strand_or_course" required>
                                        <option selected value="BSIT">BSIT</option>
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
                                        <option selected value="A">A</option>
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
                                </div> --}}

                                    {{-- <div class="col-12">
                                    <label for="yourUsername" class="form-label">Username</label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                                        <input type="text" name="name" class="form-control" id="yourUsername"
                                            required>
                                        <div class="invalid-feedback">Please enter your username.</div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label for="yourPassword" class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control" id="yourPassword" required>
                                    <div class="invalid-feedback">Please enter your password!</div>
                                </div> --}}

                                    <div class="col-12">
                                        <button class="btn btn-primary w-100" type="submit">Register</button>
                                    </div>
                                @else
                                    <div class="pt-1 pb-2 text-center">
                                        <h5 class="card-title text-center pb-0 fs-4">Registration Closed</h5>
                                        <p class="text-center">The Voting of Candidates has started to register pls contact the system admin Mr. Drat</p>
                                        <p class="text-center small">
                                            Thank you for you're cooperation.
                                        </p>
                                        <a href="{{ url('login') }}" class="btn btn-primary m-3" type="button">Log-in</a>
                                    </div>
                            @endif
                            </form>
                        </div>
                    </div>

                    <div class="credits">
                        <p class="small mb-0 text-center">Return to <a href="{{ url('/') }}">Welcome Page</a> ?</p>
                        Developed by <a href="https://www.tiktok.com/@thedirtiestrat">Mr. Dirtiest Rat (Dunhill Leal)</a>
                    </div>

                </div>
            </div>
        </div>

    </section>

    <script>
        var inp_frst = document.getElementById('first_name');
        var inp_usr = document.getElementById('validationCustomUsername');

        function on_username() {
            // inp_usr.value = "{{ $voter_id }}" + "_" + inp_frst.value;
            // window.alert(inp_frst.value);
        }
    </script>
@endsection

@section('body-links')
@endsection
