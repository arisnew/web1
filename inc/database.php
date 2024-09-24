<?php
class database
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

    function tampil_data()
    {
        $data = $this->con->query("select * from users");
        $hasil = [];
        while ($d = $data->fetch_assoc()) {
            $hasil[] = $d;
        }
        return $hasil;
    }
}


// di coba disini
$db = new database();
$data = $db->tampil_data();
var_dump($data);
