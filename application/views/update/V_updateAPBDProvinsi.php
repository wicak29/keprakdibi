        <!-- page content -->
        <div class="right_col" role="main" style="margin-left: 0px;">
          <div class="">
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12" style="margin-right:auto; margin-left:auto;float:none;">
                <div class="x_panel" style="min-height:538px;">
                  <div class="x_title">
                    <h2>Update Data APBD Provinsi Bali</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li>
                        <a href="<?php echo base_url();?>C_update" class=""><i class="fa fa-arrow-left"></i> Kembali</a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <form action="<?php echo base_url();?>C_update/viewUpdateDataRealisasiProv/" method="post" enctype="multipart/form-data" class="form-inline">
                      <div class="form-group">
                        <label for="ex3">Pilih Tahun : </label>
                        <select name="tahun" class="form-control" tabindex="-1" style="margin-left:10px;">
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
                          </select>
                          <select name="bulan" class="form-control" tabindex="-1" style="margin-left:10px;">
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
                    
                    <div class="ln_solid"></div>
                    <?php if($tahun!="Tahun" || $bulan!="Bulan") { ?>
                      <h3 align="center">Update Nilai Realisasi Prov. Bali</h3>
                      <h3 align="center"> Bulan <?php echo $bulan?> Tahun <?php echo $tahun?></h3>
                    <?php } ?>
                    <!-- <p class="text-muted font-13 m-b-30">
                      DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function: <code>$().DataTable();</code>
                    </p> -->
                    <form action="<?php echo base_url();?>C_update/updateDataNilaiRealisasiProv/" method="post" enctype="multipart/form-data" class="form-inline">
                
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th rowspan="2" style="vertical-align: middle;text-align: center;">Uraian</th>
                          <th rowspan="2" style="vertical-align: middle;text-align: center;">APBD</th>
                          <th rowspan="2" style="vertical-align: middle;text-align: center;">APBD P</th>
                          <th colspan="2" name="bulan" scope="colgroup" style="text-align: center;" value="<?php echo $bulan ?>"><?php echo $bulan ?></th>
                        </tr>
                        <tr>
                          <th scope="col">Nilai</th>
                          <th scope="col">Persentase</th>
                        </tr>
                      </thead>
                      <tbody id="tabelApbd">
                        <?php foreach ($uraian as $r) { ?>
                          <tr>
                            <td ><?php echo $r['URAIAN'] ?></td>
                            <td ><?php echo $r['APBD'] ?></td>
                            <td ><?php echo $r['APBD_P'] ?></td>
                            <td><input type="text" name="nilai[]" value="<?php echo $r['NILAI'] ?>"></td>
                            <td ><?php echo $r['PERSENTASE'] ?> %</td>
                          </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  <?php if($uraian) { ?>
                  <input type="submit" class="btn btn-warning" style="float:right;" value="Update"/>
                  <?php } ?>
                </form>

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
       