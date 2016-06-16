<!-- Page Content -->
<div id="page-content-wrapper" style="padding:0;"><!-- top navigation -->
  <div class="top_nav" style="margin-left: 0px;">
  <div class="nav_menu">
    <nav class="" role="navigation">
      <div class="nav toggle">
        <a href="#menu-toggle" id="menu-toggle"><i class="fa fa-bars"></i></a>
      </div>
      <ul class="nav navbar-nav navbar-left">
        <li><a href="<?php echo base_url('C_apbd/viewImportExcel');?>">Import File</a></li>
        <li><a href="<?php echo base_url('C_filter/');?>">Cari Data</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Kelola Data <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo base_url('C_apbd/viewRekapAPBD');?>">Rekap APBD</a></li>
            <!-- <li><a href="<?php echo base_url('C_filter/');?>">Cari Data</a></li> -->
            <li><a href="">Tambah Data</a></li>
            <li><a href="">Hapus Data</a></li>
            <li><a href="<?php echo base_url('C_update/');?>">Update Data</a></li>
          </ul>
        </li>
        <li><a href="<?php echo base_url('C_filter/viewLihatStatistik');?>">Grafik</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Kontak <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo base_url('C_pic/viewLihatPic');?>">Lihat Kontak</a></li>
            <li><a href="<?php echo base_url('C_pic/viewTambahPic');?>">Tambah Kontak</a></li>
          </ul>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right" style="width:auto;">
        <li class="">
          <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <img src="<?php echo base_url('assets');?>/gentelella/production/images/img.jpg" alt="">Admin
          </a>
        </li>
      </ul>
    </nav>
  </div>
  </div>
  <!-- /top navigation -->