<?php
include_once('../inc/config.php');

// check apakah sudah login
check_login();

require_once('../inc/database.php');

$db = new Database();


$id = (int) $_GET['id'];

// TODO validasi / pastikan bs hapus
if (! $id) {
    header('location: user.php');
    exit();
}

// delete
$sql = "DELETE FROM users WHERE id = ?";
$statement = $db->con->prepare($sql);
$statement->bind_param('i', $id);
$result = $statement->execute();

// redirect
header('location: user.php');