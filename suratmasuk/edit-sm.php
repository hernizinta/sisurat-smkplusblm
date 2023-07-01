<?php 

session_start();

if(!isset($_SESSION["ssLoginSISURAT"])){
  header("location: ../auth/login.php");
  exit();
}

require "../config/config.php";
require "../config/functions.php";
require "../module/mode-sm.php";

$tittle = "Update Surat Masuk- SI Surat SMK Plus BLM";

require "../template/header.php";
require "../template/navbar.php";
require "../template/sidebar.php";

$id = $_GET['id'];

$sqlEdit = "SELECT * FROM tbl_sm WHERE id_sm = $id";
$sm    = getData($sqlEdit)[0];


if (isset($_POST['koreksi'])) {
    if (update($_POST)) {
        echo'<script>
                alert("Data berhasil diupdate");
                document.location.href = "data-sm.php";
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
                <h1 class="m-0">Surat Masuk</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= $main_url ?>dashboard.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="<?= $main_url ?>suratmasuk/data-sm.php">Surat Masuk</a></li>
                    <li class="breadcrumb-item active">Edit Data Surat Masuk</li>
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
                    Edit Data Surat Masuk
                     <button type="submit" name="koreksi" class="btn btn-primary 
                     btn-sm float-right"><i class="fas fa-save"></i> Update</button>
                     <button type="reset" class="btn btn-danger 
                     btn-sm float-right mr-1"><i class="fas fa-times"></i> Batal</button>
                    </h6>    
                </div>
                <div class="card-body">
                    <div class="row">
                        <input type="hidden" value="<?= $sm['id_sm']?>" name="id">
                        <div class="col-lg-8 mb-3">
                            <div class="form-group">
                                <label for="perihalsm">Perihal</label>
                                <input type="text" name="perihalsm" class="form-control" id="perihalsm" 
                                placeholder="masukkan perihal" autofocus autocomplete="off" value="<?= $sm['perihalsm']?>" require>
                            </div>
                            <div class="form-group">
                                <label for="no_sm">No Surat</label>
                                <input type="text" name="no_sm" class="form-control" id="no_sm" 
                                placeholder="masukkan nomor surat" value="<?= $sm['no_sm']?>" require>
                            </div>
                            <div class="form-group">
                                    <label for="tglsuratmasuk">Tanggal Surat Masuk</label>
                                    <input type="date" name="tglsuratmasuk" class="form-control" id="tglsuratmasuk" 
                                    value="<?= $sm['tglsuratmasuk']?>" placeholder="masukkan tgl surat masuk" require>
                                </div>
                                <div class="form-group" require>
                                    <label for="instansi">Asal Surat Masuk</label>
                                    <select name="instansi" id="instansi">
                                        <option value="<?= $sm['instansi'] ?>"> <?= $sm['instansi'] ?>
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
                                            <label for="filesm">Masukkan File Surat Masuk</label>
                                            <input type="hidden" name="oldFilesm" value="<?= $sm['file_sm']?>">
                                            <br>
                                            <a href = "<?= $main_url ?>asset/suratmasuk/<?= $sm['file_sm'] ?>"><?= $sm['file_sm'] ?></a>
                                            <input type="file" class="form-control" name="filesm">

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