<div class="card shadow h-100">
    <div class="row h-100">
        <div class="col-md-4">
            <img src="{{ asset('storage/candidate img/' . $candidate->photo) }}" class="img-fluid rounded h-100 w-100"
                alt="...">
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title">
                    <a href="{{ route('candidates.show', $candidate->id) }}" class="text-decoration-none text-dark">
                        {{ $candidate->name }}
                    </a>
                </h5>
                <div class="mb-3">
                    {{-- list of infos --}}
                    @foreach ($infos as $info)
                        @if ($info->candidate_id == $candidate->id)
                            <div class="row g-1">
                                <div class="col-auto"><strong>{{ $info->kind }} :</strong></div>
                                <div class="col">{{ $info->info }}</div>
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="row row-cols-1 g-2 w-100">
                    <div class="col">
                        <a href="{{ route('candidates.edit', $candidate->id) }}" class=" text-decoration-none">
                            <button type="button" class="btn btn-outline-secondary w-100 ">Edit</button>
                        </a>
                    </div>
                    <div class="col">
                        {{-- data deletion form --}}
                        <form action="{{ route('candidates.destroy', $candidate->id) }}" method="post"
                            class="text-decoration-none w-100 ">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger w-100 ">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- <div class="card mb-3">
    <div class="row g-0">
        <div class="col-auto">
            <img src="{{ asset('storage/candidate img/' . $candidate->photo) }}" class="img-obj-fill rounded-start"
                width="150px" height="150px" alt="...">
        </div>
        <div class="col-auto">
            <div class="card-body">
                <h5 class="card-title m-0">
                    <a href="{{ route('candidates.show', $candidate->id) }}"
                        class=" text-decoration-none">{{ $candidate->name }}</a>
                </h5>
                <p class="card-text m-0">Partylist :
                    {{ $candidate->partylist }}</p>
                <p class="card-text"><small class="text-body-secondary">Course/Strand :
                        {{ $candidate->course_Or_strand }}</small>
                </p>
            </div>
        </div>
        <div class="col p-3 d-flex align-items-center">
            <div class="row row-cols-1 g-2 w-100 ">
                <div class="col">
                    <a href="{{ route('candidates.edit', $candidate->id) }}" class=" text-decoration-none">
                        <button type="button" class="btn btn-outline-secondary w-100 ">Edit</button>
                    </a>
                </div>
                <div class="col">
                    <form action="{{ route('candidates.destroy', $candidate->id) }}" method="post"
                        class="text-decoration-none w-100 ">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger w-100 ">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
