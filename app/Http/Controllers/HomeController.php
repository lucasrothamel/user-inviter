<?php

namespace App\Http\Controllers;

use App\Models\Invitations;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $pending = Invitations::pending(Auth::user()->id);
        $successful = Invitations::successful(Auth::user()->id);

        return view('home', ["successful" => $successful, "pending" => $pending]);
    }
}
