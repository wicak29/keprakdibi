        <!-- page content -->
        <div class="right_col" role="main" style="margin-left: 0px;">
          <div class="">
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12" style="margin-right:auto; margin-left:auto;float:none;">
                <div class="x_panel" style="min-height:538px;">
                  <div class="x_title">
                    <h2>Hapus APBD Provinsi</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li>
                        <a href="<?php echo base_url();?>apbd/hapus" class=""><i class="fa fa-arrow-left"></i> Kembali</a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <form action="<?php echo base_url();?>apbd/hapus/deleteDataProv/" method="post" enctype="multipart/form-data" class="form-inline">
                
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th style="vertical-align: middle;text-align: center;">Pilih</th>
                          <th style="vertical-align: middle;text-align: center;">Data Daerah</th>
                          <th style="vertical-align: middle;text-align: center;">Periode</th>
                          <th style="vertical-align: middle;text-align: center;">Tahun</th>
                          <th style="vertical-align: middle;text-align: center;">Nama Instansi</th>
                          <th style="vertical-align: middle;text-align: center;">P.I.C.</th>
                          
                        </tr>
                        
                      </thead>
                      <tbody id="tabelhapus">                        
                        <?php foreach ($list as $r) { ?>
                          <tr>
                            <td><input type="checkbox" name="data[]" value="1#<?php echo $r['PERIODE']?>#<?php echo $r['TAHUN'] ?>#<?php echo $r['INSTANSI'] ?>#<?php echo $r['PIC'] ?>#<?php echo $r['ID_KONTAK'] ?>" class="single-checkbox" /></td>
                            <td ><?php echo "Prov. Bali" ?></td>
                            <td ><?php echo $r['PERIODE'] ?></td>
                            <td ><?php echo $r['TAHUN'] ?></td>
                            <td ><?php echo $r['INSTANSI'] ?></td>
                            <td ><?php echo $r['PIC'] ?></td>
                            
                            <!-- <td ><?//php echo $r['NILAI'] ?></td> -->
                            
                          </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  <button id="checkBtn" type="button" class="btn btn-danger" data-toggle="modal" data-target=".bs-example-modal-sm" style="float:right;">Hapus</button>
                  <!-- Small modal -->
                  <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel2">HAPUS APBD</h4>
                        </div>
                        <div class="modal-body">
                          <h4>Apakah Anda yakin ingin menghapus data yang dipilih?</h4>
                        </div>
                        <div class="modal-footer">
                          <input type="submit" class="btn btn-success" value="Iya" style="margin: 0;"/>
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Tidak</button>
                        </div>

                      </div>
                    </div>
                  </div>
                  <!-- /modals -->
                </form>

                </div>

              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

      <!-- MINIMAL CHECK -->
      <script type="text/javascript">
      $(document).ready(function () {
          $( '#checkBtn').click(function() {
            checked = $("input[type=checkbox]:checked").length;

            if(!checked) {
              alert("Anda belum memilih data APBD!");
              return false;
            }
          });
      });
      </script>
      
        <!-- Datatables -->
    <script>
      $(document).ready(function() 
      {        
        $('#datatable').dataTable();
      });
    </script>
    <!-- /Datatables -->
       