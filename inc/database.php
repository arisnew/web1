<?php
class Database
{

    private $host = "127.0.0.1";
    private $uname = "root";
    private $pass = "root";
    private $db = "webdb1";
    public $con;

    function __construct()
    {
        $this->con = new mysqli($this->host, $this->uname, $this->pass, $this->db);
        if (mysqli_connect_error()) {
            die("error");
        } else {
            return $this->con;
        }
    }

    function get_data_users()
    {
        $data = $this->con->query("SELECT * FROM users");
        $hasil = [];
        while ($d = $data->fetch_assoc()) {
            $hasil[] = $d;
        }
        return $hasil;
    }

    function get_single_data_user($id)
    {
        $id = (int) $id;
        $data = $this->con->query("SELECT * FROM users WHERE id = $id");
        $hasil = $data->fetch_array(MYSQLI_ASSOC);
        return $hasil;
    }
}


// misal, di coba disini
// $db = new Database();
// $data = $db->get_data_users();

// echo '<pre>';
// var_dump($data);
// echo '</pre>';
