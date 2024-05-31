<div class="card shadow h-100">
    <div class="row h-100">
        <div class="col-md-4">
            <img src="{{ asset('storage/candidate img/' . $candidate->photo) }}" class="img-fluid rounded h-100 w-100"
                alt="...">
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title">
                    {{ $candidate->name }}
                </h5>
                {{ $candidate->partylist }}
                {{-- <p class="card-text m-0">School :
                    {{ $candidate->partylist }}</p>
                <p class="card-text"><small class="text-body-secondary">Position :
                        {{ $candidate->course_Or_strand }}</small> --}}
                </p>
                <div class="row g-2 w-100">
                    {{-- get the scores if already submitted --}}
                    @php
                        $voted_can = [];
                        foreach ($voted_candidates as $key => $value) {
                            if ($value->candidate == $candidate->id) {
                                $voted_can = $value;
                            }
                        }
                    @endphp
                    {{-- check by voted candidates --}}
                    @if ($voted_can == null)
                        @if ($c_total < 2)
                            <div class="col">
                                <input type="radio" class="btn-check" id="{{ $candidate->id . $candidate->name }}"
                                    name="{{ $positions[$i]->name }}[]" value="{{ $voter_id }}/{{ $candidate->id }}/YES"
                                    autocomplete="off" onclick="count_vote()">
                                <label class="btn btn-outline-primary rounded-3 w-100"
                                    for="{{ $candidate->id . $candidate->name }}">Yes</label>
                            </div>
                            <div class="col">
                                <input type="radio" class="btn-check" id="{{ $candidate->id . $candidate->name }}2"
                                    name="{{ $positions[$i]->name }}[]" value="{{ $voter_id }}/{{ $candidate->id }}/NO"
                                    autocomplete="off" onclick="count_vote()">
                                <label class="btn btn-outline-secondary rounded-3 w-100"
                                    for="{{ $candidate->id . $candidate->name }}2">No</label>
                            </div>
                        @else
                            <div class="col">
                                {{-- <input type="checkbox" class="btn-check" id="{{ $candidate->id . $candidate->name }}"
                                    name="{{ $positions[$i]->name }}[]" value="{{ $voter_id }}/{{ $candidate->id }}"
                                    autocomplete="off" onclick="count_vote()"> --}}
                                <input type="radio" class="btn-check" id="{{ $candidate->id . $candidate->name }}"
                                    name="{{ $positions[$i]->name }}[]"
                                    value="{{ $voter_id }}/{{ $candidate->id }}/YES" autocomplete="off"
                                    onclick="count_vote()">
                                <label class="btn btn-outline-primary rounded-3 w-100"
                                    for="{{ $candidate->id . $candidate->name }}">Vote Candidate</label>
                            </div>
                        @endif
                    @else
                        <div class="col">
                            <button type="button" class="btn btn-secondary w-100">Voted</button>
                        </div>
                    @endif

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
