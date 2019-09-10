<?php

namespace App\Components\ProfileTemplates\Templates;

use App\Models\User;

class SimpleTemplate extends Template
{
    public function getTemplate()
    {
        return "simple.index";
    }

    protected function getAdditionalData(User $user): array
    {
        $user->load('posts');

        return [];
    }
}
