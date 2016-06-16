 <!-- page content -->
        <div class="right_col" role="main" style="margin-left: 0px;">
          <div class="">
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12 center" style="margin-right:auto; margin-left:auto;float:none;">
                <div class="x_panel" style="min-height:538px;">
                  <div class="x_title">
                    <h2>Cari Data Kabupaten/Kota</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li>
                        <a href="<?php echo base_url();?>C_filter" class=""><i class="fa fa-arrow-left"></i> Kembali</a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <form action="<?php echo base_url();?>C_filter/filterKab/" method="post" enctype="multipart/form-data" class="form-inline">
                    <form class="form-inline">
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
                        <select name="tahun" class="form-control" tabindex="-1" style="margin-left:10px;">
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
                          </select>
                          <!-- <select name="periode" class="form-control" tabindex="-1" style="margin-left:10px;">
                            <option value="" selected disabled>Pilih Periode</option>
                            <option value="Triwulan_1">Triwulan 1</option>
                            <option value="Triwulan_2">Triwulan 2</option>
                            <option value="Triwulan_3">Triwulan 3</option>
                            <option value="Triwulan_4">Triwulan 4</option>                  
                          </select>-->
                          <input type="submit" class="btn btn-primary" style="margin:0 0 0 10px;" value="Cari"/>
                      </div>
                    </form>
                    
                    <div class="ln_solid"></div>
                    <!-- <p class="text-muted font-13 m-b-30">
                      DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function: <code>$().DataTable();</code>
                    </p> -->
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th rowspan="2" style="vertical-align: middle;text-align: center;">Uraian</th>
                          <!-- <th><?php echo $kabkota ?></th> -->
                          <th rowspan="2" style="vertical-align: middle;text-align: center;">APBD</th>
                          <th rowspan="2" style="vertical-align: middle;text-align: center;">APBD P</th>
                          <th colspan="2" scope="colgroup" style="text-align: center;">Triwulan 1</th>
                          <th colspan="2" scope="colgroup" style="text-align: center;">Triwulan 2</th>
                          <th colspan="2" scope="colgroup" style="text-align: center;">Triwulan 3</th>
                          <th colspan="2" scope="colgroup" style="text-align: center;">Triwulan 4</th>
                          <!-- <th>Periode</th>-->
                        </tr>
                        <tr>
                          <th scope="col">Nilai</th>
                          <th scope="col">Persentase</th>
                          <th scope="col">Nilai</th>
                          <th scope="col">Persentase</th>
                          <th scope="col">Nilai</th>
                          <th scope="col">Persentase</th>
                          <th scope="col">Nilai</th>
                          <th scope="col">Persentase</th>
                        </tr>
                      </thead>
                      <tbody id="tabelApbd">
                        <?php 
                        $j=sizeof($data_apbd);
                        //print_r($j);
                        for ($i=0; $i < 41; $i++) { 
                          //print_r($data_apbd[0]);
                        
                          //foreach ($data_apbd[] as $r) { 
                          ?>
                          <tr>
                            <?php 
                            if($j==41){ ?>

                              <td ><?php echo $data_apbd[$i]['URAIAN'] ?></td>
                              <td ><?php echo $data_apbd[$i]['APBD'] ?></td>
                              <td ><?php echo $data_apbd[$i]['APBD_P'] ?></td>
                              <td ><?php echo $data_apbd[$i]['NILAI']?></td>
                              <td ><?php echo $data_apbd[$i]['PERSENTASE'] ?>%</td>
                            <?php }
                            
                            elseif($j==82){ ?>
                              <td ><?php echo $data_apbd[$i*2]['URAIAN'] ?></td>
                              <td ><?php echo $data_apbd[$i*2]['APBD'] ?></td>
                              <td ><?php echo $data_apbd[$i*2]['APBD_P'] ?></td>
                              <td ><?php echo $data_apbd[$i*2]['NILAI']?></td>
                              <td ><?php echo $data_apbd[$i*2]['PERSENTASE'] ?>%</td>
                              <td ><?php echo $data_apbd[($i*2)+1]['NILAI']?></td>
                              <td ><?php echo $data_apbd[($i*2)+1]['PERSENTASE'] ?>%</td>

                            <?php }
                            elseif($j==123){ ?>
                              <td ><?php echo $data_apbd[$i*3]['URAIAN'] ?></td>
                              <td ><?php echo $data_apbd[$i*3]['APBD'] ?></td>
                              <td ><?php echo $data_apbd[$i*3]['APBD_P'] ?></td>
                              <td ><?php echo $data_apbd[$i*3]['NILAI']?></td>
                              <td ><?php echo $data_apbd[$i*3]['PERSENTASE'] ?>%</td>
                              <td ><?php echo $data_apbd[($i*3)+1]['NILAI']?></td>
                              <td ><?php echo $data_apbd[($i*3)+1]['PERSENTASE'] ?>%</td>
                              <td ><?php echo $data_apbd[($i*3)+2]['NILAI']?></td>
                              <td ><?php echo $data_apbd[($i*3)+2]['PERSENTASE'] ?>%</td>

                            <?php }
                            elseif($j==164){ ?>
                              <td ><?php echo $data_apbd[$i*4]['URAIAN'] ?></td>
                              <td ><?php echo $data_apbd[$i*4]['APBD'] ?></td>
                              <td ><?php echo $data_apbd[$i*4]['APBD_P'] ?></td>
                              <td ><?php echo $data_apbd[$i*4]['NILAI']?></td>
                              <td ><?php echo $data_apbd[$i*4]['PERSENTASE'] ?>%</td>
                              <td ><?php echo $data_apbd[($i*4)+1]['NILAI']?></td>
                              <td ><?php echo $data_apbd[($i*4)+1]['PERSENTASE'] ?>%</td>
                              <td ><?php echo $data_apbd[($i*4)+2]['NILAI']?></td>
                              <td ><?php echo $data_apbd[($i*4)+2]['PERSENTASE'] ?>%</td>
                              <td ><?php echo $data_apbd[($i*4)+3]['NILAI']?></td>
                              <td ><?php echo $data_apbd[($i*4)+3]['PERSENTASE'] ?>%</td>

                            <?php }


                            ?>
                            
                           <!--  ?>
                            <td ><?php echo $data_apbd[($i*4)-3]['NILAI']?></td>
                            <td ><?php echo $data_apbd[($i*4)-3]['PERSENTASE'] ?>%</td>
                            <td ><?php echo $data_apbd[($i*4)-2]['NILAI']?></td>
                            <td ><?php echo $data_apbd[($i*4)-2]['PERSENTASE'] ?>%</td>
                            <td ><?php echo $data_apbd[($i*4)-1]['NILAI']?></td>
                            <td ><?php echo $data_apbd[($i*4)-1]['PERSENTASE'] ?>%</td>
 -->
                          </tr>
                          <!-- <tr>
                            <td ><?php //echo $r['URAIAN'] ?></td>
                            <td ><?php //echo $r['APBD'] ?></td>
                            <td ><?php //echo $r['APBD_P'] ?></td>
                            <td ><?php //echo $r['NILAI']?></td>
                            <td ><?php //echo $r['PERSENTASE'] ?>%</td>
                            <td ><?php //echo $r['NILAI'] ?></td>
                            <td ><?php //echo $r['PERSENTASE'] ?>%</td>
                            <td ><?php //echo $r['NILAI'] ?></td>
                            <td ><?php //echo $r['PERSENTASE'] ?>%</td>
                          </tr> -->
                        <?php 
                      }?>
                      </tbody>
                    </table>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
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
