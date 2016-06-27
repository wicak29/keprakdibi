<!-- INSERT KE DATA APBD -->
<div class="right_col" role="main" style="margin-left: 0px;">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel" style="min-height:538px;">
          <div class="x_title">
            <h2>Grafik Bulan Tiap Tahun</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div style="margin-bottom:50px;">
              <form id="demo-form" action="<?php echo base_url();?>penerbangan/filter/viewLihatGrafikBulan" method="post" enctype="multipart/form-data" class="form-horizontal form-label-left">
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Rute :</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                  <select name="rute" class="form-control" required="required">
                      <option value="" selected disabled>Pilih Rute</option>
                      <option value="Domestik">Domestik</option>
                      <option value="Internasional">Internasional</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Bulan :</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                  <select name="bulan" class="form-control" required="required">
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
                <!-- <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Bulan :</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                  <select name="kategori" class="form-control" required="required">
                      <option value="" selected disabled>Pilih Kategori</option>
                      <option value="1">Pesawat - Datang</option>
                      <option value="2">Pesawat - Berangkat</option>
                      <option value="3">Pesawat - Transit</option>
                      <option value="4">Penumpang - Datang</option>
                      <option value="5">Penumpang - Berangkat</option>
                      <option value="6">Penumpang - Transit</option>
                      <option value="7">Bagasi - Datang</option>
                      <option value="8">Bagasi - Brangkat</option>
                      <option value="9">Bagasi - Transit</option>
                      <option value="10">Cargo - Datang</option>
                      <option value="11">Cargo - Berangkat</option>
                      <option value="12">Cargo - Transit</option>
                      <option value="13">Pos - Datang</option>
                      <option value="14">Pos - Berangkat</option>
                      <option value="15">Pos - Transit</option>
                    </select>
                  </div>
                </div> -->
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tahun :</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="col-md-3 col-sm-3 col-xs-6">
                      <p style="padding: 5px;">
                        <input type="checkbox" name="tahun[]" value="2007" class="single-checkbox" /> 2007
                        <br />
                        <input type="checkbox" name="tahun[]" value="2008" class="single-checkbox" /> 2008
                        <br />
                        <input type="checkbox" name="tahun[]" value="2009" class="single-checkbox" /> 2009
                        <br />
                        <input type="checkbox" name="tahun[]" value="2010" class="single-checkbox" /> 2010
                        <br />
                        <input type="checkbox" name="tahun[]" value="2011" class="single-checkbox" /> 2011
                        <br />
                        <input type="checkbox" name="tahun[]" value="2012" class="single-checkbox" /> 2012
                        <br />
                      </p>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-6">
                      <p style="padding: 5px;">
                        <input type="checkbox" name="tahun[]" value="2013" class="single-checkbox" /> 2013
                        <br />
                        <input type="checkbox" name="tahun[]" value="2014" class="single-checkbox" /> 2014
                        <br />
                        <input type="checkbox" name="tahun[]" value="2015" class="single-checkbox" /> 2015
                        <br />
                        <input type="checkbox" name="tahun[]" value="2016" class="single-checkbox"/> 2016
                        <br />
                        <input type="checkbox" name="tahun[]" value="2017" class="single-checkbox"/> 2017
                        <br />
                        <input type="checkbox" name="tahun[]" value="2018" class="single-checkbox"/> 2018
                        <br />
                      </p>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-6">
                      <p style="padding: 5px;">
                        <input type="checkbox" name="tahun[]" value="2019" class="single-checkbox" /> 2019
                        <br />
                        <input type="checkbox" name="tahun[]" value="2020" class="single-checkbox"/> 2020
                        <br />
                        <input type="checkbox" name="tahun[]" value="2021" class="single-checkbox"/> 2021
                        <br />
                        <input type="checkbox" name="tahun[]" value="2022" class="single-checkbox"/> 2022
                        <br />
                        <input type="checkbox" name="tahun[]" value="2023" class="single-checkbox"/> 2023
                        <br />
                        <input type="checkbox" name="tahun[]" value="2024" class="single-checkbox"/> 2024
                        <br />
                      </p>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-6">
                      <p style="padding: 5px;">
                        <input type="checkbox" name="tahun[]" value="2025" class="single-checkbox"/> 2025
                        <br />
                        <input type="checkbox" name="tahun[]" value="2026" class="single-checkbox"/> 2026
                        <br />
                        <input type="checkbox" name="tahun[]" value="2027" class="single-checkbox"/> 2027
                        <br />
                        <input type="checkbox" name="tahun[]" value="2028" class="single-checkbox"/> 2028
                        <br />
                        <input type="checkbox" name="tahun[]" value="2029" class="single-checkbox"/> 2029
                        <br />
                        <input type="checkbox" name="tahun[]" value="2030" class="single-checkbox"/> 2030
                        <br />
                      </p>
                    </div>
                  </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kategori :</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <p style="padding: 5px;">
                        <input type="checkbox" name="entitas[]" value="1" class="entitas-checkbox"/> PESAWAT - DATANG
                        <br />
                        <input type="checkbox" name="entitas[]" value="2" class="entitas-checkbox"/> PESAWAT - BERANGKAT
                        <br />
                        <input type="checkbox" name="entitas[]" value="3" class="entitas-checkbox"/> PESAWAT - TRANSIT
                        <br />
                      </p>
                      <p style="padding: 5px;">
                        <input type="checkbox" name="entitas[]" value="4" class="entitas-checkbox"/> PENUMPANG - DATANG
                        <br />
                        <input type="checkbox" name="entitas[]" value="5" class="entitas-checkbox"/> PENUMPANG - BERANGKAT
                        <br />
                        <input type="checkbox" name="entitas[]" value="6" class="entitas-checkbox"/> PENUMPANG - TRANSIT
                        <br />
                      </p>
                      <p style="padding: 5px;">
                        <input type="checkbox" name="entitas[]" value="7" class="entitas-checkbox"/> BAGASI - DATANG
                        <br />
                        <input type="checkbox" name="entitas[]" value="8" class="entitas-checkbox"/> BAGASI - BERANGKAT
                        <br />
                        <input type="checkbox" name="entitas[]" value="9" class="entitas-checkbox"/> BAGASI - TRANSIT
                        <br />
                      </p>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <p style="padding: 5px;">
                        <input type="checkbox" name="entitas[]" value="10" class="entitas-checkbox"/> CARGO - DATANG
                        <br />
                        <input type="checkbox" name="entitas[]" value="11" class="entitas-checkbox"/> CARGO - BERANGKAT
                        <br />
                        <input type="checkbox" name="entitas[]" value="12" class="entitas-checkbox"/> CARGO - TRANSIT
                        <br />
                      </p>
                      <p style="padding: 5px;">
                        <input type="checkbox" name="entitas[]" value="13" class="entitas-checkbox"/> POS - DATANG
                        <br />
                        <input type="checkbox" name="entitas[]" value="14" class="entitas-checkbox"/> POS - BERANGKAT
                        <br />
                        <input type="checkbox" name="entitas[]" value="15" class="entitas-checkbox"/> POS - TRANSIT
                        <br />
                      </p>
                    </div>
                  </select>
                  </div>
                </div>
                
                <div class="ln_solid"></div>

                <div class="form-group">
                  <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <input type="submit" class="btn btn-primary" value="Lihat Grafik"/>
                  </div>
                </div>
              </form>
            </div>
            <div id="echart_line" class="col-md-12" style="height:550px;"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /INSERT KE DATA APBD -->
<script>
  $('input[class=single-checkbox]').on('change', function (e) {
      if ($('input[class=single-checkbox]:checked').length > 5) {
          $(this).prop('checked', false);
          alert("Maksimal Pilih 5");
      }
  });

  $('input[class=entitas-checkbox]').on('change', function (e) {
    if ($('input[class=entitas-checkbox]:checked').length > 5) {
        $(this).prop('checked', false);
        alert("Maksimal Pilih 5");
    }
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
          text: <?php echo '"Grafik Penerbangan Bulan '.$periode.'",'; ?>
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
          data: [
          <?php
            $count = sizeof($tahun);
            $pos = 0;
            foreach ($tahun as $t) 
            {
              if ($count-1 != $pos) 
                echo "'".$t."',";
              else
                echo "'".$t."'";
              $pos++;
            }
          ?>
          ]
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