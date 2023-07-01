<?php 

session_start();

if(!isset($_SESSION["ssLoginSISURAT"])){
  header("location: ../auth/login.php");
  exit();
}

require "../config/config.php";
require "../config/functions.php";
require "../module/mode-sm.php";

$tittle = "Tambah Surat Masuk- SI Surat SMK Plus BLM";

require "../template/header.php";
require "../template/navbar.php";
require "../template/sidebar.php";

if(isset($_POST['simpan'])){
    if(insert($_POST) > 0){
        echo '<script>
                alert("Surat Masuk berhasil ditambahkan!");
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
                    <li class="breadcrumb-item active">Add Surat Masuk</li>
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
                        Add Surat Masuk
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
                                    <label for="perihalsm">Perihal Surat Masuk</label>
                                    <input type="text" name="perihalsm" class="form-control" id="perihalsm" 
                                    placeholder="masukkan perihal surat masuk" autofocus autocomplete="off" require>
                                </div>
                                <div class="form-group">
                                    <label for="no_sm">No Surat</label>
                                    <input type="text" name="no_sm" class="form-control" id="no_sm" 
                                    placeholder="masukkan nomor surat masuk" require>
                                </div>
                                <div class="form-group">
                                    <label for="tglsuratmasuk">Tanggal Surat Masuk</label>
                                    <input type="date" name="tglsuratmasuk" class="form-control" id="tglsuratmasuk" 
                                    value="<?= date('Y-m-d') ?>" placeholder="masukkan tgl surat masuk" require>
                                </div>
                                <div class="form-group" require>
                                    <label for="instansi">Asal Surat Masuk</label>
                                    <select name="instansi" id="instansi">
                                        <option value="">--Pilih Instansi--</option>
                                        <?php 
                                        $instansi = getData("SELECT * FROM tbl_instansi");
                                        foreach($instansi as $ins){ ?>
                                            <option value="<?= $ins['nama'] ?>">
                                            <?= $ins['nama']?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                    <label for="filesm">Masukkan File Surat Masuk</label>
                                    <input type="file" class="form-control" name="file_sm"  accept="aplication/pdf">
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