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


/*  this is how to retrieve data  ======================================*/
Route::get('/findAll',function() {

    //$Table =  User::where('id',1)->orderBy('id', 'desc')->get();
      $Table =  User::orderBy('id', 'asc')->get(); //  this will bring all the things .
    //$Table = User::where('id', '<' , 50)->firstOrFail() ;
    return $Table ;
}) ;

Route::get('find2' , function(){
   $posts = User::findOrFail(1);
   return $posts ;
});

/* retrieve ends =======================================================*/


/* data insertion with Elequent ========================================*/
Route::get('insert', function() {

    $date = date("D") ;

   DB::insert('insert into users(name , email , password) values(?,?,?)',['Saad'.$date,'s14192009@gmail.com',$date]);

});

Route::get('/ins2',function (){

    $Post = new User ;
    $Post->name = 'SaadAgain';
    $Post->email = 's14192009+1@gmail.com' ;
    $Post->Password = 'S20102010';

    $Post->save();



});


/* data insertion with Elequent ends ====================================*/


/* data update with Elequent ================================***========*/
Route::get('/update',function (){

    $Post = User::find(1) ;
    $Post->name = 'SaadUpdated';
    $Post->email = 's14192009Updated@gmail.com' ;
    $Post->Password = 'S20102010updated';

    $Post->save();



});

Route::get('/update2' , function (){

    // no need to fill all the parameters in case of updating
    User::where('id',6)->update(['name'=>'saadFromUpdate2','email'=>'FU2@FU2.com']);

});


/* data update with Elequent ends ====================================*/

/* Mass assignment operation or something */


Route::get('/create',function (){

User::create(['name'=>'saadCreatTest3', 'email'=>'create3@create.com' , 'password'=>'Whatever3']);

});

/* Mass assignment operation or something ends */


/*delete data starts here */

Route::get('/delete/{id}',function($id){

    $User = User::find($id) ;
    $User->delete();
});


//other way

Route::get('delete2/{id}',function ($id){

    User::destroy($id) ; 
});


/* delete data ends here */

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
