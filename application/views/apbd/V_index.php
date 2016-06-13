        <!-- page content
        <div class="right_col" role="main" style="margin-left: 0px;">
          <div class="">
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel" style="height:600px;">
                  <div class="x_title">
                    <h2>Import File Excel</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br>
                    <form action="<?php echo base_url();?>C_apbd/importExcel/" method="post" enctype="multipart/form-data" class="form-horizontal form-label-left">
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
                </div>

              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

        <!-- INSERT KE APBD 
        <div class="right_col" role="main" style="margin-left: 0px;">
          <div class="">
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel" style="height:600px;">
                  <div class="x_title">
                    <h2>Import File Excel</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br>
                    <form action="<?php echo base_url();?>C_apbd/insertIntoAPBD/" method="post" enctype="multipart/form-data" class="form-horizontal form-label-left">
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
                </div>

              </div>
            </div>
          </div>
        </div>
        <!-- /INSERT KE APBD -->

        <!-- INSERT KE DATA APBD -->
        <div class="right_col" role="main" style="margin-left: 0px;">
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
                    
                    <br>
                    <form action="<?php echo base_url();?>C_apbd/insertDataAPBDbyProvinsi/" method="post" enctype="multipart/form-data" class="form-horizontal form-label-left">
                      <div class="form-group">
                        <h3>Data APBD Provinsi</h3>
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Person In Charge <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control" name="id_kontak">
                            <option value="" selected disabled>Pilih PIC</option>
                            <?php
                              foreach ($list_pic as $pic) 
                              {
                                echo '<option value="'.$pic['ID_KONTAK'].'">'.$pic['PIC'].'</option>';
                              }
                            ?>
                          </select>
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Pilih Bulan <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control" name="bulan">
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
                          <select class="form-control" name="tahun">
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

                    <form action="<?php echo base_url();?>C_apbd/insertDataAPBDbyKabKota/" method="post" enctype="multipart/form-data" class="form-horizontal form-label-left">
                      <div class="form-group">
                        <h3>Data APBD Kab./Kota</h3>
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Person In Charge <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control" name="id_kontak">
                            <option value="" selected disabled>Pilih PIC</option>
                            <?php
                              foreach ($list_pic as $pic) 
                              {
                                echo '<option value="'.$pic['ID_KONTAK'].'">'.$pic['PIC'].'</option>';
                              }
                            ?>
                          </select>
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Pilih Triwulan <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control" name="triwulan">
                            <option value="" selected disabled>Pilih Triwulan</option>
                            <option value="Triwulan_1">Triwulan 1</option>
                            <option value="Triwulan_2">Triwulan 2</option>
                            <option value="Triwulan_3">Triwulan 3</option>
                            <option value="Triwulan_4">Triwulan 4</option>
                            
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tahun <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control" name="tahun">
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

                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
        <!-- /INSERT KE DATA APBD -->