        <!-- page content -->
        <div class="right_col" role="main" style="margin-left: 0px;">
          <div class="">
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel" style="min-height:538px;">
                  <div class="x_title">
                    <h2>Rekap Penerbangan Pertahun</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div>
                      <form id="demo-form" action="<?php echo base_url();?>penerbangan/viewRekapPenerbangan" method="post" enctype="multipart/form-data" class="form-horizontal form-label-left">
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ex3">Rute :</label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <select name="rute" class="form-control" required="required">
                              <option value="" selected disabled>Pilih Rute</option>
                              <option value="Domestik">Domestik</option>
                              <option value="Internasional">Internasional</option>
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ex3">Kategori :</label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <select name="kategori" class="form-control" required="required">
                              <option value="" selected disabled>Pilih Kategori</option>
                              <option value="Pesawat">Pesawat</option>
                              <option value="Penumpang">Penumpang</option>
                              <option value="Bagasi">Bagasi</option>
                              <option value="Cargo">Cargo</option>
                              <option value="Pos">Pos</option>
                            </select>
                          </div>
                        </div>
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
                        <li role="presentation" class=""><a href="#tab-data" role="tab" id="data-tab" data-toggle="tab" aria-expanded="true">Data</a>
                        </li>
                      </ul>

                      <div id="myTabContent" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade in" id="tab-data" aria-labelledby="profile-tab">
                          <?php if($tahun){?>
                          <h3 align="center">Rekapitulasi Penerbangan <?php 
                            if ($rute) echo $rute." ";
                            if ($kategori) echo $kategori;
                            else echo "_"; ?> Tahun <?php echo $tahun;?></h3>
                          <?php }?>
                          <table class="table table-striped table-bordered datatable-buttons" style="width:100%;">
                            <thead>
                              <tr>
                                <th rowspan="2" style="vertical-align: middle;text-align: center;">No</th>
                                <th rowspan="2" style="vertical-align: middle;text-align: center;">Aktivitas</th>
                                <th colspan="12" scope="colgroup" style="text-align: center;">Tahun <?php echo $tahun; ?></th>
                              </tr>
                              <tr>
                                <th scope="col" style="text-align: center;">1</th>
                                <th scope="col" style="text-align: center;">2</th>
                                <th scope="col" style="text-align: center;">3</th>
                                <th scope="col" style="text-align: center;">4</th>
                                <th scope="col" style="text-align: center;">5</th>
                                <th scope="col" style="text-align: center;">6</th>
                                <th scope="col" style="text-align: center;">7</th>
                                <th scope="col" style="text-align: center;">8</th>
                                <th scope="col" style="text-align: center;">9</th>
                                <th scope="col" style="text-align: center;">10</th>
                                <th scope="col" style="text-align: center;">11</th>
                                <th scope="col" style="text-align: center;">12</th>
                              </tr>
                            </thead>
                            <tbody id="tabelApbd">
                              <?php 
                                $no = 1;
                                if(sizeof($nilai_tabel)==3){
                                for ($r=0; $r<3; $r++) { ?>
                                  <tr>
                                    <td><?php echo $no; ?></td>
                                    <td ><?php echo $nilai_tabel[$r][12]; ?></td>
                                    <td ><?php echo $nilai_tabel[$r][0]; ?></td>
                                    <td ><?php echo $nilai_tabel[$r][1];?></td>
                                    <td ><?php echo $nilai_tabel[$r][2];?></td>
                                    <td ><?php echo $nilai_tabel[$r][3];?></td>
                                    <td ><?php echo $nilai_tabel[$r][4];?></td>
                                    <td ><?php echo $nilai_tabel[$r][5];?></td>
                                    <td ><?php echo $nilai_tabel[$r][6];?></td>
                                    <td ><?php echo $nilai_tabel[$r][7];?></td>
                                    <td ><?php echo $nilai_tabel[$r][8];?></td>
                                    <td ><?php echo $nilai_tabel[$r][9];?></td>
                                    <td ><?php echo $nilai_tabel[$r][10];?></td>
                                    <td ><?php echo $nilai_tabel[$r][11];?></td>
                                  </tr>
                              <?php $no++; }} ?>
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
            text: <?php echo '"GRAFIK REKAPITULASI PENERBANGAN '.$rute.' '.$kategori.' TAHUN '.$tahun.'",'; ?>
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
            data: ['JAN', 'FEB', 'MAR', 'APR', 'MEI', 'JUN', 'JUL', 'AGU', 'SEP', 'OKT', 'NOV', 'DES']
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