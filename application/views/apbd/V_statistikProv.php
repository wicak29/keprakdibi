<!-- INSERT KE DATA APBD -->
<div class="right_col" role="main" style="margin-left: 0px;">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel" style="min-height:538px;">
          <div class="x_title">
            <h2>Grafik Provinsi</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div style="margin-bottom:50px;">
              <form id="demo-form" action="<?php echo base_url();?>C_filter/viewLihatStatistikProv" method="post" enctype="multipart/form-data" class="form-horizontal form-label-left">
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Bulan :</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                  <select name="bulan" class="form-control" required="required">
                      <option value="" selected disabled>Pilih bulan</option>
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
                      </p>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-6">
                      <p style="padding: 5px;">
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
                      </p>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-6">
                      <p style="padding: 5px;">
                      <input type="checkbox" name="tahun[]" value="2016" class="single-checkbox"/> 2016
                        <br />
                      </p>
                    </div>
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
                    <input type="submit" class="btn btn-primary" value="Filter"/>
                  </div>
                </div>
              </form>
            </div>
            <div id="echart_line" class="col-md-12" style="height:550px;"></div>
            <table id="datatable-buttons" class="table table-striped table-bordered">
              <thead>
                <tr>
                 <!--  <th rowspan="2" style="vertical-align: middle;text-align: center;">Uraian</th> -->
                  <!-- <th><?php echo $kabkota ?></th> -->
                  <!-- <th rowspan="2" style="vertical-align: middle;text-align: center;">APBD</th>
                  <th rowspan="2" style="vertical-align: middle;text-align: center;">APBD P</th> -->
                  <?php foreach ($tahun as $t) 
                  { ?>
                   <!--  <th colspan="2" scope="colgroup" style="text-align: center;"><?php echo $t ?></th> -->
                  <?php
                  }?>
                </tr>
                <tr>
                  <?php foreach ($tahun as $t) 
                  { ?>
                    <!-- <th scope="col">Nilai</th>
                    <th scope="col">Persentase</th> -->
                  <?php
                  }?>
                </tr>
              </thead>
              <tbody id="tabelApbd">
                <tr>
                  <!-- <td>Uraian</td>
                  <td>APBD</td>
                  <td>APBDP</td> -->
                  <?php foreach ($tahun as $t) 
                  { ?>
                    <!-- <td scope="col">1</td>
                    <td scope="col">2</td> -->
                  <?php
                  }?>
                </tr>
                <!--<?php foreach ($data_apbd as $r) { ?>
                  <tr>
                    <td ><?php echo $r['URAIAN'] ?></td>
                    <td ><?php echo $r['NILAI'] ?></td>
                  </tr>
                <?php } ?> -->
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /INSERT KE DATA APBD -->
<script>
// var limit = 5;
// $('input.single-checkbox').on('change', function(evt) {
//    if($(this).siblings(':checked').length >= limit) {
//        this.checked = false;
//    }
// });
$('input[class=single-checkbox]').on('change', function (e) {
    if ($('input[class=single-checkbox]:checked').length > 5) {
        $(this).prop('checked', false);
        alert("Maksimal Pilih 5");
    }
});

$('input[class=uraian-checkbox]').on('change', function (e) {
    if ($('input[class=uraian-checkbox]:checked').length > 5) {
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
          text: "Grafik APBD Provinsi",
          subtext: ''
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