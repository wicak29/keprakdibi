        <!-- TAMBAH PIC -->
        <div class="right_col" role="main" style="margin-left: 0px;">

          <!-- ALERTS -->
          <div id="sukses-tambah" class="alert alert-success alert-dismissible fade in" style="margin-top:70px;">
            <a href="#" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">×</span></a>
            <strong>Berhasil!</strong> Kontak berhasil disimpan ke database.
          </div>    
          <div id="gagal-tambah" class="alert alert-danger alert-dismissible fade in" style="margin-top:70px;">
            <a href="#" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">×</span></a>
            <strong>Gagal!</strong> Kontak gagal disimpan ke database!
          </div>
          <!-- END ALERTS -->

          <div class="">
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel" style="min-height:538px;">
                  <div class="x_title">
                    <h2>Daftar Kontak</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="row">
                      <div class="col-md-12 col-sm-12 col-xs-12"></div>
                      <div class="col-md-12 col-sm-12 col-xs-12"></div>
                      <?php
                      $imgu = "http://localhost/keprakdibi/assets/gentelella/production/images/img.jpg";
                      foreach ($list_pic as $pic) 
                      {
                        echo '
                        <div class="col-md-4 col-sm-4 col-xs-12 profile_details">
                        <div class="well profile_view">
                          <div class="col-sm-12">
                            <h4 class="brief bg-primary"><i>'.$pic['NAMA_INSTANSI'].'</i></h4>
                            <div class="left col-xs-7">
                              <h2 style="color: #2A3F54; text-transform: uppercase;">'.$pic['PIC'].'</h2>
                              <ul class="list-unstyled">
                                <li><i class="fa fa-building"></i> '.$pic['ALAMAT'].'</li>
                                <li><i class="fa fa-phone"></i> '.$pic['NO_TELEPON'].' </li>
                                <li><i class="fa fa-at"></i> '.$pic['EMAIL'].'</li>
                                <li><i class="fa fa-smile-o"></i> '.$pic['PREFERRED_CONTACT'].'</li>
                              </ul>
                            </div>
                            <div class="right col-xs-5 text-center">
                              <img src="'.$imgu.'" alt="" class="img-circle img-responsive">
                            </div>
                          </div>
                          <div class="col-xs-12 bottom text-center">
                            <div class="col-xs-12 col-sm-9 emphasis">
                            </div>
                            <div class="col-xs-12 col-sm-3 emphasis">
                              <button class="btn btn-success btn-xs"> <i class="fa fa-user">
                                </i> </button>
                              <button class="btn btn-primary btn-xs">
                                <i class="fa fa-user"> </i>
                              </button>
                            </div>
                          </div>
                        </div>
                      </div>
                      ';
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