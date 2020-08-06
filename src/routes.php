<?php
//массив роутингов со значением контроллера и экшена
return [
    '~^$~' => [\App\Controllers\MainController::class, 'main'],
    '~^tasks/add~' => [\App\Controllers\TasksController::class, 'add'],
    '~^tasks/(\d+)/edit$~' => [\App\Controllers\TasksController::class, 'edit'],
    '~^login~' => [\App\Controllers\AdministratorsController::class, 'login'],
    '~^logout~' => [\App\Controllers\AdministratorsController::class, 'logout'],
];
