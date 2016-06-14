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
              <form id="demo-form" action="" method="post" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left">
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ex3">Daerah :</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <select name="kabkota" class="form-control" required="required">
                      <option value="" selected disabled>Pilih Daerah</option>
                      <option value="2">Kab. Badung</option>
                      <option value="3">Kab. Bangli</option>
                      <option value="4">Kab. Buleleng</option>
                      <option value="5">Kab. Gianyar</option>
                      <option value="6">Kab. Jembrana</option>
                      <option value="7">Kab. Karangasem</option>
                      <option value="8">Kab. Klungkung</option>
                      <option value="9">Kab. Tabanan</option>
                      <option value="10">Kota. Denpasar</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Periode :</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                  <select name="periode" class="form-control" required="required">
                    <option value="" selected disabled>Pilih Periode</option>
                    <option value="Triwulan_1">Triwulan 1</option>
                    <option value="Triwulan_2">Triwulan 2</option>
                    <option value="Triwulan_3">Triwulan 3</option>
                    <option value="Triwulan_4">Triwulan 4</option>
                  </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tahun :</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="col-md-3 col-sm-3 col-xs-6">
                      <p style="padding: 5px;">
                        <input type="checkbox" name="tahun[]" value="2007" class="flat" /> 2007
                        <br />
                        <input type="checkbox" name="tahun[]" value="2008" class="flat" /> 2008
                        <br />
                        <input type="checkbox" name="tahun[]" value="2009" class="flat" /> 2009
                        <br />
                      </p>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-6">
                      <p style="padding: 5px;">
                        <input type="checkbox" name="tahun[]" value="2010" class="flat" /> 2010
                        <br />
                        <input type="checkbox" name="tahun[]" value="2007" class="flat" /> 2011
                        <br />
                        <input type="checkbox" name="tahun[]" value="2008" class="flat" /> 2012
                        <br />
                      </p>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-6">
                      <p style="padding: 5px;">
                        <input type="checkbox" name="tahun[]" value="2009" class="flat" /> 2013
                        <br />
                        <input type="checkbox" name="tahun[]" value="2010" class="flat" /> 2014
                        <br />
                        <input type="checkbox" name="tahun[]" value="2007" class="flat" /> 2015
                        <br />
                        <!-- <input type="checkbox" name="tahun[]" value="2009" class="flat" /> 2009
                        <br />
                        <input type="checkbox" name="tahun[]" value="2010" class="flat" /> 2010
                        <br /> -->
                      </p>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-6">
                      <p style="padding: 5px;">
                      <input type="checkbox" name="tahun[]" value="2008" class="flat" data-parsley-maxcheck="5" required/> 2016
                        <br />
                      <!-- <p style="padding: 5px;">
                        <input type="checkbox" name="tahun[]" value="2007" class="flat" /> 2007
                        <br />
                        <input type="checkbox" name="tahun[]" value="2008" class="flat" /> 2008
                        <br />
                        <input type="checkbox" name="tahun[]" value="2009" class="flat" /> 2009
                        <br />
                        <input type="checkbox" name="tahun[]" value="2010" class="flat" /> 2010
                        <br />-->
                      </p>
                    </div>
                  </select>
                  </div>
                </div>
                <div class="ln_solid"></div>
                <div class="form-group">
                  <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <input type="submit" class="btn btn-primary" value="Filter"/>
                  </div>
                </div>
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
          text: 'Grafik APBD Kota Denpasar',
          subtext: 'lalala yeyeye lalala'
        },
        tooltip: {
          trigger: 'axis'
        },
        legend: {
          x: 220,
          y: 40,
          data: ['Intent', 'Pre-order', 'Deal']
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
          data: ['2010', '2011', '2012', '2013', '2014', '2015', '2016']
        }],
        yAxis: [
        {
          type: 'value'
        }],
        legend: {
          x: 220,
          y: 40,
          data: ['Total APBD', 'Total PDAM']
        },
        series: [
        {
          name: 'Total APBD',
          type: 'line',
          smooth: true,
          itemStyle: {
            normal: {
              areaStyle: {
                type: 'default'
              }
            }
          },
          data: [1425462, 1850762, 2620854, 2954662, 2467172, 0, 0]
        },
        {
          name: 'Total PDAM',
          type: 'line',
          smooth: true,
          itemStyle: {
            normal: {
              areaStyle: {
                type: 'default'
              }
            }
          },
          data: [1411213, 1786534, 2536716, 1986473, 2786467, 2876474, 1887564]
        }]
      });

    </script>