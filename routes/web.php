<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthManager;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\VaqtController;
use App\Http\Controllers\QidiruvController;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Http\Controllers\AuthManagerEng;
use App\Http\Controllers\RegistrationControllerEng;
use App\Http\Controllers\VaqtControllerEng;
use App\Http\Controllers\QidiruvControllerEng;

use App\Http\Controllers\AuthManagerRu;
use App\Http\Controllers\RegistrationControllerRu;
use App\Http\Controllers\VaqtControllerRu;
use App\Http\Controllers\QidiruvControllerRu;
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
//russian
//navbat
Route::get('/navbatstoreru', [QidiruvControllerRu::class, 'navbatstore'])->name('navbat.storeru');
//navbat
//login and registration
Route::get('/loginru', [AuthManagerRu::class, 'adminlogin'])->name('loginru');
Route::post('/adminloginru', [AuthManagerRu::class, 'adminloginPost'])->name('adminlogin.postru');
Route::get('/adminlogoutru', [AuthManagerRu::class, 'adminlogout'])->name('adminlogoutru');
Route::get('/registerru', [RegistrationControllerRu::class, 'register'])->name('registerru');
Route::post('/registerru', [RegistrationControllerRu::class, 'store'])->name('register.submitru');
//login and registration
//
//Route::get('/qidiruv', [QidiruvController::class, 'qidiruv'])->name('qidiruv');
Route::get('/ru', [QidiruvControllerRu::class, 'qidiruv'])->name('qidiruvru');
Route::get('/navbatru', [QidiruvControllerRu::class, 'navbat'])->name('navbatru');
Route::get('/navbatkorishru', [QidiruvControllerRu::class, 'navbatkorish'])->name('navbat.korishru');
Route::get('/navbattekshirishru', [QidiruvControllerRu::class, 'navbattekshirish'])->name('navbat.tekshirishru');
Route::get('/navbatbekorru', [QidiruvControllerRu::class, 'navbatbekor'])->name('navbat.bekorru');
//

Route::middleware(['auth', 'admin'])->group(function () {
Route::get('/adminhomeru', function () { return view('russian.base'); })->name('adminhomeru'); 
//Route::get('/', function () {return view('admin.base');})->name('/');
//vaqt
Route::get('/vaqtru', [VaqtControllerRu::class, 'vaqt'])->name('vaqtru');
Route::post('/addvaqtru', [VaqtControllerRu::class, 'store'])->name('vaqt.storeru');
Route::post('/delete-vaqtru', [VaqtControllerRu::class, 'delete'])->name('delete.vaqtru');
//vaqt
//navbat
Route::get('/adminnavbatru', [VaqtControllerRu::class, 'navbat'])->name('adminnavbatru');
Route::get('/adminnavbattasdiqru', [VaqtControllerRu::class, 'navbattasdiq'])->name('adminnavbattasdiqru');
Route::get('/adminnavbatxizmatru', [VaqtControllerRu::class, 'navbatxizmat'])->name('adminnavbatxizmatru');
Route::post('/tasdiq-navbatru', [VaqtControllerRu::class, 'tasdiqlash'])->name('tasdiq.navbatru');
Route::post('/xizmat-navbatru', [VaqtControllerRu::class, 'xizmat'])->name('xizmat.navbatru');
Route::post('/delete-navbatru', [VaqtControllerRu::class, 'navbatdelete'])->name('delete.navbatru');
//navbat
});
//russian

//english
//navbat
Route::get('/navbatstoreeng', [QidiruvControllerEng::class, 'navbatstore'])->name('navbat.storeeng');
//navbat
//login and registration
Route::get('/logineng', [AuthManagerEng::class, 'adminlogin'])->name('logineng');
Route::post('/adminlogineng', [AuthManagerEng::class, 'adminloginPost'])->name('adminlogin.posteng');
Route::get('/adminlogouteng', [AuthManagerEng::class, 'adminlogout'])->name('adminlogouteng');
Route::get('/registereng', [RegistrationControllerEng::class, 'register'])->name('registereng');
Route::post('/registereng', [RegistrationControllerEng::class, 'store'])->name('register.submiteng');
//login and registration
//
//Route::get('/qidiruv', [QidiruvController::class, 'qidiruv'])->name('qidiruv');
Route::get('/eng', [QidiruvControllerEng::class, 'qidiruv'])->name('qidiruveng');
Route::get('/navbateng', [QidiruvControllerEng::class, 'navbat'])->name('navbateng');
Route::get('/navbatkorisheng', [QidiruvControllerEng::class, 'navbatkorish'])->name('navbat.korisheng');
Route::get('/navbattekshirisheng', [QidiruvControllerEng::class, 'navbattekshirish'])->name('navbat.tekshirisheng');
Route::get('/navbatbekoreng', [QidiruvControllerEng::class, 'navbatbekor'])->name('navbat.bekoreng');
//

Route::middleware(['auth', 'admin'])->group(function () {
Route::get('/adminhomeeng', function () { return view('english.base'); })->name('adminhomeeng'); 
//Route::get('/', function () {return view('admin.base');})->name('/');
//vaqt
Route::get('/vaqteng', [VaqtControllerEng::class, 'vaqt'])->name('vaqteng');
Route::post('/addvaqteng', [VaqtControllerEng::class, 'store'])->name('vaqt.storeeng');
Route::post('/delete-vaqteng', [VaqtControllerEng::class, 'delete'])->name('delete.vaqteng');
//vaqt
//navbat
Route::get('/adminnavbateng', [VaqtControllerEng::class, 'navbat'])->name('adminnavbateng');
Route::get('/adminnavbattasdiqeng', [VaqtControllerEng::class, 'navbattasdiq'])->name('adminnavbattasdiqeng');
Route::get('/adminnavbatxizmateng', [VaqtControllerEng::class, 'navbatxizmat'])->name('adminnavbatxizmateng');
Route::post('/tasdiq-navbateng', [VaqtControllerEng::class, 'tasdiqlash'])->name('tasdiq.navbateng');
Route::post('/xizmat-navbateng', [VaqtControllerEng::class, 'xizmat'])->name('xizmat.navbateng');
Route::post('/delete-navbateng', [VaqtControllerEng::class, 'navbatdelete'])->name('delete.navbateng');
//navbat
});
//english

//uzbek
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

Route::middleware(['auth', 'admin'])->group(function () {
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
//uzbek