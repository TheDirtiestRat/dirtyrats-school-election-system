@extends('layouts.app')

@section('head-links')
    <style>
        .img-obj-fill {
            object-fit: cover;
        }
    </style>
@endsection

@section('body-content')
    <div class="container">
        <div class="pagetitle">
            <h1>Create new User</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">User</a></li>
                    <li class="breadcrumb-item active">Create User</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        {{-- alert --}}
        @include('components.alert')

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">User Form</h5>

                <!-- Floating Labels Form -->
                <form class="row g-3 align-items-center needs-validation" action="{{ route('user.store') }}" method="POST"
                    novalidate>
                    {{-- for validation --}}
                    @csrf

                    <div class="col">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="floatingName" placeholder="User Name"
                                        name="name" required>
                                    <label for="floatingName">Username</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="email" placeholder="Email"
                                        name="email" required>
                                    <label for="email">Email</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select class="form-select" id="user_type" aria-label="State" name="user_type" required>
                                        <option selected disabled value="">Select Type</option>
                                        <option value="VIEW">Viewer</option>
                                        <option value="REGISTER">Register</option>
                                        <option value="SCANNER">Scanner</option>
                                    </select>
                                    <label for="user_type">User Type</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="password" class="form-control" id="password" placeholder="Password"
                                        name="password" required>
                                    <label for="password">Password</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="password" class="form-control" id="password_confirmation" placeholder="Confirm Password"
                                        name="password_confirmation" required>
                                    <label for="password">Confirm Password</label>
                                </div>
                            </div>
                            {{-- <div class="col-12">
                                <div class="form-floating">
                                    <input type="password" class="form-control" id="new_password" placeholder="New Password"
                                        name="new_password">
                                    <label for="password">New Password</label>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Add</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </form><!-- End floating Labels Form -->

            </div>
        </div>
    </div>
@endsection
