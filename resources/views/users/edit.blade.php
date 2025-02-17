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
            <h1>Edit new User</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">User</a></li>
                    <li class="breadcrumb-item active">Edit User</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        {{-- alert --}}
        @include('components.alert')

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">User Form</h5>

                <!-- Floating Labels Form -->
                <form class="row g-3 align-items-center needs-validation" action="{{ route('user.update', $user->id) }}"
                    method="POST" novalidate>
                    {{-- for validation --}}
                    @csrf
                    @method('PUT')

                    <div class="col">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="floatingName" placeholder="User Name"
                                        name="name" value="{{ $user->name }}" required>
                                    <label for="floatingName">Username</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="email" placeholder="Email"
                                        name="email" value="{{ $user->email }}" required>
                                    <label for="email">Email</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select class="form-select" id="user_type" aria-label="State" name="user_type" required>
                                        <option selected disabled value="">Select Type</option>
                                        <option value="VOTER">Voter</option>

                                        @if (Auth::user()->type == 'ADMIN')
                                            <option value="ADMIN">Admin</option>
                                            <option value="VIEW">Viewer</option>
                                            <option value="REGISTER">Register</option>
                                            <option value="SCANNER">Scanner</option>
                                        @endif

                                    </select>
                                    <label for="user_type">User Type</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="password" class="form-control" id="password" placeholder="Password"
                                        name="password" required>
                                    <label for="password">New Password</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="password" class="form-control" id="password_confirmation"
                                        placeholder="Password" name="password_confirmation" required>
                                    <label for="password">Confirm Password</label>
                                </div>
                            </div>
                            {{-- <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="password" class="form-control" id="new_password" placeholder="New Password"
                                        name="new_password">
                                    <label for="password">New Password</label>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </form><!-- End floating Labels Form -->

            </div>
        </div>
    </div>

    {{-- for the select input values --}}
    <script>
        document.getElementById('user_type').value = '{{ $user->type }}';
    </script>
@endsection
