<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(Request $request): View
    {
        return view('home')->with(['warning'=> $request->query('warning')]);
    }

    public function redirectToIndex(): RedirectResponse
    {
        return redirect()->route('home');

    }
}
