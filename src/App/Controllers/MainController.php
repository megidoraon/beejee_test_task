<?php

namespace App\Controllers;

use App\Models\Tasks\Task;

class MainController extends AbstractController
{
    public function main(): void
    {
        $tasks = Task::findAll();
        $this->view->renderHtml('/main/main.php', ['tasks' => $tasks, 'title' => 'Главная страница']);
    }
}