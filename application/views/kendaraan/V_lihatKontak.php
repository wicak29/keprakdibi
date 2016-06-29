        <!-- TAMBAH PIC -->
        <div class="right_col" role="main" style="margin-left: 0px;">

          <!-- ALERTS -->
          <div id="sukses-tambah" class="alert alert-success alert-dismissible fade in" style="margin-top:70px;">
            <a href="#" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">×</span></a>
            <strong>Berhasil!</strong> Kontak berhasil ditambah ke Kendaraan.
          </div>    
          <div id="gagal-tambah" class="alert alert-danger alert-dismissible fade in" style="margin-top:70px;">
            <a href="#" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">×</span></a>
            <strong>Gagal!</strong> Kontak gagal ditambah ke Kendaraan!
          </div>
          <!-- END ALERTS -->

          <div class="">
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel" style="min-height:538px;">
                  <div class="x_title">
                    <h2>Daftar Kontak Kendaraan</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="row">
                      <div class="col-md-12 col-sm-12 col-xs-12"></div>
                      <div class="col-md-12 col-sm-12 col-xs-12"></div>
                      <?php
                      $imgu = base_url('assets/gentelella/production/images/user.png');
                      foreach ($list_kontak as $pic) 
                        if ($pic['ID_KONTAK']!=1)
                      {
                      { ?>
                        <!-- <form> -->
                          <div class="col-md-4 col-sm-4 col-xs-12 profile_details">
                            <div class="well profile_view">
                              <div class="col-sm-12">
                                <h4 class="brief"><i> <?php echo $pic['NAMA_INSTANSI']; ?></i></h4>
                                <div class="left col-xs-7">
                                  <h2 style="color: #2A3F54; text-transform: uppercase;"><?php echo $pic['PIC'];?></h2>
                                  <ul class="list-unstyled">
                                    <li><i class="fa fa-building"></i> <?php echo $pic['ALAMAT']; ?></li>
                                    <li><i class="fa fa-phone"></i> <?php echo $pic['NO_TELEPON']; ?></li>
                                    <li><i class="fa fa-envelope"></i> <?php echo $pic['EMAIL']; ?></li>
                                    <li><i class="fa fa-smile-o"></i> <?php echo $pic['PREFERRED_CONTACT']; ?></li>
                                  </ul>
                                </div>
                                <div class="right col-xs-5 text-center">
                                  <img src="<?php echo $imgu; ?>" alt="" class="img-circle img-responsive">
                                </div>
                              </div>
                              <div class="col-xs-12 bottom text-center">
                                <div class="col-xs-12 col-sm-10 emphasis">
                                </div>
                                <div class="col-xs-12 col-sm-2 emphasis">
                                  <a href="<?php echo base_url();?>kendaraan/deleteKontak/<?php echo $pic['ID_KONTAK']; ?>"
                                    <button class="btn btn-danger btn-xs" data-toggle="tooltip" title="Hapus dari Kendaraan"> 
                                    <i class="fa fa-trash"> </i> 
                                    </button>
                                  </a>
                                </div>
                              </div>
                            </div>
                          </div>
                        <!-- </form> -->
                        <?php
                        }
                      }
                    ?>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
        <!-- /INSERT KE APBD -->

        <script type="text/javascript">
        $(document).ready(function()
        {
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