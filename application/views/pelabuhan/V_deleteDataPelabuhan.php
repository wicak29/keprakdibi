        <!-- page content -->
        <div class="right_col" role="main" style="margin-left: 0px;">
          <div class="">
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12" style="margin-right:auto; margin-left:auto;float:none;">
                <div class="x_panel" style="min-height:538px;">
                  <div class="x_title">
                    <h2>Hapus Data Pelabuhan</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <form action="<?php echo base_url();?>pelabuhan/hapus/filterHapusDataPelabuhan/" method="post" enctype="multipart/form-data" class="form-inline">
                      <div class="form-group">
                        <label for="ex3">Pilih Pelabuhan : </label>
                        <select class="form-control" name="id_pelabuhan" required="required">
                          <option value="" selected disabled>Pilih pelabuhan</option>
                          <?php
                            foreach ($list_pelabuhan as $pelabuhan) 
                            {
                              echo '<option value="'.$pelabuhan['ID_PELABUHAN'].'">'.$pelabuhan['PELABUHAN'].'</option>';
                            }
                          ?>
                        </select>
                        
                        <input type="submit" class="btn btn-primary" style="margin:0 0 0 10px;" value="Cari"/>
                      </div>
                    </form>
                    
                    <div class="ln_solid"></div>
                    <!-- <p class="text-muted font-13 m-b-30">
                      DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function: <code>$().DataTable();</code>
                    </p> -->
                    <form action="<?php echo base_url();?>pelabuhan/hapus/deleteDataPelabuhan/" method="post" enctype="multipart/form-data" class="form-inline">
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th style="vertical-align: middle;text-align: center;">Pilih</th>
                          <th style="vertical-align: middle;text-align: center;">Nama Pelabuhan</th>
                          <th style="vertical-align: middle;text-align: center;">Periode</th>
                          <th style="vertical-align: middle;text-align: center;">Tahun</th>
                          <th style="vertical-align: middle;text-align: center;">Nama Instansi</th>
                          <th style="vertical-align: middle;text-align: center;">P.I.C.</th>
                        </tr>
                      </thead>
                      <tbody id="tabelApbd">                        
                         <?php foreach ($list as $r) { ?>
                           <tr>
                            <td><input type="checkbox" name="data[]" value="<?php echo $r['ID_PELABUHAN']?>#<?php echo $r['PERIODE']?>#<?php echo $r['TAHUN'] ?>#<?php echo $r['NAMA_INSTANSI'] ?>#<?php echo $r['PIC'] ?>#<?php echo $r['ID_KONTAK'] ?>" class="single-checkbox" /></td>
                            <td ><?php echo $r['PELABUHAN'] ?></td>
                            <td ><?php echo $r['PERIODE'] ?></td>
                            <td ><?php echo $r['TAHUN'] ?></td>
                            <td ><?php echo $r['NAMA_INSTANSI'] ?></td>
                            <td ><?php echo $r['PIC'] ?></td>
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
                          <h4 class="modal-title" id="myModalLabel2">HAPUS DATA PELABUHAN</h4>
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

      <!-- DATA TABLES-->
      <script>
      $(document).ready(function() 
      {
        $('#datatable').dataTable();  
      });
      </script>
      <!-- /Datatables -->
       