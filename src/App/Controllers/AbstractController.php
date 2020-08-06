<?php

namespace App\Controllers;

use App\Models\Administrators\Administrator;
use App\Services\AdministratorAuthService;
use App\View\View;

abstract class AbstractController
{
    /** @var View */
    protected $view;

    /** @var Administrator|null */
    protected $administrator;

    /**
     * AbstractController constructor.
     */
    public function __construct()
    {
        $this->administrator = AdministratorAuthService::getAdministratorByToken();
        $this->view = new View(__DIR__ . '/../../../templates');
        $this->view->setVar('administrator', $this->administrator);
    }
}