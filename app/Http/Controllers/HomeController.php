<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use function redirect;
use function view;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        return view('home')->with(['warning'=> $request->query('warning')]);
    }

    public function redirectToIndex(Request $request){
        return redirect()->route('home');

    }
}
