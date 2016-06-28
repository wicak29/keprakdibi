
        <!-- INSERT KE DATA APBD -->
        <div class="right_col" role="main" style="margin-left: 0px;">

          <!-- ALERTS -->
          <div id="sukses-tambah" class="alert alert-success alert-dismissible fade in" style="margin-top:70px;">
            <a href="#" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">×</span></a>
            <strong>Berhasil!</strong> File berhasil disimpan ke database.
          </div>    
          <div id="gagal-tambah" class="alert alert-danger alert-dismissible fade in" style="margin-top:70px;">
            <a href="#" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">×</span></a>
            <strong>Gagal!</strong> File gagal disimpan ke database!
          </div>
          <div id="duplikat-tambah" class="alert alert-warning alert-dismissible fade in" style="margin-top:70px;">
            <a href="#" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">×</span></a>
            <strong>Warning!</strong> Data Sudah Pernah Diupload!
          </div>
          <div id="gagal-apbdp" class="alert alert-warning alert-dismissible fade in" style="margin-top:70px;">
            <a href="#" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">×</span></a>
            <strong>Gagal!</strong> Data APBD/APBD Perubahan untuk tahun yang dipilih BELUM ADA!
          </div>
          <!-- END ALERTS -->

          <div class="">
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel" style="min-height:538px;">
                  <div class="x_title">
                    <h2>Import File Excel</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="" role="tabpanel" data-example-id="togglable-tabs">
                      <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                       <!--  <li role="presentation" class="active"><a href="#tab-apbdp" role="tab" id="apbdp-tab" data-toggle="tab" aria-expanded="true">APDBP</a>
                        </li> -->
                        <li role="presentation" class="" style="display:none;"><a href="#tab-uraian" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Uraian</a>
                        </li>
                        <li role="presentation" class="active"><a href="#tab-datapelabuhan" id="provinsi-tab" role="tab" data-toggle="tab" aria-expanded="false">Data Pelabuhan</a>
                        </li>
                        <!-- <li role="presentation" class=""><a href="#tab-kabupaten" role="tab" id="kabupaten-tab" data-toggle="tab" aria-expanded="false">Kabupaten/Kota</a>
                        </li> -->
                      </ul>

                      <div id="myTabContent" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade in" id="tab-uraian" aria-labelledby="profile-tab">
                          <form action="<?php echo base_url();?>pelabuhan/insertUraian/" method="post" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left">
                            <h3>Data Uraian pelabuhan</h3>
                            <br>
                            <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Pilih File <span class="required">*</span>
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="file" name="file" id="excelUpload" required="required" class="form-control col-md-7 col-xs-12">
                              </div>
                            </div>
                              <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                  <input type="submit" class="btn btn-primary" value="Upload"/>
                                </div>
                              </div>
                          </form>
                        </div>
                        <div role="tabpanel" class="tab-pane fade in active" id="tab-datapelabuhan" aria-labelledby="home-tab">
                          <form action="<?php echo base_url();?>pelabuhan/insertDataPelabuhan/" method="post" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left">
                            <h3>Import Data Pelabuhan Provinsi Bali 
                              <a href="<?php echo base_url(); ?>pelabuhan/downloadFormatImport" class="pull-right" style="padding:0px;">
                                <button type="button" class="btn btn-info btn-xs"><i class="fa fa-download"></i> Format File Import</button>
                              </a>
                            </h3>
                            <br>
                            <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Pelabuhan <span class="required">*</span>
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control" name="id_pelabuhan" required="required">
                                  <option value="" selected disabled>Pilih Pelabuhan</option>
                                  <?php
                                    foreach ($list_pelabuhan as $pelabuhan) 
                                    {
                                      echo '<option value="'.$pelabuhan['ID_PELABUHAN'].'">'.$pelabuhan['PELABUHAN'].'</option>';
                                    }
                                  ?>
                                </select>
                              </div>
                            </div>

                            <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Person In Charge <span class="required">*</span>
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control" name="id_kontak" required="required">
                                  <option value="" selected disabled>Pilih PIC</option>
                                  <?php
                                    foreach ($list_pic as $pic) 
                                    {
                                      echo '<option value="'.$pic['ID_KONTAK'].'">'.$pic['PIC'].' - '.$pic['NAMA_INSTANSI'].'</option>';
                                    }
                                  ?>
                                </select>
                              </div>
                            </div>
                            
                            <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Bulan <span class="required">*</span>
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control" name="bulan" required="required">
                                  <option value="" selected disabled>Pilih Bulan</option>
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
                              </div>
                            </div>
                            
                            <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tahun <span class="required">*</span>
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control" name="tahun" required="required">
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
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Pilih File <span class="required">*</span>
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="file" name="file" id="excelUpload" required="required" class="form-control col-md-7 col-xs-12">
                              </div>
                            </div>
                            <div class="form-group">
                              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <input type="submit" class="btn btn-primary" value="Upload"/>
                              </div>
                            </div>
                          </form>
                          <br>
                          <br>
                          <div class="ln_solid"></div>
                          <div>
                            <h3>Data Pelabuhan yang Telah di Import</h3>
                            <table id="datatable" class="table table-striped table-bordered" style="width:100%;">
                            <thead>
                              <tr>
                                <th style="vertical-align: middle;text-align: center;">No</th>
                                <th style="vertical-align: middle;text-align: center;">Nama Pelabuhan</th>
                                <th style="vertical-align: middle;text-align: center;">Periode</th>
                                <th style="vertical-align: middle;text-align: center;">Tahun</th>
                                <th style="vertical-align: middle;text-align: center;">Nama Instansi</th>
                                <th style="vertical-align: middle;text-align: center;">P.I.C.</th>
                              </tr>
                            </thead>
                            <tbody id="tabelProvinsi">                        
                              <?php 
                                $no=1;
                                foreach ($list_data_pelabuhan as $p) { ?>
                                <tr>
                                  <td><?php echo $no?></td>
                                  <td ><?php echo $p['PELABUHAN'] ?></td>
                                  <td ><?php echo $p['PERIODE'] ?></td>
                                  <td ><?php echo $p['TAHUN'] ?></td>
                                  <td ><?php echo $p['NAMA_INSTANSI'] ?></td>
                                  <td ><?php echo $p['PIC'] ?></td>
                                </tr>
                                <?php $no++;
                                } ?>
                            </tbody>
                          </table>
                          </div>
                        </div>

                      </div>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
        <!-- /INSERT KE DATA APBD -->
      
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
          else if ($this->session->flashdata('notif')==3)
          { ?>
            $('#duplikat-tambah').show();
            <?php
          }
          else if ($this->session->flashdata('notif')==4)
          { ?>
            $('#gagal-apbdp').show();
            <?php
          }

          ?>

        });
        </script>