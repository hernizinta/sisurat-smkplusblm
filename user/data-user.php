<?php 

session_start();

if(!isset($_SESSION["ssLoginSISURAT"])){
  header("location: ../auth/login.php");
  exit();
}

require "../config/config.php";
require "../config/functions.php";
require "../module/mode-user.php";

$tittle = "Data User- SI Surat SMK Plus BLM";

require "../template/header.php";
require "../template/navbar.php";
require "../template/sidebar.php";


?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Users</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= $main_url ?>dashboard.php">Home</a></li>
            <li class="breadcrumb-item active">User</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-tittle">Data User
                    <a href="<?= $main_url?>user/add-user.php" class="btn btn-sm btn-primary float-right"><i class="fas fa-user-plus fa-sm"></i> Add User</a>
                    </h6>
                    <!-- <div class="card-tools">   
                    </div> -->
                </div>
                <div class="card-body table-responsive p-3">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Username</th>
                                <th>Nama Lengkap</th>
                                <th>Alamat</th>
                                <th>Level User</th>
                                <th>Foto</th>
                                <th style="width: 10%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php 
                          $no = 1;
                          $users = getData("SELECT * FROM tbl_user");
                          foreach($users as $user) : ?>
                          <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $user['username'] ?></td>
                            <td><?= $user['fullname'] ?></td>
                            <td><?= $user['adress'] ?></td>
                            <td><?php if($user['level'] == 1){
                              echo 'Administrator';
                            }else if($user['level'] == 2){
                              echo 'Kepala Sekolah';

                            } else{
                              echo 'Kepala Yayasan';
                            }
                             ?></td>
                            <td><img src="../asset/image/<?= $user['foto'] ?>" class="rounded-circle" 
                            alt="" width="60px"></td>
                            <td><a href="edit-user.php?id=<?= $user['userid'] ?>" class="btn btn-sm btn-warning" title="edituser"><i class="fas fa-user-edit"></i></a>
                            <a href="del-user.php?id=<?= $user['userid'] ?>&foto=<?= $user['foto'] ?>" class="btn btn-sm btn-danger" title="hapususer" onclick="return confirm ('Anda yakin ingin mengapus user ini?')">
                            <i class="fas fa-user-times"></i></a>
                            </td>
                          </tr>
                          <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

<?php 

require "../template/footer.php";

?>