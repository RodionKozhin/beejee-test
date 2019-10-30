<?php
class Model_Tasks extends Model
{
    public $errors = array();

    public function get_page($page, $order, $by)
    {
        if (in_array($order, ['name', 'email', 'done']) && in_array($by, ['desc', 'asc'])) {
            $order_by = "ORDER BY {$order} {$by}";
        }
        else {
            $order_by = '';
        }

        $tasks_count = DB::run("SELECT COUNT(*) as `count` FROM `tasks`", [])->fetch()['count'];

        $per_page = 3;

        $pages_count = ceil($tasks_count/$per_page);

        if ($page > $pages_count - 1) {
            $page = $pages_count - 1;
        }

        if ($page < 0) {
            $page = 0;
        }

        $limit = "LIMIT ".($page*$per_page).", ".$per_page;

        $tasks = DB::run("SELECT `id`, `name`, `email`, `text`, `done`, `edited` FROM `tasks` {$order_by} {$limit}", [])->fetchAll();

        return array("tasks" => $tasks, "page" => $page, "pages_count" => $pages_count, "order" => $order, "by" => $by);
    }

    public function get($id)
    {
        $task = DB::run("SELECT `id`, `name`, `email`, `text`, `done`, `edited` FROM `tasks` WHERE `id` = ?", [$id])->fetch();

        return $task;
    }

    public function save($post)
    {
        $message = "";
        $error = "";
        $id = null;

        $post = array_map("trim", $post);
        $post = array_map("htmlspecialchars", $post);
        $post = array_map("strip_tags", $post);

        if (isset($post['id']) && !empty($post['id'])) {
            $id = $post['id'];
        }

        if ($this->validate($post)) {

            if ($id) {

                $task = $this->get($id);

                if (isset($post['done']) && !empty($post['done'])) {
                    $done = 1;
                }
                else {
                    $done = 0;
                }

                if ($task['text'] == $post['text'] && $task['edited'] != 1) {
                    $edited = 0;
                }
                else {
                    $edited = 1;
                }

                $stmt = DB::run("UPDATE `tasks` SET `name` = ?, `email` = ?, `text` = ?, `done` = ?, `edited` = ? WHERE `id` = ?",
                    [$post['name'], $post['email'], $post['text'], $done, $edited, $id]);
            }
            else {
                $stmt = DB::run("INSERT INTO `tasks` (`name`, `email`, `text`)
                VALUES (?, ?, ?)",
                    [$post['name'], $post['email'], $post['text']]);
            }

            if ($stmt->rowCount() === 1 || $id) {
                $message = "Данные сохранены.";
            }
        }
        else {
            $error = implode(" ", $this->errors);

            $task = $post;
        }

        return array("message" => $message, "error" => $error, "task" => $task);
    }

    public function validate($post) {

        if (isset($post['name']) && isset($post['email']) && isset($post['text']) && !empty($post['name']) && !empty($post['email']) && !empty($post['text'])) {

            if (strpos($post['email'], '@') !== false) {
                $result = true;
            }
            else {
                $this->errors[] = "Введен некорректный Email.";
                $result = false;
            }
        }
        else {
            $this->errors[] = "Заполните все поля.";
            $result = false;
        }

        return $result;
    }
}