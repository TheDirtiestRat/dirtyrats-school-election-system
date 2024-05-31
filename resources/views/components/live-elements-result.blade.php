<div class="d-flex flex-column gap-2 text-center h-100 ">
    <div class="text-bg-light shadow rounded-4 p-3">
        <div>
            <h1>Voters</h1>
            <h3 class=" display-3 ">{{ $registered_voters }}</h3>
        </div>
    </div>
    <div class=" text-bg-light shadow rounded-4 p-3">
        <h1>Voted</h1>
        <h3 class=" display-3 ">{{ $voted_voters }}</h3>
        <h5>{{ round(($voted_voters / $registered_voters) * 100, 2) }}%</h5>
    </div>
    <div class=" text-bg-light shadow rounded-4 p-3 h-100 overflow-auto ">
        <h1>Remaining</h1>
        <h3 class=" display-3 ">{{ $remaining_voters }}</h3>
        <h5>{{ round(($remaining_voters / $registered_voters) * 100, 2) }}%</h5>
    </div>
</div>
<div class="d-flex flex-row gap-2 h-100 overflow-auto">
    @for ($i = 0; $i < count($top_candidates); $i++)
        <div class="card rounded-4 shadow mb-0" style="min-width: 300px">
            <div class=" d-flex flex-column m-0 h-100 ">
                <img src="{{ asset('storage/candidate img/' . $top_candidates[$i]->photo) }}" alt="Candidate Img"
                    class="img-player rounded-top-4">
                <div class=" mb-0 mt-auto flex-column">

                    <div class="card-body text-center p-2">
                        <h5 class="card-title p-0 text-truncate">No.{{ $i + 1 }} {{ $top_candidates[$i]->name }}
                        </h5>
                        <h5 class="card-title p-0 ">{{ $top_candidates[$i]->total }} votes</h5>
                        {{-- yes or no votes --}}
                        @php
                            // yes or no of each candidates
                            $yes = [];
                            $no = [];
                            foreach ($agree_votes as $key => $value) {
                                if ($value->candidate == $top_candidates[$i]->id) {
                                    $yes = $value;
                                }
                            }
                            foreach ($disagree_votes as $key => $value) {
                                if ($value->candidate == $top_candidates[$i]->id) {
                                    $no = $value;
                                }
                            }
                        @endphp
                        <div class="d-flex justify-content-evenly text-muted">
                            <h3 class="m-0">
                                Yes
                                @if ($yes == null)
                                    0
                                @else
                                    {{ $yes->total }}
                                @endif
                            </h3>
                            <h3 class="m-0">
                                No
                                @if ($no == null)
                                    0
                                @else
                                    {{ $no->total }}
                                @endif
                            </h3>
                        </div>

                        <p class="card-text m-0 text-truncate">
                            {{ $top_candidates[$i]->position }}
                        </p>
                        <p class="card-text">
                            {{ $top_candidates[$i]->partylist }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @endfor
</div>
{{-- <div class=" text-bg-light shadow rounded-4 p-3 h-100 overflow-auto">
    <div class="col-12">
        <h1>Top Candidates</h1>
    </div> --}}
{{-- candidates

    <div class="row g-2">
        <div class="col-12">
            <h1>Top Candidates</h1>
        </div>
        @for ($i = 0; $i < count($top_candidates); $i++)
            <div class="col-md-2">
                <div class="card rounded-4 shadow m-0 h-100 ">
                    <img src="{{ asset('storage/candidate img/' . $top_candidates[$i]->photo) }}" alt="Candidate Img"
                        class="card-img-top">
                    <div class="card-body text-center p-2">
                        <h5 class="card-title p-0 text-truncate">No.{{ $i + 1 }} {{ $top_candidates[$i]->name }}</h5>
                        <h5 class="card-title p-0 ">{{ $top_candidates[$i]->total }} votes</h5>
                        <p class="card-text m-0 text-truncate">
                            {{ $top_candidates[$i]->position }}
                        </p>
                        <p class="card-text">
                            {{ $top_candidates[$i]->partylist }}
                        </p>
                    </div>
                </div>
            </div>
        @endfor
    </div>
</div> --}}
