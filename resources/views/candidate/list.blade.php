@extends('layouts.app')

@section('head-links')
    <style>
        .img-obj-fill {
            object-fit: cover;
        }

        .img-fluid {
            max-width: 100%;
            /* height: auto; */
            object-fit: cover;
        }
    </style>
@endsection

@section('body-content')
    <div class="container">
        <div class="pagetitle">
            <h1>List of Candidate</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Candidate</a></li>
                    <li class="breadcrumb-item active">Candidate List</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        {{-- alert --}}
        @include('components.alert')

        <section class="section">
            <ul class="nav nav-tabs d-flex" id="myTabjustified" role="tablist">
                {{-- list of positions --}}
                @for ($i = 0; $i < $positions->count(); $i++)
                    {{-- @forelse ($positions as $position) --}}
                    @if ($i == 0)
                        <li class="nav-item flex-fill" role="presentation">
                            <button class="nav-link w-100 active" id="home-tab" data-bs-toggle="tab"
                                data-bs-target="#tab{{ $i }}-justified" type="button" role="tab"
                                aria-controls="{{ $i }}" aria-selected="true">{{ $positions[$i]->name }}</button>
                        </li>
                    @else
                        <li class="nav-item flex-fill" role="presentation">
                            <button class="nav-link w-100" id="home-tab" data-bs-toggle="tab"
                                data-bs-target="#tab{{ $i }}-justified" type="button" role="tab"
                                aria-controls="{{ $i }}"
                                aria-selected="false">{{ $positions[$i]->name }}</button>
                        </li>
                    @endif
                    {{-- @empty
                        <li class="nav-item flex-fill" role="presentation">
                            <button class="nav-link w-100 active" id="home-tab" data-bs-toggle="tab" data-bs-target="#"
                                type="button" role="tab" aria-controls="home" aria-selected="true">No Position</button>
                        </li> --}}
                    {{-- @endforelse --}}
                @endfor
            </ul>
            <div class="tab-content pt-3" id="myTabjustifiedContent">
                {{-- list of candidates by position --}}
                @for ($i = 0; $i < $positions->count(); $i++)
                    {{-- @foreach ($positions as $position) --}}
                    @if ($i == 0)
                        <div class="tab-pane fade show active pt-3" id="tab{{ $i }}-justified" role="tabpanel"
                            aria-labelledby="home-tab">
                            <div class="row justify-content-center g-2">
                                {{-- get the cadidate belong to this position --}}
                                @forelse ($candidates as $candidate)
                                    @if ($candidate->position == $positions[$i]->name)
                                        <div class="col-md-6">
                                            @include('components.card-candidate')
                                        </div>
                                    @endif
                                @empty
                                    <div class="col-md-6">
                                        <div class="card mb-3 shadow  text-center">
                                            <div class="card-body">
                                                <h5 class="card-title text-muted">
                                                    No Candidate listed
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    @else
                        <div class="tab-pane fade pt-3" id="tab{{ $i }}-justified" role="tabpanel"
                            aria-labelledby="home-tab">
                            <div class="row justify-content-center g-2">
                                {{-- get the cadidate belong to this position --}}
                                @forelse ($candidates as $candidate)
                                    @if ($candidate->position == $positions[$i]->name)
                                        <div class="col-md-6">
                                            @include('components.card-candidate')
                                        </div>
                                    @endif
                                @empty
                                    <div class="col-md-6">
                                        <div class="card mb-3 shadow  text-center">
                                            <div class="card-body">
                                                <h5 class="card-title text-muted">
                                                    No Candidate listed
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    @endif
                    {{-- @endforeach --}}
                @endfor
            </div>


        </section>
    @endsection
