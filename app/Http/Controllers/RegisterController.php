<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    function getUsers(Request $req){
        return $req->input();
       }
    }

