<?php

namespace App\Services;

use App\Models\Administrators\Administrator;

final class AdministratorAuthService
{
    /**
     * @param Administrator $administrator
     */
    public static function createToken(Administrator $administrator): void
    {
        $token = $administrator->getId() . ':' . $administrator->getAuthToken();
        setcookie('token', $token, 0, '/', '', false, true);
    }

    /**
     * @return Administrator|null
     */
    public static function getAdministratorByToken(): ?Administrator
    {
        $token = $_COOKIE['token'] ?? '';

        if (empty($token)) {
            return null;
        }

        [$administratorId, $authToken] = explode(':', $token, 2);

        $administrator = Administrator::getById((int) $administratorId);

        if ($administrator === null) {
            return null;
        }

        if ($administrator->getAuthToken() !== $authToken) {
            return null;
        }

        return $administrator;
    }
}