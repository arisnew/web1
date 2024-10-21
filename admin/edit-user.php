<?php
include_once('../inc/config.php');

// check login
check_login();

include('../template/section_top.php');

require_once('../inc/database.php');

$db = new Database();
$id = $_GET['id'];
$user = $db->get_single_data_user($id);
?>

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Edit Data User</h1>


<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Edit Data User</h6>
    </div>
    <div class="card-body">

        <div class="row">
            <div class="col-md-6">
                <!-- form here -->
                <form action="save-user.php" method="POST">
                    <div class="form-group">
                        <input type="hidden" name="id" value="<?= $id ?>">
                        <label for="full-name">Full Name</label>
                        <input type="text" class="form-control" id="full-name" name="full-name" value="<?= $user['full_name'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" value="<?= $user['username'] ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <div class="form-group">
                        <label for="access-level">Access Level</label>
                        <select name="access-level" class="form-control">
                            <option value="User" <?= $user['level'] == 'User' ? 'selected' : '' ?>>User</option>
                            <option value="Admin" <?= $user['level'] == 'Admin' ? 'selected' : '' ?>>Admin</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a class="btn btn-default" href="user.html">Cancel</a>
                </form>
            </div>
        </div>

            

    </div>
</div>


<?php
include('../template/section_bottom.php');
?>