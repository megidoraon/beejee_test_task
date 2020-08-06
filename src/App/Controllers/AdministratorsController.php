<?php

namespace App\Controllers;

use App\Exceptions\InvalidArgumentException;
use App\Models\Administrators\Administrator;
use App\Services\AdministratorAuthService;

class AdministratorsController extends AbstractController
{
    public function login(): void
    {
        if (!empty($_POST)) {
            try {
                $administrator = Administrator::login($_POST);
                AdministratorAuthService::createToken($administrator);
                header('Location: /');
                exit();
            } catch (InvalidArgumentException $exception) {
                $this->view->renderHtml('administrators/login.php', ['error' => $exception->getMessage()]);
                return;
            }
        }
        $this->view->renderHtml('administrators/login.php');
    }

    public function logout(): void
    {
        setcookie('token', '', -1, '/', '', false, true);
        header('Location: /');
    }
}