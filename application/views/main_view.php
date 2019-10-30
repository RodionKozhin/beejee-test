<div class="container">
    <div class="row">
        <div class="col-sm">
            <h1 class="py-4">Список задач</h1>

            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Имя пользователя
                        <a class="<?="{$order}_{$by}" == "name_desc" ? 'text-dark' : ''?>" href="?page=<?=$page?>&order=name&amp;by=desc">&#9660;</a>
                        <a class="<?="{$order}_{$by}" == "name_asc" ? 'text-dark' : ''?>" href="?page=<?=$page?>&order=name&amp;by=asc">&#9650;</a>
                    </th>
                    <th scope="col">Email
                        <a class="<?="{$order}_{$by}" == "email_desc" ? 'text-dark' : ''?>" href="?page=<?=$page?>&order=email&amp;by=desc">&#9660;</a>
                        <a class="<?="{$order}_{$by}" == "email_asc" ? 'text-dark' : ''?>" href="?page=<?=$page?>&order=email&amp;by=asc">&#9650;</a>
                    </th>
                    <th scope="col">Текст задачи</th>
                    <th scope="col">Статус
                        <a class="<?="{$order}_{$by}" == "done_desc" ? 'text-dark' : ''?>" href="?page=<?=$page?>&order=done&amp;by=desc">&#9660;</a>
                        <a class="<?="{$order}_{$by}" == "done_asc" ? 'text-dark' : ''?>" href="?page=<?=$page?>&order=done&amp;by=asc">&#9650;</a>
                    </th>
                </tr>
                </thead>
                <tbody>

                <?php foreach ($tasks as $task): ?>
                    <tr>
                        <th scope="row"><?=$task['name']?></th>
                        <td><?=$task['email']?></td>
                        <td><?=$task['text']?>
                            <?php if ($is_admin): ?>
                            <br>
                            <a href="/main/add_task/?id=<?=$task['id']?>">Редактировать</a>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if ($task['done']): ?>
                                <small>Выполнено</small>
                            <?php else: ?>
                                <small>Не выполнено</small>
                            <?php endif; ?>

                            <?php if ($task['edited']): ?>
                                <br><small>Отредактировано администратором</small>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>

                </tbody>
            </table>

            <nav aria-label="Page navigation example">
                <ul class="pagination">

                    <?php for ($i = 0; $i < $pages_count; $i++): ?>
                        <li class="page-item <?=$i == $page? 'active' : ''?>"><a class="page-link" href="?page=<?=$i?>&order=<?=$order?>&amp;by=<?=$by?>"><?=$i+1?></a></li>
                    <?php endfor; ?>

                </ul>
            </nav>

        </div>
    </div>
</div>