<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    function getUsers(){
    //     $name = 'rawya';
    //     $age='18';
    //    // return view ('Users',compact('name','age') ); //compact method
    //    return view('Users')  //with method 
    //    ->with('name', $name)
    //    ->with('age', $age);
 
    $users = [
        'user1' => 'rawya',
        'user2' => 'aziz',
        'user3' => 'ahmed',
        'user4' => 'mouhamed',
    ];

    return view('Users')->with('users', $users);
   }
}
