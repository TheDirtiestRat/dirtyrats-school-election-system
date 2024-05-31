<?php

namespace App\Http\Controllers;

use App\Models\RegisteredVoter;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected static ?string $password;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::query()->latest()->get();

        return view('users.users-list', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // get the input data required
        $request->validate([
            'name' => 'required|unique:users,name',
            'password' => 'required|confirmed',
            // 'description' => 'required',
        ]);

        $data = $request->all();
        // dd($data);

        // store the data in the database patient table
        $user = User::query()->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'type' => $data['user_type'],
        ]);

        // redirect back
        return redirect()->route('user.index')->with('success', 'New User Added.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::query()->where('id', $id)->first();

        // for the voter acc
        $voter = RegisteredVoter::query()->where('user_id', Auth::user()->id)->first();

        return view('users.profile', compact('user', 'voter'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::query()->where('id', $id)->first();

        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // get the user
        $user = User::query()->where('id', $id)->first();

        // get the input data required
        $credentials = $request->validate([
            // 'name' => 'required|unique:users,name,except,id',
            'password' => 'required|confirmed',
            // 'new_password' => 'required',
            // 'description' => 'required',
        ]);

        $data = $request->all();

        // $hashedPassword = Hash::make($data['password']);
        // if (!Hash::check('plain-text', $hashedPassword)) {
        //     // The passwords dosent match...
        //     return back()->with('error', 'Password doesent match');
        // }

        // store the data in the database patient table
        $user = User::query()->where('id', $id)->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => static::$password ??= Hash::make($data['password']),
            'type' => $data['user_type'],
        ]);

        // redirect back
        return redirect()->route('user.index')->with('success', 'User Updated.');
    }

    public function hash_the_passwords() {
        ini_set('max_execution_time', 3600);

        $users = User::query()->whereBetween('id', [166, 2094],)->get(['id', 'password']);
        $id_list = [];
        $pass_list = [];

        // dd($users);

        foreach ($users as $key => $value) {
            User::query()->where('id', $value->id)->update([
                'password' => Hash::make($value->password),
            ]);

            // array_push($id_list, $value->id);
            array_push($pass_list, "user " . $value->id . " is done.");
        }
        dd($pass_list);


        // User::query()->where('id', $id_list)->update([
        //     'password' => Hash::make($pass_list),
        // ]);

        dd('password being hashed');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
