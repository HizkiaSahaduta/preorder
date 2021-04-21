<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;

class MyAccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        return view('layouts.MyAccount');
    }

}
