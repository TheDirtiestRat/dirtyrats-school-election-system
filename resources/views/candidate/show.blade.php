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
        <h1>Candidate</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Candidate</a></li>
                <li class="breadcrumb-item active">Candidate Details</li>
            </ol>
        </nav>
    </div>
    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">

                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column text-center align-items-center">

                        <img src="{{ asset('storage/candidate img/'. $candidate->photo) }}" alt="Profile" class="rounded-4 img-obj-fill">
                        <h2 class="">{{ $candidate->name }}</h2>
                        <h3>{{ $candidate->position }}</h3>
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
                                <a href="{{ route('candidates.edit', $candidate->id) }}" class=" text-decoration-none">
                                    <button class="nav-link">Edit Candidate</button>  
                                </a>  
                            </li>

                        </ul>
                        <div class="tab-content pt-2">

                            <div class="tab-pane fade show active profile-overview" id="profile-overview">

                                <h5 class="card-title">Profile Details</h5>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Full Name</div>
                                    <div class="col-lg-9 col-md-8">{{ $candidate->name }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Course or Strand</div>
                                    <div class="col-lg-9 col-md-8">{{ $candidate->course_Or_strand }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">School Level</div>
                                    <div class="col-lg-9 col-md-8">{{ $candidate->school_level }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">PartyList</div>
                                    <div class="col-lg-9 col-md-8">{{ $candidate->partylist }}</div>
                                </div>

                            </div>

                        </div><!-- End Bordered Tabs -->

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
