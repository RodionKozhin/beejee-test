<div class="container">
    <div class="row">
        <div class="col-sm">
            <h1 class="py-4">Авторизация</h1>

            <form action="/main/login/" method="post">
                <div class="form-group">
                    <label for="name">Имя пользователя</label>
                    <input type="text" class="form-control" name="name" id="name">
                </div>
                <div class="form-group">
                    <label for="password">Пароль</label>
                    <input type="password" class="form-control" name="password" id="password">
                </div>
                <button type="submit" class="btn btn-primary">Войти</button>
            </form>
        </div>
    </div>
</div>