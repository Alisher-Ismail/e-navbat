<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthManager;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\VaqtController;
use App\Http\Controllers\QidiruvController;
use Illuminate\Http\Request;
use Carbon\Carbon;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//navbat
Route::get('/navbatstore', [QidiruvController::class, 'navbatstore'])->name('navbat.store');
//navbat
//login and registration
Route::get('/login', [AuthManager::class, 'adminlogin'])->name('login');
Route::post('/adminlogin', [AuthManager::class, 'adminloginPost'])->name('adminlogin.post');
Route::get('/adminlogout', [AuthManager::class, 'adminlogout'])->name('adminlogout');
Route::get('/register', [RegistrationController::class, 'register'])->name('register');
Route::post('/register', [RegistrationController::class, 'store'])->name('register.submit');
//login and registration
//
//Route::get('/qidiruv', [QidiruvController::class, 'qidiruv'])->name('qidiruv');
Route::get('/', [QidiruvController::class, 'qidiruv'])->name('qidiruv');
Route::get('/navbat', [QidiruvController::class, 'navbat'])->name('navbat');
Route::get('/navbatkorish', [QidiruvController::class, 'navbatkorish'])->name('navbat.korish');
Route::get('/navbattekshirish', [QidiruvController::class, 'navbattekshirish'])->name('navbat.tekshirish');
Route::get('/navbatbekor', [QidiruvController::class, 'navbatbekor'])->name('navbat.bekor');
//

Route::middleware('auth')->group(function () {
Route::get('/adminhome', function () { return view('admin.base'); })->name('adminhome'); 
//Route::get('/', function () {return view('admin.base');})->name('/');
//vaqt
Route::get('/vaqt', [VaqtController::class, 'vaqt'])->name('vaqt');
Route::post('/addvaqt', [VaqtController::class, 'store'])->name('vaqt.store');
Route::post('/delete-vaqt', [VaqtController::class, 'delete'])->name('delete.vaqt');
//vaqt
//navbat
Route::get('/adminnavbat', [VaqtController::class, 'navbat'])->name('adminnavbat');
Route::get('/adminnavbattasdiq', [VaqtController::class, 'navbattasdiq'])->name('adminnavbattasdiq');
Route::get('/adminnavbatxizmat', [VaqtController::class, 'navbatxizmat'])->name('adminnavbatxizmat');
Route::post('/tasdiq-navbat', [VaqtController::class, 'tasdiqlash'])->name('tasdiq.navbat');
Route::post('/xizmat-navbat', [VaqtController::class, 'xizmat'])->name('xizmat.navbat');
Route::post('/delete-navbat', [VaqtController::class, 'navbatdelete'])->name('delete.navbat');

//navbat

});

//get qabul vaqtlari

Route::get('/api/qabulvaqtlari', function(Request $request) {
    $day = $request->input('sana1');  // Using input method to get request data
    $userId = $request->input('uid');  // Getting userId from request data
    $dayOfWeek = Carbon::parse($day)->dayOfWeek;  // Getting the day of the week

    // Fetch the 'vaqt' column values from the Vaqt model
    //$vaqts = App\Models\Vaqt::where('kun', $dayOfWeek)->where('userid', $userId)->get();
    $vaqts = App\Models\Vaqt::where('userid', $userId)->where('kun', $dayOfWeek)->pluck('vaqt');
    $navbats = App\Models\Navbat::where('sana', $day)->where('userid', $userId)->pluck('vaqt');
    // Return the response as JSON
    return response()->json([
        //'dayOfWeek' => $dayOfWeek,
        'vaqt' => $vaqts,
        'navbat' => $navbats,
    ]);
});
//get qabul vaqtlari