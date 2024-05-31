@extends('layouts.app')

@section('body-content')
    <div class="container">
        <div class="pagetitle">
            <h1>Positions</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Position</a></li>
                    <li class="breadcrumb-item active">Position List</li>
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
                        aria-selected="true">List</button>
                </li>
                <li class="nav-item flex-fill" role="presentation">
                    <button class="nav-link w-100" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-justified"
                        type="button" role="tab" aria-controls="profile" aria-selected="false">Create New
                        Position</button>
                </li>
            </ul>
            <div class="tab-content pt-3" id="myTabjustifiedContent">
                <div class="tab-pane fade show active pt-3" id="home-justified" role="tabpanel" aria-labelledby="home-tab">
                    <div class="row justify-content-center g-2">
                        @forelse ($positions as $position)
                            {{-- card --}}
                            <div class="col-auto">
                                <div class="card mb-3">
                                    <div class="row g-0">
                                        <div class="col">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-auto">
                                                        <h5 class="card-title m-0">
                                                            <a href="{{ route('candidates.show', 0) }}"
                                                                class=" text-decoration-none">{{ $position->name }}</a>
                                                        </h5>
                                                        <p class="card-text m-0">Total : 
                                                            @foreach ($candidates as $can)
                                                                @if ($can->position == $position->name)
                                                                    {{ $can->total }}
                                                                @endif
                                                            @endforeach
                                                        </p>
                                                    </div>
                                                    <div class="col-12">
                                                        <a href="{{ route('positions.edit', $position->id) }}"
                                                            class=" text-decoration-none">
                                                            <button type="button"
                                                                class="btn btn-outline-secondary">Edit</button>
                                                        </a>
                                                        {{-- data deletion form --}}
                                                        <form action="{{ route('positions.destroy', $position->id) }}"
                                                            method="post" class=" text-decoration-none float-end">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-outline-danger">Delete</button>
                                                        </form>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-auto">
                                <div class="card mb-3">
                                    <div class="row g-0">
                                        <div class="col">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-auto">
                                                        <h5 class="card-title text-muted m-0">
                                                            No Position set Yet.
                                                        </h5>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endforelse
                        {{-- @for ($i = 0; $i < 10; $i++)
                            <div class="col-auto">
                                <div class="card mb-3">
                                    <div class="row g-0">
                                        <div class="col">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-auto">
                                                        <h5 class="card-title m-0">
                                                            <a href="{{ route('candidates.show', 0) }}"
                                                                class=" text-decoration-none">Name of The Postion</a>
                                                        </h5>
                                                        <p class="card-text m-0">Total : 99</p>
                                                        </p>
                                                    </div>
                                                    <div class="col-12">
                                                        <a href="{{ route('positions.edit', 0) }}"
                                                            class=" text-decoration-none">
                                                            <button type="button"
                                                                class="btn btn-outline-secondary">Edit</button>
                                                        </a>
                                                        <a href="{{ route('positions.destroy', 0) }}"
                                                            class=" text-decoration-none float-end">
                                                            <button type="button"
                                                                class="btn btn-outline-danger">Delete</button>
                                                        </a>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endfor --}}
                    </div>
                </div>
                <div class="tab-pane fade pt-3" id="profile-justified" role="tabpanel" aria-labelledby="profile-tab">
                    {{-- form to add new position --}}
                    <form action="{{ route('positions.store') }}" method="POST" class="row g-3 needs-validation"
                        novalidate>
                        {{-- for validation --}}
                        @csrf

                        <div class="col">
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="floatingName"
                                            placeholder="Candidate Name" name="name" required>
                                        <label for="floatingName">Positin name</label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <textarea class="form-control" placeholder="Address" id="floatingTextarea" style="height: 150px;" name="description"></textarea>
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

            </div>


        </section>
    @endsection
