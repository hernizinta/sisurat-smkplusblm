<?php 

session_start();

if(!isset($_SESSION["ssLoginSISURAT"])){
  header("location: ../auth/login.php");
  exit();
}

require "../config/config.php";
require "../config/functions.php";
require "../module/mode-sm.php";

$tittle = "Data Surat Masuk- SI Surat SMK Plus BLM";

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
          <h1 class="m-0">Surat Masuk</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= $main_url ?>dashboard.php">Home</a></li>
            <li class="breadcrumb-item active">Surat Masuk</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-tittle">Data Surat Masuk
                    <a href="<?= $main_url?>report/r-rekapsm.php" class="btn btn-sm btn-primary float-right"><i class="fas fa-print fa-sm"></i> Cetak</a>
                    <a href="<?= $main_url?>suratmasuk/add-sm.php" class="btn btn-sm btn-primary float-right mr-1"><i class="fas fa-plus fa-sm"></i> Add Surat Masuk</a>
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
                                <th>Asal Surat</th>
                                <th>File</th>
                                <th style="width: 10%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                          $no = 1;
                          $suratmasuk = getData("SELECT * FROM tbl_sm");
                          foreach($suratmasuk as $sm) : ?>
                          <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $sm['perihalsm'] ?></td>
                            <td><?= $sm['no_sm'] ?></td>
                            <td><?= tgl_indo($sm['tglsuratmasuk']) ?></td>
                            <td><?= $sm['instansi'] ?></td>
                            <td>
                            <a href = "<?= $main_url ?>asset/suratmasuk/<?= $sm['file_sm'] ?>" class="btn btn-danger"><i class="fas fa-file-pdf"></i> file surat</a>
                            </td>
                            <td><a href="edit-sm.php?id=<?= $sm['id_sm'] ?>" class="btn btn-sm btn-warning" title="editsm"><i class="fas fa-user-edit"></i></a>
                            <a href="del-sm.php?id=<?= $sm['id_sm'] ?>&file_sm=<?= $sm['file_sm'] ?>" class="btn btn-sm btn-danger" title="hapussm" onclick="return confirm ('Anda yakin ingin mengapus data ini?')">
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