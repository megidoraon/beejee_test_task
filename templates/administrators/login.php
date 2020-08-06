<?php include __DIR__ . '/../header.php'; ?>

<div class="row">
    <div class="col-12">
        <h1>Авторизация</h1>
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
        <form action="/login" method="post">
            <div class="form-group">
                <label for="exampleInputLogin">Логин</label>
                <input name="login" type="name" class="form-control" id="exampleInputLogin" placeholder="Введите логин" value="<?= $_POST['login'] ?? '' ?>">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Пароль</label>
                <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Введите пароль">
            </div>
            <button type="submit" class="btn btn-primary">Войти</button>
        </form>
    </div>
</div>

<?php include __DIR__ . '/../footer.php'; ?>