<?php 

session_start();

if(!isset($_SESSION["ssLoginSISURAT"])){
  header("location: ../auth/login.php");
  exit();
}

require "../config/config.php";
require "../config/functions.php";

$tittle = "Laporan Surat Masuk- SI Surat SMK Plus BLM";

require "../template/header.php";
require "../template/navbar.php";
require "../template/sidebar.php";

$sqlPeriode = "";
$awalTgl = "";
$akhirTgl = "";
$dari_tgl = "";
$sampai_tgl = "";

if(isset($_GET['Tampil'])){
    $dari_tgl = isset($_GET['dari_tgl']) ? $_GET['dari_tgl'] : "01-".date('m-Y');
    $sampai_tgl= isset($_GET['sampai_tgl']) ? $_GET['sampai_tgl'] : "01-".date('d-m-Y');
    $sqlPeriode = "where A.tglsuratmasuk BETWEEN '".$dari_tgl."' AND '".$sampai_tgl."'";
}else{
    $awalTgl = "01-".date('m-Y');
    $akhirTgl = "01-".date('d-m-Y');

    $sqlPeriode = "where A.tglsuratmasuk BETWEEN '".$dari_tgl."' AND '".$sampai_tgl."'";
}

?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1 class="m-0">Laporan Surat Masuk</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= $main_url ?>dashboard.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="<?= $main_url ?>suratmasuk/data-sm.php">Surat Masuk</a></li>
                    <li class="breadcrumb-item active">Laporan Surat Masuk</li>
                </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-tittle">
                        CETAK LAPORAN SURAT MASUK BERDASARKAN TANGGAL
                    </h6>
                </div>
                <div class="card-body">
                    <form method="GET">
                        <table>
                        <tr>
                        <td><label class="control-label mr-2">Dari Tanggal</label></td>
                        <td><input type="date" name="dari_tgl" id="id_sm" class="form-control mr-3" required></td>
                        <td><label class="control-label ml-4 mr-2">Sampai Tanggal</label></td>
                        <td><input type="date" name="sampai_tgl" id="id_sm" class="form-control" required></td>
                        <td><input type="submit" class="btn btn-primary ml-2" name="Tampil" value="Tampil"></td>
                        </tr>
                        </table>
                    </form>
                   
                    <br>
                    <h3 class="text-center">LAPORAN SURAT MASUK</h3>
                    <h6 class="text-center">Priode tanggal <?= tgl_indo($dari_tgl) ?> <b>sampai</b> tanggal <?= tgl_indo($sampai_tgl) ?></h6>
                    <div class="card-body table-responsive p-3">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Perihal</th>
                                <th>No Surat</th>
                                <th>Tanggal Surat</th>
                                <th>Asal Surat</th>
                                <th>File</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                          $no = 1;
                          if (isset($_GET['Tampil'])) {
                            $dari_tgl = $_GET['dari_tgl'];
                            $sampai_tgl = $_GET['sampai_tgl'];
                            $suratmasuk = getData("SELECT * FROM tbl_sm WHERE tglsuratmasuk BETWEEN '$dari_tgl' AND '$sampai_tgl'");
                          }else{
                          $suratmasuk = getData("SELECT * FROM tbl_sm");
                          }
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
                          </tr>
                          <?php endforeach; ?>
                        </tbody>
                        <form method="GET" action="../report/r-suratmasuk.php" target="_blank">
                        <table>
                        <tr>
                        <td><input type="hidden" name="dari_tgl" id="id_sm" value="<?= $dari_tgl ?>"></td>
                        <td><input type="hidden" name="sampai_tgl" id="id_sm" value="<?= $sampai_tgl ?>"></td>
                        <td><input type="submit" class="btn btn-primary ml-2" name="cetak" value="Cetak Laporan"></td>
                        </tr>
                        </table>
                    </form>
                    </table>
                    
                </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php 

require "../template/footer.php";

?>