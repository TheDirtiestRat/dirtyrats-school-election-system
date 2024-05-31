@extends('layouts.app')

@section('head-links')
@endsection

@section('body-content')
    <div class="container">
        <div class="pagetitle">
            <h1>Configuration</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Settings</a></li>
                    <li class="breadcrumb-item active">Configuration</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        {{-- alert --}}
        @include('components.alert')

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body overflow-auto">
                            <h5 class="card-title">Update Configuration</h5>

                            {{-- initialized config --}}
                            @php
                                $can_register = ($can_register->value == 1) ? 'checked' : '';
                                $can_vote = ($can_vote->value == 1) ? 'checked' : '';
                            @endphp

                            <form class="row g-3 needs-validation" action="{{ route('updateConfig') }}"
                                method="POST" novalidate>
                                {{-- for validation --}}
                                @csrf
                                {{-- @method('PUT') --}}

                                <div class="col-md-auto">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="can_register" name="can_register" value="1" {{ $can_register }}>
                                        <label class="form-check-label" for="can_register">Open
                                            Registration</label>
                                    </div>
                                </div>
                                <div class="col-md-auto">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="can_vote" name="can_vote" value="1" {{ $can_vote }}>
                                        <label class="form-check-label" for="can_vote">Voters Can Vote</label>
                                    </div>
                                </div>

                                <div class="col-12 w-100 ">
                                    <button class="btn btn-primary" type="submit">Update</button>
                                </div>
                            </form>

                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>
@endsection

@section('body-links')
@endsection
