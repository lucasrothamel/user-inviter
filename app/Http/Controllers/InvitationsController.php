<?php

namespace App\Http\Controllers;

use App\Models\Invitations;

class InvitationsController extends Controller
{
    /**
     * Display a listing of all the invitations for administrators use
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invitations = Invitations::query()
            ->with('userCreated', 'userInvited', 'method')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('invitations')->with(["invitations" => $invitations]);
    }
}
