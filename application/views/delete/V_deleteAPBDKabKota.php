        <!-- page content -->
        <div class="right_col" role="main" style="margin-left: 0px;">
          <div class="">
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12" style="margin-right:auto; margin-left:auto;float:none;">
                <div class="x_panel" style="min-height:538px;">
                  <div class="x_title">
                    <h2>Lihat Tabel</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li>
                        <a href="<?php echo base_url();?>C_filter" class=""><i class="fa fa-arrow-left"></i> Kembali</a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <form action="<?php echo base_url();?>C_delete/filterKab/" method="post" enctype="multipart/form-data" class="form-inline">
                      <div class="form-group">
                        <label for="ex3">Pilih Daerah : </label>
                        <select class="form-control" name="kabkota" required="required">
                          <option value="" selected disabled>Pilih Daerah</option>
                          <option value="2">Kab. Badung</option>
                          <option value="3">Kab. Bangli</option>
                          <option value="4">Kab. Buleleng</option>
                          <option value="5">Kab. Gianyar</option>
                          <option value="6">Kab. Jembrana</option>
                          <option value="7">Kab. Karangasem</option>
                          <option value="8">Kab. Klungkung</option>
                          <option value="9">Kab. Tabanan</option>
                          <option value="10">Kota. Denpasar</option>
                        </select>
                        
                        <input type="submit" class="btn btn-primary" style="margin:0 0 0 10px;" value="Cari"/>
                      </div>
                    </form>
                    
                    <div class="ln_solid"></div>
                    <!-- <p class="text-muted font-13 m-b-30">
                      DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function: <code>$().DataTable();</code>
                    </p> -->
                    <form action="<?php echo base_url();?>C_delete/deleteDataKab/" method="post" enctype="multipart/form-data" class="form-inline">
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th rowspan="2" style="vertical-align: middle;text-align: center;">Pilih</th>
                          <th rowspan="2" style="vertical-align: middle;text-align: center;">Data Daerah</th>
                          <th rowspan="2" style="vertical-align: middle;text-align: center;">Periode</th>
                          <th rowspan="2" style="vertical-align: middle;text-align: center;">Tahun</th>
                          <th rowspan="2" style="vertical-align: middle;text-align: center;">Nama Instansi</th>
                          <th rowspan="2" style="vertical-align: middle;text-align: center;">P.I.C.</th>
                        </tr>
                      </thead>
                      <tbody id="tabelApbd">                        
                        <?php foreach ($list as $r) { ?>
                          <tr>
                            <td><input type="checkbox" name="data[]" value="<?php echo $r['ID_DAERAH']?>#<?php echo $r['PERIODE']?>#<?php echo $r['TAHUN'] ?>#<?php echo $r['INSTANSI'] ?>#<?php echo $r['PIC'] ?>#<?php echo $r['ID_KONTAK'] ?>" class="single-checkbox" /></td>
                            <td ><?php echo $r['ID_DAERAH'] ?></td>
                            <td ><?php echo $r['PERIODE'] ?></td>
                            <td ><?php echo $r['TAHUN'] ?></td>
                            <td ><?php echo $r['INSTANSI'] ?></td>
                            <td ><?php echo $r['PIC'] ?></td>
                            
                            <!-- <td ><?//php echo $r['NILAI'] ?></td> -->
                            
                          </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                    <input type="submit" class="btn btn-danger" style="float:right;" value="Delete"/>
                  </form>
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
       