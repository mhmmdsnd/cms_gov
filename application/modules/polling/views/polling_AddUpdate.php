<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/daterangepicker.min.css" />
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/markdown.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/moment.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap-markdown.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.inputlimiter.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/daterangepicker.min.js"></script>
<script src="<?php echo base_url();?>assets/js/canvasjs.min.js"></script>
<!-- /.page-header -->
<script type="text/javascript">
$(document).ready(function(){
	image_ext = ["jpeg", "jpg", "png", "gif" , "bmp"];
	doc_ext = ["doc","pdf","docx"];
	//Add Row
	var addDiv = $('#pollValue');
	var i = $('#pollValue').size() + 1;
	$('textarea.limited').inputlimiter({
		remText: '%n character%s remaining...',
		limitText: 'max allowed : %n.'
	});
	$('#caseFile').ace_file_input({
		no_file:'No File ...',
		btn_choose:'Choose',
		btn_change:'Change',
		droppable:false,
		onchange:null,
		thumbnail:false, //| true | large
		blacklist:'exe|php'
	});
	$('textarea[data-provide="markdown"]').each(function(){
        var $this = $(this);

		if ($this.data('markdown')) {
		  $this.data('markdown').showEditor();
		}
		else $this.markdown()
		
		$this.parent().find('.btn').addClass('btn-white');
    });
	$('input[name=casedate]').daterangepicker({
		'applyClass' : 'btn-sm btn-success',
		'cancelClass' : 'btn-sm btn-default',
		locale: {
			applyLabel: 'Apply',
			cancelLabel: 'Cancel',
		}
	})
	.prev().on(ace.click_event, function(){
		$(this).next().focus();
	});
	$('#add').on('click',function(){
		$(
		'<div class="form-group">'+
		'<label class="col-sm-3 control-label no-padding-right">Polling Value : </label>'+
		'<div class="col-sm-9">'+
		'<input id="pollingId" name="pollingId['+i+']" type="hidden" value="" />'+
		'<input id="pollingValue" name="pollingValue['+i+']" type="text" maxlength="20" class="col-xs-10 col-sm-2" value="" />'+
		'</div></div>').appendTo(addDiv);
		i++;
		});
});
</script>
<?php if ($_SERVER['REQUEST_URI'] == "/polling/create") { ?>
<script type="text/javascript">
$(document).ready(function(){
	$("#newcase_form").validate({
		errorElement: 'div',
		errorClass: 'help-block',
		rules: {
			casetitle: { required:true }, caselocation: { required:true }
		},
		messages : {
			casetitle : { required : " Insert Case Title." }, caselocation : { required : " Please select one." }
		},
		success: function (e) {
			$(e).closest('.form-group').removeClass('has-error');//.addClass('has-info');
			$(e).remove();
		},
		highlight: function (e) {
			$(e).closest('.form-group').removeClass('has-info').addClass('has-error');
		}
	});
});
</script>
<div class="page-header">
  <h1>Polling Wizard</h1>
</div>
<form method="post" id="polling_form" name="polling_form" class="form-horizontal" role="form" enctype="multipart/form-data" >
 <input type="hidden" name="casestate" value="3" />
  <input type="hidden" name="casetype" value="4" />
 <div class="form-group">
    <label class="col-sm-3 control-label no-padding-right">Polling Title</label>
    <div class="col-sm-9">
      <input id="casetitle" name="casetitle" type="text" maxlength="20" class="col-xs-10 col-sm-5" value="" />
    </div>
  </div>
  <div class="form-group">
   <label class="col-sm-3 control-label no-padding-right">Period Date</label>
   <div class="col-sm-9">
        <div class="input-group">
            <span class="input-group-addon">
                <i class="fa fa-calendar bigger-110"></i>
            </span>
            <input class="col-xs-3" type="text" name="casedate" id="casedate" readonly="readonly" />
        </div>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-3 control-label no-padding-right">Location</label>
    <div class="col-sm-9">
      <?php $extra = array('class' => 'input-medium'); echo form_dropdown("caselocation",$getlocation,"",$extra) ?>
    </div>
  </div>
  <div class="hr hr-16 hr-dotted"></div>
  <div class="form-group">
    <label class="col-sm-3 control-label no-padding-right">Headline</label>
    <div class="col-sm-9">
      <textarea class="col-xs-10 col-sm-5 limited" id="caseheader" name="caseheader" maxlength="200"></textarea>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-3 control-label no-padding-right">File Attachment</label>
    <div class="col-xs-10 col-sm-5">
      <input type="file" id="caseFile" name="caseFile" />
    </div>
  </div>
  <div class="space-24"></div>
	<h3 class="header smaller lighter blue">
        Polling Detail
    </h3>
    <div id="pollValue">
    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right">Polling Value : </label>
        <div class="col-sm-9">
          <input id="pollingId" name="pollingId[0]" type="hidden" value="" />
          <input id="pollingValue" name="pollingValue[0]" type="text" maxlength="20" class="col-xs-10 col-sm-2" value="" />
        </div>
    </div>
    <div class="form-group">
	    <label class="col-sm-3 control-label no-padding-right">Polling Value : </label>
    	<div class="col-sm-9">
    	  <input id="pollingId" name="pollingId[1]" type="hidden" value="" />
    	  <input id="pollingValue" name="pollingValue[1]" type="text" maxlength="20" class="col-xs-10 col-sm-2" value="" />
    	</div>
	</div>   
    </div>
   <div class="form-group">
    <label class="col-sm-3 control-label no-padding-right"></label>
    <div class="col-sm-9">
    	<input type="button" id="add" class="btn btn-sm btn-primary" value="Add"/>
    </div>
  </div>
  <div class="hr hr-16 hr-dotted"></div>
  <div class="form-group">
    <div class="col-md-offset-3 col-md-9">
      <input type="submit" name="action" value="Submit" class="btn btn-primary" />
      &nbsp; &nbsp; &nbsp;
      <input type="button" value="Cancel" class="btn btn-primary" onclick="document.location.replace('<?php echo base_url();?>newcase');" />
    </div>
  </div>
</form>
<?php } elseif($_SERVER['REQUEST_URI'] == "/polling/update/$detail->caseId" && $detail->caseApproval == 1) { ?>
<div class="page-header">
  <h1>Polling Wizard</h1>
</div>
<form method="post" id="polling_form" name="polling_form" class="form-horizontal" role="form">
  <input type="hidden" name="id" value="<?php echo $detail->caseId ?>" />
  <input type="hidden" name="casestate" value="<?php echo $detail->caseState ?>" />
  <input type="hidden" name="casetype" value="<?php echo $detail->caseType ?>" />
  <div class="form-group">
    <label class="col-sm-3 control-label no-padding-right">Case Title</label>
    <div class="col-sm-9">
      <input id="casetitle" name="casetitle" type="text" maxlength="20" class="col-xs-10 col-sm-5" value="<? echo $detail->caseTitle ?>" />
    </div>
  </div>
  <div class="form-group">
   <label class="col-sm-3 control-label no-padding-right">Period Date</label>
   <div class="col-sm-9">
        <div class="input-group">
            <span class="input-group-addon">
                <i class="fa fa-calendar bigger-110"></i>
            </span>
            <input class="col-xs-3" type="text" name="casedate" id="casedate" readonly="readonly" />
        </div>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-3 control-label no-padding-right">Location</label>
    <div class="col-sm-9">
      <?php $extra = array('class' => 'input-medium'); echo form_dropdown("caselocation",$getlocation,$detail->caseLocation,$extra) ?>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-3 control-label no-padding-right">Headline</label>
    <div class="col-sm-9">
      <textarea class="col-xs-10 col-sm-5 limited" id="caseheader" name="caseheader" maxlength="200"><? echo $detail->caseHeader ?></textarea>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-3 control-label no-padding-right">File Attachment</label>
    <div class="col-xs-10 col-sm-5">
      <input type="file" id="caseFile" name="caseFile" />
    </div>
  </div>
  <div class="space-24"></div>
	<h3 class="header smaller lighter blue">
        Polling Detail
    </h3>
    <div id="pollValue">
    <?php for($i=0;$i<count($polldetail);$i++) { ?>
    <div class="form-group" >
    <label class="col-sm-3 control-label no-padding-right">Polling Value : </label>
    <div class="col-sm-9">
      <input id="pollingId" name="pollingId[<? echo $i; ?>]" type="hidden" value="<? echo $polldetail[$i]['pollingId'] ?>" />
      <input id="pollingValue" name="pollingValue[<? echo $i; ?>]" type="text" maxlength="20" class="col-xs-10 col-sm-2" value="<? echo $polldetail[$i]['pollingValue'] ?>" />
    </div>
    </div>
    <? }?>
    </div>
    <!-- <label class="col-sm-3 control-label no-padding-right">Polling Value : </label>
    <div class="col-sm-9">
      <input id="pollingId" name="pollingId[<? echo count($polldetail); ?>]" type="hidden" value="" />
      <input id="pollingValue" name="pollingValue[<? echo count($polldetail) ?>]" type="text" maxlength="20" class="col-xs-10 col-sm-2" value="" />
    </div> 
  </div>-->
   <div class="form-group">
    <label class="col-sm-3 control-label no-padding-right"></label>
    <div class="col-sm-9">
    	<input type="button" id="add" class="btn btn-sm btn-primary" value="Add"/>
    </div>
  </div>
  <div class="hr hr-16 hr-dotted"></div>
  <div class="clearfix form-actions">
    <div class="col-md-offset-3 col-md-9">
      <input type="submit" name="action" value="Submit" class="btn btn-primary" />
      &nbsp; &nbsp; &nbsp;
      <input type="button" value="Cancel" class="btn btn-primary" onclick="document.location.replace('<?php echo base_url();?>polling');" />
    </div>
  </div>
</form>
<!-- DETAIL / VIEW -->
<? } else { ?>
<script type="text/javascript">
$(document).ready(function(){
var dataPoints = [];
$.getJSON("<?php echo base_url(); ?>cpanel/pollchart/?caseId=<? echo $detail->caseId ?>", function(data){  
	$.each(data, function(key, value){
		dataPoints.push({y: parseInt(value[0]), indexLabel: value[1]});
	});
	var chart = new CanvasJS.Chart("chartContainer",
	{
		legend: {
			maxWidth: 350,
			itemWidth: 120
		},
		data: [
		{
			type: "pie",
			showInLegend: true,
			toolTipContent:"{indexLabel} - #percent %",
			legendText: "{indexLabel}",
			dataPoints: dataPoints }]
	});
	chart.render();
});
});
</script>
<div class="col-sm-10 col-sm-offset-1">
	<div class="widget-box transparent">
		<div class="widget-header widget-header-large">
			<h3 class="widget-title grey lighter">
				<i class="ace-icon fa fa-leaf green"></i>
				<? echo $detail->caseTitle ?>
			</h3>
            <div class="widget-toolbar no-border invoice-info">
                <span class="invoice-info-label">Author :</span>
                <span class="red"><? echo $detail->caseAuthor ?></span>

                <br />
                <span class="invoice-info-label">Periode Date:</span>
                <span class="blue"><? echo $detail->caseDateStart ?> s/d <? echo $detail->caseDateEnd ?></span>
            </div>
		</div>
		<div class="widget-body">
        <div class="widget-main padding-24">
            <div class="row">
                <div class="col-sm-9">
                    <div>
                        <ul class="list-unstyled spaced">
                            <li>
                                <i class="ace-icon fa fa-caret-right blue"></i>Location : <b class="red"><? echo $detail->locationName ?></b>
                            </li>
                            <li>
                                <i class="ace-icon fa fa-caret-right blue"></i>Header : <b class="red"><? echo $detail->caseHeader ?></b>
                            </li>
                         </ul>
                    </div>
                </div><!-- /.col -->
         	</div><!-- /.row -->
            <div class="space"></div>
            <h3 class="header smaller lighter blue">
                <i class="ace-icon fa fa-leaf green"></i>
                Polling Detail
            </h3>
            <div class="profile-skills">
            <div id="chartContainer" style="height: 300px; width: 50%;"></div>    
           	</div>
        </div>
        </div>
        <div class="hr hr-16 hr-dotted"></div>
          <div class="clearfix ">
            <div class="col-md-offset-3 col-md-9">
              <input type="button" value="Cancel" class="btn btn-primary" onclick="document.location.replace('<?php echo base_url();?>polling');" />
            </div>
          </div>
    </div>
</div>
<? } ?>
