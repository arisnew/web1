<?php
include_once('../inc/config.php');

// check login
check_login();

// set page
$page->set_active_menu('user');
$page->title = 'Data User';


include('../template/section_top.php');

// sertakan database
require_once('../inc/database.php');

$db = new Database();

?>

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Data User</h1>


<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data User</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Level</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>

                    <?php
                    // php
                    $data = $db->get_data_users();
                    if ($data) {
                        foreach ($data as $user) {
                            ?>
                            <tr>
                                <td><?= $user['full_name'] ?></td>
                                <td><?= $user['username'] ?></td>
                                <td><?= $user['level'] ?></td>
                                <td>
                                    <a href="edit-user.php?id=<?= $user['id'] ?>" class="btn btn-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    
                                    <a href="delete-user.php?id=<?= $user['id'] ?>" class="btn btn-danger"
                                        onclick="return confirm('Apakah Anda yakin mau menghapus data ini????')"
                                    >
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    ?>


                    
                    
                </tbody>
            </table>

            <a href="add-user.html" class="btn btn-success">
                <i class="fas fa-plus"></i>
                Tambah Data
            </a>
        </div>
    </div>
</div>


<?php
include('../template/section_bottom.php');
?>    