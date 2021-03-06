        <!-- page content -->
        <div class="right_col" role="main" style="margin-left: 0px;">
          <div class="">
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12" style="margin-right:auto; margin-left:auto;float:none;">
                <div class="x_panel" style="min-height:538px;">
                  <div class="x_title">
                    <h2>Cari Data Pelabuhan</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="row">
                      <form action="<?php echo base_url();?>pelabuhan/filter/filterDataPelabuhan/" method="post" enctype="multipart/form-data" class="form-inline">
                        <div class="form-group">
                          <label for="ex3">Pilih Pelabuhan : </label>
                          <select name="pelabuhan" class="form-control" tabindex="-1" style="margin-left:10px;" required="required">
                              <option value="" selected disabled>Pilih Pelabuhan</option>
                              
                              <?php
                                    foreach ($pelabuhan as $p) 
                                    {
                                      echo '<option value="'.$p['ID_PELABUHAN'].'">'.$p['PELABUHAN'].'</option>';
                                    }
                                  ?>
                              
                            </select>

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
                      <br><br><h3 align="center">Data Realisasi Pelabuhan <?php echo $tabel_title['PELABUHAN']?> </h3>
                      <h3 align="center">Bulan <?php echo $bulan?> Tahun <?php echo $tahun?></h3>
                     <?php } ?>
                    <!-- <p class="text-muted font-13 m-b-30">
                      DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function: <code>$().DataTable();</code>
                    </p> -->
                    <table id="datatable-buttons" class="table table-striped table-bordered" style="width:100%;">
                      <thead>
                        <tr>
                          <th style="vertical-align: middle;text-align: center;">No.</th>
                          <th style="vertical-align: middle;text-align: center;">JENIS DATA</th>
                          <th style="vertical-align: middle;text-align: center;">SATUAN</th>
                          <th style="vertical-align: middle;text-align: center;">REALISASI</th>
                        </tr>
                      </thead>
                      <tbody id="tabelApbd">
                         <?php 
                         $i=1;

                         foreach ($hasil_filter as $r) { ?> 
                          <tr>
                            <td ><?php echo $i ?></td>
                            <td ><?php echo $r['JENIS_DATA'] ?></td>
                            <td ><?php echo $r['SATUAN'] ?></td>
                            <td ><?php echo $r['REALISASI'] ?></td>
                            
                          </tr>
                         <?php $i++;} ?>
                      </tbody>
                    </table>
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
        </div>
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
       