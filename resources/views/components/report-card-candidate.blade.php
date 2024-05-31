<div class="card shadow h-100">
    <div class="row h-100">
        <div class="col-md-4">
            <img src="{{ asset('storage/candidate img/' . $candidate->photo) }}" class="img-fluid rounded h-100 w-100"
                alt="...">
        </div>
        <div class="col-md-8">
            <div class="card-body p-0 h-100">
                <div class="row g-2 h-100">
                    <div class="col p-3">
                        <h5 class="card-title m-0">
                            <a href="{{ route('candidates.show', $candidate->id) }}"
                                class=" text-decoration-none">{{ $candidate->name }}</a>
                        </h5>
                        {{-- <p class="card-text m-0">Partylist : --}}
                        {{ $candidate->partylist }}
                        {{-- </p> --}}
                        {{-- <p class="card-text"><small class="text-body-secondary">Course/Strand :
                                {{ $candidate->course_Or_strand }}</small>
                        </p> --}}
                    </div>
                    <div class="col">
                        <div class="row row-cols-1 g-2 w-100 h-100 text-center align-items-center">
                            @php
                                $vote = [];
                                // votes for each candidates
                                foreach ($votes as $key => $value) {
                                    if ($value->candidate == $candidate->id) {
                                        $vote = $value;
                                    }
                                }
                                // yes or no of each candidates
                                $yes = [];
                                $no = [];
                                foreach ($agree_votes as $key => $value) {
                                    if ($value->candidate == $candidate->id) {
                                        $yes = $value;
                                    }
                                }
                                foreach ($disagree_votes as $key => $value) {
                                    if ($value->candidate == $candidate->id) {
                                        $no = $value;
                                    }
                                }
                            @endphp
                            <div class="col m-0">
                                <h1 class="text-primary m-1">
                                    @if ($vote == null)
                                        %00
                                    @else
                                        %{{ round(($vote->total / $registered_voters) * 100, 2) }}
                                    @endif
                                </h1>
                                <p class="m-0 text-muted fs-3 ">
                                    @if ($vote == null)
                                        00
                                    @else
                                        {{ $vote->total }}
                                    @endif
                                </p>
                                <div class="d-flex justify-content-evenly text-muted">
                                    <h3 class="m-0">
                                        Yes
                                        @if ($yes == null)
                                            -
                                        @else
                                            {{ $yes->total }}
                                        @endif
                                    </h3>
                                    <h3 class="m-0">
                                        No
                                        @if ($no == null)
                                            -
                                        @else
                                            {{ $no->total }}
                                        @endif
                                    </h3>
                                </div>
                            </div>

                        </div>
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
        <div class="col p-3 d-flex align-items-center ">
            <input class="form-check-input radio shadow" type="radio" name="{{ $positions[$i]->name }}[]" id="{{ $candidate->id . $candidate->name }}" value="{{ $voter->voter_id }}/{{ $candidate->name }}/{{ $candidate->position }}/{{ $candidate->partylist }}" placeholder="Vote"> --}}
{{-- <label class="form-check-label" for="gridRadios1">
                First radio
            </label> --}}
{{-- <button type="radio" class="btn btn-outline-primary radio w-100">Vote</button> --}}
{{-- </div>
    </div>
</div> --}}


{{-- <div class="card shadow h-100">
    <div class="row h-100">
        <div class="col-md-4">
            <img src="{{ asset('storage/candidate img/' . $candidate->photo) }}" class="img-obj-fill rounded-start"
                class="img-fluid rounded h-100 w-100" alt="...">
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <div class="row g-2">
                    <div class="col">
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
                    <div class="col">
                        <div class="row row-cols-1 g-2 w-100 text-center">
                            @php
                                $vote = [];

                                foreach ($votes as $key => $value) {
                                    if ($value->candidate == $candidate->id) {
                                        $vote = $value;
                                    }
                                }
                            @endphp
                            <div class="col">
                                <h1 class="text-primary m-1">
                                    @if ($vote == null)
                                        %00
                                    @else
                                        %{{ round(($vote->total / $registered_voters) * 100, 2) }}
                                    @endif
                                </h1>
                            </div>
                            <div class="col m-0">
                                <p class="m-0 text-muted">
                                    @if ($vote == null)
                                        000
                                    @else
                                        {{ $vote->total }}
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        
    </div>
</div> --}}
