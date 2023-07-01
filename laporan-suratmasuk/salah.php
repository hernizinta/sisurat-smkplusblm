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
$tglAwal = "";
$tglAkhir = "";

if(isset($_POST['btnTampil'])){
    $tglAwal = isset($_POST['txtTglAwal']) ? $_POST['txtTglAwal'] : "01-".date('m-Y');
    $tglAkhir = isset($_POST['txtTglAkhir']) ? $_POST['txtTglAkhir'] : "01-".date('d-m-Y');
    $sqlPeriode = "where A.tglsuratmasuk BETWEEN '".$tglAwal."' AND '".$tglAkhir."'";
}else{
    $awalTgl = "01-".date('m-Y');
    $akhirTgl = "01-".date('d-m-Y');

    $sqlPeriode = "where A.tglsuratmasuk BETWEEN '".$tglAwal."' AND '".$tglAkhir."'";
}


?>
<div class="content-wrapper">
<div class="container">
    <div class="container-fluid">
        <h3 class="text-dark mb-4">Transaksi Surat Masuk</h3>
        <h4>Periode Tanggal <b><?php echo ($tglAwal); ?></b> s/d <b><?php echo ($tglAkhir); ?></b></h4>
        <div class="card-shadow">
            <div class="card-header py-3">

            </div>
            <div class="card-body">
                <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form10" target="_self">
                    <div class="row">
                        <div class="col-lg-3">
                            <input type="date" name="txtTglAwal" class="form-control" value="<?php echo $awalTgl; ?>" size="10"/>
                        </div>
                        <div class="col-lg-3">
                            <input type="date" name="txtTglAkhir" class="form-control" value="<?php echo $akhirTgl; ?>" size="10"/>
                        </div>
                        <div class="col-lg-3">
                            <input type="submit" name="btnTampil" class="btn btn-success" value="Tampilkan" size="10"/>
                        </div>
                    </div>
                </form>
            </div>
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
                                <th style="width: 10%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                          $no = 1;
                          if (isset($_POST['btnTampil'])) {
                            $awalTgl = $_POST['txtTglAwal'];
                            $akhirTgl = $_POST['txtTglAkhir'];
                            $suratmasuk = getData("SELECT * FROM tbl_sm WHERE tglsuratmasuk BETWEEN '$awalTgl' AND '$akhirTgl'");
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
                            <td><a href="edit-sm.php?id=<?= $sm['id_sm'] ?>" class="btn btn-sm btn-warning" title="editsm"><i class="fas fa-user-edit"></i></a>
                            <a href="del-sm.php?id=<?= $sm['id_sm'] ?>&file_sm=<?= $sm['file_sm'] ?>" class="btn btn-sm btn-danger" title="hapussm" onclick="return confirm ('Anda yakin ingin mengapus data ini?')">
                            <i class="fas fa-trash"></i></a>
                            </td>
                          </tr>
                          <?php endforeach; ?>
                        </tbody>
                    </table>
                    
                </div>
                <div class="row">
                    <div class="col-lg-3">
                        <a href="../report/r-suratmasuk.php?awal=<?php echo $tglAwal; ?>&&akhir=<?php echo $tglAkhir; ?>" target="_blank" alt="Edit Data" class="btn btn-primary">Cetak Laporan</a>
                    </div>
                </div>
        </div>
    </div>
</div>
</div>
<?php 

require "../template/footer.php";

?>