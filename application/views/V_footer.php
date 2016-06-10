<!-- footer content -->
        <footer style="margin-left: 0px;">
          <div class="pull-right">
            Kerja Praktik - <a href="http://www.bi.go.id/">Bank Indonesia</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="<?php echo base_url('assets'); ?>/gentelella/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url('assets'); ?>/gentelella/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url('assets'); ?>/gentelella/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?php echo base_url('assets'); ?>/gentelella/vendors/nprogress/nprogress.js"></script>
    <!-- ECharts -->
    <script src="<?php echo base_url('assets'); ?>/gentelella/vendors/echarts/dist/echarts.min.js"></script>
    <script src="<?php echo base_url('assets'); ?>/gentelella/vendors/echarts/map/js/world.js"></script>

    <!-- bootstrap-daterangepicker -->
    <script src="<?php echo base_url('assets'); ?>/gentelella/production/js/moment/moment.min.js"></script>
    <script src="<?php echo base_url('assets'); ?>/gentelella/production/js/datepicker/daterangepicker.js"></script>
    <!-- bootstrap-wysiwyg -->
    <script src="<?php echo base_url('assets'); ?>/gentelella/vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
    <script src="<?php echo base_url('assets'); ?>/gentelella/vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
    <script src="<?php echo base_url('assets'); ?>/gentelella/vendors/google-code-prettify/src/prettify.js"></script>
    <!-- jQuery Tags Input -->
    <script src="<?php echo base_url('assets'); ?>/gentelella/vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
    <!-- Switchery -->
    <script src="<?php echo base_url('assets'); ?>/gentelella/vendors/switchery/dist/switchery.min.js"></script>

    <!-- Select2 -->
    <script src="<?php echo base_url('assets'); ?>/gentelella/vendors/select2/dist/js/select2.full.min.js"></script>
    <!-- Parsley -->
    <script src="<?php echo base_url('assets'); ?>/gentelella/vendors/parsleyjs/dist/parsley.min.js"></script>
    <!-- Autosize -->
    <script src="<?php echo base_url('assets'); ?>/gentelella/vendors/autosize/dist/autosize.min.js"></script>
    <!-- jQuery autocomplete -->
    <script src="<?php echo base_url('assets'); ?>/gentelella/vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
    <!-- starrr -->
    <script src="<?php echo base_url('assets'); ?>/gentelella/vendors/starrr/dist/starrr.js"></script>
    
    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url('assets'); ?>/gentelella/production/js/custom.js"></script>

    <!-- Select2 -->
    <script>
      $(document).ready(function() {
        $(".select2_single").select2({
          placeholder: "Pilih Daerah",
          allowClear: true
        });
        $(".select3_single").select2({
          placeholder: "Pilih Tahun",
          allowClear: true
        });
        $(".select4_single").select2({
          placeholder: "Pilih Triwulan",
          allowClear: true
        });
      });
    </script>
    <!-- /Select2 -->

    <script>
    var echartLine = echarts.init(document.getElementById('echart_line'), theme);

      echartLine.setOption({
        title: {
          text: 'Line Graph',
          subtext: 'Subtitle'
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
        xAxis: [{
          type: 'category',
          boundaryGap: false,
          data: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun']
        }],
        yAxis: [{
          type: 'value'
        }],
        series: [{
          name: 'Deal',
          type: 'line',
          smooth: true,
          itemStyle: {
            normal: {
              areaStyle: {
                type: 'default'
              }
            }
          },
          data: [10, 12, 21, 54, 260, 830, 710]
        }, {
          name: 'Pre-order',
          type: 'line',
          smooth: true,
          itemStyle: {
            normal: {
              areaStyle: {
                type: 'default'
              }
            }
          },
          data: [30, 182, 434, 791, 390, 30, 10]
        }, {
          name: 'Intent',
          type: 'line',
          smooth: true,
          itemStyle: {
            normal: {
              areaStyle: {
                type: 'default'
              }
            }
          },
          data: [1320, 1132, 601, 234, 120, 90, 20]
        }]
      });
    </script>
  </body>
</html>