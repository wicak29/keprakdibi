        <!-- page content -->
        <div class="right_col" role="main" style="margin-left: 0px;">
          <!-- ALERTS -->
          <div id="sukses-tambah" class="alert alert-success alert-dismissible fade in" style="margin-top:70px;">
            <a href="#" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">×</span></a>
            <strong>Berhasil!</strong> User berhasil di tambahkan ke database!
          </div>    
          <div id="gagal-tambah" class="alert alert-danger alert-dismissible fade in" style="margin-top:70px;">
            <a href="#" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">×</span></a>
            <strong>Gagal!</strong> User gagal di tambahkan ke database!
          </div>

          <!-- END ALERTS -->
          <div class="">
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12" style="margin-right:auto; margin-left:auto;float:none;">
                <div class="x_panel" style="min-height:538px;">
                  <div class="x_title">
                    <h3>List User
                      <a href="<?php echo base_url('C_admin/viewTambahUser');?>" class="pull-right" style="padding:0px;">
                        <button type="button" class="btn btn-info btn-sm"><i class="fa fa-plus"></i> Tambah User</button>
                      </a>
                    </h3>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th style="width:5%;">No</th>
                          <th>Username</th>
                          <th>Level</th>
                          <th style="width:10%;">Action</th>
                        </tr>                        
                      </thead>
                      <tbody id="tabelApbd">                        
                        <?php 
                        $no = 1;
                        foreach ($user as $r) { ?>
                          <tr>
                            <td ><?php echo $no; ?></td>
                            <td ><?php echo $r['USERNAME'] ?></td>
                            <td ><?php echo $r['LEVEL'] ?></td>
                            <td>
                              <a href="<?php echo base_url();?>C_admin/viewUpdateAdmin/<?php echo $r['ID_USER']; ?>">
                                <button class="btn btn-primary btn-xs" title="Edit User"> 
                                <i class="fa fa-edit"> </i> 
                                </button>
                              </a>
                              <button id="checkBtn" type="button" class="btn btn-danger btn-xs" data-toggle="modal" title="Hapus User" data-target=".bs-example-modal-sm">
                                <i class="fa fa-trash"> </i> 
                              </button>
                            </td>
                          </tr>
                        <?php
                        $no++; } ?>
                      </tbody>
                    </table>
                  <!-- <button id="checkBtn" type="button" class="btn btn-danger" data-toggle="modal" data-target=".bs-example-modal-sm" style="float:right;">Hapus</button> -->
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
                          <a href="<?php echo base_url();?>C_admin/deleteUser/<?php echo $r['ID_USER']; ?>">
                            <button type="button" class="btn btn-success">Iya</button>
                          </a>
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Tidak</button>
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
        <!-- /page content -->


      <script type="text/javascript">
        $(document).ready(function()
        {
          $('#datatable').dataTable();
          <?php if ($this->session->flashdata('notif')==1) 
          { ?>
            $('#sukses-tambah').show();
            <?php
          } 
          else if ($this->session->flashdata('notif')==2)
          { ?>
            $('#gagal-tambah').show();
            <?php
          }
          ?>
        });
        </script>
       