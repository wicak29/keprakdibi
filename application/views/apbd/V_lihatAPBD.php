        <!-- page content -->
        <div class="right_col" role="main" style="margin-left: 0px;">
          <div class="">
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel" style="min-height:538px;">
                  <div class="x_title">
                    <h2>Rekap APBD Pertahun</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <form class="form-inline">
                      <div class="form-group">
                        <label for="ex3">Pilih Tahun : </label>
                        <select name="detailApbd" onchange="showApbd(this.value)" class="form-control" tabindex="-1" style="margin-left:10px;">
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
                            <option value="2018">2018</option>
                            <option value="2019">2019</option>
                            <option value="2020">2020</option>
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
                          </select>
                      </div>
                    </form>
                    <div class="ln_solid"></div>
                    <!-- <p class="text-muted font-13 m-b-30">
                      DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function: <code>$().DataTable();</code>
                    </p> -->
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Uraian</th>
                          <th>Prov. Bali</th>
                          <th>Kab. Badung</th>
                          <th>Kab. Bangli</th>
                          <th>Kab. Buleleng</th>
                          <th>Kab. Gianyar</th>
                          <th>Kab. Jembrana</th>
                          <th>Kab. Karangasem</th>
                          <th>Kab. Klungkung</th>
                          <th>Kab. Tabanan</th>
                          <th>Kota Denpasar</th>
                        </tr>
                      </thead>
                      <tbody id="tabelApbd">

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
        function showApbd(tahun) 
        {
          var request = $.ajax(
          {
            url: "<?php echo base_url('C_apbd/getNilaiByTahun'); ?>/"+tahun,
            method: "GET"
          });
           
          request.done(function( list_data ) 
          {
            var arrLength=list_data.length;
            $("#tabelApbd").html("");
            for(i=0;i<41;i++)
            {
                $( "#tabelApbd" ).append( 
                    "<tr>"+
                    "<td>"+list_data[i][10]+"</td>"+
                    "<td>"+list_data[i][9]+"</td>"+
                    "<td>"+list_data[i][0]+"</td>"+
                    "<td>"+list_data[i][1]+"</td>"+
                    "<td>"+list_data[i][2]+"</td>"+
                    "<td>"+list_data[i][3]+"</td>"+
                    "<td>"+list_data[i][4]+"</td>"+
                    "<td>"+list_data[i][5]+"</td>"+
                    "<td>"+list_data[i][6]+"</td>"+
                    "<td>"+list_data[i][7]+"</td>"+
                    "<td>"+list_data[i][8]+"</td>"+
                    "</tr>" );              
            }
          });
           
          request.fail(function( jqXHR, textStatus ) 
          {
            alert( "Request failed: " + textStatus );
          });
          }
        </script>