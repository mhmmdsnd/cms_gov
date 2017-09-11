<script src="<?php echo base_url();?>assets/js/holder.min.js"></script>
<script src="<?php echo base_url();?>assets/js/canvasjs.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/markdown.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap-markdown.min.js"></script>
<script type="text/javascript">
jQuery(function($){
//this is for demo only
	<?php if ($detail->caseType == "4") { ?>
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
	<? } ?>
	$('.message-content .message-body').ace_scroll({
		size: 150,
		mouseWheelLock: true,
		styleClass: 'scroll-visible'
	});
    $('textarea[data-provide="markdown"]').each(function(){
        var $this = $(this);

        if ($this.data('markdown')) {
            $this.data('markdown').showEditor();
        }
        else $this.markdown()

        $this.parent().find('.btn').addClass('btn-white');
    });
});
</script>
<div class="page-header">
    <h1><? echo $detail->caseTitle ?></h1>
</div>
<div class="row">
<div class="col-xs-12">
<div class="tabbable">
<!-- START NAVBAR -->
<div class="tab-content no-border no-padding">
	<div id="inbox" class="tab-pane in active">
		<div class="message-container">
			<div id="id-message-item-navbar" class="message-navbar clearfix">
            <div class="message-bar">
                <div class="message-toolbar">
                                    
                </div>
            </div>
            <div>
                <div class="messagebar-item-left">
                    <a href="<?php echo base_url();?>cases/" class="btn-back-message-list">
                        <i class="ace-icon fa fa-arrow-left blue bigger-110 middle"></i>
                        <b class="bigger-110 middle">Back</b>
                    </a>
                </div>

                <div class="messagebar-item-right">
                    <i class="ace-icon fa fa-clock-o bigger-110 orange"></i>
                    <span class="grey"><? echo $detail->createdDate ?></span>
                </div>
            </div>
        </div>
		</div>
	</div>
</div>
 <!-- END NAVBAR-->
</div>
</div>
</div>
<div class="message-content" id="id-message-content">
<div class="message-header clearfix">
    <div class="pull-left">
        <div class="space-4"></div>
		&nbsp;
        <img class="middle" alt="<?php echo $detail->caseAuthor ?>" title="<?php echo $detail->caseAuthor ?>" src="<?php echo base_url();?>assets/images/avatar2.png" width="32" />
        &nbsp;
        <a href="#" class="sender"><?php echo $detail->caseAuthor ?></a>
        &nbsp;
        <i class="ace-icon fa fa-clock-o bigger-110 orange middle"></i>
        <span class="time grey"><? echo $detail->createdDate ?></span>
    </div>
    <div class="pull-right action-buttons">
        <a href="#" title="Comment">
            <i class="ace-icon fa fa-comment green icon-only bigger-130"></i>
        </a>
		<a href="#" title="Delete">
            <i class="ace-icon fa fa-trash-o red icon-only bigger-130"></i>
        </a>
    </div>
</div>
<div class="hr hr-double"></div>
<div class="message-body">
    <p>
        <? echo $detail->caseContent ?>
    </p>
</div>
<? if($detail->caseFile || $detail->caseImages) { ?>
<div class="hr hr-double"></div>
<div class="message-attachment clearfix">
    <div class="attachment-title">
        <span class="blue bolder bigger-110">Attachments</span>
    </div>
    &nbsp;
    <ul class="attachment-list pull-left list-unstyled">
        <? if($detail->caseFile) { ?><li>
            <a href="#" class="attached-file">
                <i class="ace-icon fa fa-file-o bigger-110"></i>
                <span class="attached-name"><? echo $detail->caseFile ?></span>
            </a>
            <span class="action-buttons">
                <a href="#">
                    <i class="ace-icon fa fa-download bigger-125 blue"></i>
                </a>
            </span>
        </li><? } ?>
    </ul>
</div>
<? } ?>
<?php if ($detail->caseType == "5") { ?>
<div class="hr hr-double"></div>
<form method="post" name="petisi_form">
<input type="hidden" name="ct" value="<? echo $detail->caseType ?>" />
<div class="row">
	<div class="col-xs-8">
    	<h4 class="blue">
            Total Signatures
        </h4>
        <p><i class="ace-icon fa fa-info-circle green"></i>
            Update : <? echo date("Y-m-d H:i");?>  </p>
        <div class="progress progress-striped pos-rel active">
            <div class="progress-bar progress-bar-success" style="width:<? echo (($count/$signparam->maxsign)*100) ?>%;"></div>
        </div>
         <span class="bigger-200 blue"><? echo $count ?></span>&nbsp;&nbsp;
         <span class="lead">Signatures from <? echo $signparam->maxsign ?></span>
     </div>
     <? if($casedetail < 1) {?>
     <div class="col-xs-12">
     <input type="submit" name="action" value="Sign" class="btn btn-lg btn-success" />
     </div>
     <? } ?>
</div>
</form>
<?php } ?>
<!-- START POLLING -->
<?php if ($detail->caseType == "4") { ?>
<div class="hr hr-double"></div>
<div class="row">
	<div class="col-xs-8">
    	<h4 class="blue">
            Polling Percentage
        </h4>
        <p><i class="ace-icon fa fa-info-circle green"></i>
            Update : <? echo date("Y-m-d H:i:");?> </p>
        <!-- START PERCENTAGE  -->
        <div id="chartContainer" style="height: 300px; width: 100%;"></div>   
        </div>
        <!-- END PERCENTAGE -->		
   </div>
</div>
<? if($casedetail < 1) {?>
<div class="hr hr-double"></div>
<form method="post" name="polling_form">
<input type="hidden" name="ct" value="<? echo $detail->caseType ?>" />
<div class="row">
	<div class="col-xs-12">
    <h4 class="blue">
            Polling : <? echo $detail->caseTitle ?>
     </h4>
      <p><i class="ace-icon fa fa-info-circle green"></i>
            please select your poll! </p>
     <?php for($j=0;$j<count($polldetail);$j++) { ?>
     <div class="radio">
        <label>
            <input name="pollingId" type="radio" class="ace" value="<? echo $polldetail[$j]['pollingId'] ?>" />
            <span class="lbl"> <? echo $polldetail[$j]['pollingValue'] ?></span>
        </label>
    </div>
    <? } ?>
    <input type="submit" name="action" value="Poll" class="btn btn-lg btn-success" />
    </div>
</div>
</form>
<? } ?>
<? } ?>
<!-- END POLLING -->
</div><!-- /.message-content -->
<div class="space-4"></div>
<?php if ($detail->caseType < "4") { ?>
    <!-- ($detail->caseType != "4" && $detail->caseType != "5") -->
<? for($i=0;$i<count($comment);$i++) { ?>
<!-- START REPLY -->
<div class="row">
    <div class="col-xs-12">
        <!-- START NAVBAR -->
        <div class="tab-content no-border no-padding">
            <div id="inbox" class="tab-pane in active">
                <div class="message-container">
                    <div id="id-message-item-navbar" class="message-navbar clearfix">
                        <div class="message-bar">
                            <div class="message-toolbar"></div>
                        </div>
                        <div>
                        <div class="messagebar-item-left">
                            <div class="pull-left">
                                <div class="space-4"></div>
                                &nbsp;
                                <img class="middle" alt="<? echo $comment[$i]['author'] ?>" title="<? echo $comment[$i]['author'] ?>" src="<?php echo base_url();?>assets/images/avatar2.png" width="32" />
                                &nbsp;
                                <a href="#" class="sender"><? echo $comment[$i]['author'] ?></a>
                                &nbsp;
                                <i class="ace-icon fa fa-clock-o bigger-110 orange middle"></i>
                                <span class="time grey"><? echo $comment[$i]['dateComment'] ?></span>
                            </div>
                        </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END NAVBAR-->
    </div>
</div>
<!-- START CONTENT COMMENT-->
<div class="message-content" id="id-message-content">
    <div class="message-body">
        <p><? echo $comment[$i]['comment'] ?></p>
    </div>
</div>
<!-- END CONTENT COMMENT-->
<!-- END REPLY-->
<div class="space-4"></div>
<? } ?>
    <div class="form-group">
    <form method="post" name="forum" enctype="multipart/form-data">
    <textarea name="comment" data-provide="markdown" data-iconlibrary="fa" rows="7"></textarea><br>
        <input type="submit" name="action" value="Submit" class="btn btn-primary" />
    </form>
    </div>
<div class="space-4"></div>
<?php } ?>