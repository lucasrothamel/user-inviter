<?php

namespace App\Http\Controllers;

class InviteController extends Controller
{
    public function index()
    {
        return view('invite.index');
    }

    public function store()
    {
        return view(
            'invite.index',
            [
                "message" => "Great, you invited some users, but surely, "
                    . "you want to invite some more users...",
            ]
        );
    }
}
