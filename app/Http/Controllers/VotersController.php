<?php

namespace App\Http\Controllers;

use App\Jobs\ImportStudentVoters;
use App\Jobs\ImportVoters;
use App\Jobs\ProcessImportJob;
use App\Models\RegisteredVoter;
use App\Models\User;
use App\Models\Candidate;
use App\Models\Position;
use App\Models\SignedVoter;
use App\Models\SystemConfig;
use App\Models\VotedCandidate;
use App\Models\VotedVoter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use Illuminate\Contracts\Validation\Validator;

class VotersController extends Controller
{
    protected static ?string $password;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function registered_list()
    {
        // generate voter id
        $voter_id = fake()->numerify('V######');
        // get the list of registered voters
        $voters = RegisteredVoter::query()->latest()->get();

        return view('voters.register-list', compact(
            'voter_id',
            'voters',
        ));
    }
    public function signed_list()
    {
        $signed = SignedVoter::query()->join('registered_voters', 'signed_voters.voter', 'registered_voters.voter_id')->get();

        return view('voters.signed-list', compact(
            'signed',
        ));
    }
    public function voted_list()
    {
        $voted = DB::table('voted_voters')->join('registered_voters', 'voted_voters.voter_id', 'registered_voters.voter_id')->get();

        // dd($voted);

        return view('voters.voted-list', compact(
            'voted',
        ));
    }

    public function remaining_list()
    {
        $voted = json_decode(json_encode(DB::table('voted_voters')->get('voter_id')), true);
        // $remaining = RegisteredVoter::query()->latest()->get();
        $remaining = RegisteredVoter::query()->whereNotIn('voter_id', $voted)->latest()->get();
        // dd($remaining);

        return view('voters.remaining-list', compact(
            'remaining',
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('voters.register');
    }

    public function course_and_year(Request $request)
    {
        // $request->validate([
        //     'school_level' => 'required',
        // ]);

        $school_level = $request->input('school_level');
        $courses = array();
        $year = array();

        if ($school_level == 'College') {
            $courses = [
                'BSIT',
                'BSCS',
                'HM',
                'BSBA',
                'WAD',
                'ACT',
                'OMT',
                'OAT',
                'HRT',
            ];
            $year = [
                '1ST',
                '2ND',
                '3RD',
                '4TH',
            ];
        } else {
            $courses = [
                'TVL',
                'STEM',
                'ANIMATION',
                'TEST',
            ];
            $year = [
                '1ST',
                '2ND',
            ];
        }

        // dd($courses);

        return view('pages.reg-str-yr', compact('courses', 'year'));
    }

    public function usn_and_name(Request $request)
    {
        $usn = $request->input('usn');
        $isExist = false;
        // check usn
        if (!empty(RegisteredVoter::query()->where('usn_or_lrn', '=', $usn)->first())) {
            $isExist = true;
        } else {
            $isExist = false;
        }

        // dd($isExist);

        // generate voter id
        $voter_id = fake()->numerify('V############');

        // dd($courses);

        return view('pages.reg-usn-nm', compact(
            'voter_id',
            'isExist',
        ));
    }

    public function usr_reg(Request $request)
    {
        $test = $request->validate([
            'school_level' => 'required',

            'strand_or_course' => 'required',
            'year' => 'required',
            'section' => 'required',

            // 'usn_or_lrn' => 'required|unique:registered_voters,usn_or_lrn',

            'first_name' => 'required',
            'last_name' => 'required',

            // 'voter_id' => 'required|unique:registered_voters,voter_id',
        ]);

        $school_level = $request->input('school_level');
        $strand_or_course = $request->input('strand_or_course');
        $year = $request->input('year');
        $section = $request->input('section');
        $voter_id = $request->input('voter_id');
        $first_name = $request->input('first_name');
        $mid_name = $request->input('mid_name');
        $last_name = $request->input('last_name');
        $usn_or_lrn = $request->input('usn_or_lrn');

        if (!empty(RegisteredVoter::query()->where('usn_or_lrn', '=', $usn_or_lrn)->get())) {
            return redirect(url()->previous());
        }

        // dd();

        return view('pages.reg-acc', compact(
            'school_level',
            'strand_or_course',
            'year',
            'section',
            'voter_id',
            'first_name',
            'mid_name',
            'last_name',
            'usn_or_lrn',
        ));
    }

    public function register_new_voter()
    {
        // generate voter id
        $voter_id = fake()->numerify('V######');

        return view('pages.register-voter', compact(
            'voter_id',
        ));
    }

    public function import_voters()
    {

        return view('pages.import-voters');
    }

    public function import(Request $request)
    {
        ini_set('max_execution_time', 3600);

        // get the input data required
        $request->validate([
            'file' => 'required|file',
        ]);

        // get the file data
        $file = $request->file('file');
        $fileContents = file($file->getPathname());
        // $utf8_file_data = json_encode($fileContents);

        // dd($utf8_file_data);

        for ($i = 0; $i < count($fileContents); $i++) {
            // if ($i != 0) {
            $data = str_getcsv($fileContents[$i]);
            $data =  mb_convert_encoding($data, 'UTF-8', 'ISO-8859-1');
            // dd( mb_convert_encoding($data, 'UTF-8', 'ISO-8859-1'));

            if (count($data) <= 8 || $data == null) {
                return back()->with('error', 'The Imported CSV file does not match with the template.');
            }

            // generate voter id
            $voter_id = fake()->numerify('V############');
            $email = $voter_id . '@email.com';

            // create a user account for the voter
            $voter_acc = User::query()->create([
                'name' => $data[0],
                'email' => $email,
                'email_verified_at' => now(),
                // 'password' => static::$password ??= Hash::make($data[3]),
                'password' => $data[3],
                'type' => 'VOTER',
                'remember_token' => Str::random(10),
            ]);

            // dd($voter_acc->id);

            // store the data in the database voter table
            $voter = RegisteredVoter::query()->create([
                'voter_id' => $voter_id,
                'usn_or_lrn' => $data[0],
                'first_name' => $data[1],
                'mid_name' => $data[2],
                'last_name' => $data[3],
                'strand_or_course' => $data[5],
                'school_level' => $data[4],
                'year' => $data[6],
                'section' => $data[7],
                'house' => $data[8],
                'user_id' => $voter_acc->id,
            ]);
            
        }

        // $voters = RegisteredVoter::query()->get();
        // dd($voters);

        // $file = $request->file('file');
        // $storedFile = $file->store('csv', 'public');
        // dispatch(new ProcessImportJob(storage_path('app/public/' . $storedFile)))->onQueue('import');
        // ImportVoters::dispatch($file);
        // $storedFile = $file->store('csv', 'public');
        // dispatch(new ImportVoters(storage_path('app/public/' . $storedFile)));

        // return view('medicine.import-batch', compact('date_today', 'voters', 'batch_no'));
        // return redirect()->route('registeredVoters')->with('success', 'Voters Data Imported.');
        return redirect()->route('registeredVoters')->with('success', 'Voters Data is Proccessed to import.');
    }

    public function old_import(Request $request)
    {
        // get the input data required
        $request->validate([
            'file' => 'required|file',
        ]);

        if (request()->has('file')) {
            $data = file(request()->file);
            // $data = array_map('str_getcsv', file(request()->file));
            // $header = $data[0];
            // unset($data[0]);

            $chuncks = array_chunk($data, 100);
            // convert to new chunks
            foreach ($chuncks as $key => $chunck) {
                $name = "/tmp{$key}.csv";
                $path = resource_path('temp');
                file_put_contents($path . $name, $chunck);
            }
        }

        // get the files
        $path = resource_path('temp');
        $files = glob("$path/*.csv");
        // dd($files);

        $header = [];
        foreach ($files as $key => $file) {
            $data = array_map('str_getcsv', file($file));
            if ($key === 0) {
                $header = $data[0];
                unset($data[0]);
            }

            // dd((array)$data);

            // run queue
            // ImportStudentVoters::dispatch($data, $header)->onQueue('Testing');
            // unlink($file);
        }


        // run the queues
        // ImportStudentVoters::dispatch()->onQueue('Testing');
        dd("processing");

        return redirect()->route('registeredVoters')->with('success', 'Voters Data is Proccessed to import.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->input());

        // get the input data required
        $request->validate([
            'voter_id' => 'required|unique:registered_voters,voter_id',
            'usn_or_lrn' => 'required|unique:registered_voters,usn_or_lrn',
            // 'usn_or_lrn' => 'required',
            'first_name' => 'required',
            // 'mid_name' => 'required',
            'last_name' => 'required',
            'strand_or_course' => 'required',
            'school_level' => 'required',
            'year' => 'required',
            'section' => 'required',

            'username' => 'required|unique:users,name',
        ]);

        $data = $request->all();
        $email = $data['first_name'] . '@mail.com';
        // dd($data);

        // create a user account for the voter
        $voter_acc = User::query()->create([
            'name' => $data['username'],
            'email' => $email,
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make($data['last_name']),
            'type' => 'VOTER',
            'remember_token' => Str::random(10),
        ]);

        // dd($voter_acc->id);

        // store the data in the database voter table
        $voter = RegisteredVoter::query()->create([
            'voter_id' => $data['voter_id'],
            'usn_or_lrn' => $data['usn_or_lrn'],
            'first_name' => $data['first_name'],
            'mid_name' => $data['mid_name'],
            'last_name' => $data['last_name'],
            'strand_or_course' => $data['strand_or_course'],
            'school_level' => $data['school_level'],
            'year' => $data['year'],
            'section' => $data['section'],
            'house' => 'Default',
            'user_id' => $voter_acc->id,
        ]);

        // redirect back
        return redirect()->route('registeredVoters')->with('success', 'New Voter Registered.');
        // return redirect()route('positions.index')->with('success', 'New Position Istablished.');
    }

    public function register_voter(Request $request)
    {
        $can_register = SystemConfig::query()->where('key', 'can_register')->first();
        if ($can_register->value != 1) {
            return redirect('registerNewVoter');
        }
        // dd($request->input());
        // get the input data required
        $request->validate([
            // 'name' => 'required|unique:positions,name',
            // 'description' => 'required',
            'voter_id' => 'required',
            // 'usn_or_lrn' => 'required|unique:registered_voters,usn_or_lrn',
            // 'usn_or_lrn' => 'required',
            // 'first_name' => 'required|unique:registered_voters,first_name',
            // 'mid_name' => 'required',
            'last_name' => 'required|unique:registered_voters,last_name',
            // 'strand_or_course' => 'required',
            // 'school_level' => 'required',
            // 'year' => 'required',
            'username' => 'required|unique:users,name',
            'password' => 'required|confirmed',
        ]);

        $data = $request->all();
        // dd($data);

        // create a user account for the voter
        $voter_acc = User::query()->create([
            'name' => $data['username'],
            'email' => $data['voter_id'] . '@gmail.com',
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make($data['password']),
            'type' => 'VOTER',
            'remember_token' => Str::random(10),
        ]);

        // dd($voter_acc->id);

        // store the data in the database voter table
        $voter = RegisteredVoter::query()->create([
            'voter_id' => $data['voter_id'],
            'usn_or_lrn' => '01111111111111',
            'first_name' => $data['first_name'],
            'mid_name' => $data['mid_name'],
            'last_name' => $data['last_name'],
            'strand_or_course' => ($data['strand_or_course'] != null) ? $data['strand_or_course'] : ' ',
            'school_level' => ($data['school_level'] != null) ? $data['school_level'] : ' ',
            'year' => '2024',
            'section' => 'A',
            'house' => 'Default',
            'user_id' => $voter_acc->id,
        ]);

        // redirect back
        return redirect()->route('thankYouVoter', $voter->voter_id);
        // return redirect()route('positions.index')->with('success', 'New Position Istablished.');
    }

    public function candidate_vote()
    {
        // get voters details
        $voter = RegisteredVoter::query()->where('user_id', Auth::user()->id)->first();
        $voter_id = $voter->voter_id;

        // checks positions
        // $pos_check = [
        //     'President',
        //     'Vice President External',
        //     'Vice President Internal',
        //     'Secretary',
        //     'Treasurer',
        //     'Auditor',
        //     'PIO',
        //     'PRO',
        //     // representativ
        //     $voter->strand_or_course,
        //     // house
        //     $voter->house,
        // ];

        $positions = Position::query()->get('name');
        // $positions = Position::query()->whereIn('name', $pos_check)->get('name');
        $candidates = Candidate::query()->latest()->get();
        $candidate_total = Candidate::query()->selectRaw('count(id) as total, position')->groupBy('position')->get();

        $voted_candidates = VotedCandidate::query()->where('voter', $voter_id)->join('candidates', 'voted_candidates.candidate', 'candidates.id')->get();
        $is_voted = VotedVoter::query()->where('voter_id', $voter_id)->exists();
        $is_signed = SignedVoter::query()->where('voter', $voter->voter_id)->exists();

        // dd($is_voted);

        return view('voters.vote-candidates', compact(
            'positions',
            'candidates',
            'voter',
            'voter_id',
            'is_voted',
            'is_signed',
            'voted_candidates',
            'candidate_total',
        ));
    }

    public function record_voted_candidates(Request $request)
    {
        // validate the voted
        $request->validate([
            'President' => 'required',
            'Vice_President' => 'required',
            'Secretary' => 'required',
            'Treasurer' => 'required',
            'Public_Information_Officer' => 'required',
            'Auditor' => 'required',

            'External_Affairs' => 'required',
            'Cultural_Activities_and_Sports_Development' => 'required',
            'Student_Organization' => 'required',
            'Multimedia_and_the_Art' => 'required',
        ]);

        // get all the data
        $positions = Position::query()->latest()->get('name');

        // $the_postion = str_replace(' ', '_', $positions[0]->name);
        // if(empty($request->input($the_postion))) {
        //     return redirect()->route('voteCandidates')->with('warning', 'Minimum vote is 1. Maximum vote is 4.');
        // }

        // check if the voter voted atleas 1 candidate
        // $limit_v = 7;
        // if (count($request->input()) <= $limit_v) {
        //     return redirect()->route('voteCandidates')->with('warning', 'Vote at least '. $limit_v .' candidate.');
        // }

        // $count_votes = count($request->input($the_postion));
        // check if the voter voted atleas the required candidates to vote
        // if ($count_votes > 4 && $count_votes != null) {
        //     return redirect()->route('voteCandidates')->with('warning', 'You can only vote 4 candidates. Voted candidates('. count($request->input($the_postion)) .')');
        // } else if (count($request->input($the_postion)) < 0) {
        //     return redirect()->route('voteCandidates')->with('warning', 'Vote atleast one candidate.');
        // }

        // dd($request->input());
        $voter = RegisteredVoter::query()->where('user_id', Auth::user()->id)->first();
        $is_voted = VotedVoter::query()->where('voter_id', $voter->voter_id)->exists();
        if ($is_voted) {
            return redirect()->route('voteCandidates')->with('warning', 'You have already voted you cannot vote again.');
        }

        // $voted_candidate = array();
        $voted_candidates = $request->input(str_replace(' ', '_', $positions[0]->name));

        // dd($voted_candidates);

        // separate the data
        for ($i = 0; $i < count($positions); $i++) {
            $compare = str_replace(' ', '_', $positions[$i]->name);
            // $position = Position::query()->where('name', )->get('name');
            if ($request->has($compare)) {
                $value = $request->input($compare)[0];
                $column = explode('/', $value);

                // check first if the vote is yes or no

                $data = [
                    'voter' => $column[0],
                    'candidate' => $column[1],
                    'agree' => $column[2],
                    // $column[3],
                ];

                // record the voters voted candidates
                VotedCandidate::query()->create($data);
                // array_push($voted_candidate, $data);
            }
        }


        // for ($i = 0; $i < count($voted_candidates); $i++) {
        //     # code...
        //     $value = $request->input($the_postion)[$i];
        //     $column = explode('/', $value);

        //     $data = [
        //         'voter' => $column[0],
        //         'candidate' => $column[1],
        //         // $column[2],
        //         // $column[3],
        //     ];

        //     // record the voters voted candidates
        //     VotedCandidate::query()->create($data);
        // }

        // separate the data
        // for ($i = 0; $i < count($positions); $i++) {
        //     $compare = str_replace(' ', '_', $positions[$i]->name);
        //     // $position = Position::query()->where('name', )->get('name');
        //     if ($request->has($compare)) {
        //         $value = $request->input($compare)[0];
        //         $column = explode('/', $value);

        //         $data = [
        //             'voter' => $column[0],
        //             'candidate' => $column[1],
        //             // $column[2],
        //             // $column[3],
        //         ];

        //         // record the voters voted candidates
        //         VotedCandidate::query()->create($data);
        //         // array_push($voted_candidate, $data);
        //     }
        // }

        // is voted
        VotedVoter::query()->create([
            'voter_id' => $voter->voter_id,
        ]);

        return redirect()->route('voteCandidates')->with('success', 'Votes Recorded.');
        // dd($voted_candidate);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // $voter = RegisteredVoter::query()->where('registered_voters.id', $id)->first();
        $voter = RegisteredVoter::query()->where('registered_voters.id', $id)->join('users', 'registered_voters.user_id', '=', 'users.id')->first(['registered_voters.*', 'users.email', 'users.name']);
        $voted_candidates = VotedCandidate::query()->where('voter', $voter->voter_id)->join('candidates', 'voted_candidates.candidate', 'candidates.id')->get();
        // dd($voter);

        return view('voters.show', compact('voter', 'voted_candidates'));
    }

    public function scanned_voter(Request $request)
    {
        // get the data
        $key = $request->voter_id;
        $scanner = $request->scanner;
        $date_and_time_now = date('Y-m-d h:i:s');

        $voter = RegisteredVoter::query()->where('registered_voters.voter_id', $key)->first();

        if (empty($voter)) {
            return view('components.no-voter-toast');
        }

        $is_signed = SignedVoter::query()->where('voter', $voter->voter_id)->exists();
        $is_voted = VotedVoter::query()->where('voter_id', $voter->voter_id)->exists();

        if ($request->ajax()) {
            // dd($is_signed);

            // recored the scanned voter
            if ($is_signed == true) {
                // after they vote they can now sign out
                if ($is_voted == true) {
                    SignedVoter::query()->where('voter', '=', $voter->voter_id)->update([
                        'scanner_out' => $scanner,
                        'scan_out' => $date_and_time_now,
                    ]);
                }
            } else {
                SignedVoter::query()->create([
                    'voter' => $voter->voter_id,
                    'scanner_in' => $scanner,
                    'scan_in' => $date_and_time_now,
                    'scanner_out' => null,
                    'scan_out' => null,
                ]);
            }
        }

        return view('components.scanned-notifs-toast', compact('voter', 'is_signed', 'is_voted'));
    }

    public function scanned_list()
    {
        $scanned_voters = DB::table('signed_voters')->join('registered_voters', 'signed_voters.voter', '=', 'registered_voters.voter_id')->latest('signed_voters.created_at')->get();

        // dd($scanned_voters);

        return view('pages.scanned-list', compact('scanned_voters'));
    }

    public function show_qrcode_ID(string $id)
    {
        // $voter = RegisteredVoter::query()->where('registered_voters.id', $id)->first();
        $voter = RegisteredVoter::query()->where('registered_voters.id', $id)->join('users', 'registered_voters.user_id', '=', 'users.id')->first(['registered_voters.*', 'users.email', 'users.name']);
        // $voted_candidates = VotedCandidate::query()->where('voter', $voter->voter_id)->join('candidates', 'voted_candidates.candidate', 'candidates.id')->get();
        // dd($voter);

        if ($voter == null) {
            // else failed
            return back()->with('error', 'Failed! No voter with that Information.');
        }

        return view('voters.voters-qrcode-id', compact('voter'));
    }

    public function voted_candidates()
    {
        $voter = RegisteredVoter::query()->where('user_id', Auth::user()->id)->first();
        // $voter = RegisteredVoter::query()->where('registered_voters.id', $id)->join('users', 'registered_voters.user_id', '=', 'users.id')->first(['registered_voters.*', 'users.email', 'users.name']);
        $voted_candidates = VotedCandidate::query()->where('voter', $voter->voter_id)->join('candidates', 'voted_candidates.candidate', 'candidates.id')->get();
        return view(
            'voters.voted-candidates',
            compact([
                'voted_candidates',
            ])
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('voters.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // get the input data required
        $request->validate([
            // 'name' => 'required|unique:positions,name',
            // 'description' => 'required',
            'voter_id' => 'required',
            // 'usn_or_lrn' => 'required|unique:registered_voters,usn_or_lrn',
            'usn_or_lrn' => 'required',
            'first_name' => 'required',
            // 'mid_name' => 'required',
            'last_name' => 'required',
            'strand_or_course' => 'required',
            'school_level' => 'required',
            'year' => 'required',
            'section' => 'required',

            'username' => 'required',
        ]);

        $data = $request->all();
        // dd($data);

        // dd($voter_acc->id);

        // store the data in the database voter table
        $e_voter = RegisteredVoter::query()->where('id', '=', $id)->update([
            // 'voter_id' => $data['voter_id'],
            'usn_or_lrn' => $data['usn_or_lrn'],
            'first_name' => $data['first_name'],
            'mid_name' => $data['mid_name'],
            'last_name' => $data['last_name'],
            'strand_or_course' => $data['strand_or_course'],
            'school_level' => $data['school_level'],
            'year' => $data['year'],
            'section' => $data['section'],
            // 'user_id' => $voter_acc->id,
        ]);

        $voter = RegisteredVoter::query()->where('id', $id)->first();

        // dd($voter);

        // update user account for the voter
        $voter_acc = User::query()->where('id', $voter->user_id)->update([
            'name' => $data['usn_or_lrn'],
            // 'name' => $data['voter_id'] . '_' . $data['first_name'],
            'email' => $data['email'],
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make($data['last_name']),
            'type' => 'VOTER',
            'remember_token' => Str::random(10),
        ]);

        // redirect back
        return redirect()->route('voters.show', $voter->id)->with('success', 'Voter Updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //deletes the record in the database
        $voter = RegisteredVoter::query()->where('id', $id)->first();
        $voter_acc = User::query()->where('id', $voter->user_id)->delete();
        RegisteredVoter::query()->where('id', $voter->id)->delete();

        // redirect to the index
        return redirect()->route('registeredVoters')->with('success', 'Voter Remove.');
    }
}
