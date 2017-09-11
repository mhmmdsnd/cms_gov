<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/daterangepicker.min.css" />
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/markdown.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/moment.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap-markdown.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.inputlimiter.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/daterangepicker.min.js"></script>
<div class="page-header">
  <h1>Topic Dialog Wizard</h1>
</div>
<!-- /.page-header -->
<script type="text/javascript">
$(document).ready(function(){
	image_ext = ["jpeg", "jpg", "png", "gif" , "bmp"];
	doc_ext = ["doc","pdf","docx"];
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
});
</script>
<?php if ($_SERVER['PATH_INFO'] == "/dialog/create") { ?>
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
<form method="post" id="dialog_form" name="dialog_form" class="form-horizontal" role="form" enctype="multipart/form-data" >
<input type="hidden" name="casestate" value="4" />
<input type="hidden" name="casetype" value="2" />
 <div class="form-group">
    <label class="col-sm-3 control-label no-padding-right">Topic Dialog Title</label>
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
  <div class="hr hr-16 hr-dotted"></div>
  <div class="form-group">
    <div class="col-md-offset-3 col-md-9">
      <input type="submit" name="action" value="Submit" class="btn btn-primary" />
      &nbsp; &nbsp; &nbsp;
      <input type="button" value="Cancel" class="btn btn-primary" onclick="document.location.replace('<?php echo base_url();?>newcase');" />
    </div>
  </div>
</form>
<?php } else { ?>
<form method="post" id="newcase_form" name="newcase_form" class="form-horizontal" role="form">
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
  <div class="hr hr-16 hr-dotted"></div>
  <div class="clearfix form-actions">
    <div class="col-md-offset-3 col-md-9">
      <input type="submit" name="action" value="Submit" class="btn btn-primary" />
      &nbsp; &nbsp; &nbsp;
      <input type="button" value="Cancel" class="btn btn-primary" onclick="document.location.replace('<?php echo base_url();?>newcase');" />
    </div>
  </div>
</form>
<? } ?>
