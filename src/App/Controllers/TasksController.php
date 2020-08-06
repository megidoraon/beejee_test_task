<?php

namespace App\Controllers;

use App\Exceptions\NotFoundException;
use App\Exceptions\UnauthorizedException;
use App\Models\Tasks\Task;
use App\Exceptions\InvalidArgumentException;

class TasksController extends AbstractController
{
    public function add(): void
    {
        if (!empty($_POST)) {
            try {
                $task = Task::createTask($_POST);
            } catch (InvalidArgumentException $exception) {
                $this->view->renderHtml('tasks/add.php', ['error' => $exception->getMessage()]);
                return;
            }
            $this->view->renderHtml('tasks/add.php', ['success' => 'Задача создана']);
            exit();
        }

        $this->view->renderHtml('tasks/add.php');
    }

    public function edit(int $taskId): void
    {
        $task = Task::getById($taskId);

        if ($task === null) {
            throw new NotFoundException();
        }

        if ($this->administrator === null) {
            throw new UnauthorizedException();
        }

        if (!empty($_POST)) {
            try {
                $task->updateTask($_POST);
            } catch (InvalidArgumentException $exception) {
                $this->view->renderHtml('tasks/edit.php', ['error' => $exception->getMessage(), 'task' => $task]);
                return;
            }

            header('Location: /');
            exit();
        }

        $this->view->renderHtml('tasks/edit.php', ['task' => $task]);
    }
}