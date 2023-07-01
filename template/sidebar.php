<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a class="sidebar-brand mt-1 d-flex align-items-center" href="<?= $main_url ?>dashboard.php" class="brand-link ">
      <img src="<?= $main_url ?>asset/image/logosmkblm.png" alt="Logo" class="brand-image img-circle elevation-3 ml-3" width="40px">
      <div class="sidebar-brand-text text-center d-block text-white mt-2 mx-3"><h6>SI ARSIP SURAT</h6><sup>SMK PLUS BLM</sup></div>
    </a>
    <hr color="white" size="20%"></hr>
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel pb-1  d-flex">
        <div class="image">
          <img src="<?= $main_url ?>asset/image/<?= userLogin()['foto']?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?= userLogin()['fullname'] ?> </a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class ="nav-item" >
            <a href="<?= $main_url ?>dashboard.php"  class ="nav-link  <?= menuHome() ?>">
              <i class="nav-icon fas fa-tachometer-alt text-sm"></i> 
              <p>Dashboard</p>        
            </a>
          </li>
          <?php 
            if (userLogin()['level'] !=3) {
            
          ?>
          <li class ="nav-item" >
            <a href="<?= $main_url ?>instansi/data-instansi.php"  class ="nav-link <?= menuInstansi() ?>">
              <i class="nav-icon fas fa-school text-sm"></i> 
              <p>Instansi</p>        
            </a>
          </li> 
          <?php } ?>
          <li class="nav-item">
            <a href="<?= $main_url ?>suratmasuk/data-sm.php" class="nav-link <?= menuSm() ?>">
            <i class="nav-icon fas fa-envelope-open-text text-sm"></i>
            <p>Surat Masuk</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= $main_url ?>suratkeluar/data-sk.php" class="nav-link <?= menuSk() ?>">
            <i class="nav-icon fas fa-envelope text-sm"></i>
            <p>Surat Keluar</p>
            </a>
          </li>
          <li class ="nav-item <?= menuReport() ?>">
            <a href="#"  class ="nav-link">
              <i class="nav-icon fas fa-folder text-sm"></i> 
              <p>Laporan
                <i class="fas fa-angle-left right"></i>
              </p>        
            </a>
            <ul class ="nav nav-treeview">
              <li class="nav-item">
                  <a href="<?= $main_url ?>laporan-suratmasuk" class="nav-link <?= menuRsm()?>">
                    <i class="far fa-circle nav-icon text-sm"></i>
                    <p>Laporan Surat Masuk</p>
                  </a>
              </li>
              <li class="nav-item">
                  <a href="<?= $main_url ?>laporan-suratkeluar" class="nav-link <?= menuRsk()?>">
                    <i class="far fa-circle nav-icon text-sm"></i>
                    <p>Laporan Surat Keluar</p>
                  </a>
              </li>
            </ul>
          </li>
          <?php 
            if (userLogin()['level'] == 1) {
          ?>
          <li class ="nav-item <?= menuSetting() ?>">
            <a href="#"  class ="nav-link">
              <i class="nav-icon fas fa-cog text-sm"></i> 
              <p>Pengaturan
                <i class="fas fa-angle-left right"></i>
              </p>        
            </a>
            <ul class ="nav nav-treeview">
              <li class="nav-item">
                  <a href="<?= $main_url ?>user/data-user.php" class="nav-link <?= menuUser()?>">
                    <i class="fas fa-users-cog nav-icon text-sm"></i>
                    <p>users</p>
                  </a>
              </li>
            </ul>
          </li>
          <?php } ?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
