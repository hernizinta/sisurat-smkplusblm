<?php 

session_start();

if(!isset($_SESSION["ssLoginSISURAT"])){
  header("location: ../auth/login.php");
  exit();
}

require "../config/config.php";
require "../config/functions.php";
require "../module/mode-sk.php";

$tittle = "Tambah Surat Keluar- SI Surat SMK Plus BLM";

require "../template/header.php";
require "../template/navbar.php";
require "../template/sidebar.php";

if(isset($_POST['simpan'])){
    if(insert($_POST) > 0){
        echo '<script>
                alert("Surat keluar berhasil ditambahkan!");
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
                    <li class="breadcrumb-item active">Add Surat Keluar</li>
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
                        Add Surat Keluar
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
                                    <label for="perihalsk">Perihal Surat Keluar</label>
                                    <input type="text" name="perihalsk" class="form-control" id="perihalsk" 
                                    placeholder="masukkan perihal surat keluar" autofocus autocomplete="off" require>
                                </div>
                                <div class="form-group">
                                    <label for="no_sk">No Surat</label>
                                    <input type="text" name="no_sk" class="form-control" id="no_sk" 
                                    placeholder="masukkan nomor surat keluar" require>
                                </div>
                                <div class="form-group">
                                    <label for="tglsuratkeluar">Tanggal Surat Keluar</label>
                                    <input type="date" name="tglsuratkeluar" class="form-control" id="tglsuratkeluar" 
                                    value="<?= date('Y-m-d') ?>" placeholder="masukkan tgl surat keluar" require>
                                </div>
                                <div class="form-group" require>
                                    <label for="instansi">Asal Surat keluar</label>
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
                                    <label for="filesk">Masukkan File Surat Keluar</label>
                                    <input type="file" class="form-control" name="file_sk"  accept="aplication/pdf">
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