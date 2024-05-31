@extends('layouts.app')

@section('head-links')
    <style>
        .img-obj-fill {
            object-fit: cover;
        }
    </style>
@endsection

@section('body-content')
    <div class="pagetitle">
        <h1>User</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">User</a></li>
                <li class="breadcrumb-item active">User Details</li>
            </ol>
        </nav>
    </div>
    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">

                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column text-center align-items-center">

                        {{-- <img src="{{ asset('storage/User img/' . $User->photo) }}" alt="Profile"
                            class="rounded-4 img-obj-fill"> --}}
                        <h2 class="">{{ $user->name }}</h2>
                        <h3>{{ $user->type }}</h3>
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
                                <a href="{{ route('user.edit', $user->id) }}" class=" text-decoration-none">
                                    <button class="nav-link">Edit User</button>
                                </a>
                            </li>
                            {{-- for the voters --}}
                            {{-- @if (Auth::user()->type == 'VOTER')
                                <li class="nav-item">
                                    <a href="{{ route('qrcodeID', $voter->id) }}" class="nav-link" target="_blank">QR Code
                                        ID</a>
                                </li>
                            @endif --}}
                        </ul>
                        <div class="tab-content pt-2">

                            <div class="tab-pane fade show active profile-overview" id="profile-overview">

                                <h5 class="card-title">Profile Details</h5>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Full Name</div>
                                    <div class="col-lg-9 col-md-8">{{ $user->name }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Email</div>
                                    <div class="col-lg-9 col-md-8">{{ $user->email }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Created at</div>
                                    <div class="col-lg-9 col-md-8">{{ $user->created_at }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Updated at</div>
                                    <div class="col-lg-9 col-md-8">{{ $user->updated_at }}</div>
                                </div>
                            </div>
                        </div><!-- End Bordered Tabs -->
                    </div>
                </div>

                {{-- if its a voter, add the information here --}}
            </div>
        </div>
    </section>
@endsection
