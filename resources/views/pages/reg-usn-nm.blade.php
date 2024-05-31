@if ($isExist)
    <div class="row g-2 justify-content-center">
        <div class="col-8 text-center text-muted ">
            <h3>USN is Already Taken</h3>
            <hr>
        </div>
    </div>
@else
    <div class="row g-2 justify-content-center mb-3">
        <div class="col-12 text-center ">
            <h2>Enter your Name</h2>
        </div>
        <div class="col-md-3">
            <label for="first_name" class="form-label">First name</label>
            <input type="text" class="form-control" id="first_name" name="first_name" value="" onkeyup=""
                required>
            <div class="valid-feedback">
                Looks good!
            </div>
        </div>
        <div class="col-md-2">
            <label for="mid_name" class="form-label">Middle name</label>
            <input type="text" class="form-control" id="mid_name" name="mid_name" value="">
            <div class="valid-feedback">
                Looks good!
            </div>
        </div>
        <div class="col-md-3">
            <label for="last_name" class="form-label">Last name</label>
            <input type="text" class="form-control" id="last_name" name="last_name" value="" required>
            <div class="valid-feedback">
                Looks good!
            </div>
        </div>
        <div class="col-md-8">
            <label for="last_name" class="form-label">Voter ID</label>
            <input type="text" class="form-control" id="voter_id" name="voter_id" value="{{ $voter_id }}"
                required readonly>
            <div class="valid-feedback">
                Looks good!
            </div>
        </div>
    </div>
@endif
