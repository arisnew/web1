<?php
@session_start();

class App {
    protected $app_name = 'My App';
    protected $app_version = '1.0';
    protected $base_url = 'http://localhost:81/web1/';

    // page
    public $title = '';
    protected $active_menu = false;

    function set_active_menu($menu) {
        $this->active_menu = $menu;
    }

    function is_active_menu($menu) {
        if ($this->active_menu == $menu) {
            return ' active ';
        }
        return '';
    }

    function get_app_name(){
        return $this->app_name;
    }

    function get_app_version(){
        return $this->app_version;
    }

    function site_url($page = '') {
        return $this->base_url . $page;
    }
    
}

function check_login() {
    if (! isset($_SESSION['username'])) {
        $_SESSION['error_msg'] = 'Silahkan login terlebih dahulu!';
        header('Location: login.php');
        exit();
    }
}

$page = new App();