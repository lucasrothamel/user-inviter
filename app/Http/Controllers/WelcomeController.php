<?php

namespace App\Http\Controllers;

class WelcomeController extends Controller
{
    /**
     * Show the guest page
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('welcome');
    }
}
