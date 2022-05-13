<<<<<<< HEAD
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<div class="content-wrapper ml-0">
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0">Dashboard</h1>
            </div>
            <div class="col-sm-6"></div>
         </div>
      </div>
   </div>
   <section class="content">	
      <div class="container-fluid">
         <div class="row">
            <div class="col-lg-3 col-6">
               <div class="small-box bg-info">
                  <div class="inner">
                     <h3><span id="over_due">00</span></h3>
                     <p>Bills Over Due</p>
                  </div>
                  <div class="icon">
                     <i class="ion ion-bag"></i>
                  </div>
                  <a href="#" class="small-box-footer">Total No of Meters :<span id="total_meter">00</span> 
                  <i class="fas fa-arrow-circle-right"></i></a>
               </div>
            </div>
            <div class="col-lg-3 col-6">
               <div class="small-box bg-success">
                  <div class="inner">
                     <h3><span id="urgent_bill">00</span></h3>
                     <p>Bills need to upload Today</p>
                  </div>
                  <div class="icon">
                     <i class="ion ion-stats-bars"></i>
                  </div>
                  <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
               </div>
            </div>
            <div class="col-lg-3 col-6">
               <div class="small-box bg-warning">
                  <div class="inner">
                     <h3><span>00</span></h3>
                     <p>--</p>
                  </div>
                  <div class="icon">
                     <i class="ion ion-person-add"></i>
                  </div>
                  <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
               </div>
            </div>
            <div class="col-lg-3 col-6">
               <div class="small-box bg-danger">
                  <div class="inner">
                     <h3><span id="pending_payments">00</span></h3>
                     <p>Bills Payment Pending</p>
                  </div>
                  <div class="icon">
                     <i class="ion ion-pie-graph"></i>
                  </div>
                  <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
               </div>
            </div>
         </div>
         <div class="row">
            <section class="col-lg-5 connectedSortable">
               <div class="card">
<!--                   <div class="card-header"> -->
<!--                      <h3 class="card-title"> -->
<!--                         <i class="fas fa-chart-pie mr-1"></i> -->
<!--                         Bill Uploading -->
<!--                      </h3> -->
<!--                   </div> -->
                  <div class="card-body">
                     <div class="tab-content p-0">
                        <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 400px;">
                        	<div id="piechart" style="height: 400px;"></div>
                        </div>
                     </div>
                  </div>
               </div>
            </section>
            
            <section class="col-lg-7 connectedSortable">
               <div class="card bg-gradient-default">
                  <div class="card-header border-0">
                     <h3 class="card-title">
                        <i class="fas fa-map-marker-alt mr-1"></i>
                        OverAll Bills
                     </h3> <br/><br/>
                     <div class="card-tools">
                        <select id="company">
                        	<option value="">All Company</option>
                        	<?php foreach($companies as $company){ ?>
                        	    <option value="<?php echo $company['cid'];?>"><?php echo $company['name']; ?></option>
                        	<?php }?>
                        </select>
                        <select id="month">
                        	<option value="">Select Month</option>
                        	<?php for($i=1;$i<=12;$i++){ ?>
                        	<option value="<?php echo $i; ?>" <?php if($i == date('n')){ echo "selected"; } ?>><?php echo DateTime::createFromFormat('!m', $i)->format('F');?></option>
                        	<?php } ?>
                        </select>
                        <select id="year">
                        	<option value="">Select Year</option>
                        	<option value="2021" <?php if(date('Y') == '2021'){ echo "selected"; }?>>2021</option>
                        	<option value="2022" <?php if(date('Y') == '2022'){ echo "selected"; }?>>2022</option>
                        </select>
                     </div>
                  </div>
                  <div class="card-body">
                     <div id="piechart" style="height: 400px;">
                     	<!--<div id="piechart2" style="height: 400px;"></div>-->
                     	<div id="columnchart_values" style="height: 400px;"></div>
                     </div>
                  </div>
               </div>
            </section>
         </div>
      </div>
   </section>
</div>
<aside class="control-sidebar control-sidebar-dark"></aside>
</div>

<script>
	$(document).ready(function(){
    	const baseUrl = $('#base_url').val();
    	chartData = [];
    	chartData2 = [];
    	barChartData = [];
    	
    	
    	function drawchart(){	
              google.charts.load('current', {'packages':['corechart']});
              google.charts.setOnLoadCallback(drawChart);
              
              function drawChart() {
        
                var data = new google.visualization.DataTable();
                data.addColumn('string', 'Topping');
                data.addColumn('number', 'Slices');
                data.addRows(chartData);
        
        		console.log(chartData);
        		console.log('pie');
                var options = {
                    'title':'Meter Bill Upload Detail',
                    'legend' : {position: 'left', textStyle: {color: 'blue', fontSize: 16}},
                    'legend' : {alignment: 'center'},
                    'titleTextStyle' : { color: 'red',bold:true},
                     pieHole: 0.3,
                    //'width':screen.width/2,
                    //'height':screen.height/2
                };
        
                var chart = new google.visualization.PieChart(document.getElementById('piechart'));
                chart.draw(data, options);
               
                google.visualization.events.addListener(chart, 'select', selectHandler2);
                
                function selectHandler2(e) {	
                    var selectedItem = chart.getSelection();
                    console.log(chartArray[selectedItem[0].row] );
                    if(selectedItem.length){
                        farmerList(chartArray[selectedItem[0].row].StateId);
                    }
                }
        
              }
         }
    	
    	
    	
    	function drawchart2(){	
              google.charts.load('current', {'packages':['corechart']});
              google.charts.setOnLoadCallback(drawChart3);
              
              function drawChart3() {
        
                var data = new google.visualization.DataTable();
                data.addColumn('string', 'Topping');
                data.addColumn('number', 'Slices');
                data.addRows(chartData2);
        
                var options = {
                    'title':'Bill Payment Detail',
                    'legend' : {position: 'left', textStyle: {color: 'blue', fontSize: 16}},
                    'legend' : {alignment: 'center'},
                    'titleTextStyle' : { color: 'red',bold:true},
                     //pieHole: 0.4,
                    //'width':screen.width/2,
                    //'height':screen.height/2
                };
        
                var chart = new google.visualization.PieChart(document.getElementById('piechart2'));
                chart.draw(data, options);
               
                google.visualization.events.addListener(chart, 'select', selectHandler2);
                
                function selectHandler2(e) {	
                    var selectedItem = chart.getSelection();
                    console.log(chartArray[selectedItem[0].row] );
                    if(selectedItem.length){
                        farmerList(chartArray[selectedItem[0].row].StateId);
                    }
                }
        
              }
         }
         
         
         function drawBarChart(){
         	 google.charts.load("current", {packages:['corechart']});
    		 google.charts.setOnLoadCallback(drawbarChart);
    		 
             function drawbarChart() {
             		var data = new google.visualization.DataTable();
             		data.addColumn('string', 'company');
                    data.addColumn('number', 'bill');
                    data.addColumn({type: 'string', role: 'style'});
                    data.addRows(barChartData);

                  var options = {
                    title: "Corresponding month bill",
                    width: 600,
                    height: 400,
                    bar: {groupWidth: "95%"},
                    legend: { position: "none" },
                  };
                  var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
                  chart.draw(data, options);
              }
    	}
    	///bill upload detail///////////////
    	//////////////////////////////////////
    	fetch(`${baseUrl}Dashboard_ctrl/bill_upload_data`)
      		.then(response => response.json())
      		.then(response => {      		
      			$('#over_due').html(response.data1['OVER DUE']);
      			$('#urgent_bill').html(response.data1['URGENT']);
      			$('#total_meter').html(response.data1['total_meters']);
      			$('#pending_payments').html(response.data1['payment_pending']);
      			var l = response.data.length;
      			var c=0;
      			while(c < l){
      				chartData.push([response.data[c].status, parseInt(response.data[c].total)]);
                    c++;
      			}
      		}).then(response =>{
      			drawchart();
      		});
      		
      	
      	$(document).on('change','#company,#month,#year',function(){
      		bill_payment_chart();
      	});
      		
      	/////////////// bill payments //////////////////
      	//////////////////////////////////////////////
      	bill_payment_chart();
      	function bill_payment_chart(){
      		let myColor = ['#FF5733 ','#E9D47C','#C3E97C','#90BAAB','#149065','#38B8C1','#0B9EA7','#0B2CA7','#6A7396'];
          	$.ajax({
                url: `${baseUrl}Dashboard_ctrl/bill_payments`,
                method: "POST",
                dataType: "json",
                data : {
      				'company' : $('#company').val(),
      				'month' : $('#month').val(),
      				'year' : $('#year').val()
      			},
                success(response){
                	chartData2 = [];
                	barChartData = [];
                    if(response.status == 200){
                    	$.each(response.data,function(key,value){
//                     		chartData2.push([value.company_name, parseInt(value.total_bill)]);
                    		barChartData.push([value.company_name, parseInt(value.total_bill),myColor[Math.floor((Math.random() * 10) + 1)]]);
                    	});
//                     	drawchart2();
                    	drawBarChart();
                    } else {
                    	barChartData = [];
                    	drawBarChart();
                    	console.log('No record found.');
                    }
                }
            });
        }	
  	});
</script>
=======
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<div class="content-wrapper ml-0">
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0">Dashboard</h1>
            </div>
            <div class="col-sm-6"></div>
         </div>
      </div>
   </div>
   <section class="content">	
      <div class="container-fluid">
         <div class="row">
            <div class="col-lg-3 col-6">
               <div class="small-box bg-info">
                  <div class="inner">
                     <h3><span id="over_due">00</span></h3>
                     <p>Bills Over Due</p>
                  </div>
                  <div class="icon">
                     <i class="ion ion-bag"></i>
                  </div>
                  <a href="#" class="small-box-footer">Total No of Meters :<span id="total_meter">00</span> 
                  <i class="fas fa-arrow-circle-right"></i></a>
               </div>
            </div>
            <div class="col-lg-3 col-6">
               <div class="small-box bg-success">
                  <div class="inner">
                     <h3><span id="urgent_bill">00</span></h3>
                     <p>Bills need to upload Today</p>
                  </div>
                  <div class="icon">
                     <i class="ion ion-stats-bars"></i>
                  </div>
                  <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
               </div>
            </div>
            <div class="col-lg-3 col-6">
               <div class="small-box bg-warning">
                  <div class="inner">
                     <h3><span>00</span></h3>
                     <p>--</p>
                  </div>
                  <div class="icon">
                     <i class="ion ion-person-add"></i>
                  </div>
                  <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
               </div>
            </div>
            <div class="col-lg-3 col-6">
               <div class="small-box bg-danger">
                  <div class="inner">
                     <h3>00</h3>
                     <p>--</p>
                  </div>
                  <div class="icon">
                     <i class="ion ion-pie-graph"></i>
                  </div>
                  <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
               </div>
            </div>
         </div>
         <div class="row">
            <section class="col-lg-5 connectedSortable">
               <div class="card">
<!--                   <div class="card-header"> -->
<!--                      <h3 class="card-title"> -->
<!--                         <i class="fas fa-chart-pie mr-1"></i> -->
<!--                         Bill Uploading -->
<!--                      </h3> -->
<!--                   </div> -->
                  <div class="card-body">
                     <div class="tab-content p-0">
                        <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 400px;">
                        	<div id="piechart" style="height: 400px;"></div>
                        </div>
                     </div>
                  </div>
               </div>
            </section>
            
            <section class="col-lg-7 connectedSortable">
               <div class="card bg-gradient-default">
                  <div class="card-header border-0">
                     <h3 class="card-title">
                        <i class="fas fa-map-marker-alt mr-1"></i>
                        OverAll Bills
                     </h3> <br/><br/>
                     <div class="card-tools">
                        <select id="company">
                        	<option value="">All Company</option>
                        	<?php foreach($companies as $company){ ?>
                        	    <option value="<?php echo $company['cid'];?>"><?php echo $company['name']; ?></option>
                        	<?php }?>
                        </select>
                        <select id="month">
                        	<option value="">Select Month</option>
                        	<?php for($i=1;$i<=12;$i++){ ?>
                        	<option value="<?php echo $i; ?>" <?php if($i == date('n')){ echo "selected"; } ?>><?php echo DateTime::createFromFormat('!m', $i)->format('F');?></option>
                        	<?php } ?>
                        </select>
                        <select id="year">
                        	<option value="">Select Year</option>
                        	<option value="2021" <?php if(date('Y') == '2021'){ echo "selected"; }?>>2021</option>
                        	<option value="2022" <?php if(date('Y') == '2022'){ echo "selected"; }?>>2022</option>
                        </select>
                     </div>
                  </div>
                  <div class="card-body">
                     <div id="piechart" style="height: 400px;">
                     	<!--<div id="piechart2" style="height: 400px;"></div>-->
                     	<div id="columnchart_values" style="height: 400px;"></div>
                     </div>
                  </div>
               </div>
            </section>
         </div>
      </div>
   </section>
</div>
<aside class="control-sidebar control-sidebar-dark"></aside>
</div>

<script>
	$(document).ready(function(){
    	const baseUrl = $('#base_url').val();
    	chartData = [];
    	chartData2 = [];
    	barChartData = [];
    	
    	
    	function drawchart(){	
              google.charts.load('current', {'packages':['corechart']});
              google.charts.setOnLoadCallback(drawChart);
              
              function drawChart() {
        
                var data = new google.visualization.DataTable();
                data.addColumn('string', 'Topping');
                data.addColumn('number', 'Slices');
                data.addRows(chartData);
        
        		console.log(chartData);
        		console.log('pie');
                var options = {
                    'title':'Meter Bill Upload Detail',
                    'legend' : {position: 'left', textStyle: {color: 'blue', fontSize: 16}},
                    'legend' : {alignment: 'center'},
                    'titleTextStyle' : { color: 'red',bold:true},
                     pieHole: 0.3,
                    //'width':screen.width/2,
                    //'height':screen.height/2
                };
        
                var chart = new google.visualization.PieChart(document.getElementById('piechart'));
                chart.draw(data, options);
               
                google.visualization.events.addListener(chart, 'select', selectHandler2);
                
                function selectHandler2(e) {	
                    var selectedItem = chart.getSelection();
                    console.log(chartArray[selectedItem[0].row] );
                    if(selectedItem.length){
                        farmerList(chartArray[selectedItem[0].row].StateId);
                    }
                }
        
              }
         }
    	
    	
    	
    	function drawchart2(){	
              google.charts.load('current', {'packages':['corechart']});
              google.charts.setOnLoadCallback(drawChart3);
              
              function drawChart3() {
        
                var data = new google.visualization.DataTable();
                data.addColumn('string', 'Topping');
                data.addColumn('number', 'Slices');
                data.addRows(chartData2);
        
                var options = {
                    'title':'Bill Payment Detail',
                    'legend' : {position: 'left', textStyle: {color: 'blue', fontSize: 16}},
                    'legend' : {alignment: 'center'},
                    'titleTextStyle' : { color: 'red',bold:true},
                     //pieHole: 0.4,
                    //'width':screen.width/2,
                    //'height':screen.height/2
                };
        
                var chart = new google.visualization.PieChart(document.getElementById('piechart2'));
                chart.draw(data, options);
               
                google.visualization.events.addListener(chart, 'select', selectHandler2);
                
                function selectHandler2(e) {	
                    var selectedItem = chart.getSelection();
                    console.log(chartArray[selectedItem[0].row] );
                    if(selectedItem.length){
                        farmerList(chartArray[selectedItem[0].row].StateId);
                    }
                }
        
              }
         }
         
         
         function drawBarChart(){
         	 google.charts.load("current", {packages:['corechart']});
    		 google.charts.setOnLoadCallback(drawbarChart);
    		 
             function drawbarChart() {
             		var data = new google.visualization.DataTable();
             		data.addColumn('string', 'company');
                    data.addColumn('number', 'bill');
                    data.addColumn({type: 'string', role: 'style'});
                    data.addRows(barChartData);

                  var options = {
                    title: "Corresponding month bill",
                    width: 600,
                    height: 400,
                    bar: {groupWidth: "95%"},
                    legend: { position: "none" },
                  };
                  var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
                  chart.draw(data, options);
              }
    	}
    	///bill upload detail///////////////
    	//////////////////////////////////////
    	fetch(`${baseUrl}Dashboard_ctrl/bill_upload_data`)
      		.then(response => response.json())
      		.then(response => {      		
      			$('#over_due').html(response.data1['OVER DUE']);
      			$('#urgent_bill').html(response.data1['URGENT']);
      			$('#total_meter').html(response.data1['total_meters']);
      			
      			var l = response.data.length;
      			var c=0;
      			while(c < l){
      				chartData.push([response.data[c].bill_status, parseInt(response.data[c].total)]);
                    c++;
      			}
      		}).then(response =>{
      			drawchart();
      		});
      		
      	
      	$(document).on('change','#company,#month,#year',function(){
      		bill_payment_chart();
      	});
      		
      	/////////////// bill payments //////////////////
      	//////////////////////////////////////////////
      	bill_payment_chart();
      	function bill_payment_chart(){
      		let myColor = ['#FF5733 ','#E9D47C','#C3E97C','#90BAAB','#149065','#38B8C1','#0B9EA7','#0B2CA7','#6A7396'];
          	$.ajax({
                url: `${baseUrl}Dashboard_ctrl/bill_payments`,
                method: "POST",
                dataType: "json",
                data : {
      				'company' : $('#company').val(),
      				'month' : $('#month').val(),
      				'year' : $('#year').val()
      			},
                success(response){
                	chartData2 = [];
                	barChartData = [];
                    if(response.status == 200){
                    	$.each(response.data,function(key,value){
//                     		chartData2.push([value.company_name, parseInt(value.total_bill)]);
                    		barChartData.push([value.company_name, parseInt(value.total_bill),myColor[Math.floor((Math.random() * 10) + 1)]]);
                    	});
//                     	drawchart2();
                    	drawBarChart();
                    } else {
                    	barChartData = [];
                    	drawBarChart();
                    	console.log('No record found.');
                    }
                }
            });
        }	
  	});
</script>
>>>>>>> b8649bfae6c73219475d2f68c496ec4191cab5fc
