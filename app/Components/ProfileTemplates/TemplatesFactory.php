<?php

namespace App\Components\ProfileTemplates;

use App\Components\ProfileTemplates\Templates\SimpleTemplate;
use App\Models\User;

class TemplatesFactory
{
    public function get(User $user)
    {
        $user->load('profileTemplate');

        if (empty($user->profileTemplate)) {
            throw new InvalidTemplateException("no template set for user {$user->id}");
        }

        switch ($user->profileTemplate->name) {
            case "simple":
                return new SimpleTemplate();
        }

        throw new InvalidTemplateException("unknown Template: {$user->profileTemplate->name}");
    }
}
