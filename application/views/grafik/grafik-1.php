   
<link rel="stylesheet" href="<?=base_url()?>assets/amcharts/samples/style.css" type="text/css">
<script src="<?=base_url()?>assets/amcharts/amcharts/amcharts.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/amcharts/amcharts/serial.js" type="text/javascript"></script>

    <script>
            var chart;

            var chartData = [
              
              <?php 
                foreach ($grafik_bulan_tahun as $key => $vaGrafik1) {
                    # code...
              ?>

                {
                    "country": "<?=$vaGrafik1['nama_pelanggaran']?>",
                    "visits": "<?=$vaGrafik1['JumlahPelanggaran']?>",
                    "color": "#52BCD3"
                },
                
              <?php } ?>
            ];


            AmCharts.ready(function () {
                // SERIAL CHART
                chart = new AmCharts.AmSerialChart();
                chart.dataProvider = chartData;
                chart.categoryField = "country";
                // the following two lines makes chart 3D
                chart.depth3D = 20;
                chart.angle = 30;

                // AXES
                // category
                var categoryAxis = chart.categoryAxis;
                categoryAxis.labelRotation = 40;
                categoryAxis.dashLength = 5;
                categoryAxis.gridPosition = "start";

                // value
                var valueAxis = new AmCharts.ValueAxis();
                valueAxis.title = "Total Pelanggaran";
                valueAxis.dashLength = 5;
                chart.addValueAxis(valueAxis);

                // GRAPH
                var graph = new AmCharts.AmGraph();
                graph.valueField = "visits";
                graph.colorField = "color";
                graph.balloonText = "<span style='font-size:14px'>[[category]]: <b>[[value]]</b> Siswa</span>";
                graph.type = "column";
                graph.lineAlpha = 0;
                graph.fillAlphas = 1;
                chart.addGraph(graph);

                // CURSOR
                var chartCursor = new AmCharts.ChartCursor();
                chartCursor.cursorAlpha = 0;
                chartCursor.zoomable = false;
                chartCursor.categoryBalloonEnabled = false;
                chart.addChartCursor(chartCursor);

                chart.creditsPosition = "top-right";


                // WRITE
                chart.write("chartdiv");

            });
        </script>


        <div class="col-sm-12">
                <h4 style="color:#52BCD3"><p>Data Jumlah Pelanggaran Bulan <?=$bulan?> Tahun <?=$tahun?></p></h4>
                </div>
        <div class="col-sm-12">
            <div id="chartdiv" style="width: 100%; height: 400px;"></div>
        </div>