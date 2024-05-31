<?php

namespace App\Http\Controllers;

use App\Models\SystemConfig;
use Illuminate\Http\Request;

use App\Models\Candidate;
use App\Models\Position;
use Illuminate\Support\Facades\DB;

class ConfigurationController extends Controller
{
    public function configuration()
    {
        return view('pages.configuration');
    }

    public function update_configuration(Request $request)
    {
        // update the config values
        if ($request->input('can_register') != null) {
            SystemConfig::query()->where('key', 'can_register')->update([
                'value' => $request->input('can_register'),
            ]);
        } else {
            SystemConfig::query()->where('key', 'can_register')->update([
                'value' => 0,
            ]);
        }

        if ($request->input('can_vote') != null) {
            SystemConfig::query()->where('key', 'can_vote')->update([
                'value' => $request->input('can_vote'),
            ]);
        } else {
            SystemConfig::query()->where('key', 'can_vote')->update([
                'value' => 0,
            ]);
        }

        //  dd($value);

        return view('pages.configuration')->with('success', 'Config updated!');
    }

    public function welcome_page() {
        $positions = Position::query()->get('name');
        $candidates = Candidate::query()->latest()->get();
        $infos = DB::table('candidates_info')->get();
    
    
        return view('welcome', compact(
            'positions',
            'candidates',
            'infos',
        ));
    }
}
