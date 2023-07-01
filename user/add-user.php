<?php 

session_start();

if(!isset($_SESSION["ssLoginSISURAT"])){
  header("location: ../auth/login.php");
  exit();
}

require "../config/config.php";
require "../config/functions.php";
require "../module/mode-user.php";

$tittle = "Tambah User- SI Surat SMK Plus BLM";

require "../template/header.php";
require "../template/navbar.php";
require "../template/sidebar.php";

if(isset($_POST['simpan'])){
    if(insert($_POST) > 0){
        echo '<script>
                alert("User baru berhasil registrasi!");
                document.location.href = "data-user.php";
            </script>';
       
    }
}

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <form action="" method="post" enctype="multipart/form-data">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1 class="m-0">Users</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= $main_url ?>dashboard.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="<?= $main_url ?>user/data-user.php">Users</a></li>
                    <li class="breadcrumb-item active">Add User</li>
                </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="card-header">
                        <h6 class="card-tittle"><i class="fas fa-plus fa-sm"></i>
                        Add User
                        <button type="submit" name="simpan" class="btn btn-primary 
                        btn-sm float-right"><i class="fas fa-save"></i> Simpan</button>
                        <button type="reset" class="btn btn-danger 
                        btn-sm float-right mr-1"><i class="fas fa-times"></i> Batal</button>
                        </h6>    
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-8 mb-3">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" name="username" class="form-control" id="username" 
                                    placeholder="masukkan username" autofocus autocomplete="off" require>
                                </div>
                                <div class="form-group">
                                    <label for="fullname">Nama Lengkap</label>
                                    <input type="text" name="fullname" class="form-control" id="fullname" 
                                    placeholder="masukkan nama lengkap" require>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" class="form-control" id="password" 
                                    placeholder="masukkan password" require>
                                </div>
                                <div class="form-group">
                                    <label for="password2">Konfirmasi Password</label>
                                    <input type="password" name="password2" class="form-control" id="password2" 
                                    placeholder="masukkan kembali password anda" require>
                                </div>
                                <div class="form-group" require>
                                    <label for="level">Level User</label>
                                    <select name="level" id="level" class="form-control">
                                        <option value="">-- Level User --</option>
                                        <option value="1">-- Administrator --</option>
                                        <option value="2">-- Kepala Sekolah --</option>
                                        <option value="3">-- Kepala Yayasan --</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="adress">Alamat</label>
                                <textarea name="adress" id="adress" cols="" rows="3" class="form-control" placeholder="masukkan alamat user" require></textarea>
                                </div>
                            </div>
                            <div class="col-lg-4 text-center">
                                <img src="<?= $main_url ?>asset/image/default.png" class="profile-user-img 
                                img-circle mb-3" alt="">
                                <input type="file" class="form-control" name="foto">
                                <span class="text-sm"> Tipe File Gambar</span><br>
                            </div>
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>

    </section>
</div>




<?php 

require "../template/footer.php";

?>