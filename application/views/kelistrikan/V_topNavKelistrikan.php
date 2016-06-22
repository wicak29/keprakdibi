<!--Page Content -->
<div id="page-content-wrapper" style="padding:0;"><!-- top navigation -->
  <div class="top_nav" style="margin-left: 0px;">
  <div class="nav_menu">
    <nav class="" role="navigation">
      <div class="nav toggle">
        <a href="#menu-toggle" id="menu-toggle"><i class="fa fa-bars"></i></a>
      </div>
      <ul class="nav navbar-nav navbar-left">
        <li><a href="<?php echo base_url('kelistrikan/C_kelistrikan/');?>">Import File</a></li>
        <li><a href="<?php echo base_url('pelabuhan/C_filter/');?>">Cari Data</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Kelola Data <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Rekap APBD</a></li>
            <!-- <li><a href="<?php echo base_url('C_filter/');?>">Cari Data</a></li> --> 
            <li><a href="<?php echo base_url('pelabuhan/C_delete/');?>">Hapus Data</a></li>
            <li><a href="<?php echo base_url('pelabuhan/C_update/');?>">Update Data</a></li>
          </ul>
        </li>
        <!-- <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Grafik <span class="caret"></span></a>
          <ul class="dropdown-menu"> -->
            <!-- <li><a href="<?php echo base_url('C_filter/viewLihatStatistikProv');?>">Provinsi</a></li>
            <li><a href="<?php echo base_url('C_filter/viewLihatStatistik');?>">Kabupaten/Kota</a></li>
          </ul> -->
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right" style="width:auto;">
        <li class="">
          <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <img src="<?php echo base_url('assets');?>/gentelella/production/images/mayu.jpg" alt="">Hi, 
            <?php
              $var = $this->session->userdata;
              echo $var['username'];
            ?>
            <span class=" fa fa-angle-down"></span>
          </a>
          <ul class="dropdown-menu dropdown-usermenu pull-right" style="right: 0;">
            <li><a href="<?php echo base_url('C_auth/logout');?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
  </div>
  </div>
  <!-- /top navigation