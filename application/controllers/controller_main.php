<?php
class Controller_Main extends Controller
{
    function __construct()
    {
        $this->models = array("Tasks", "Users");
        parent::__construct();
    }

    function index()
    {
        $this->tasks = new Model_Tasks();

        $get = $_GET;

        if (isset($get["page"])) {
            $page = (int)$get["page"];
        }
        else {
            $page = 0;
        }

        if (isset($get["order"]) && isset($get["by"])) {
            $order = $get["order"];
            $by = $get["by"];
        }
        else {
            $order = "name";
            $by = "asc";
        }

        $data = $this->tasks->get_page($page, $order, $by) + array("order" => $order, "by" => $by);

        $data+= array("is_admin" => $this->is_admin());

        if (isset($_SESSION['message'])) {
            $data['message'] = $_SESSION['message'];
            unset($_SESSION['message']);
        }

        $this->view->generate('main_view.php', 'template_view.php', $data);
    }

    function add_task()
    {
        $this->tasks = new Model_Tasks();

        $data = array();
        $post = $_POST;
        $get = $_GET;

        $is_admin = $this->is_admin();

        if (!$is_admin && (isset($post['id']) || isset($get['id']))) {
            $this->redirect('/main/login/');
            die();
        }

        if (!empty($post)) {
            $data = $this->tasks->save($post);

            if (!$data['error'] && !$data['task']['id']) {
                $this->redirect();
                $_SESSION['message'] = "Данные сохранены.";
            }
        }

        if (isset($get['id']) && !empty($get['id'])) {
            $data["task"] = $this->tasks->get($get['id']);

            if (!$data["task"]) {
                $this->redirect('/404.html');
            }
        }

        $data+= array("is_admin" => $is_admin);

        $this->view->generate('add_task_view.php', 'template_view.php', $data);
    }

    function login()
    {
        $this->users = new Model_Users();

        $data = array();
        $post = $_POST;

        if (!empty($post)) {
            $data = $this->users->login($post);
        }

        if ($this->is_admin()) {
            $this->redirect();
        }

        $data+= array("is_admin" => $this->is_admin());

        $this->view->generate('login_view.php', 'template_view.php', $data);
    }

    function logout()
    {
        unset($_SESSION['is_admin']);
        $this->redirect();
    }
}