<!--Page Content -->
<div id="page-content-wrapper" style="padding:0;"><!-- top navigation -->
  <div class="top_nav" style="margin-left: 0px;">
  <div class="nav_menu">
    <nav class="" role="navigation">
      <div class="nav toggle">
        <a href="#menu-toggle" id="menu-toggle"><i class="fa fa-bars"></i></a>
      </div>
      <ul class="nav navbar-nav navbar-left">
        <li><h3 style="line-height:1.5; margin-right:10px; margin-left:-5px;font-weight: bold; color : #1ABB9C;"><a href="<?php echo base_url('kendaraan/');?>">KENDARAAN</a></h3></li>
        <li><a href="<?php echo base_url('kendaraan/');?>">Import File</a></li>
        <li><a href="<?php echo base_url('kendaraan/filter/');?>">Cari Data</a></li>
         <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Kelola Data <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo base_url('kendaraan/viewRekapKendaraan/'); ?>">Rekap Kendaraan</a></li>
            <li><a href="<?php echo base_url('kendaraan/hapus/');?>">Hapus Data</a></li>
            <li><a href="<?php echo base_url('kendaraan/update/');?>">Update Data</a></li>
          </ul>
        </li>
        <li><a href="<?php echo base_url('kendaraan/filter/viewLihatGrafikBulan');?>">Grafik</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Kontak <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo base_url('kendaraan/viewLihatKontak');?>">Lihat Kontak Kendaraan</a></li>
            <li><a href="<?php echo base_url('kendaraan/viewTambahKontak');?>">Tambah Kontak Kendaraan </a></li>
            <li><a href="<?php echo base_url('kendaraan/viewHapusKontak');?>">Hapus Kontak Kendaraan </a></li>
          </ul>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right" style="width:auto;">
        <li class="">
          <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <img src="<?php echo base_url('assets');?>/gentelella/production/images/user.png" alt="">Hi, 
            <?php
              $var = $this->session->userdata;
              echo $var['username'];
            ?>
            <span class=" fa fa-angle-down"></span>
          </a>
          <ul class="dropdown-menu dropdown-usermenu pull-right" style="right: 0;">
            <?php
              if ($var['level']=="admin") 
                { ?>
                  <li><a href="<?php echo base_url('C_admin/');?>"><i class="fa fa-lock pull-right"></i> Ke Halaman Admin</a></li>
            <?php } ?>
            <li><a href="<?php echo base_url('C_auth/logout');?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
  </div>
  </div>
  <!-- /top navigation