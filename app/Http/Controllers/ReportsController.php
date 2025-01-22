<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;
use App\Models\VotedCandidate;
use App\Models\RegisteredVoter;
use App\Models\VotedVoter;
use App\Models\Position;
use App\Models\SignedVoter;
use Illuminate\Support\Facades\DB;

class ReportsController extends Controller
{
    public function dashboard()
    {
        // data here
        $registered_voters = RegisteredVoter::query()->get()->count();
        $voters_by_course = RegisteredVoter::query()->selectRaw('count(strand_or_course) as total, strand_or_course')->groupBy(['strand_or_course'])->get();
        $signed_voters = SignedVoter::query()->get()->count();
        $voted_voters = VotedVoter::query()->get()->count();
        $recent_voters = VotedVoter::query()->join('registered_voters', 'voted_voters.voter_id', '=', 'registered_voters.voter_id')->latest('voted_voters.created_at')->get();

        $voted_positions = VotedCandidate::query()->selectRaw('candidates.position, COUNT(candidates.position) AS total')->join('candidates', 'voted_candidates.candidate', '=', 'candidates.id')->groupByRaw('candidates.position')->get();
        $total_votes = VotedCandidate::query()->select('voter')->groupBy(['voter'])->get()->count();

        $reg_by_day = RegisteredVoter::query()->selectRaw('count(id) as total, created_at')->groupBy(['created_at'])->limit(7)->get();
        $sig_by_day = SignedVoter::query()->selectRaw('count(id) as total, created_at')->groupBy(['created_at'])->limit(7)->get();
        $vot_by_day = VotedCandidate::query()->selectRaw('count(id) as total, created_at')->groupBy(['created_at'])->limit(7)->get();

        $top_candidates = VotedCandidate::query()->selectRaw('candidates.name, candidates.position, candidates.photo, COUNT(candidates.name) AS total')->join('candidates', 'voted_candidates.candidate', '=', 'candidates.id')->groupByRaw('candidates.name, candidates.position, candidates.photo')->orderByDesc('total')->limit(5)->get();

        // dd($voters_by_course);

        return view('pages.dashboard', compact(
            'registered_voters',
            'voters_by_course',
            'signed_voters',
            'voted_voters',
            'recent_voters',

            'total_votes',
            'top_candidates',
            'voted_positions',

            'reg_by_day',
            'sig_by_day',
            'vot_by_day',
        ));
    }

    public function voters_reports()
    {
        // data here
        // data here
        $registered_voters = RegisteredVoter::query()->get()->count();
        $voters_by_course = RegisteredVoter::query()->selectRaw('count(strand_or_course) as total, strand_or_course')->groupBy(['strand_or_course'])->get();
        $signed_voters = 0;
        $voted_voters = VotedVoter::query()->get()->count();
        $recent_voters = VotedVoter::query()->join('registered_voters', 'voted_voters.voter_id', '=', 'registered_voters.voter_id')->latest('voted_voters.created_at')->limit(5)->get();

        $voted_positions = VotedCandidate::query()->selectRaw('candidates.position, COUNT(candidates.position) AS total')->join('candidates', 'voted_candidates.candidate', '=', 'candidates.id')->groupByRaw('candidates.position')->get();
        $total_votes = VotedCandidate::query()->select('voter')->groupBy(['voter'])->get()->count();

        $reg_by_day = RegisteredVoter::query()->selectRaw('count(id) as total, created_at')->groupBy(['created_at'])->limit(7)->get();
        $sig_by_day = RegisteredVoter::query()->selectRaw('count(id) as total, created_at')->groupBy(['created_at'])->limit(7)->get();
        $vot_by_day = VotedCandidate::query()->selectRaw('count(id) as total, created_at')->groupBy(['created_at'])->limit(7)->get();

        $top_candidates = VotedCandidate::query()->selectRaw('candidates.name, candidates.position, candidates.photo, COUNT(candidates.name) AS total')->join('candidates', 'voted_candidates.candidate', '=', 'candidates.id')->groupByRaw('candidates.name, candidates.position, candidates.photo')->orderByDesc('total')->limit(3)->get();

        $votes_candidates = VotedCandidate::query()->selectRaw('candidates.name, candidates.position, candidates.photo, COUNT(candidates.name) AS total')->join('candidates', 'voted_candidates.candidate', '=', 'candidates.id')->groupByRaw('candidates.name, candidates.position, candidates.photo')->orderByDesc('total')->limit(3)->get();

        // dd($votes_candidates);

        return view('reports.voters', compact(
            'registered_voters',
            'voters_by_course',
            'signed_voters',
            'voted_voters',
            'recent_voters',

            'total_votes',
            'top_candidates',
            'votes_candidates',
            'voted_positions',

            'reg_by_day',
            'sig_by_day',
            'vot_by_day',
        ));
    }

    public function live_results() {
        $registered_voters = RegisteredVoter::query()->get()->count();
        if ($registered_voters < 1) {
            $registered_voters = 1;
        }
        $voted_voters = VotedVoter::query()->get()->count();
        $voted = json_decode( json_encode(DB::table('voted_voters')->get('voter_id')), true);
        $voters = RegisteredVoter::query()->whereNotIn('voter_id', $voted)->latest()->get();
        $remaining_voters = count($voters);

        $top_candidates = VotedCandidate::query()->selectRaw('candidates.id, candidates.name, candidates.position, candidates.photo, candidates.partylist, COUNT(candidates.name) AS total')->join('candidates', 'voted_candidates.candidate', '=', 'candidates.id')->groupByRaw('candidates.id, candidates.name, candidates.position, candidates.photo, candidates.partylist')->orderByDesc('total')->get();
        // $top_candidates = VotedCandidate::query()->selectRaw('candidates.name, candidates.position, candidates.photo, candidates.partylist, COUNT(candidates.name) AS total')->join('candidates', 'voted_candidates.candidate', '=', 'candidates.id')->groupByRaw('candidates.name, candidates.position, candidates.photo, candidates.partylist')->orderByDesc('total')->get();

        $agree_votes = VotedCandidate::query()->selectRaw('`candidate`, COUNT(`agree`) AS total')->where('agree', 'YES')->groupByRaw('candidate')->get();
        $disagree_votes = VotedCandidate::query()->selectRaw('`candidate`, COUNT(`agree`) AS total')->where('agree', 'NO')->groupByRaw('candidate')->get();

        return view('reports.live', compact(
            'registered_voters',
            'voted_voters',
            'remaining_voters',
            'top_candidates',

            'agree_votes',
            'disagree_votes',
        ));
    }

    public function live_results_component() {
        $registered_voters = RegisteredVoter::query()->get()->count();
        if ($registered_voters < 1) {
            $registered_voters = 1;
        }
        $voted_voters = VotedVoter::query()->get()->count();
        $voted = json_decode( json_encode(DB::table('voted_voters')->get('voter_id')), true);
        $voters = RegisteredVoter::query()->whereNotIn('voter_id', $voted)->latest()->get();
        $remaining_voters = count($voters);

        $top_candidates = VotedCandidate::query()->selectRaw('candidates.id, candidates.name, candidates.position, candidates.photo, candidates.partylist, COUNT(candidates.name) AS total')->join('candidates', 'voted_candidates.candidate', '=', 'candidates.id')->groupByRaw('candidates.id,candidates.name, candidates.position, candidates.photo, candidates.partylist')->orderByDesc('total')->get();

        $agree_votes = VotedCandidate::query()->selectRaw('`candidate`, COUNT(`agree`) AS total')->where('agree', 'YES')->groupByRaw('candidate')->get();
        $disagree_votes = VotedCandidate::query()->selectRaw('`candidate`, COUNT(`agree`) AS total')->where('agree', 'NO')->groupByRaw('candidate')->get();

        return view('components.live-elements-result', compact(
            'registered_voters',
            'voted_voters',
            'remaining_voters',
            'top_candidates',

            'agree_votes',
            'disagree_votes',
        ));
    }

    public function get_voters_reports()
    {
        // data here
        // data here
        $registered_voters = RegisteredVoter::query()->get()->count();
        // $voters_by_course = RegisteredVoter::query()->selectRaw('count(strand_or_course) as total, strand_or_course')->groupBy(['strand_or_course'])->get();
        // $signed_voters = 0;
        $voted_voters = VotedVoter::query()->get()->count();
        // $recent_voters = VotedVoter::query()->join('registered_voters', 'voted_voters.voter_id', '=', 'registered_voters.voter_id')->latest('voted_voters.created_at')->limit(5)->get();

        $voted_positions = VotedCandidate::query()->selectRaw('candidates.position, COUNT(candidates.position) AS total')->join('candidates', 'voted_candidates.candidate', '=', 'candidates.id')->groupByRaw('candidates.position')->get();
        $total_votes = VotedCandidate::query()->select('voter')->groupBy(['voter'])->get()->count();

        // $reg_by_day = RegisteredVoter::query()->selectRaw('count(id) as total, created_at')->groupBy(['created_at'])->limit(7)->get();
        // $sig_by_day = RegisteredVoter::query()->selectRaw('count(id) as total, created_at')->groupBy(['created_at'])->limit(7)->get();
        // $vot_by_day = VotedCandidate::query()->selectRaw('count(id) as total, created_at')->groupBy(['created_at'])->limit(7)->get();

        $top_candidates = VotedCandidate::query()->selectRaw('candidates.name, candidates.position, candidates.photo, COUNT(candidates.name) AS total')->join('candidates', 'voted_candidates.candidate', '=', 'candidates.id')->groupByRaw('candidates.name, candidates.position, candidates.photo')->orderByDesc('total')->limit(3)->get();

        $votes_candidates = VotedCandidate::query()->selectRaw('candidates.name, candidates.position, candidates.photo, COUNT(candidates.name) AS total')->join('candidates', 'voted_candidates.candidate', '=', 'candidates.id')->groupByRaw('candidates.name, candidates.position, candidates.photo')->orderByDesc('total')->limit(3)->get();

        // dd($votes_candidates);

        return view('components.voters-result-elements', compact(
            'registered_voters',
            // 'voters_by_course',
            // 'signed_voters',
            'voted_voters',
            // 'recent_voters',

            'total_votes',
            'top_candidates',
            'votes_candidates',
            // 'voted_positions',

            // 'reg_by_day',
            // 'sig_by_day',
            // 'vot_by_day',
        ));
    }

    public function print_reports() {
        // $registered_voters = RegisteredVoter::query()->get()->count();
        // $voted_voters = VotedVoter::query()->get()->count();
        // $voted = json_decode( json_encode(DB::table('voted_voters')->get('voter_id')), true);
        // $remaining = RegisteredVoter::query()->whereNotIn('voter_id', $voted)->count();

        // $top_candidates = VotedCandidate::query()->selectRaw('candidates.name, candidates.position, candidates.photo, COUNT(candidates.name) AS total')->join('candidates', 'voted_candidates.candidate', '=', 'candidates.id')->groupByRaw('candidates.name, candidates.position, candidates.photo')->orderByDesc('total')->get();

        // return view('reports.print-candidate-result', compact(
        //     'registered_voters',
        //     'top_candidates',
        //     'voted_voters',
        //     'remaining',
        // ));

        // data here
        $registered_voters = RegisteredVoter::query()->get()->count();
        $voted_voters = VotedVoter::query()->get()->count();
        $voted = json_decode( json_encode(DB::table('voted_voters')->get('voter_id')), true);
        $remaining = RegisteredVoter::query()->whereNotIn('voter_id', $voted)->count();
        $positions = Position::query()->get('name');

        $candidates = Candidate::query()->get();

        $registered_voters = RegisteredVoter::query()->get()->count();
        $total_votes = VotedCandidate::query()->select('voter')->groupBy(['voter'])->get()->count();
        $votes = VotedCandidate::query()->selectRaw('candidate, COUNT(voter) AS total')->groupByRaw('candidate')->get();

        $agree_votes = VotedCandidate::query()->selectRaw('`candidate`, COUNT(`agree`) AS total')->where('agree', 'YES')->groupByRaw('candidate')->get();
        $disagree_votes = VotedCandidate::query()->selectRaw('`candidate`, COUNT(`agree`) AS total')->where('agree', 'NO')->groupByRaw('candidate')->get();

        // dd($votes);

        return view('reports.print-candidate-result', compact(
            'registered_voters',
            'voted_voters',
            'remaining',
            'positions',
            'candidates',
            'votes',
            'registered_voters',
            'total_votes',

            'agree_votes',
            'disagree_votes',
        ));
    }

    public function print_registered_voters() {
        $registered_voters = RegisteredVoter::query()->get()->count();
        // get the list of registered voters
        $voters = RegisteredVoter::query()->latest()->get();

        return view('reports.print-registered-voters', compact(
            'registered_voters',
            'voters',
        ));
    }

    public function print_remaining_voters() {
        $voted = json_decode( json_encode(DB::table('voted_voters')->get('voter_id')), true);
        // $remaining = RegisteredVoter::query()->latest()->get();
        $voters = RegisteredVoter::query()->whereNotIn('voter_id', $voted)->latest()->get();
        $total_remaining = count($voters);

        return view('reports.print-remaining-voters', compact(
            'total_remaining',
            'voters',
        ));
    }

    public function print_voted_voters() {
        $voted_voters = VotedVoter::query()->get()->count();
        // get the list of registered voters
        $voters = VotedVoter::query()->selectRaw('voted_voters.*, registered_voters.*')->join('registered_voters', 'voted_voters.voter_id', '=', 'registered_voters.voter_id')->orderBy('voted_voters.id', 'asc')->get();
        // dd($voters);
        // $voters = VotedVoter::query()->join('registered_voters', 'voted_voters.voter_id', '=', 'registered_voters.voter_id')->orderBy('voted_voters.id', 'asc')->get([
        //     'voted_voters.id',
        //     'voted_voters.voter_id',
        //     'registered_voters.first_name',
        //     'registered_voters.mid_name',
        //     'registered_voters.last_name',
        //     'voted_voters.created_at',
        // ]);

        return view('reports.print-voted-voters', compact(
            'voted_voters',
            'voters',
        ));
    }

    public function candidate_reports()
    {
        // data here
        $positions = Position::query()->get('name');

        $candidates = Candidate::query()->get();

        $registered_voters = RegisteredVoter::query()->get()->count();
        $total_votes = VotedCandidate::query()->select('voter')->groupBy(['voter'])->get()->count();
        $votes = VotedCandidate::query()->selectRaw('candidate, COUNT(voter) AS total')->groupByRaw('candidate')->get();

        $agree_votes = VotedCandidate::query()->selectRaw('`candidate`, COUNT(`agree`) AS total')->where('agree', 'YES')->groupByRaw('candidate')->get();
        $disagree_votes = VotedCandidate::query()->selectRaw('`candidate`, COUNT(`agree`) AS total')->where('agree', 'NO')->groupByRaw('candidate')->get();

        // dd($votes);

        return view('reports.candidates', compact(
            'positions',
            'candidates',
            'votes',
            'registered_voters',
            'total_votes',

            'agree_votes',
            'disagree_votes'
        ));
    }

    public function winners()
    {
        // data here

        return view('reports.winners');
    }
}
