<?php

namespace App\Components\ProfileTemplates\Templates;

use App\Models\Invitations;
use App\Models\User;

/**
 * Extend this class to provide new profile templates for the user to choose from.
 */
abstract class Template
{
    abstract public function getTemplate();

    /**
     * Load any data required by this template
     * @param User $user
     * @return array
     */
    abstract protected function getAdditionalData(User $user): array;

    /**
     * Load any data that are shared by all templates
     * @param User $user
     * @return array
     */
    public function getData(User $user): array
    {
        $data = [
            "pending" => Invitations::pending($user->id),
            "successful" => Invitations::successful($user->id),
        ];

        $additional = $this->getAdditionalData($user);

        return array_merge($data, $additional);
    }
}

