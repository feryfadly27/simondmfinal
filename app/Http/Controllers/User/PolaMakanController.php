<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class PolaMakanController extends Controller
{
    public function index()
    {
        return view('user.pola-makan');
    }
}
