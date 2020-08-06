<?php include __DIR__ . '/../header.php'; ?>

<div class="row">
    <div class="col-12">
        <h1>Добавление задачи</h1>
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
        <form action="/tasks/add" method="post">
            <div class="form-group">
                <label for="exampleInputName">Имя</label>
                <input name="name" type="name" class="form-control" id="exampleInputName" placeholder="Введите имя" value="<?= $_POST['name'] ?? '' ?>">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Введите email" value="<?= $_POST['email'] ?? '' ?>">
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Текст задачи</label>
                <textarea name="text" class="form-control" id="exampleFormControlTextarea1" rows="3"><?= $_POST['text'] ?? '' ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Создать</button>
        </form>
    </div>
</div>

<?php include __DIR__ . '/../footer.php'; ?>