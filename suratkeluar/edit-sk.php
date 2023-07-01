<?php 

session_start();

if(!isset($_SESSION["ssLoginSISURAT"])){
  header("location: ../auth/login.php");
  exit();
}

require "../config/config.php";
require "../config/functions.php";
require "../module/mode-sk.php";

$tittle = "Update Surat Keluar- SI Surat SMK Plus BLM";

require "../template/header.php";
require "../template/navbar.php";
require "../template/sidebar.php";

$id = $_GET['id'];

$sqlEdit = "SELECT * FROM tbl_sk WHERE id_sk = $id";
$sk    = getData($sqlEdit)[0];


if (isset($_POST['koreksi'])) {
    if (update($_POST)) {
        echo'<script>
                alert("Data berhasil diupdate");
                document.location.href = "data-sk.php";
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
                <h1 class="m-0">Surat Keluar</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= $main_url ?>dashboard.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="<?= $main_url ?>suratkeluar/data-sk.php">Surat Keluar</a></li>
                    <li class="breadcrumb-item active">Edit Data Surat Keluar</li>
                </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-tittle"><i class="fas fa-pen fa-sm"></i>
                    Edit Data Surat Keluar
                     <button type="submit" name="koreksi" class="btn btn-primary 
                     btn-sm float-right"><i class="fas fa-save"></i> Update</button>
                     <button type="reset" class="btn btn-danger 
                     btn-sm float-right mr-1"><i class="fas fa-times"></i> Batal</button>
                    </h6>    
                </div>
                <div class="card-body">
                    <div class="row">
                        <input type="hidden" value="<?= $sk['id_sk'] ?>" name="id">
                        <div class="col-lg-8 mb-3">
                            <div class="form-group">
                                <label for="perihalsk">Perihal</label>
                                <input type="text" name="perihalsk" class="form-control" id="perihalsk" 
                                placeholder="masukkan perihal" autofocus autocomplete="off" value="<?= $sk['perihalsk']?>" require>
                            </div>
                            <div class="form-group">
                                <label for="no_sk">No Surat</label>
                                <input type="text" name="no_sk" class="form-control" id="no_sk" 
                                placeholder="masukkan nomor surat" value="<?= $sk['no_sk']?>" require>
                            </div>
                            <div class="form-group">
                                    <label for="tglsuratkeluar">Tanggal Surat Masuk</label>
                                    <input type="date" name="tglsuratkeluar" class="form-control" id="tglsuratkeluar" 
                                    value="<?= $sk['tglsuratkeluar']?>" placeholder="masukkan tgl surat keluar" require>
                                </div>
                                <div class="form-group" require>
                                    <label for="instansi">Asal Surat Keluar</label>
                                    <select name="instansi" id="instansi">
                                        <option value="<?= $sk['instansi'] ?>"> <?= $sk['instansi'] ?>
                                        <?php 
                                        $instansi = getData("SELECT * FROM tbl_instansi");
                                        foreach($instansi as $ins){ ?>
                                            <option value="<?= $ins['nama'] ?>">
                                            <?= $ins['nama']?></option>
                                            <?php
                                        }
                                        ?>
                                        </option>
                                    </select>
                                </div>
                                
                        </div>
                                <div class="col-lg-4 text-center">
                                            <label for="filesk">Masukkan File Surat Keluar</label>
                                            <input type="hidden" name="oldFilesk" value="<?= $sk['file_sk']?>">
                                            <br>
                                            <a href = "<?= $main_url ?>asset/suratkeluar/<?= $sk['file_sk'] ?>"><?= $sk['file_sk'] ?></a>
                                            <input type="file" class="form-control" name="filesk">

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