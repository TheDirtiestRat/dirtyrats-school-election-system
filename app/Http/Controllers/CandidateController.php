<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $positions = Position::query()->get('name');
        $candidates = Candidate::query()->latest()->get();
        $infos = DB::table('candidates_info')->get();

        return view('candidate.list', compact(
            'positions',
            'candidates',
            'infos',
        ));
    }

    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $positions = Position::query()->latest()->get('name');

        return view('candidate.create', compact('positions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd(!empty($request->input('kind')));

        // get the input data required
        $request->validate([
            'name' => 'required|unique:candidates,name',
            // 'couseOrstrand' => 'required',
            // 'school_level' => 'required',
            'partylist' => 'required',
            'position' => 'required',
        ]);

        // dd($request->input());

        $data = $request->all();
        // dd($data);

        // adds the picture
        $newPhotoName = 'profile-img.jpg';
        if ($request->photo != null) {
            $newPhotoName = $data['name'] . "-" . $data['partylist'] . "." . $request->photo->guessExtension();
            $request->file('photo')->storeAs('candidate img', $newPhotoName, 'public');
        }

        // store the data in the database patient table
        $candidate = Candidate::query()->create([
            'name' => $data['name'],
            // 'course_Or_strand' => $data['couseOrstrand'],
            // 'school_level' => $data['school_level'],
            'position' => $data['position'],
            'partylist' => $data['partylist'],
            'photo' => $newPhotoName,
        ]);

        // dd(count($request->input('kind')));

        // add the info if theres any
        if(!empty($request->input('kind'))) {

            for ($i = 0; $i < count($request->input('kind')); $i++) {
                DB::table('candidates_info')->insert([
                    'candidate_id' => $candidate->id,
                    'kind' => $request->input('kind')[$i],
                    'info' => $request->input('info')[$i]
                ]);
            }
        }
        

        // redirect back
        return redirect()->route('candidates.create')->with('success', 'New Candidate Added.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $candidate = Candidate::query()->where('id', $id)->first();

        return view('candidate.show', compact('candidate'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $candidate = Candidate::query()->where('id', $id)->first();
        $positions = Position::query()->latest()->get('name');
        $infos = DB::table('candidates_info')->where('candidate_id', '=', $candidate->id)->get();

        return view('candidate.edit', compact('candidate', 'positions', 'infos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         // get the input data required
         $request->validate([
            'name' => 'required',
            // 'couseOrstrand' => 'required',
            // 'school_level' => 'required',
            'partylist' => 'required',
            'position' => 'required',
        ]);
        // dd($request->input());

        $data = $request->all();
        // dd($data);

        // update the photo if theres new
        $newPhotoName = '';
        if ($request->photo != null) {
            // find and deletes the image of the employee
            $this->delete_image($id);
            
            $newPhotoName = $data['name'] . "-" . $data['partylist'] ."." . $request->photo->guessExtension();
            $request->file('photo')->storeAs('candidate img', $newPhotoName, 'public');
        } else {
            $emp = Candidate::query()->select('photo')->where('id', $id)->first();
            // dd($emp);
            $newPhotoName = $emp->photo;
        }

        // store the data in the database patient table
        $candidate = Candidate::query()->where('id', $id)->update([
            'name' => $data['name'],
            // 'course_Or_strand' => $data['couseOrstrand'],
            // 'school_level' => $data['school_level'],
            'position' => $data['position'],
            'partylist' => $data['partylist'],
            'photo' => $newPhotoName,
        ]);

        // removes the candidates info
        DB::table('candidates_info')->where('candidate_id', $id)->delete();

        // add the info if theres any
        if(!empty($request->input('kind'))) {

            for ($i = 0; $i < count($request->input('kind')); $i++) {
                DB::table('candidates_info')->insert([
                    'candidate_id' => $id,
                    'kind' => $request->input('kind')[$i],
                    'info' => $request->input('info')[$i]
                ]);
            }
        }

        $positions = Position::query()->get('name');
        $candidates = Candidate::query()->latest()->get();

        // redirect back
        return redirect()->route('candidates.index')->with('success', 'Candidate Updated.')->with('candidates', $candidates)->with('positions', $positions);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->delete_image($id);

        //deletes the record in the database
        $deleted_candidates = Candidate::query()->where('id', $id)->delete();

        $positions = Position::query()->get('name');
        // get the Candidate records
        $candidates = Candidate::query()->latest()->get();

        // redirect to the index
        return redirect()->route('candidates.index')->with('success', 'Candidate Remove.')->with('candidates', $candidates)->with('positions', $positions);
    }

    public function delete_image($id)
    {
        //gets the meds to be deleted
        $candidate = Candidate::query()->where('id', $id)->first();

        // deletes the photo
        $destination = "storage\candidate img\\" . $candidate->photo;
        // $destination = public_path() . "storage/images/" . $emp->profile_pic;
        // dd($destination);

        if (File::exists($destination) && $candidate->photo != 'profile-img.jpg') {
            // delete the picture from the directory
            File::delete($destination);
            // dd('File deleted.');
        }
    }
}
