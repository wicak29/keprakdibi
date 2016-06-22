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
                    <div>
                      <form id="demo-form" action="<?php echo base_url();?>C_apbd/viewRekapAPBD" method="post" enctype="multipart/form-data" class="form-horizontal form-label-left">
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ex3">Tahun :</label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <select name="tahun" class="form-control" required="required">
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
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Uraian :</label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <p style="padding: 5px;">
                                <input type="checkbox" name="uraian[]" value="1" class="uraian-checkbox"/> PENDAPATAN DAERAH
                                <br />
                                <input type="checkbox" name="uraian[]" value="2" class="uraian-checkbox"/> PAD
                                <br />
                                <input type="checkbox" name="uraian[]" value="3" class="uraian-checkbox"/> Pend. Pajak Daerah
                                <br />
                                <input type="checkbox" name="uraian[]" value="4" class="uraian-checkbox"/> Retribusi Daerah
                                <br />
                                <input type="checkbox" name="uraian[]" value="5" class="uraian-checkbox"/> Hsl. PMD &amp; Hsl. Pengel
                                <br />
                                <input type="checkbox" name="uraian[]" value="6" class="uraian-checkbox"/> Lain-lain PAD Sah
                                <br />
                                <input type="checkbox" name="uraian[]" value="7" class="uraian-checkbox"/> Dana Perimbangan
                                <br />
                                <input type="checkbox" name="uraian[]" value="8" class="uraian-checkbox"/> Bagi Hasil Pajak &amp; Bukan Pajak
                                <br />
                                <input type="checkbox" name="uraian[]" value="9" class="uraian-checkbox"/> DAU
                                <br />
                                <input type="checkbox" name="uraian[]" value="10" class="uraian-checkbox"/> DAK
                                <br />
                                <input type="checkbox" name="uraian[]" value="11" class="uraian-checkbox"/> Penguatan Infrastuktur Daerah
                                <br />
                                <input type="checkbox" name="uraian[]" value="12" class="uraian-checkbox"/> Lain-lain Pendapatan Sah
                                <br />
                                <input type="checkbox" name="uraian[]" value="13" class="uraian-checkbox"/> Pendapatan Hibah
                                <br />
                                <input type="checkbox" name="uraian[]" value="14" class="uraian-checkbox"/> Bagi Hsl. Pajak Prov &amp; Pemda
                                <br />
                                <input type="checkbox" name="uraian[]" value="15" class="uraian-checkbox"/> Penyesuaian &amp; Otonomi Khusus
                                <br />
                                <input type="checkbox" name="uraian[]" value="16" class="uraian-checkbox"/> Bantuan Keuangan Prov &amp; Pemda
                                <br />
                                <input type="checkbox" name="uraian[]" value="17" class="uraian-checkbox"/> Sumbangan Pihak Ketiga
                                <br />
                                <input type="checkbox" name="uraian[]" value="18" class="uraian-checkbox"/> Alokasi Krg. Byr. DAK
                                <br />
                              </p>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <p style="padding: 5px;">
                                <input type="checkbox" name="uraian[]" value="19" class="uraian-checkbox"/> BELANJA DAERAH
                                <br />
                                <input type="checkbox" name="uraian[]" value="20" class="uraian-checkbox"/> Belanja Tidak Langsung
                                <br />
                                <input type="checkbox" name="uraian[]" value="21" class="uraian-checkbox"/> Belanja Pegawai
                                <br />
                                <input type="checkbox" name="uraian[]" value="22" class="uraian-checkbox"/> Belanja Barang
                                <br />
                                <input type="checkbox" name="uraian[]" value="23" class="uraian-checkbox"/> Belanja Subsidi
                                <br />
                                <input type="checkbox" name="uraian[]" value="24" class="uraian-checkbox"/> Belanja Hibah
                                <br />
                                <input type="checkbox" name="uraian[]" value="25" class="uraian-checkbox"/> Belanja Bantuan Sosial
                                <br />
                                <input type="checkbox" name="uraian[]" value="26" class="uraian-checkbox"/> Blj. Bagi Hsl Pr/Kt/Kab/Pemda
                                <br />
                                <input type="checkbox" name="uraian[]" value="27" class="uraian-checkbox"/> Belanja Bantuan Keuangan
                                <br />
                                <input type="checkbox" name="uraian[]" value="28" class="uraian-checkbox"/> Belanja Tidak Terduga
                                <br />
                                <input type="checkbox" name="uraian[]" value="29" class="uraian-checkbox"/> Belanja Langsung
                                <br />
                                <input type="checkbox" name="uraian[]" value="30" class="uraian-checkbox"/> Belanja Pegawai
                                <br />
                                <input type="checkbox" name="uraian[]" value="31" class="uraian-checkbox"/> Belanja Barang dan Jasa
                                <br />
                                <input type="checkbox" name="uraian[]" value="32" class="uraian-checkbox"/> Belanja Modal
                                <br />
                              </p>
                              <p style="padding: 5px;">
                                <input type="checkbox" name="uraian[]" value="33" class="uraian-checkbox"/> SURPLUS/(DEFISIT)
                                <br />
                                <input type="checkbox" name="uraian[]" value="34" class="uraian-checkbox"/> PEMBIAYAAN
                                <br />
                                <input type="checkbox" name="uraian[]" value="35" class="uraian-checkbox"/> Penerimaan Daerah
                                <br />
                                <input type="checkbox" name="uraian[]" value="36" class="uraian-checkbox"/> Penggunaan SILPA
                                <br />
                                <input type="checkbox" name="uraian[]" value="37" class="uraian-checkbox"/> Pengeluaran Daerah
                                <br />
                                <input type="checkbox" name="uraian[]" value="38" class="uraian-checkbox"/> Penyertaan Modal Pemda
                                <br />
                                <input type="checkbox" name="uraian[]" value="39" class="uraian-checkbox"/> Penguatan Modal Pemda
                                <br />
                                <input type="checkbox" name="uraian[]" value="40" class="uraian-checkbox"/> Pembiayaan Netto
                                <br />
                                <input type="checkbox" name="uraian[]" value="41" class="uraian-checkbox"/> SILPA
                                <br />
                              </p>
                            </div>
                          </select>
                          </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <input id="checkBtn" type="submit" class="btn btn-primary" value="Lihat Rekapitulasi"/>
                          </div>
                        </div>
                      </form>
                    </div>
                   
                    <div class="ln_solid"></div>
                    <div class="" role="tabpanel" data-example-id="togglable-tabs">
                      <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#tab-grafik" role="tab" id="grafik-tab" data-toggle="tab" aria-expanded="false">Grafik</a>
                        </li>
                        <li role="presentation" class=""><a href="#tab-realisasi" role="tab" id="realisasi-tab" data-toggle="tab" aria-expanded="true">Realisasi</a>
                        </li>
                        <li role="presentation" class=""><a href="#tab-persentase" id="persentase-tab" role="tab" data-toggle="tab" aria-expanded="false">Persentase</a>
                        </li>
                      </ul>

                      <div id="myTabContent" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade in" id="tab-realisasi" aria-labelledby="profile-tab">
                          <h3 align="center">Rekapitulasi APBD Tahun <?php echo $tahun;?></h3>
                          <table class="table table-striped table-bordered datatable-buttons">
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
                              <?php 
                                for ($r=0; $r<41; $r++) { ?>
                                  <tr>
                                    <td ><?php echo $nilai_tabel[$r][10] ?></td>
                                    <td ><?php echo $nilai_tabel[$r][9]['NILAI_REALISASI'] ?></td>
                                    <td ><?php echo $nilai_tabel[$r][0]['NILAI_REALISASI'] ?></td>
                                    <td ><?php echo $nilai_tabel[$r][1]['NILAI_REALISASI'] ?></td>
                                    <td ><?php echo $nilai_tabel[$r][2]['NILAI_REALISASI'] ?></td>
                                    <td ><?php echo $nilai_tabel[$r][3]['NILAI_REALISASI'] ?></td>
                                    <td ><?php echo $nilai_tabel[$r][4]['NILAI_REALISASI'] ?></td>
                                    <td ><?php echo $nilai_tabel[$r][5]['NILAI_REALISASI'] ?></td>
                                    <td ><?php echo $nilai_tabel[$r][6]['NILAI_REALISASI'] ?></td>
                                    <td ><?php echo $nilai_tabel[$r][7]['NILAI_REALISASI'] ?></td>
                                    <td ><?php echo $nilai_tabel[$r][8]['NILAI_REALISASI'] ?></td>
                                  </tr>
                              <?php } ?>
                            </tbody>
                          </table>      
                        </div>

                        <div role="tabpanel" class="tab-pane fade in" id="tab-persentase" aria-labelledby="profile-tab">
                          <h3 align="center">Rekapitulasi APBD Tahun <?php echo $tahun;?></h3>
                          <table class="table table-striped table-bordered datatable-buttons">
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
                            <tbody id="tabelApbdPersen">
                              <?php 
                                for ($r=0; $r<41; $r++) { ?>
                                  <tr>
                                    <td ><?php echo $nilai_tabel[$r][10] ?></td>
                                    <td ><?php echo $nilai_tabel[$r][9]['PERSEN_REALISASI'] ?>%</td>
                                    <td ><?php echo $nilai_tabel[$r][0]['PERSEN_REALISASI'] ?>%</td>
                                    <td ><?php echo $nilai_tabel[$r][1]['PERSEN_REALISASI'] ?>%</td>
                                    <td ><?php echo $nilai_tabel[$r][2]['PERSEN_REALISASI'] ?>%</td>
                                    <td ><?php echo $nilai_tabel[$r][3]['PERSEN_REALISASI'] ?>%</td>
                                    <td ><?php echo $nilai_tabel[$r][4]['PERSEN_REALISASI'] ?>%</td>
                                    <td ><?php echo $nilai_tabel[$r][5]['PERSEN_REALISASI'] ?>%</td>
                                    <td ><?php echo $nilai_tabel[$r][6]['PERSEN_REALISASI'] ?>%</td>
                                    <td ><?php echo $nilai_tabel[$r][7]['PERSEN_REALISASI'] ?>%</td>
                                    <td ><?php echo $nilai_tabel[$r][8]['PERSEN_REALISASI'] ?>%</td>
                                  </tr>
                              <?php } ?>
                            </tbody>
                          </table>      
                        </div>

                        <div role="tabpanel" class="tab-pane fade active in" id="tab-grafik" aria-labelledby="profile-tab" >
                          <div id="echart_line" style="height:550px;" ></div>
                        </div>
                        <!-- END TAB PANEL -->
                      </div>
                      <!-- END TAB CONTENT -->
                    </div>
                  </div>
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
                alert("Anda belum memilih uraian!");
                return false;
              }

            });
        });

      </script>

        <script>
        var theme = {
            color: [
                '#26B99A', '#34495E', '#BDC3C7', '#3498DB',
                '#9B59B6', '#8abb6f', '#759c6a', '#bfd3b7'
            ],

            title: {
                itemGap: 8,
                textStyle: {
                    fontWeight: 'normal',
                    color: '#408829'
                }
            },

            dataRange: {
                color: ['#1f610a', '#97b58d']
            },

            toolbox: {
                color: ['#408829', '#408829', '#408829', '#408829']
            },

            tooltip: {
                backgroundColor: 'rgba(0,0,0,0.5)',
                axisPointer: {
                    type: 'line',
                    lineStyle: {
                        color: '#408829',
                        type: 'dashed'
                    },
                    crossStyle: {
                        color: '#408829'
                    },
                    shadowStyle: {
                        color: 'rgba(200,200,200,0.3)'
                    }
                }
            },

            dataZoom: {
                dataBackgroundColor: '#eee',
                fillerColor: 'rgba(64,136,41,0.2)',
                handleColor: '#408829'
            },
            grid: {
                borderWidth: 0
            },

            categoryAxis: {
                axisLine: {
                    lineStyle: {
                        color: '#408829'
                    }
                },
                splitLine: {
                    lineStyle: {
                        color: ['#eee']
                    }
                }
            },

            valueAxis: {
                axisLine: {
                    lineStyle: {
                        color: '#408829'
                    }
                },
                splitArea: {
                    show: true,
                    areaStyle: {
                        color: ['rgba(250,250,250,0.1)', 'rgba(200,200,200,0.1)']
                    }
                },
                splitLine: {
                    lineStyle: {
                        color: ['#eee']
                    }
                }
            },
            timeline: {
                lineStyle: {
                    color: '#408829'
                },
                controlStyle: {
                    normal: {color: '#408829'},
                    emphasis: {color: '#408829'}
                }
            },

            k: {
                itemStyle: {
                    normal: {
                        color: '#68a54a',
                        color0: '#a9cba2',
                        lineStyle: {
                            width: 1,
                            color: '#408829',
                            color0: '#86b379'
                        }
                    }
                }
            },
            map: {
                itemStyle: {
                    normal: {
                        areaStyle: {
                            color: '#ddd'
                        },
                        label: {
                            textStyle: {
                                color: '#c12e34'
                            }
                        }
                    },
                    emphasis: {
                        areaStyle: {
                            color: '#99d2dd'
                        },
                        label: {
                            textStyle: {
                                color: '#c12e34'
                            }
                        }
                    }
                }
            },
            force: {
                itemStyle: {
                    normal: {
                        linkStyle: {
                            strokeColor: '#408829'
                        }
                    }
                }
            },
            chord: {
                padding: 4,
                itemStyle: {
                    normal: {
                        lineStyle: {
                            width: 1,
                            color: 'rgba(128, 128, 128, 0.5)'
                        },
                        chordStyle: {
                            lineStyle: {
                                width: 1,
                                color: 'rgba(128, 128, 128, 0.5)'
                            }
                        }
                    },
                    emphasis: {
                        lineStyle: {
                            width: 1,
                            color: 'rgba(128, 128, 128, 0.5)'
                        },
                        chordStyle: {
                            lineStyle: {
                                width: 1,
                                color: 'rgba(128, 128, 128, 0.5)'
                            }
                        }
                    }
                }
            },
            gauge: {
                startAngle: 225,
                endAngle: -45,
                axisLine: {
                    show: true,
                    lineStyle: {
                        color: [[0.2, '#86b379'], [0.8, '#68a54a'], [1, '#408829']],
                        width: 8
                    }
                },
                axisTick: {
                    splitNumber: 10,
                    length: 12,
                    lineStyle: {
                        color: 'auto'
                    }
                },
                axisLabel: {
                    textStyle: {
                        color: 'auto'
                    }
                },
                splitLine: {
                    length: 18,
                    lineStyle: {
                        color: 'auto'
                    }
                },
                pointer: {
                    length: '90%',
                    color: 'auto'
                },
                title: {
                    textStyle: {
                        color: '#333'
                    }
                },
                detail: {
                    textStyle: {
                        color: 'auto'
                    }
                }
            },
            textStyle: {
                fontFamily: 'Arial, Verdana, sans-serif'
            }
        };

        var echartLine = echarts.init(document.getElementById('echart_line'), theme);

        echartLine.setOption({
          title: {
            text: "GRAFIK REKAP PERTAHUN",
            subtext: ''
          },
          tooltip: {
            trigger: 'axis'
          },
          legend: {
            x: 220,
            y: 40,
            data: [
            <?php 
              $count = sizeof($finalResult);
              $pos = 0;
              foreach ($finalResult as $key) 
              {
                if ($count-1 != $pos)
                  echo "'".$key[0]."',";
                else
                  echo "'".$key[0]."'";
                $pos++;
              }
            ?>
            ]
          },
          toolbox: {
            show: true,
            feature: {
              magicType: {
                show: true,
                title: {
                  line: 'Line',
                  bar: 'Bar',
                  stack: 'Stack',
                  tiled: 'Tiled'
                },
                type: ['line', 'bar', 'stack', 'tiled']
              },
              restore: {
                show: true,
                title: "Restore"
              },
              saveAsImage: {
                show: true,
                title: "Save Image"
              }
            }
          },
          calculable: true,
          xAxis: [
          {
            type: 'category',
            boundaryGap: false,
            data: ['BALI', 'BDG', 'BGL', 'BLL', 'GYR', 'JBR', 'KRS', 'KLU', 'TBN', 'DPS']
          }],
          yAxis: [
          {
            type: 'value'
          }],
          series: [
          <?php
            $count = sizeof($finalResult);
            $pos = 0;
            foreach ($finalResult as $key) 
            {
              if ($count-1 != $pos)
                echo "{
                    name: '".$key[0]."',
                    type: 'line',
                    smooth: true,
                    itemStyle: {
                      normal: {
                        areaStyle: {
                          type: 'default'
                        }
                      }
                    },
                    data: [".$key[1]."]
                  },";
              else
                echo "{
                    name: '".$key[0]."',
                    type: 'line',
                    smooth: true,
                    itemStyle: {
                      normal: {
                        areaStyle: {
                          type: 'default'
                        }
                      }
                    },
                    data: [".$key[1]."]
                  }";
              $pos++;
            }
          ?>
          ]
        });        
        </script>
        <!-- DATA TABLES-->
        <script>
      $(document).ready(function() {
        var handleDataTableButtons = function() {
          if ($(".datatable-buttons").length) {
            $(".datatable-buttons").DataTable({
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