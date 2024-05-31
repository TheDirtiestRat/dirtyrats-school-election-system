<div class="row g-2 justify-content-center mb-3">
    <div class="col-12 text-center ">
        <h2>Enter your Username and Password</h2>
    </div>

    <div class="col-md-8">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username"
            name="username" value="" autocomplete="true" required>
        <div class="invalid-feedback">
            Please choose a username.
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-floating">
            <input type="password" class="form-control" id="password" placeholder="Password"
                name="password" required>
            <label for="password">Password</label>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-floating">
            <input type="password" class="form-control" id="password_confirmation"
                placeholder="Confirm Password" name="password_confirmation" required>
            <label for="password">Confirm Password</label>
        </div>
    </div>
</div>
