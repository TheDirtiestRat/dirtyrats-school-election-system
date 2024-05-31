<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\PositionsController;
use App\Http\Controllers\ReportsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VotersController;
use App\Models\RegisteredVoter;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [ConfigurationController::class, 'welcome_page']);

// authentication
Route::get('/login', [AuthenticationController::class, 'login'])->name('login');
Route::post('/loginUser', [AuthenticationController::class, 'login_user']);

// register new voter
// Route::get('/registerNewVoter', [VotersController::class, 'register_new_voter']);
// Route::post('/registerVoter', [VotersController::class, 'register_voter'])->name('registerVoter');
// Route::get('/thankYouVoter/{v_id}', function (string $v_id) {
//     $voter = RegisteredVoter::query()->where('voter_id', $v_id)->join('users', 'registered_voters.user_id', '=', 'users.id')->first(['registered_voters.*', 'users.name']);

//     if ($voter == null) {
//         return redirect('/');
//     }

//     return view('pages.thank-you-page', compact('voter'));
// })->name('thankYouVoter');

// authenticate
Route::middleware('auth')->group(function () {
    // if is admin
    Route::middleware('user.type:ADMIN')->group(function () {
        // pages
        Route::get('/dashboard', [ReportsController::class, 'dashboard']);
        Route::resource('candidates', CandidateController::class);
        Route::get('/candidatesReports', [ReportsController::class, 'candidate_reports']);
        Route::get('/candidateWinners', [ReportsController::class, 'winners']);
        Route::resource('voters', VotersController::class);
        Route::get('/registeredVoters', [VotersController::class, 'registered_list'])->name('registeredVoters');

        // register
        Route::any('/course_and_year', [VotersController::class, 'course_and_year']);
        Route::any('/usn_and_name', [VotersController::class, 'usn_and_name']);
        // Route::any('/usr_acc', [VotersController::class, 'usr_reg'])->name('usr_acc');

        Route::get('/hashPasswords', [UserController::class, 'hash_the_passwords']);

        // import
        Route::get('/importVoters', [VotersController::class, 'import_voters']);
        Route::post('/Import', [VotersController::class, 'import']);

        Route::get('/signedVoters', [VotersController::class, 'signed_list']);
        Route::get('/votedVoters', [VotersController::class, 'voted_list']);
        Route::get('/remainingVoters', [VotersController::class, 'remaining_list']);

        

        Route::get('/votersReports', [ReportsController::class, 'voters_reports']);
        Route::get('/getvotersReports', [ReportsController::class, 'get_voters_reports']);
        Route::resource('positions', PositionsController::class);
        Route::get('/printReports', [ReportsController::class, 'print_reports']);

        Route::get('/printRegisteredVoters', [ReportsController::class, 'print_registered_voters']);
        Route::get('/printVotedVoters', [ReportsController::class, 'print_voted_voters']);
        Route::get('/printRemaingVoters', [ReportsController::class, 'print_remaining_voters']);

        // config page
        Route::get('/configuration',  [ConfigurationController::class, 'configuration']);
        Route::post('/updateConfig', [ConfigurationController::class, 'update_configuration'])->name('updateConfig');
    });

    // if is voter
    Route::middleware('user.type:VOTER')->group(function () {
        // pages
        Route::get('/voteCandidates', [VotersController::class, 'candidate_vote'])->name('voteCandidates');
        Route::get('/votedCandidates', [VotersController::class, 'voted_candidates']);
        Route::post('/storeVotedCandidates', [VotersController::class, 'record_voted_candidates'])->name('storeVotedCandidates');
    });

    Route::middleware('user.type:VIEW,ADMIN')->group(function () {
        Route::get('/Live', [ReportsController::class, 'live_results']);
        Route::get('/liveElementsResult', [ReportsController::class, 'live_results_component']);
    });

    // can be accessed by scanner and admin
    Route::middleware('user.type:SCANNER,ADMIN')->group(function () {
        // get voters qrcode ID
        Route::get('/qrcodeID/{id}', [VotersController::class, 'show_qrcode_ID'])->name('qrcodeID');

        // scanner
        Route::get('/scanner', function () {
            return view('pages.scanner');
        });

        Route::get('/scannedVoter', [VotersController::class, 'scanned_voter']);

        // scanned list
        Route::get('/scannedList', [VotersController::class, 'scanned_list']);
    });

    // user management
    Route::resource('user', UserController::class, [
        'only' => ['index', 'create', 'store', 'destroy']
    ])->middleware('user.type:ADMIN');
    Route::resource('user', UserController::class, [
        'only' => ['show', 'edit', 'update']
    ])->middleware('user.type:VOTER,ADMIN');

    // log out
    Route::delete('/logoutUser', [AuthenticationController::class, 'logout_user']);
});
