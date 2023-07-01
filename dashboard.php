<?php

session_start();

if(!isset($_SESSION["ssLoginSISURAT"])){
  header("location: auth/login.php");
  exit();
}

require "config/config.php";
require "config/functions.php";

$tittle = "Dasboard - Arsip Surat";
require "template/header.php";
require "template/navbar.php";
require "template/sidebar.php";

$users = getData("SELECT * FROM tbl_user");
$userNum = count($users);

$instansies = getData("SELECT * FROM tbl_instansi");
$insNum = count($instansies);

$suratmasuk = getData("SELECT * FROM tbl_sm");
$smNum = count($suratmasuk);

$suratkeluar = getData("SELECT * FROM tbl_sk");
$skNum = count($suratkeluar);
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= $main_url ?>dashboard.php">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <a href="<?= $main_url?>/user" class="small-box bg-info" style="height: 90px;">
            <div class="inner">
              <h3><?= $userNum ?></h3>

              <p >Users</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
          </a>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <a href="<?= $main_url?>/instansi" class="small-box bg-success" style="height: 90px;">
            <div class="inner">
              <h3><?= $insNum ?></h3>

              <p>Instansi</p>
            </div>
            <div class="icon">
              <i class="ion ion-android-bus"></i>
            </div>
          </a>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <a href="<?= $main_url?>/suratmasuk" class="small-box bg-warning" style="height: 90px;">
            <div class="inner">
              <h3><?= $smNum ?></h3>
              <p>Surat Masuk</p>
            </div>
            <div class="icon">
            <i class="ion ion-android-mail"></i>
            </div>
          </a>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
        <a href="<?= $main_url?>/suratkeluar" class="small-box bg-danger" style="height: 90px;">
          <!-- small box -->
            <div class="inner">
              <h3><?= $skNum ?></h3>

              <p>Surat Keluar</p>
            </div>
            <div class="icon">
              <i class="ion ion-android-mail"></i>
            </div>
        </a>
        </div>
        <!-- ./col -->
      </div>
      <br>
      <div class="card">
        <div class="card-body">
          <center>
          <img src="<?= $main_url ?>asset/image/logosmk.png" width="150px">
          <h4 class="">SMK PLUS BERKUALITAS LENGKONG MANDIRI</h4>
          <h6 class="">Jl. Lengkong Raya, Kel. Lengkong Wetan, Kec. Serpong, Kota Tangerang Selatan, Banten 15310. Telp.021-53191575, E-mail: smkplusblm@gmail.com</h6>
          </center>
        </div>
      </div>
      
      <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php

require "template/footer.php";

?>