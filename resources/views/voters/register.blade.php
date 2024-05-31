@extends('layouts.single')

@section('head-links')
@endsection

@section('content-title')
    Register New Voter
@endsection

@section('body-content')
    <form action="{{ route('voters.store') }}" class="needs-validation" method="post" novalidate>
        {{-- for validation --}}
        @csrf

        <div class="row g-2 justify-content-center mb-3">
            <div class="col-12 text-center ">
                <h2>Choose you're School Level</h2>
            </div>
            <div class="col-md-2">
                <input type="radio" name="school_level" id="College" value="College" class="btn-check" required>
                <label class="btn btn-outline-primary w-100 " for="College">College</label>
            </div>
            <div class="col-md-2">
                <input type="radio" name="school_level" id="Senior_High" value="Senior High" class="btn-check" required>
                <label class="btn btn-outline-primary w-100 " for="Senior_High">Senior High</label>
            </div>
        </div>

        <div class="" id='CourseAndYearArea'>
        </div>

        <div class="row g-2 justify-content-center mb-3">
            <div class="col-12 text-center ">
                <h2>Enter your USN</h2>
            </div>
            <div class="col-md-8">
                {{-- <label for="usn_or_lrn" class="form-label">USN</label> --}}
                <div class="row g-2">
                    <div class="col"><input type="text" class="form-control" id="usn_or_lrn" name="usn_or_lrn"
                            required>
                        <div class="invalid-feedback">
                            Please provide a valid USN or LRN.
                        </div>
                    </div>
                    <div class="col-auto">
                        <button type="button" class="btn btn-primary" id="UsnCheck">Check</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="IndividualRecordsArea">

        </div>

        {{-- account --}}
        <div class="row g-2 justify-content-center mb-1">
            <div class="col-12 text-center ">
                <h2>Enter your Username and Password</h2>
            </div>

            <div class="col-md-8">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="" autocomplete="true"
                    required>
                <div class="invalid-feedback">
                    Please choose a username.
                </div>
            </div>
        </div>

        <div class="row g-2 justify-content-center mb-3">
            <div class="col-md-4">
                <div class="form-floating">
                    <input type="password" class="form-control" id="password" placeholder="Password" name="password"
                        required>
                    <label for="password">Password</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-floating">
                    <input type="password" class="form-control" id="password_confirmation" placeholder="Confirm Password"
                        name="password_confirmation" required>
                    <label for="password">Confirm Password</label>
                </div>
            </div>
        </div>

        <div class=" d-flex justify-content-center ">
            <button type="submit" class="btn btn-primary mt-3">Next</button>
        </div>
    </form>
@endsection

@section('body-links')
    {{-- ajax script --}}
    <script type="module">
        $('#College').on('change', function() {
            var $value = $(this).val();
            // console.log($value)
            get_output("{{ url('course_and_year') }}", {
                'school_level': $value,
            }, "CourseAndYearArea");
        });
        $('#Senior_High').on('change', function() {
            var $value = $(this).val();
            // console.log($value)
            get_output("{{ url('course_and_year') }}", {
                'school_level': $value,
            }, "CourseAndYearArea");
        });

        // let first_name;
        // let mid_name;
        // let last_name;

        $('#UsnCheck').on('click', function() {
            var $value = $('#usn_or_lrn').val();
            // console.log($value)
            get_output("{{ url('usn_and_name') }}", {
                'usn': $value,
            }, "IndividualRecordsArea");

            // get the elements of the name
            // first_name = $('#first_name');
            // mid_name = $('#mid_name');
            // last_name = $('#last_name');

            // console.log(first_name);
        });

        // ajax search function
        function get_output(_url, _data, outputElem) {
            // console.log($search_key)
            $.ajax({
                url: _url,
                type: "GET",
                data: _data,
                success: function(data) {
                    $('#' + outputElem).html(data);
                }
            })
        }
    </script>
@endsection
