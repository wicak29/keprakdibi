        <!-- page content -->
        <div class="right_col" role="main" style="margin-left: 0px;">
                   <!-- ALERTS -->
          <!-- <div id="apbd-belum" class="alert alert-success alert-dismissible fade in" style="margin-top:70px;">
            <a href="#" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">×</span></a>
            <strong>Data APBD belum dimasukkan</strong>
          </div> -->
          <!-- END OF ALERT -->
          <div class="">
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12" style="margin-right:auto; margin-left:auto;float:none;">
                <div class="x_panel" style="min-height:538px;">
                  <div class="x_title">
                    <h2>Cari Data Provinsi</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li>
                        <a href="<?php echo base_url();?>apbd/filter" class=""><i class="fa fa-arrow-left"></i> Kembali</a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="row">
                      <form action="<?php echo base_url();?>apbd/filter/lihatFilterProvinsi/" method="post" enctype="multipart/form-data" class="form-inline">
                        <div class="form-group">
                          <label for="ex3">Pilih Tahun : </label>
                          <select name="tahun" class="form-control" tabindex="-1" style="margin-left:10px;" required="required">
                              <option value="" selected disabled>Pilih tahun</option>
                                  <option value="2007">2007</option>
                                  <option value="2008">2008</option>
                                  <option value="2009">2009</option>
                                  <option value="2010">2010</option>
                                  <option value="2011">2011</option>
                                  <option value="2012">2012</option>
                                  <option value="2013">2013</option>
                                  <option value="2014">2014</option>
                                  <option value="2015">2015</option>
                                  <option value="2016">2016</option>
                                  <option value="2017">2017</option>
                                  <option value="2018">2018</option>
                                  <option value="2019">2019</option>
                                  <option value="2020">2020</option>
                                  <option value="2021">2021</option>
                                  <option value="2022">2022</option>
                                  <option value="2023">2023</option>
                                  <option value="2024">2024</option>
                                  <option value="2025">2025</option>
                                  <option value="2026">2026</option>
                                  <option value="2027">2027</option>
                                  <option value="2028">2028</option>
                                  <option value="2029">2029</option>
                                  <option value="2030">2030</option>
                                  
                            </select>
                            <select name="bulan" class="form-control" tabindex="-1" style="margin-left:10px;" required="required">
                              <option value="" selected disabled>Pilih bulan</option>
                              <option value="Januari">Januari</option>
                              <option value="Februari">Februari</option>
                              <option value="Maret">Maret</option>
                              <option value="April">April</option>
                              <option value="Mei">Mei</option>
                              <option value="Juni">Juni</option>
                              <option value="Juli">Juli</option>
                              <option value="Agustus">Agustus</option>
                              <option value="September">September</option>
                              <option value="Oktober">Oktober</option>
                              <option value="November">November</option>
                              <option value="Desember">Desember</option>
                            </select>
                          <input type="submit" class="btn btn-primary" style="margin:0 0 0 10px;" value="Cari"/>
                        </div>
                      </form>
                    </div>                    
                    <div class="ln_solid"></div>
                    <?php if($bulan!="Bulan" && $tahun!="Tahun") { ?>
                      <button id="checkBtn" type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target=".bs-example-modal-sm" style="float:right;">Lihat PIC</button>
                      <br>
                      <br>
                      <h3 align="center">Data Realisasi APBD Prov. Bali</h3>
                      <h3 align="center">Bulan <?php echo $bulan?> Tahun <?php echo $tahun?></h3>
                    <?php } ?>
                    <!-- <p class="text-muted font-13 m-b-30">
                      DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function: <code>$().DataTable();</code>
                    </p> -->
                     <div class="" role="tabpanel" data-example-id="togglable-tabs">
                      <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#tab-kumulatif" role="tab" id="grafik-tab" data-toggle="tab" aria-expanded="false">Kumulatif</a>
                        </li>
                        <li role="presentation" class=""><a href="#tab-nonkumulatif" role="tab" id="realisasi-tab" data-toggle="tab" aria-expanded="true">Non Kumulatif</a>
                        </li>
                        <!-- <li role="presentation" class=""><a href="#tab-persentase" id="persentase-tab" role="tab" data-toggle="tab" aria-expanded="false">Persentase</a>
                        </li> -->
                      </ul>
                  <div id="myTabContent" class="tab-content">
                  <div role="tabpanel" class="tab-pane active" id="tab-kumulatif" aria-labelledby="profile-tab">

                    <table id="datatable-buttons" class="table table-striped table-bordered" style="width:100%;">
                      <thead>
                        <tr>
                          <th rowspan="2" style="vertical-align: middle;text-align: center;">Uraian</th>
                          <th rowspan="2" style="vertical-align: middle;text-align: center;">Plafon</th>
                          <th rowspan="2" style="vertical-align: middle;text-align: center;">Plafon Perubahan</th>
                          <th colspan="2" scope="colgroup" style="text-align: center;"><?php echo $bulan?></th>
                        </tr>
                        <tr>
                          <th scope="col" style="text-align: center;">Nilai</th>
                          <th scope="col" style="text-align: center;">%</th>
                        </tr>
                      </thead>
                      <tbody id="tabelApbd">
                        <?php if(sizeof($all_uraian)==41){
                        for ($r=0; $r<41; $r++) { ?>
                          <tr>
                            <!-- <td ><?php echo $uraian[$r]['URAIAN'] ?></td> -->
                            <td ><?php echo $all_uraian[$r]['URAIAN']; ?></td>
                            <td ><?php echo $plafon[$r]['APBD'] ?></td>
                            <td ><?php echo $plafon[$r]['APBD_P'] ?></td>
                            <td ><?php echo $uraian[$r]['NILAI'] ?></td>
                            <td ><?php echo $uraian[$r]['PERSENTASE']; if($uraian[$r]['PERSENTASE']!='data tidak ada'){echo " %";} ?> </td>
                          </tr>
                        <?php }} ?>
                      </tbody>
                    </table>
                  </div>

                  <div role="tabpanel" class="tab-pane fade in" id="tab-nonkumulatif" aria-labelledby="profile-tab">
                          <table class="table table-striped table-bordered datatable-buttons">
                            <thead>
                              <tr>
                                
                                <th rowspan="2" style="vertical-align: middle;text-align: center;">Uraian</th>
                                <th rowspan="2" style="vertical-align: middle;text-align: center;">Plafon</th>
                                <th rowspan="2" style="vertical-align: middle;text-align: center;">Plafon Perubahan</th>
                                <th colspan="2" scope="colgroup" style="text-align: center;">Nilai <?php echo $bulan?></th>
                              </tr>
                            </thead>
                            <tbody id="tabelApbd">
                              <?php 
                              if($nonkumulatif){

                              if(sizeof($nonkumulatif[0])==41){
                                for ($r=0; $r<41; $r++) { ?>
                                  <tr>
                                    <td ><?php echo $all_uraian[$r]['URAIAN']; ?></td>
                                    <td ><?php echo $plafon[$r]['APBD'] ?></td>
                                    <td ><?php echo $plafon[$r]['APBD_P'] ?></td>
                                    <td ><?php echo $nonkumulatif[0][$r]['NILAI'] ?></td>
                                    <!-- <td ><?php echo $nonkumulatif[1][$r]['NILAI'] ?></td>
                                    <td ><?php echo $nonkumulatif[2][$r]['NILAI'] ?></td>
                                    <td ><?php echo $nonkumulatif[3][$r]['NILAI'] ?></td>
                                  </tr> -->
                              <?php }}} ?>
                            </tbody>
                          </table>
                        </div>
                        <!-- END TAB PANEL -->
                      </div>
                      <!-- END TAB CONTENT -->
                      <!-- Small modal -->
                      <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                          <div class="modal-content">

                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                              </button>
                              <h4 class="modal-title" id="myModalLabel2">Detail Kontak</h4>
                            </div>
                            <div class="modal-body">
                              <h2 style="color: #2A3F54; text-transform: uppercase;"><?php echo $data_pic[0]['PIC']?></h2>
                              <ul class="list-unstyled">
                                <li><i class="fa fa-building"></i> <?php echo $data_pic[0]['NAMA_INSTANSI']?></li>
                                <li><i class="fa fa-home"></i> <?php echo $data_pic[0]['ALAMAT']?></li>
                                <li><i class="fa fa-phone"></i> <?php echo $data_pic[0]['NO_TELEPON']?></li>
                                <li><i class="fa fa-envelope"></i> <?php echo $data_pic[0]['EMAIL']?></li>
                                <li><i class="fa fa-smile-o"></i> <?php echo $data_pic[0]['PREFERRED_CONTACT']?></li>
                              </ul>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-success" data-dismiss="modal">Ok</button>
                            </div>

                          </div>
                        </div>
                      </div>
                      <!-- /modals -->


                </div>

              </div>
            </div>
          </div>
        </div>

<!-- Nofif -->
      
        <script type="text/javascript">
        // $(document).ready(function()
        // {
          

        //   <?php if ($this->session->flashdata('notif')==1) 
        //   { ?>
        //     $('#apbd-belum').show();
        //     <?php
        //   } 
        //   else if ($this->session->flashdata('notif')==2)
        //   { ?>
        //     $('#gagal-tambah').show();
        //     <?php
        //   }
        //   else if ($this->session->flashdata('notif')==3)
        //   { ?>
        //     $('#duplikat-tambah').show();
        //     <?php
        //   }
        //   else if ($this->session->flashdata('notif')==4)
        //   { ?>
        //     $('#gagal-apbdp').show();
        //     <?php
        //   }

        //   ?>

        // });
        // </script>
        <!-- /page content -->

        <!-- DATA TABLES-->
        <script>
      $(document).ready(function() {
        var handleDataTableButtons = function() {
          if ($("#datatable-buttons").length) {
            $("#datatable-buttons").DataTable({
              dom: "Bfrtip",
              buttons: [
                {
                  extend: "copy",
                  className: "btn-sm"
                },
                {
                  extend: "csv",
                  className: "btn-sm"
                },
                {
                  extend: "excel",
                  className: "btn-sm"
                },
                {
                  extend: "pdfHtml5",
                  className: "btn-sm"
                },
                {
                  extend: "print",
                  className: "btn-sm"
                },
              ],
              responsive: true,
              order: [],
              paging: false
            });
          }
        };

        TableManageButtons = function() {
          "use strict";
          return {
            init: function() {
              handleDataTableButtons();
            }
          };
        }();
        TableManageButtons.init();
      });
    </script>
    <!-- /Datatables -->
       