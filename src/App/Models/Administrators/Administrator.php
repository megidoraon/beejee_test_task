<?php

namespace App\Models\Administrators;

use App\Exceptions\InvalidArgumentException;
use App\Models\ActiveRecord;

class Administrator extends ActiveRecord
{
    /** @var string */
    protected $login;

    /** @var string */
    protected $passwordHash;

    /** @var string */
    protected $authToken;

    /**
     * @return string
     */
    public function getPasswordHash(): string
    {
        return $this->passwordHash;
    }

    /**
     * @return string
     */
    public function getAuthToken(): string
    {
        return $this->authToken;
    }

    /**
     * @return string
     */
    protected static function getTableName(): string
    {
        return 'administrators';
    }

    private function refreshAuthToken(): void
    {
        $this->authToken = sha1(random_bytes(100)) . sha1(random_bytes(100));
    }

    /**
     * @param array $loginData
     * @return Administrator
     * @throws InvalidArgumentException
     */
    public static function login(array $loginData): Administrator
    {
        if (empty($loginData['login'])) {
            throw new InvalidArgumentException('Введите логин');
        }

        if (empty($loginData['password'])) {
            throw new InvalidArgumentException('Введите пароль');
        }

        $administrator = Administrator::findOneByColumn('login', strip_tags(trim(htmlentities($loginData['login']))));
        if ($administrator === null) {
            throw new InvalidArgumentException('Нет пользователя с таким логином');
        }

        if (!password_verify(strip_tags(trim(htmlentities($loginData['password']))), $administrator->getPasswordHash())) {
            throw new InvalidArgumentException('Неправильный пароль');
        }

        $administrator->refreshAuthToken();
        $administrator->save();

        return $administrator;
    }


}