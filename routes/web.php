<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Route;

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
    return '<h1><center>welcome to the, manytomany relation crud</center></h1>';
});

//------------------MANY TO MANY RELATION CREATE DATA---------------

Route::get('/create', function (){

    $user = User::find(1);

    $role = new Role(['name'=>'admin']);

    $user->roles()->save($role);

});

//------------------MANY TO MANY RELATION READ DATA---------------

Route::get('/read', function (){

    $user = User::findorfail(1);

//    dd($user->roles); //dye dump collection of data
//
    foreach ($user->roles as $role){

        return $role->name;
//        dd($role);

    }

});


//------------------MANY TO MANY RELATION UPDATE DATA---------------

Route::get('/update', function (){

    $user = User::findorfail(1);


    if($user->has('roles')){

    foreach ($user->roles as $role){

        if($role->name == 'Admin'){

            $role->name = "admin";
            $role->update();
        }

    }

    }

});

//------------------MANY TO MANY RELATION DELETE DATA---------------

Route::get('/delete', function (){

    $user = User::findorfail(1);

    foreach ($user->roles as $role){

        $role->whereName('admin')->delete();

    }


});

//------------------MANY TO MANY RELATION ATTACHING/detaching---------------

Route::get('/attach', function (){

    $user = User::findorfail(1);

    $user->roles()->attach(6);


});

Route::get('/detach', function (){

    $user = User::findorfail(1);

    $user->roles()->detach(3); //in not specified the role if in the "detach()", hence will delete all the roles of that specific user


});

//------------------MANY TO MANY RELATION SYNC---------------

Route::get('/sync', function (){

    $user = User::findorfail(1);

    $user->roles()->sync([4,6]); //roles id that are not given in the sync parameter"sync([])" hence will be deleted from the "role_user" table
    


});
