 <!-- page content -->
        <div class="right_col" role="main" style="margin-left: 0px;">
          <div class="">
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-8 col-sm-8 col-xs-12 center" style="margin-right:auto; margin-left:auto;float:none;">
                <div class="x_panel" style="min-height:538px;">
                  <div class="x_title">
                    <h2>Lihat Tabel</h2>
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
                          <select name="periode" class="form-control" tabindex="-1" style="margin-left:10px;">
                            <option value="" selected disabled>Pilih Periode</option>
                            <option value="Triwulan_1">Triwulan 1</option>
                            <option value="Triwulan_2">Triwulan 2</option>
                            <option value="Triwulan_3">Triwulan 3</option>
                            <option value="Triwulan_4">Triwulan 4</option>
                          </select>
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
                          <th>Uraian</th>
                          <th><?php echo $kabkota ?></th>
                          <!-- <th>Periode</th>
                          <th>Tahun</th> -->
                        </tr>
                      </thead>
                      <tbody id="tabelApbd">
                        <?php foreach ($data_apbd as $r) { ?>
                          <tr>
                            <td ><?php echo $r['URAIAN'] ?></td>
                            <td ><?php echo $r['NILAI'] ?></td>
                          </tr>
                        <?php } ?>
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