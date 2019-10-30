<?php
class Model_Users extends Model
{
    public function login($post) {
        $post = array_map("trim", $post);

        $message = "";
        $error = "";

        if (isset($post['name']) && isset($post['password']) && !empty($post['name']) && !empty($post['password'])) {

            $user = DB::run("SELECT `id`, `name`, `password` as `hash` FROM `users` WHERE `name` = ?", [$post['name']])->fetch();

            if (!$user) {
                $error = "Пользователь не найден.";
            }
            else {
                $verified = password_verify($post['password'], $user['hash']);

                if ($verified) {
                    $message = "Правильный пароль.";
                    $_SESSION['is_admin'] = true;
                }
                else {
                    $error = "Неправильный пароль.";
                }
            }
        }
        else {
            $error = "Заполните все поля.";
        }

        return array("message" => $message, "error" => $error);
    }
}