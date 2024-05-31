<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\Candidate;
use Illuminate\Http\Request;

class PositionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $positions = Position::query()->latest()->get();
        $candidates = Candidate::query()->selectRaw('count(id) as total, position')->groupBy('position')->get();

        return view('positions.position-list', compact('positions', 'candidates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // get the input data required
        $request->validate([
            'name' => 'required|unique:positions,name',
            // 'description' => 'required',
        ]);

        $data = $request->all();
        // dd($data);

        // store the data in the database patient table
        $patient = Position::query()->create([
            'name' => $data['name'],
            'description' => ($data['description'] == null) ? ' ' : $data['description'],
        ]);

        // redirect back
        return redirect()->route('positions.index')->with('success', 'New Position Istablished.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $position = Position::query()->where('id', $id)->first();

        return view('positions.edit', compact('position'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // get the input data required
        $request->validate([
            'name' => 'required',
            // 'description' => 'required',
        ]);

        $data = $request->all();
        // dd($data);

        // store the data in the database patient table
        $position = Position::query()->where('id', '=', $id)->update([
            'name' => $data['name'],
            'description' => ($data['description'] == null) ? ' ' : $data['description'],
        ]);

        // redirect back
        return redirect()->route('positions.index')->with('success', 'Position Updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //deletes the record in the database
        $position = Position::query()->where('id', $id)->delete();

        // redirect to the index
        return redirect()->route('positions.index')->with('success', 'Position Remove.');
    }
}
