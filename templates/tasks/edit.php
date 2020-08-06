<?php include __DIR__ . '/../header.php'; ?>

<div class="row">
    <div class="col-12">
        <h1>Редактирование задачи</h1>
    </div>
    <div class="col-12">
        <?php if(!empty($error)): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= $error ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
        <?php if(!empty($success)): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= $success ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
        <form action="/tasks/<?= $task->getId() ?>/edit" method="post">
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Текст задачи</label>
                <textarea name="text" class="form-control" id="exampleFormControlTextarea1" rows="3"><?= $task->gettext() ?></textarea>
            </div>
            <div class="form-check">
                <input name="status" type="checkbox" class="form-check-input" id="exampleCheck1" <?= $task->getStatus() == 1 ? 'checked' : '' ?>>
                <label class="form-check-label" for="exampleCheck1">Задача выполнена</label>
            </div>
            <button type="submit" class="btn btn-primary">Обновить</button>
        </form>
    </div>
</div>

<?php include __DIR__ . '/../footer.php'; ?>