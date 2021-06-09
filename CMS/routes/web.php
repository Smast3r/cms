<?php

use App\Models\Message;
use Illuminate\Support\Facades\Route;
use App\Models\User ;
use App\Models\Files ;
use App\Models\Role ;
use App\Models\Country;

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
    foreach ($Table as $opj){
    echo $opj->id.' '.$opj->name.' <br> ';
    }


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

/* Mass assignment operation or something =========================================================*/


Route::get('/create',function (){

User::create(['name'=>'saadCreatTest3', 'email'=>'create3@create.com' , 'password'=>'Whatever3']);

});

/* Mass assignment operation or something ends =========================================================*/


/*delete data starts here =========================================================*/

Route::get('/delete/{id}',function($id){

    $User = User::find($id) ;
    $User->delete();
});


//other way

Route::get('delete2/{id}',function ($id){

    User::destroy($id) ;
});


/* delete data ends here =========================================================*/


/*Soft delete starts here !!=========================================================*/
Route::get('/softD',function (){

User::find(6)->delete();

});

Route::get('/RSD',function (){

  return  User::withTrashed()->orderBy('id')->get() ;

});

Route::get('/RSDD',function (){

    return  User::onlyTrashed()->orderBy('id')->get() ;

});


Route::get('/restore', function(){

    User::withTrashed()->where('id',1)->restore();

});


Route::get('/FD',function (){
    User::withTrashed()->where('id',4)->forceDelete();
});

/*Soft delete ends here !!=========================================================*/

/*Relations starts here !!=========================================================*/

//one to one --
//
//Route::get('/user/{id}',function ($id){
//    return User::find($id)->file ;
//
//
//});

Route::get('/file/{id}/user', function ($id) {

    return Files::find($id)->user ;
});



// one to many --

Route::get('user/{id}/posts',function ($id){

    $user = User::find(1) ;
    foreach ($user->files as $file) {

        echo $file . "<br>";

    }
});


//many to many

Route::get('/admins',function (){

    $role = Role::find(1) ;
    foreach ($role->users as $User){
        echo $User->name .' with id : '.$User->id .' is  admin '.'<br>' ;
    }
});


// accessing pivot

Route::get('/user/pivot',function(){

    $user=User::find(3);
    foreach($user->roles as $role){
        echo $role->pivot->user_id." ".$role->pivot->role_id."<br>";
    }
});

// has many through
// this is to get posts from (KSA , Bahrain) only using the users table.

Route::get('user/country',function(){

    $country = Country::find(1) ;

    foreach ($country->files as $file){

        echo $file->name ;
        echo "<br>" ;
    }

});


//Polymorphic relations
// for example messages sent to a certain user ;
Route::get('Test',function (){

    $user = User::find(1) ;
    echo $user.'<br>' ;
    $i = 1 ;
    foreach ($user->messages as $message){

        echo 'message: '.$i++.' <br> '.'content: '.$message->content  ;

    }
});


Route::get('TestInv',function (){

    Message::findOrFail(2);
    $messageable = Message::findOrFail(1)->messageable;
    return $messageable ;
});

Route::get('testP',function (){

    $file = Files::find(2) ;

    foreach ($file->tags as $tag){
        echo $tag->name.'<br>' ;
    }

});


/*Relations ends here !!=========================================================*/


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
