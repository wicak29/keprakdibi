        <!-- page content -->
        <div class="right_col" role="main" style="margin-left: 0px;">
          <div class="">
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12" style="margin-right:auto; margin-left:auto;float:none;">
                <div class="x_panel" style="min-height:538px;">
                  <div class="x_title">
                    <h2>Cari Data Penerbangan</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li>
                        <a href="<?php echo base_url();?>penerbangan/filter" class=""><i class="fa fa-arrow-left"></i> Kembali</a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="row">
                      <form action="<?php echo base_url();?>penerbangan/filter/filterDataPenerbangan/" method="post" enctype="multipart/form-data" class="form-inline">
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
                            <label for="ex3">Pilih Bulan : </label>
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
                       <h3 align="center">Data Penerbangan Entitas <?php echo $entitas?></h3>
                      <h3 align="center">Bulan <?php echo $bulan?> Tahun <?php echo $tahun?></h3>
                     <?php } ?>
                    <!-- <p class="text-muted font-13 m-b-30">
                      DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function: <code>$().DataTable();</code>
                    </p> -->
                    <table id="datatable-buttons" class="table table-striped table-bordered" style="width:100%;">
                      <thead>
                        <tr>
                          <th rowspan="2" style="vertical-align: middle;text-align: center;">No.</th>
                          <th rowspan="2" style="vertical-align: middle;text-align: center;">Entitas</th>
                          <th colspan="3" style="vertical-align: middle;text-align: center;">Domestik</th>
                          <th colspan="3" style="vertical-align: middle;text-align: center;">Internasional</th>
                        </tr>
                        <tr>
                          <th style="vertical-align: middle;text-align: center;">Datang</th>
                          <th style="vertical-align: middle;text-align: center;">Berangkat</th>
                          <th style="vertical-align: middle;text-align: center;">Transit</th>
                          <th style="vertical-align: middle;text-align: center;">Datang</th>
                          <th style="vertical-align: middle;text-align: center;">Berangkat</th>
                          <th style="vertical-align: middle;text-align: center;">Transit</th>
                        </tr>
                      </thead>
                      <tbody id="tabelApbd">
                         <?php 
                         $j=0;
                         $k=0;
                         if(sizeof($penerbangan)==30){
                         for($i=0; $i<5; $i++) { 
                            ?> 
                          <tr>
                            <td ><?php echo $i+1 ?></td>
                            <td ><?php echo $list_entitas[$i]['NAMA_ENTITAS'] ?></td>
                            <td ><?php echo $penerbangan[$i*3]['NILAI'] ?></td>
                            <td ><?php echo $penerbangan[$i*3+1]['NILAI'] ?></td>
                            <td ><?php echo $penerbangan[$i*3+2]['NILAI'] ?></td>
                            <td ><?php echo $penerbangan[$i*3+15]['NILAI'] ?></td>
                            <td ><?php echo $penerbangan[$i*3+16]['NILAI'] ?></td>
                            <td ><?php echo $penerbangan[$i*3+17]['NILAI'] ?></td>
                            
                          </tr>
                         <?php } } ?>
                      </tbody>
                    </table>
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
       