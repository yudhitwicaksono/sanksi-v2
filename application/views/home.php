<?php 
$this->session->unset_userdata('pesan');
$this->session->unset_userdata('parameter');
?>
<br><!-- /.panel-heading -->
  <div class="panel-body">
   <div class="timeline-badge"><h4 class="timeline-title"></h4>
    <div class="timeline-panel">
	 <div class="timeline-heading"></div>
	  <div class="timeline-body">
	   <div class="col-sm-12">
		<div class="card">
		 <div class="card-block">
		  <div class="card-title-block">
			<h3 class="title">Data Grafik Pelanggaran Berasarkan Bulan dan Tahun</h3> 
			<hr/>
		  </div>
		  <section class="example">
		   <div class="table-flip-scroll">
		   	
		   	<div class="row">
		   	
		   	<div class="form-group"> 
		   	 <div class="col-sm-2">
		   	 	<label class="control-label">Bulan</label><br/> 
		   	 </div>
		   	 <div class="col-sm-3">
		   	 	<select id="bulan" class="form-control">
			 	<option></option>
			 	<option value="1">Januari</option>
			 	<option value="2">Februari</option>
			 	<option value="3">Maret</option>
			 	<option value="4">April</option>
			 	<option value="5">Mei</option>
			 	<option value="6">Juni</option>
			 	<option value="7">Juli</option>
			 	<option value="8">Agustus</option>
			 	<option value="9">September</option>
			 	<option value="10">Oktober</option>
			 	<option value="11">November</option>
			 	<option value="12">Desember</option>
			 </select>	
		   	 </div>
		   	 <div class="col-sm-2">
		   	 	<label class="control-label">Tahun</label><br/> 
		   	 </div>
		   	 <div class="col-sm-3">
		   	 	<select id="tahun" class="form-control">
			 	  <option></option>
			 	    <?php foreach ($tahun as $key => $vaData) { ?>
						<option value="<?=$vaData['tahun_pelanggaran']?>"><?=$vaData['tahun_pelanggaran']?>	
						</option>
					<?php } ?>
			 	</select>	
		   	 </div>

		   	 <div class="col-sm-2">
		   	 	<button type="button" class="btn btn-primary" onclick="return grafik1();">
		   	 		Show
		   	 	</button> <strong>Klik 2x</strong>
		   	 </div>
		   	 </div>
			 </div>

			 <div class="row" id="grafik-1">
			 	<div class="col-sm-12">
		   		<h4 style="color:#52BCD3"><p>Data Jumlah Pelanggaran Bulan <?=date("m")?> Tahun <?=date("Y")?></p></h4>
		   		</div>
			 	<div class="col-sm-12">
			 		<div id="chartdiv" style="width: 100%; height: 400px;"></div>
			 	</div>
			 </div>


		   </div>
		  </section>
		 </div>
		</div>
	   </div>
	   <div class="col-sm-12">
		<div class="card">
		 <div class="card-block">
		  <div class="card-title-block">
			<h3 class="title">Data Grafik Pelanggaran Berdasarkan Kelas</h3> 
			<hr/>
		  </div>
		  <section class="example">
		   <div class="table-flip-scroll">
		   	<div class="row" >
		   	<div class="form-group"> 
		   	 <div class="col-sm-2">
		   	 	<label class="control-label">Kelas</label><br/> 
		   	 </div>
		   	 <div class="col-sm-3">
		   	 	<select id="kelas" class="form-control">
			 	<option></option>
			 	<?php 
			 	foreach ($kelas as $key => $vaKelas) { ?>
			 		<option value="<?=$vaKelas['id_kelas']?>">
			 			<?=$vaKelas['kelas']?> <?=$vaKelas['jurusan']?> <?=$vaKelas['no_kelas']?>
			 		</option>
			 	<?php } ?>
			 </select>	
		   	 </div>
		   	 
		   	 <div class="col-sm-2">
		   	 	<button type="button" class="btn btn-primary" onclick="return grafik2();">
		   	 		Show
		   	 	</button> <strong>Klik 2x</strong>
		   	 </div>
		   	 </div>
			 </div>

			 <div class="row" id="grafik-2">
			 	<div class="col-sm-12">
			 		<div id="chartdiv-2" style="width: 100%; height: 400px;"></div>
			 	</div>
			 </div>

		   </div>
		  </section>
		 </div>
		</div>
	   </div>
	   <div class="col-sm-12">
		<div class="card">
		 <div class="card-block">
		  <div class="card-title-block">
			<h3 class="title">Data Grafik Pelanggaran Berdasarkan Kelas,Bulan dan Tahun</h3> 
			<hr/>
		  </div>
		  <section class="example">
		   <div class="table-flip-scroll">
		   	
		   	<div class="row">
		   	<div class="form-group"> 
		   	 <div class="col-sm-1">
		   	 	<label class="control-label">Kelas</label><br/> 
		   	 </div>
		   	 <div class="col-sm-2">
		   	 	<select id="kelas2" class="form-control">
			 	<option></option>
			 	<?php 
			 	foreach ($kelas as $key => $vaKelas) { ?>
			 		<option value="<?=$vaKelas['id_kelas']?>">
			 			<?=$vaKelas['kelas']?> <?=$vaKelas['jurusan']?> <?=$vaKelas['no_kelas']?>
			 		</option>
			 	<?php } ?>
			 </select>	
		   	 </div>
		   	 <div class="col-sm-1">
		   	 	<label class="control-label">Bulan</label><br/> 
		   	 </div>
		   	 <div class="col-sm-2">
		   	 	<select id="bulan2" class="form-control">
			 	<option></option>
			 	<option value="1">Januari</option>
			 	<option value="2">Februari</option>
			 	<option value="3">Maret</option>
			 	<option value="4">April</option>
			 	<option value="5">Mei</option>
			 	<option value="6">Juni</option>
			 	<option value="7">Juli</option>
			 	<option value="8">Agustus</option>
			 	<option value="9">September</option>
			 	<option value="10">Oktober</option>
			 	<option value="11">November</option>
			 	<option value="12">Desember</option>
			 </select>	
		   	 </div>
		   	 <div class="col-sm-1">
		   	 	<label class="control-label">Tahun</label><br/> 
		   	 </div>
		   	 <div class="col-sm-2">
		   	 	<select id="tahun2" class="form-control">
			 	  <option></option>
			 	  <option value="2017">2017</option>
			 	  <option value="2018">2018</option>
			 	  <option value="2019">2019</option>
			 	</select>	
		   	 </div>
		   	 <div class="col-sm-2">
		   	 	<button type="button" class="btn btn-primary" onclick="return grafik3();">
		   	 		Show
		   	 	</button> <strong>Klik 2x</strong>
		   	 </div> 
		   	 </div>
			 </div>

			 <div class="row" id="grafik-3">
			 	<div class="col-sm-12">
			 		<div id="chartdiv-3" style="width: 100%; height: 400px;"></div>
			 	</div>
			 </div>


		   </div>
		  </section>
		 </div>
		</div>
	   </div>
	   </div>
	  </div>
   </div><!-- /.panel-body -->
<!-- #endregion Jssor Slider End -->
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



        <script>
            var chart2;

            var chartData2 = [
              
              <?php 
              	foreach ($grafik_bulan_tahun as $key => $vaGrafik1) {
              		# code...
              ?>

                {
                    "country2": "<?=$vaGrafik1['nama_pelanggaran']?>",
                    "visits2": "0",
                    "color2": "#52BCD3"
                },
                
              <?php } ?>
            ];


            AmCharts.ready(function () {
                // SERIAL CHART
                chart2 = new AmCharts.AmSerialChart();
                chart2.dataProvider = chartData2;
                chart2.categoryField = "country2";
                // the following two lines makes chart 3D
                chart2.depth3D = 20;
                chart2.angle = 30;

                // AXES
                // category
                var categoryAxis = chart2.categoryAxis;
                categoryAxis.labelRotation = 40;
                categoryAxis.dashLength = 5;
                categoryAxis.gridPosition = "start";

                // value
                var valueAxis = new AmCharts.ValueAxis();
                valueAxis.title = "Total Pelanggaran";
                valueAxis.dashLength = 5;
                chart2.addValueAxis(valueAxis);

                // GRAPH
                var graph = new AmCharts.AmGraph();
                graph.valueField = "visits2";
                graph.colorField = "color2";
                graph.balloonText = "<span style='font-size:14px'>Data Kosong Pilih Kelas Dulu </span>";
                graph.type = "column";
                graph.lineAlpha = 0;
                graph.fillAlphas = 1;
                chart2.addGraph(graph);

                // CURSOR
                var chartCursor = new AmCharts.ChartCursor();
                chartCursor.cursorAlpha = 0;
                chartCursor.zoomable = false;
                chartCursor.categoryBalloonEnabled = false;
                chart2.addChartCursor(chartCursor);

                chart2.creditsPosition = "top-right";


                // WRITE
                chart2.write("chartdiv-2");

            });
        </script>


        <script>
            var chart3;

            var chartData3 = [
              
              <?php 
              	foreach ($grafik_bulan_tahun as $key => $vaGrafik1) {
              		# code...
              ?>

                {
                    "country3": "<?=$vaGrafik1['nama_pelanggaran']?>",
                    "visits3": "0",
                    "color3": "#52BCD3"
                },
                
              <?php } ?>
            ];


            AmCharts.ready(function () {
                // SERIAL CHART
                chart3 = new AmCharts.AmSerialChart();
                chart3.dataProvider = chartData3;
                chart3.categoryField = "country3";
                // the following two lines makes chart 3D
                chart3.depth3D = 20;
                chart3.angle = 30;

                // AXES
                // category
                var categoryAxis = chart3.categoryAxis;
                categoryAxis.labelRotation = 40;
                categoryAxis.dashLength = 5;
                categoryAxis.gridPosition = "start";

                // value
                var valueAxis = new AmCharts.ValueAxis();
                valueAxis.title = "Total Pelanggaran";
                valueAxis.dashLength = 5;
                chart3.addValueAxis(valueAxis);

                // GRAPH
                var graph = new AmCharts.AmGraph();
                graph.valueField = "visits3";
                graph.colorField = "color3";
                graph.balloonText = "<span style='font-size:14px'>Data Kosong Pilih Kelas Dulu </span>";
                graph.type = "column";
                graph.lineAlpha = 0;
                graph.fillAlphas = 1;
                chart3.addGraph(graph);

                // CURSOR
                var chartCursor = new AmCharts.ChartCursor();
                chartCursor.cursorAlpha = 0;
                chartCursor.zoomable = false;
                chartCursor.categoryBalloonEnabled = false;
                chart3.addChartCursor(chartCursor);

                chart3.creditsPosition = "top-right";


                // WRITE
                chart3.write("chartdiv-3");

            });
        </script>


        <script type="text/javascript">
       
       function grafik1(){
        var bulan 	= $('#bulan').val();
        var tahun 	= $('#tahun').val();

        if (bulan == '') {
          window.alert('Bulan Kosong');
        }else if(tahun == ''){
         window.alert('Tahun Kosong');
        }else{
       // ajax adding data to database
         $.ajax({
	        type: "POST",
	        data  :"bulan="+bulan+
	               "&tahun="+tahun,  
	        url: "<?=site_url('Main/grafik_1')?>",
	        cache: false,
	           beforeSend:function(){
				 $("#grafik-1").html("<div align='center'><img  width='20' height=20'   src='<?=base_url()?>assets/loading.gif' /></div>");
				},
	           success:function(msg){
	           	$("#grafik-1").html(msg);
	           }
	     });
        };
   	   }





   	   function grafik2(){
        var kelas 	= $('#kelas').val();

        if (kelas == '') {
          window.alert('Kelas Kosong');
        }else{
       // ajax adding data to database
         $.ajax({
	        type: "POST",
	        data  :"kelas="+kelas+
	               "&id_kelas="+kelas,  
	        url: "<?=site_url('Main/grafik_2')?>",
	        cache: false,
	           beforeSend:function(){
				 $("#grafik-2").html("<div align='center'><img  width='20' height=20'   src='<?=base_url()?>assets/loading.gif' /></div>");
				},
	           success:function(msg){
	           	$("#grafik-2").html(msg);
	           }
	     });
        };
   	   }


   	   function grafik3(){
        var bulan 	= $('#bulan2').val();
        var tahun 	= $('#tahun2').val();
        var kelas 	= $('#kelas2').val();

        if (kelas == '' || bulan == '' || tahun == '') {
          window.alert('Masih Ada Kosong');
        }else{
       // ajax adding data to database
         $.ajax({
	        type: "POST",
	        data  :"kelas="+kelas+
	               "&bulan="+bulan+
	               "&tahun="+tahun,  
	        url: "<?=site_url('Main/grafik_3')?>",
	        cache: false,
	           beforeSend:function(){
				 $("#grafik-3").html("<div align='center'><img  width='20' height=20'   src='<?=base_url()?>assets/loading.gif' /></div>");
				},
	           success:function(msg){
	           	$("#grafik-3").html(msg);
	           }
	     });
        };
   	   }
   	  </script>