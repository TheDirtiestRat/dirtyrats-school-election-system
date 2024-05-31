@extends('layouts.app')

@section('head-links')
    <style>
        .img-obj-fill {
            object-fit: cover;
        }

        .img-fluid {
            max-width: 100%;
            height: auto;
            object-fit: cover;
        }

        .vote_counter {
            position: fixed;
            visibility: hidden;
            opacity: 0;
            left: 15px;
            /* right: 15px; */
            bottom: 15px;
            z-index: 99999;
            background: #4154f1;
            width: auto;
            height: 40px;
            color: white;
            border-radius: 4px;
            transition: all 0.4s;
        }

        .vote_counter i {
            font-size: 24px;
            color: #fff;
            line-height: 0;
        }

        .vote_counter:hover {
            background: #6776f4;
            color: #fff;
        }

        .vote_counter.active {
            visibility: visible;
            opacity: 1;
        }
    </style>
@endsection

@section('body-content')
    <div class="container">
        <div class="pagetitle">
            <h1>Vote you're Candidate</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Vote</a></li>
                    <li class="breadcrumb-item active">Candidate Vote</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        {{-- alert --}}
        @include('components.alert')

        @if ($can_vote->value == 1 && !$is_voted)
            {{-- @if ($is_signed == true) --}}
            {{-- vote form --}}
            <form class="row g-3 align-items-center needs-validation" action="{{ route('storeVotedCandidates') }}"
                method="POST">
                {{-- for validation --}}
                @csrf

                <section class="section">
                    {{-- <ul class="nav nav-tabs d-flex" id="myTabjustified" role="tablist">
                        list of positions
                        @for ($i = 0; $i < $positions->count(); $i++)
                            @if ($i == 0)
                                <li class="nav-item flex-fill" role="presentation">
                                    <button class="nav-link w-100 active" id="home-tab" data-bs-toggle="tab"
                                        data-bs-target="#tab{{ $i }}-justified" type="button" role="tab"
                                        aria-controls="{{ $i }}"
                                        aria-selected="true">{{ $positions[$i]->name }}</button>
                                </li>
                            @else
                                <li class="nav-item flex-fill" role="presentation">
                                    <button class="nav-link w-100" id="home-tab" data-bs-toggle="tab"
                                        data-bs-target="#tab{{ $i }}-justified" type="button" role="tab"
                                        aria-controls="{{ $i }}"
                                        aria-selected="false">{{ $positions[$i]->name }}</button>
                                </li>
                            @endif
                        @endfor
                    </ul> --}}

                    <div class="tab-content pt-3" id="myTabjustifiedContent">
                        {{-- list of candidates by position --}}
                        @for ($i = 0; $i < $positions->count(); $i++)
                            {{-- total count of candidates in this position --}}
                            @foreach ($candidate_total as $can)
                                @if ($can->position == $positions[$i]->name)
                                    @php
                                        $c_total = $can->total;
                                    @endphp
                                @endif
                            @endforeach

                            {{-- @foreach ($positions as $position) --}}
                            {{-- @if ($i == 0) --}}
                            {{-- <div class="tab-pane fade show active pt-3" id="tab{{ $i }}-justified"
                                role="tabpanel" aria-labelledby="home-tab"> --}}
                            <div class="row justify-content-center g-2 mb-3">
                                <div class="col-12">
                                    <h1 class="text-center display-5 mt-3"><strong>{{ $positions[$i]->name }}</strong></h1>
                                    <hr>
                                </div>

                                {{-- get the cadidate belong to this position --}}
                                @forelse ($candidates as $candidate)
                                    @if ($candidate->position == $positions[$i]->name)
                                        <div class="col-md-6">
                                            @include('components.vote-card-candidate')
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
                            {{-- </div> --}}
                            {{-- @else
                                <div class="tab-pane fade pt-3" id="tab{{ $i }}-justified" role="tabpanel"
                                    aria-labelledby="home-tab">
                                    <div class="row justify-content-center g-2">
                                        @forelse ($candidates as $candidate)
                                            @if ($candidate->position == $positions[$i]->name)
                                                <div class="col-md-6">
                                                    @include('components.vote-card-candidate')
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
                            @endif --}}
                            {{-- @endforeach --}}
                        @endfor
                    </div>
                </section>

                <hr>

                {{-- submit button --}}
                <button type="submit" class="d-none" id="submitVotesFormBtn">Submit</button>
            </form>

            <div class="text-center">
                {{-- if not voted yet --}}
                @if ($is_voted)
                    <h2 class="text-muted">You have voted. Thank you for Voting!</h2>
                @else
                    {{-- submit button to trigger the modal --}}
                    <button type="button" class="btn btn-primary btn-lg" id="SubmitVotes" data-bs-toggle="modal"
                        data-bs-target="#Modal">Submit Vote</button>
                @endif
            </div>
            {{-- @else
                <h1 class="text-muted text-center">
                    Scan you QR code signature first to vote.
                </h1>
            @endif --}}
        @elseif ($is_voted)
            <div class="container text-center">
                <img src="{{ asset('storage/assets/img/not-found.svg') }}" class="" alt="..."
                    style="width: 300px">
                <h1 class="text-center">Thank you for Voting! <strong>{{ $voter->first_name }} {{ $voter->mid_name }}
                        {{ $voter->last_name }}</strong></h1>
            </div>
        @else
            <div class="text-center mt-4 mb-4">
                <h2>Voting is closed yet</h2>
            </div>
        @endif


        {{-- modal --}}
        <div class="modal fade" tabindex="-1" id="Modal">
            <div class="modal-dialog modal-dialog-centered text-dark">
                {{-- modal summary content --}}
                <div class="modal-content rounded-4">
                    <div class="modal-header">
                        <h5 class="modal-title">Submit Vote</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p class="text-center">
                            Are you sure <strong>about you're selection of candidates</strong>? review them first before
                            submitting.
                        </p>
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal"
                            onclick="submit_votes()">Accept</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- submits the form votes --}}
        <script>
            function submit_votes() {
                document.getElementById("submitVotesFormBtn").click();
            }
        </script>
    @endsection

    @section('body-links')
        <a href="#" class="vote_counter d-flex align-items-center justify-content-center p-2" id="vote_counter">
            Vote Count (0)
        </a>

        @if ($is_voted)
            {{-- execute script to log out the user in a certertain time --}}
            <script>
                const logout_btn = document.getElementById('logout_btn');
                start_timer()

                function start_timer() {
                    setTimeout(function() {
                        logout_btn.click();
                        console.log(logout_btn);
                    }, 120000);
                }
            </script>
        @endif

        {{-- on scroll fade vote counter --}}
        <script>
            const onscroll = (el, listener) => {
                el.addEventListener('scroll', listener)
            }

            let votecounter = document.getElementById('vote_counter');
            if (votecounter) {
                const toggleVoteCounter = () => {
                    if (window.scrollY > 100) {
                        votecounter.classList.add('active')
                    } else {
                        votecounter.classList.remove('active')
                    }
                }
                window.addEventListener('load', toggleVoteCounter)
                onscroll(document, toggleVoteCounter)
            }
        </script>

        {{-- count voted --}}
        <script>
            function count_vote() {
                var count = 0;
                var inElem = document.getElementsByTagName('input');

                for (let index = 0; index < inElem.length; index++) {
                    // const element = array[index];
                    if (inElem[index].type === "radio" && inElem[index].checked === true) {
                        count++;
                    }
                    // if (inElem[index].type === "checkbox" && inElem[index].checked === true) {
                    //     count++;
                    // }
                }

                votecounter.innerHTML = "Vote Count (" + count + ")";
            }
        </script>
    @endsection
