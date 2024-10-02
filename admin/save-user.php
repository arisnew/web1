<?php

require_once('../inc/database.php');

$db = new Database();

// tangkap data dari form
$full_name = $_POST['full-name'];
$username = $_POST['username'];
$password = $_POST['password'];
$level = $_POST['access-level'];

$id = (int) $_POST['id'];

// TODO validasi

if ($id) {
    // TODO seharusnya divalidasi dulu apakah id valid

    // update
    $sql = "UPDATE users 
        SET full_name = ?, 
            password = ?,
            level = ?
        WHERE id = ?";

    // TODO try catch
    $password = password_hash($password, PASSWORD_DEFAULT);
    $statement = $db->con->prepare($sql);
    $statement->bind_param('sssi', $full_name, $password, $level, $id);

    $result = $statement->execute();
} else {
    // insert
    $sql = "INSERT INTO users (full_name, username, password, level) VALUES (?, ?, ?, ?)";

    // TODO try catch
    // NOTE password HASH
    $password = password_hash($password, PASSWORD_DEFAULT);
    $statement = $db->con->prepare($sql);
    $statement->bind_param('ssss', $full_name, $username, $password, $level);

    $result = $statement->execute();
}


// var_dump($result);

// redirect
header('location: user.php');