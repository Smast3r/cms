<?php

use Illuminate\Support\Facades\Route;
use App\Models\User ;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/find',function() {

    $Table =  User::where('id',1)->orderBy('id')->get();
    return $Table ;
}) ;

Route::get('insert', function() {

    $date = date("D") ;

   DB::insert('insert into users(name , email , password) values(?,?,?)',['Saad'.$date,'s14192009@gmail.com',$date]);

});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
