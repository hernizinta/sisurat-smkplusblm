<?php 

session_start();

if(!isset($_SESSION["ssLoginSISURAT"])){
  header("location: ../auth/login.php");
  exit();
}

require "../config/config.php";
require "../config/functions.php";
require "../module/mode-sk.php";

$tittle = "Data Surat Keluar- SI Surat SMK Plus BLM";

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
          <h1 class="m-0">Surat Keluar</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= $main_url ?>dashboard.php">Home</a></li>
            <li class="breadcrumb-item active">Surat Keluar</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-tittle">Data Surat Keluar
                    <a href="<?= $main_url?>report/r-rekapsk.php" class="btn btn-sm btn-primary float-right"><i class="fas fa-print fa-sm"></i> Cetak</a>
                    <a href="<?= $main_url?>suratkeluar/add-sk.php" class="btn btn-sm btn-primary float-right mr-1"><i class="fas fa-plus fa-sm"></i> Add Surat Keluar</a>
                    </h6>
                    <!-- <div class="card-tools">   
                    </div> -->
                </div>
                <div class="card-body table-responsive p-3">
                    <table class="table table-hover text-nowrap" id="tblData">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Perihal</th>
                                <th>No Surat</th>
                                <th>Tanggal Surat</th>
                                <th>Tujuan Surat</th>
                                <th>File</th>
                                <th style="width: 10%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                          $no = 1;
                          $suratkeluar = getData("SELECT * FROM tbl_sk");
                          foreach($suratkeluar as $sk) : ?>
                          <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $sk['perihalsk'] ?></td>
                            <td><?= $sk['no_sk'] ?></td>
                            <td><?= tgl_indo($sk['tglsuratkeluar']) ?></td>
                            <td><?= $sk['instansi'] ?></td>
                            <td>
                            <a href = "<?= $main_url ?>asset/suratkeluar/<?= $sk['file_sk'] ?>" class="btn btn-danger"><i class="fas fa-file-pdf"></i> file surat</a>
                            </td>
                            <td><a href="edit-sk.php?id=<?= $sk['id_sk'] ?>" class="btn btn-sm btn-warning" title="editsk"><i class="fas fa-user-edit"></i></a>
                            <a href="del-sk.php?id=<?= $sk['id_sk'] ?>&file_sk=<?= $sk['file_sk'] ?>" class="btn btn-sm btn-danger" title="hapussk" onclick="return confirm ('Anda yakin ingin mengapus data ini?')">
                            <i class="fas fa-trash"></i></a>
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