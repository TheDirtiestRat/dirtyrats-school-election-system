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
            <h1>Update Candidate</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Candidate</a></li>
                    <li class="breadcrumb-item active">Update Candidate</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        {{-- alert --}}
        @include('components.alert')

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Candidate Form</h5>

                <!-- Floating Labels Form -->
                <form class="row g-3 align-items-center needs-validation"
                    action="{{ route('candidates.update', $candidate->id) }}" enctype="multipart/form-data" method="POST"
                    novalidate>
                    {{-- for validation --}}
                    @csrf
                    @method('PUT')

                    <div class="col-md-auto">
                        <div class="column g-1">
                            <div class="col-auto text-center">
                                <label for="file" class="form-label d-block ">Candidate Photo</label>
                                <img src="{{ asset('storage/candidate img/' . $candidate->photo) }}"
                                    class="img-obj-fill border rounded-4 shadow mb-2" alt="" id="outputImage"
                                    width="180px" height="180px">
                            </div>
                            <div class="col">
                                <label for="inputNumber" class="form-label">File Upload</label>
                                <input class="form-control" type="file" id="formFile" accept="image/*" name="photo"
                                    id="file" onchange="loadFile(event)">
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="floatingName"
                                        placeholder="Candidate Name" name="name" value="{{ $candidate->name }}" required>
                                    <label for="floatingName">Candidate Name</label>
                                </div>
                            </div>
                            {{-- <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="floatingEmail"
                                        placeholder="Course / Strand" name="couseOrstrand" required>
                                    <label for="floatingEmail">Position</label>
                                </div>
                            </div> --}}
                            {{-- <div class="col-md-6">
                                <div class="form-floating">
                                    <select class="form-select" id="floatingSelect" aria-label="State" name="school_level"
                                        required>
                                        <option value="4">College 4th</option>
                                        <option value="3">College 3rd</option>
                                        <option value="2">College 2nd</option>
                                        <option value="2">College 1nd</option>

                                        <option value="2">Senior High 2nd</option>
                                        <option value="1">Senior High 1nd</option>
                                    </select>
                                    <label for="floatingSelect">School Level</label>
                                </div>
                            </div> --}}
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="floatingTextarea"
                                        placeholder="Partylist Title" name="partylist" value="{{ $candidate->partylist }}"
                                        required>
                                    <label for="floatingTextarea">Party List</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating mb-3">
                                    <select class="form-select" aria-label="State" name="position" id="position"
                                        required>
                                        @forelse ($positions as $position)
                                            <option value="{{ $position->name }}">{{ $position->name }}</option>
                                        @empty
                                            <option selected disabled value="">No position</option>
                                            {{-- <option selected disabled><span class="text-muted">No position</span></option> --}}
                                        @endforelse
                                    </select>
                                    <label for="position">Position to Run</label>
                                </div>
                            </div>
                            <div class="col-12 text-center">
                                <button class="btn btn-primary" onclick="add_new_criteria()" type="button">
                                    Add Info
                                </button>
                            </div>
                            <div class="col-12">
                                {{-- criteria list --}}
                                <div class="col-12" id="criteria_list">
                                    @for ($i = 0; $i < count($infos); $i++)
                                        <div class="row g-1 " id="criteria{{ $i }}">
                                            <div class="col-md-auto">
                                                <label for="kind{{ $i }}" class="form-label">Kind</label>
                                                <input type="text" class="form-control" placeholder="Fetish Haha"
                                                    name="kind[]" id="kind{{ $i }}"
                                                    value="{{ $infos[$i]->kind }}" required>
                                            </div>
                                            <div class="col-md">
                                                <label for="info{{ $i }}" class="form-label">Information</label>
                                                <input type="text" class="form-control" placeholder="I like feet stuff"
                                                    name="info[]" id="info{{ $i }}"
                                                    value="{{ $infos[$i]->info }}" required>
                                            </div>
                                            <div class="col-md-auto">
                                                <label for="btn{{ $i }}" class="form-label">Remove</label>
                                                <button class="btn btn-danger w-100" id="btn{{ $i }}"
                                                    onclick="remove_criteria('criteria{{ $i }}')"
                                                    type="button">
                                                    <i class="bi bi-trash3"></i>
                                                </button>
                                            </div>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Update</button>
                        {{-- <button type="reset" class="btn btn-secondary">Reset</button> --}}
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- for the select input values --}}
    <script>
        // document.getElementById('school_level').value = '{{ $candidate->school_level }}';
        document.getElementById('position').value = '{{ $candidate->position }}';
    </script>
    <!-- image display script -->
    <script>
        var loadFile = function(event) {
            var image = document.getElementById('outputImage');
            image.src = URL.createObjectURL(event.target.files[0]);
        };
    </script>
    {{-- add candidata extra info --}}
    <script>
        const list = document.getElementById('criteria_list');
        var index = 0;

        function add_new_criteria() {
            index++;

            // create the new element
            const cri = document.createElement("div");
            cri.classList.add('row');
            cri.classList.add('mb-1');
            cri.id = "criteria" + index;
            cri.innerHTML = `<div class="col-md-auto">
                    <label for="kind` + index + `" class="form-label">Kind</label>
                    <input type="text" class="form-control" placeholder="Fetish Haha" name="kind[]"
                        id="kind` + index + `" value="" required>
                </div>
                <div class="col-md">
                    <label for="points` + index + `" class="form-label">Information</label>
                    <input type="text" class="form-control" placeholder="I like feet stuff" name="info[]" id="info` +
                index + `" value="" required>
                </div>
                <div class="col-md-auto">
                    <label for="btn` + index + `" class="form-label">Remove</label>
                    <button class="btn btn-danger w-100" id="btn` + index + `" onclick="remove_criteria('criteria` +
                index + `')" type="button">
                        <i class="bi bi-trash3"></i>
                    </button>
                </div>`;

            // add the new element
            list.appendChild(cri);
        }

        function remove_criteria(id) {
            const criteria = document.getElementById(id);
            // criteria.remove();

            // remove the element
            list.removeChild(criteria);
        }
    </script>
@endsection
