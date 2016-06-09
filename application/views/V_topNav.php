<!-- top navigation -->
<div class="top_nav" style="margin-left: 0px;">

  <div class="nav_menu">
    <nav class="" role="navigation">
      <div class="nav toggle">
        <a id="menu_toggle"><i class="fa fa-thumbs-o-up"></i></a>
      </div>
      <ul class="nav navbar-nav navbar-left">
        <li class="active"><a href="#">Home</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">APBD <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo base_url('C_apbd/viewImportExcel');?>">Import Excel</a></li>
            <li><a href="<?php echo base_url('C_apbd/viewRekapAPBD');?>">Rekap APBD</a></li>
            <li><a href="<?php echo base_url('C_apbd/viewCariTable');?>">Cari Data</a></li>
            <li><a href="<?php echo base_url('C_apbd/viewLihatStatistik');?>">Statistik</a></li>
          </ul>
        </li>
        <li><a href="<?php echo base_url('C_pic/viewTambahPic');?>">PIC</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
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