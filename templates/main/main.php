<?php include __DIR__ . '/../header.php'; ?>

<div class="row">
    <div class="col-12">
        <h1>Список задач</h1>
    </div>
    <div class="col-12">
        <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>Id</th>
                <th>Имя</th>
                <th>Email</th>
                <th>Текст</th>
                <th>Статус</th>
                <?php if (!empty($administrator)): ?>
                    <th>Редактирование</th>
                <?php endif; ?>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>Id</th>
                <th>Имя</th>
                <th>Email</th>
                <th>Текст</th>
                <th>Статус</th>
                <?php if (!empty($administrator)): ?>
                    <th>Редактирование</th>
                <?php endif; ?>
            </tr>
            </tfoot>
            <tbody>
            <?php if (!empty($tasks)): ?>
                <?php foreach ($tasks as $task): ?>
                    <tr>
                        <td><?= $task->getId() ?></td>
                        <td><?= $task->getUserName() ?></td>
                        <td><?= $task->getEmail() ?></td>
                        <td><?= $task->getText() ?></td>
                        <td><?= $task->getStatus() === 0 ? 'Не выполнена' : 'Выполнена' ?></td>
                        <?php if (!empty($administrator)): ?>
                            <td><a href="/tasks/<?= $task->getId() ?>/edit">Отредактировать задачу</a></td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include __DIR__ . '/../footer.php'; ?>