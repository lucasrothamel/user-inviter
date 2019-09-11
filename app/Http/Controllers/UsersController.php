<?php

namespace App\Http\Controllers;

use App\Components\ProfileTemplates\ProfileTemplate;
use App\Models\User;

class UsersController extends Controller
{
    private $profileTemplate;

    public function __construct(ProfileTemplate $profileTemplate)
    {
        $this->profileTemplate = $profileTemplate;
    }

    public function index()
    {
        $users = User::allUsers();

        return view('users.index', compact('users'))
            ->with(["input" => request()->all()]);
    }

    /**
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \App\Components\ProfileTemplates\InvalidTemplateException
     */
    public function details(User $user)
    {
        return $this->profileTemplate->getTemplate($user);
    }
}
