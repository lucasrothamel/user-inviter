<?php

namespace App\Components\ProfileTemplates;

use App\Models\User;

/**
 * Class ProfileTemplate
 * Provide an easy to extend profile templates functionality
 * @package App\Components\ProfileTemplates
 */
class ProfileTemplate
{
    private $templatesFactory;

    private $profilesFolder = 'profiles';

    public function __construct(TemplatesFactory $templatesFactory)
    {
        $this->templatesFactory = $templatesFactory;
    }

    /**
     * @param  User $user
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     * @throws InvalidTemplateException
     */
    public function getTemplate(User $user)
    {
        $user->load('invitations', 'profileTemplate');

        $template = $this->templatesFactory->get($user);
        $templateName = $template->getTemplate();
        $data = $template->getData($user);

        return view($this->profilesFolder . '.' . $templateName, compact('user', 'data'));
    }
}
