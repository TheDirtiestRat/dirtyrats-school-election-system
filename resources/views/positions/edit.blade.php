@extends('layouts.app')

@section('body-content')
    <div class="container">
        <div class="pagetitle">
            <h1>Positions</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Position</a></li>
                    <li class="breadcrumb-item active">Edit Position</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        {{-- alert --}}
        @include('components.alert')

        <section class="section">
            <ul class="nav nav-tabs d-flex" id="myTabjustified" role="tablist">
                <li class="nav-item flex-fill" role="presentation">
                    <button class="nav-link w-100 active" id="home-tab" data-bs-toggle="tab"
                        data-bs-target="#home-justified" type="button" role="tab" aria-controls="home"
                        aria-selected="true">Edit
                        Position</button>
                </li>
            </ul>
            <div class="tab-content pt-3" id="myTabjustifiedContent">
                <div class="tab-pane fade show active pt-3" id="home-justified" role="tabpanel" aria-labelledby="home-tab">
                    {{-- form to edit position --}}
                    <form action="{{ route('positions.update', $position->id) }}" method="POST" class="row g-3 needs-validation" novalidate>
                        {{-- for validation --}}
                        @csrf
                        @method('PUT')

                        <div class="col">
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="floatingName"
                                            placeholder="Candidate Name" name="name" value="{{ $position->name }}" required>
                                        <label for="floatingName">Positin name</label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <textarea class="form-control" placeholder="Description" id="floatingTextarea" style="height: 150px;" name="description" required>{{ $position->description }}</textarea>
                                        <label for="floatingTextarea">Description</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade pt-3" id="profile-justified" role="tabpanel" aria-labelledby="profile-tab">
                    
                </div>

            </div>


        </section>
    @endsection
