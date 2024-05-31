@extends('layouts.guest')

@section('head-links')
@endsection

@section('body-content')
    <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                    <div class="d-flex justify-content-center py-4">
                        <a href="index.html" class="logo d-flex align-items-center w-auto">
                            <img src="{{ asset('storage/assets/img/logo.png ') }}" alt="">
                            <span class="d-none d-lg-block">@include('components.app-name')</span>
                        </a>
                    </div><!-- End Logo -->

                    <div class="card mb-3 shadow">
                        <div class="card-body text-center">
                            <div class="pt-2 pb-2">
                                <h2 class="card-title text-center pb-0 fs-1">Thank you for registering!</h2>
                                <p class="text-center fs-3">Voter <strong>{{ $voter->first_name }} {{ $voter->mid_name }} {{ $voter->last_name }} </strong> ({{ $voter->voter_id }})</p>
                                {{-- <p class="text-center small">Username: {{ $voter->name }}</p> --}}
                            </div>

                            <a href="{{ url('/') }}" class="btn btn-primary m-3" type="button">Home Page</a>
                        </div>
                    </div>

                    <div class="credits">
                        Developed by <a href="https://www.tiktok.com/@thedirtiestrat">Mr. Dirtiest Rat</a>
                    </div>

                </div>
            </div>
        </div>

    </section>
@endsection

@section('body-links')
@endsection
