<?php
session_start();

require_once('../inc/database.php');
// koneksi db
$db = new Database();

// data dr form
$username = $_POST['username'];
$password = $_POST['password'];

// validasi
if (! $username) {
    // TODO
}

$results = $db->check_login($username, $password);

// jika ok -> buat session
if ($results[0]) {
    $_SESSION['username'] = $results[2]['id'];
    $_SESSION['full_name'] = $results[2]['full_name'];
    
    header('Location: user.php');
} else {
    $_SESSION['error_msg'] = $results[1];
    header('Location: login.php');
}