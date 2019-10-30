<div class="container">
    <div class="row">
        <div class="col-sm">
            <h1 class="py-4">Создать задачу</h1>

            <form action="/main/add_task/<?=isset($task['id'])? "?id={$task['id']}" : '' ?>" method="post">
                <div class="form-group">
                    <label for="name">Имя пользователя</label>
                    <input type="text" class="form-control" name="name" id="name" value="<?=isset($task['name'])? $task['name'] : '' ?>">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" name="email" id="email" value="<?=isset($task['email'])? $task['email'] : '' ?>">
                </div>
                <div class="form-group">
                    <label for="text">Текст задачи</label>
                    <textarea class="form-control" name="text" id="text"><?=isset($task['text'])? $task['text'] : '' ?></textarea>
                </div>

                <?php if ($is_admin && isset($task['id']) && $task['id']): ?>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" name="done" id="done" <?=isset($task['done']) && $task['done']? 'checked' : '' ?> value="1">
                        <label class="form-check-label" for="done">Выполнено</label>
                    </div>

                    <input type="hidden" name="id" id="id" value="<?=isset($task['id'])? $task['id'] : '' ?>">
                <?php endif; ?>
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </form>
        </div>
    </div>
</div>