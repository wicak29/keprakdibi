        <!-- page content -->
        <div class="right_col" role="main" style="margin-left: 0px;">
          <div class="">
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12" style="margin-right:auto; margin-left:auto;float:none;">
                <div class="x_panel" style="min-height:538px;">
                  <div class="x_title">
                    <h2>Hapus Kontak dari Kendaraan</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <form action="<?php echo base_url();?>kendaraan/hapusKontakBanyak/" method="post" enctype="multipart/form-data" class="form-inline">
                    <table id="" class="table table-striped table-bordered">
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
                        <?php 
                        foreach ($list as $r) { 
                          if ($r['ID_KONTAK']!=1) {?>
                          <tr>
                            <td><input type="checkbox" name="data[]" value="<?php echo $r['ID_KONTAK']?>#<?php echo $r['PIC'] ?>#<?php echo $r['NAMA_INSTANSI'] ?>#<?php echo $r['NO_TELEPON'] ?>#<?php echo $r['EMAIL'] ?>#<?php echo $r['ALAMAT'] ?>#<?php echo $r['PREFERRED_CONTACT'] ?>" class="single-checkbox" /></td>
                            <td ><?php echo $r['PIC'] ?></td>
                            <td ><?php echo $r['NAMA_INSTANSI'] ?></td>
                            <td ><?php echo $r['NO_TELEPON'] ?></td>
                            <td ><?php echo $r['EMAIL'] ?></td>
                            <td ><?php echo $r['ALAMAT'] ?></td>
                            <td ><?php echo $r['PREFERRED_CONTACT'] ?></td>
                          </tr>
                        <?php } 
                      } ?>
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
                          <h4 class="modal-title" id="myModalLabel2">HAPUS KONTAK</h4>
                        </div>
                        <div class="modal-body">
                          <h4>Apakah Anda yakin ingin menghapus kontak yang dipilih?</h4>
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

      <script type="text/javascript">
      $(document).ready(function () {
          $('#checkBtn').click(function() {
            checked = $("input[type=checkbox]:checked").length;

            if(!checked) {
              alert("Anda belum memilih kontak yang akan dihapus!");
              return false;
            }

          });
      });
      </script>
       