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

    function check_login($username, $password)
    {
        $result = false;
        $message = '';
        $user = [];
        try {
            $sql = "SELECT * FROM users WHERE username = ? AND is_active = 1";
            $stm = $this->con->prepare($sql);
            $stm->bind_param('s', $username);
            $stm->execute();
            $hasil = $stm->get_result();
            $user = $hasil->fetch_array(MYSQLI_ASSOC);
        } catch (\Exception $e) {
            $message = 'Error : ' . $e->getMessage();
        }

        if (! $user) {
            $message .= ' Invalid user!';
            return [$result, $message, $user];
        }

        // check password
        if (! password_verify($password, $user['password'])) {
            $message .= ' Invalid password!';
            return [$result, $message, $user];
        }

        // ok
        $result = true;


        return [$result, $message, $user];
    }

    
    function get_total_user($status = '')
    {
        $total = 0;

        $where = '1';
        // jika spesifik
        switch ($status) {
            case 'active':
                $where = ' is_active = 1 ';
                break;
            
            case 'non-active':
                $where = ' is_active = 0 ';
                break;
            
            default:
                # code...
                break;
        }
        
        try {
            $data = $this->con->query("SELECT count(id) AS total FROM users WHERE $where");
            $result = $data->fetch_array(MYSQLI_ASSOC);
            $total = $result['total'];
        } catch (\Throwable $th) {
            //throw $th;
        }
        
        return $total;
    }

}


// misal, di coba disini
// $db = new Database();
// $data = $db->get_data_users();

// echo '<pre>';
// var_dump($data);
// echo '</pre>';
