<script src="<?php echo base_url();?>assets/js/canvasjs.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
var dataPoints = [];
$.getJSON("<?php echo base_url(); ?>cpanel/casechart", function(data){  
	$.each(data, function(key, value){
		dataPoints.push({y: parseInt(value[0]), label: value[1]});
	});
	var chart = new CanvasJS.Chart("chartContainer",
	{
		title:{
				text: "Registered Case"
		},
		legend: {
			maxWidth: 350,
			itemWidth: 120
		},
		data: [
		{
			type: "column",
			showInLegend: true,
			legendText: "{indexLabel}",
			dataPoints: dataPoints }]
	});
	chart.render();
});
});
</script>
<!--Div that will hold the pie chart-->
<div class="row">
<div class="space-6"></div>
	<div class="col-sm-5">
    <div class="widget-box">
    <div class="widget-header widget-header-flat widget-header-small">
        <h5 class="widget-title">
            <i class="ace-icon fa fa-signal"></i>
            Registered Case
        </h5>
    </div>
    <div class="widget-body">
        <div class="widget-main">
			<div id="chartContainer" style="height: 300px; width: 100%;"></div>    
       </div><!-- /.widget-main -->
    </div><!-- /.widget-body -->
    </div><!-- /.widget-box -->
    </div><!-- /.col -->
	
    
</div>