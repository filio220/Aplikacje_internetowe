<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('name', function(){
    return "Imię";
});

Route::redirect('imie', 'name');

/*Route::get('city', function(){
    return view('city', ['firstName' => 'Janusz', 'lastName' => 'Nowak', 'city' => 'Poznań']);
});*/

Route::get('city_data', function(){
    return "test";
});

/*Route::get('city_data/{city}', function($city){
    return view('city', ['firstName' => 'Janusz', 'lastName' => 'Nowak', 'city' => $city]);
});*/

Route::get('city_data/{city}/{street?}', function($city, $street=null){
    return view('city', ['firstName' => 'Janusz', 'lastName' => 'Nowak', 'city' => $city, 'street' => $street]);
});

//miasto_data => city_data
Route::redirect('miasto_data', 'city_data');
Route::redirect('miasto_data/{city}/{street?}', '/city_data/{city}/{street?}');
//Route::view()

Route::get('pages/{x}', function($x){
    $pages = [
        "contact" => "kontakt@wp.pl",
        "home" => "Strona domowa",
        "about" => "Strona o mnie"
    ];
    return $pages[$x]??"Błędne dane podane przez użytkownika";
});


