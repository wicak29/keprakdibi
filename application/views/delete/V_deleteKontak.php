        <!-- page content -->
        <div class="right_col" role="main" style="margin-left: 0px;">
          <div class="">
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12" style="margin-right:auto; margin-left:auto;float:none;">
                <div class="x_panel" style="min-height:538px;">
                  <div class="x_title">
                    <h2>Hapus Kontak</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li>
                        <a href="<?php echo base_url();?>C_pic/viewLihatPic" class=""><i class="fa fa-user"></i> Lihat Kontak</a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <form action="<?php echo base_url();?>C_delete/deleteDataKontak/" method="post" enctype="multipart/form-data" class="form-inline">
                
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th rowspan="2" style="vertical-align: middle;text-align: center;">Pilih</th>
                          <th rowspan="2" style="vertical-align: middle;text-align: center;">Person In Charge</th>
                          <th rowspan="2" style="vertical-align: middle;text-align: center;">Nama Instansi</th>
                          <th rowspan="2" style="vertical-align: middle;text-align: center;">No. Telepon</th>
                          <th rowspan="2" style="vertical-align: middle;text-align: center;">Email</th>
                          <th rowspan="2" style="vertical-align: middle;text-align: center;">Alamat</th>
                          <th rowspan="2" style="vertical-align: middle;text-align: center;">Preferred Contact</th>
                          
                        </tr>
                        
                      </thead>
                      <tbody id="tabelApbd">                        
                        <?php foreach ($list as $r) { ?>
                          <tr>
                            <td><input type="checkbox" name="data[]" value="<?php echo $r['ID_KONTAK']?>#<?php echo $r['PIC'] ?>#<?php echo $r['NAMA_INSTANSI'] ?>#<?php echo $r['NO_TELEPON'] ?>#<?php echo $r['EMAIL'] ?>#<?php echo $r['ALAMAT'] ?>#<?php echo $r['PREFERRED_CONTACT'] ?>" class="single-checkbox" /></td>
                            
                            <td ><?php echo $r['PIC'] ?></td>
                            <td ><?php echo $r['NAMA_INSTANSI'] ?></td>
                            <td ><?php echo $r['NO_TELEPON'] ?></td>
                            <td ><?php echo $r['EMAIL'] ?></td>
                            <td ><?php echo $r['ALAMAT'] ?></td>
                            <td ><?php echo $r['PREFERRED_CONTACT'] ?></td>
                            
                            
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
       