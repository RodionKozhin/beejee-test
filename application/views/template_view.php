<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>BeeJee Test</title>

    <link rel="stylesheet" href="/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Задачник</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/">Список задач</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/main/add_task/">Создать задачу</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <?php if ($is_admin): ?>
                    <a class="btn btn-outline-success my-2 my-sm-0" href="/main/logout">Выйти</a>
                <?php else: ?>
                    <a class="btn btn-outline-success my-2 my-sm-0" href="/main/login">Войти</a>
                <?php endif; ?>
            </form>
        </div>
    </nav>
</div>

<?php include 'application/views/'.$content_view; ?>

<?php if (isset($message) && !empty($message)): ?>
    <div class="container my-4">
        <div class="row">
            <div class="col-sm">
                <div class="alert alert-success" role="alert">
                    <?=$message?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php if (isset($error) && !empty($error)): ?>
    <div class="container my-4">
        <div class="row">
            <div class="col-sm">
                <div class="alert alert-danger" role="alert">
                    <?=$error?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<script src="/js/jquery-3.3.1.slim.min.js"></script>
<script src="/js/popper.min.js"></script>
<script src="/js/bootstrap.min.js"></script>

</body>
</html>