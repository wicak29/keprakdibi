<!-- INSERT KE DATA APBD -->
<div class="right_col" role="main" style="margin-left: 0px;">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel" style="min-height:538px;">
          <div class="x_title">
            <h2>Statistik</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div style="margin-bottom:50px;">
              <form action="<?php echo base_url();?>C_filter/filterKab/" method="post" enctype="multipart/form-data" class="form-inline">
                <div class="form-group">
                  <label for="ex3">Pilih Tahun : </label>
                  <select name="kabkota" class="form-control" tabindex="-1" style="margin-left:10px;">
                    <option value="" selected disabled>Pilih Kabupaten/Kota</option>
                    <option value="2">Badung</option>
                    <option value="3">Bangli</option>                          
                    <option value="4">Buleleng</option>
                    <option value="5">Gianyar</option>
                    <option value="6">Jembrana</option>
                    <option value="7">Karangasem</option>
                    <option value="8">Klungkung </option>
                    <option value="9">Tabanan</option>
                    <option value="10">Kota Denpasar</option>
                  </select>
                  <select name="periode" class="form-control" tabindex="-1" style="margin-left:10px;">
                    <option value="" selected disabled>Pilih Periode</option>
                    <option value="Triwulan_1">Triwulan 1</option>
                    <option value="Triwulan_2">Triwulan 2</option>
                    <option value="Triwulan_3">Triwulan 3</option>
                    <option value="Triwulan_4">Triwulan 4</option>
                  </select>
                </div>
                <input type="submit" class="btn btn-primary" style="margin:0 0 0 10px;" value="Cari"/>
              </form>
            </div>
            <div id="echart_line" style="height:350px;"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /INSERT KE DATA APBD -->