@extends('layouts.app')

@section('head-links')
    <link href="{{ asset('storage/assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">
@endsection

@section('body-content')
    <div class="container">
        <div class="pagetitle">
            <h1>Import Voters</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Voters</a></li>
                    <li class="breadcrumb-item active">Import List</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        {{-- alert --}}
        @include('components.alert')

        <section class="section">
            <div class="row g-2">
                <div class="col-lg-12">
                    <div class="card rounded ">
                        <div class="card-body overflow-auto">
                            <h5 class="card-title">Registered</h5>
                            <div class="row">
                                <div class="col">
                                    <p>This where you import Voters in the System using CSV.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <form action="{{ url('Import') }}" method="post" class="needs-validations row g-2"
                        enctype="multipart/form-data" novalidat>
                        {{-- for validation --}}
                        @csrf
                        <div class="input-group col-md">
                            <input type="file" class="form-control" name="file" accept=".csv" id="inputGroupFile02"
                                required>
                            <label class="input-group-text" for="inputGroupFile02">Upload CSV File</label>
                        </div>

                        <div class="col-md-auto">
                            <button class="btn btn-primary w-100" type="submit">
                                Import
                            </button>
                        </div>
                    </form>
                </div>
                <div class="col-12">
                    <div class="alert alert-warning rounded-3" role="alert">
                        <h4 class="alert-heading">Note *</h4>
                        <p>When Import CSV data from excel make sure that the column squence is the same as these.</p>
                        <ol>
                            <li>USN</li>
                            <li>Fist name</li>
                            <li>Middle Name</li>
                            <li>Last Name</li>
                            <li>School Level</li>
                            <li>Course</li>
                            <li>Year</li>
                            <li>Section</li>
                            <li>House</li>
                        </ol>
                        <hr>
                        <p class="mb-0">Having the Columns not the same as the database may lead to errors in importing
                            the data
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('body-links')
    <script src="{{ asset('storage/assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
@endsection
