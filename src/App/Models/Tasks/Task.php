<?php

namespace App\Models\Tasks;

use App\Models\ActiveRecord;
use App\Exceptions\InvalidArgumentException;

class Task extends ActiveRecord
{
    /** @var string */
    protected $userName;

    /** @var string */
    protected $email;

    /** @var string */
    protected $text;

    /** @var int */
    protected $status;

    /**
     * @return string
     */
    public function getUserName(): string
    {
        return $this->userName;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param string $userName
     */
    public function setUserName(string $userName): void
    {
        $this->userName = $userName;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @param string $text
     */
    public function setText(string $text): void
    {
        $this->text = $text;
    }

    /**
     * @param int $status
     */
    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    protected static function getTableName(): string
    {
        return 'tasks';
    }

    /**
     * @param array $fields
     * @return Task
     * @throws InvalidArgumentException
     */
    public static function createTask(array $fields): Task
    {
        if (empty($fields['name'])) {
            throw new InvalidArgumentException('Имя обязательно для заполнения');
        }

        if (!preg_match('/^[а-яёА-ЯЁ\s]+|[a-zA-Z\s]+$/', $fields['name'])) {
            throw new InvalidArgumentException('Имя может состоять только из символов латинского и русского алфавитов');
        }

        if (empty($fields['email'])) {
            throw new InvalidArgumentException('Email обязателен для заполнения');
        }

        if (!filter_var($fields['email'], FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException('Email некорректно заполнен');
        }

        if (empty($fields['text'])) {
            throw new InvalidArgumentException('Текст обязателен для заполнения');
        }

        $task = new Task();

        $task->setUserName(strip_tags(trim(htmlentities($fields['name']))));
        $task->setEmail(strip_tags(trim(htmlentities($fields['email']))));
        $task->setText(strip_tags(trim(htmlentities($fields['text']))));
        $task->save();

        return $task;
    }

    /**
     * @param array $fields
     * @return $this
     * @throws InvalidArgumentException
     */
    public function updateTask(array $fields): Task
    {

        if (empty($fields['text'])) {
            throw new InvalidArgumentException('Текст задачи обязателен для заполнения');
        }

        $this->setText(strip_tags(trim(htmlentities($fields['text']))));

        if (!empty($fields['status'] && $fields['status'] === 'on')) {
            $this->setStatus(1);
        } else {
            $this->setStatus(0);
        }

        $this->save();

        return $this;
    }
}