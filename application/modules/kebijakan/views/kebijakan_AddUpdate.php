<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/daterangepicker.min.css" />
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/markdown.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/moment.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap-markdown.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.inputlimiter.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/daterangepicker.min.js"></script>
<div class="page-header">
  <h1><? echo $this->lang->line('header_kebijakan') ?></h1>
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
<?php if ($_SERVER['PATH_INFO'] == "/kebijakan/create") { ?>
<script type="text/javascript">
$(document).ready(function(){
	$("#newcase_form").validate({
		errorElement: 'div',
		errorClass: 'help-block',
		rules: {
			casetitle: { required:true }, caselocation: { required:true }
		},
		messages : {
			casetitle : { required : <? echo $this->lang->line('fld_req')."".$this->lang->line('field_kom1') ?> }, caselocation : { required : " Please select one." }
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
<form method="post" id="kebijakan_form" name="kebijakan_form" class="form-horizontal" role="form" enctype="multipart/form-data" >
<input type="hidden" name="casestate" value="4" />
<input type="hidden" name="casetype" value="3" />
 <div class="form-group">
    <label class="col-sm-3 control-label no-padding-right"><? echo $this->lang->line('field_kebijakan1') ?></label>
    <div class="col-sm-9">
      <input id="casetitle" name="casetitle" type="text" maxlength="20" class="col-xs-10 col-sm-5" value="" />
    </div>
  </div>
  <div class="form-group">
   <label class="col-sm-3 control-label no-padding-right"><? echo $this->lang->line('field_kebijakan2') ?></label>
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
    <label class="col-sm-3 control-label no-padding-right"><? echo $this->lang->line('field_kebijakan3') ?></label>
    <div class="col-sm-9">
      <?php $extra = array('class' => 'input-medium'); echo form_dropdown("caselocation",$getlocation,"",$extra) ?>
    </div>
  </div>
  <div class="hr hr-16 hr-dotted"></div>
  <div class="form-group">
    <label class="col-sm-3 control-label no-padding-right"><? echo $this->lang->line('field_kebijakan4') ?></label>
    <div class="col-sm-9">
      <textarea class="col-xs-10 col-sm-5 limited" id="caseheader" name="caseheader" maxlength="200"></textarea>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-3 control-label no-padding-right"><? echo $this->lang->line('field_kebijakan5') ?></label>
    <div class="col-xs-10 col-sm-5">
      <input type="file" id="caseFile" name="caseFile" />
    </div>
  </div>
  <div class="hr hr-16 hr-dotted"></div>
  <div class="form-group">
    <div class="col-md-offset-3 col-md-9">
      <input type="submit" name="action" value="Submit" class="btn btn-primary" />
      &nbsp; &nbsp; &nbsp;
      <input type="button" value="Cancel" class="btn btn-primary" onclick="document.location.replace('<?php echo base_url();?>kebijakan');" />
    </div>
  </div>
</form>
<?php } elseif($_SERVER['PATH_INFO'] == "/kebijakan/update/$detail->caseId" && $detail->caseApproval == 1) { ?>
<form method="post" id="newcase_form" name="newcase_form" class="form-horizontal" role="form">
  <input type="hidden" name="id" value="<?php echo $detail->caseId ?>" />
  <input type="hidden" name="casestate" value="<?php echo $detail->caseState ?>" />
  <input type="hidden" name="casetype" value="<?php echo $detail->caseType ?>" />
  <div class="form-group">
    <label class="col-sm-3 control-label no-padding-right"><? echo $this->lang->line('field_kebijakan1') ?></label>
    <div class="col-sm-9">
      <input id="casetitle" name="casetitle" type="text" maxlength="20" class="col-xs-10 col-sm-5" value="<? echo $detail->caseTitle ?>" />
    </div>
  </div>
  <div class="form-group">
   <label class="col-sm-3 control-label no-padding-right"><? echo $this->lang->line('field_kebijakan2') ?></label>
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
    <label class="col-sm-3 control-label no-padding-right"><? echo $this->lang->line('field_kebijakan3') ?></label>
    <div class="col-sm-9">
      <?php $extra = array('class' => 'input-medium'); echo form_dropdown("caselocation",$getlocation,$detail->caseLocation,$extra) ?>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-3 control-label no-padding-right"><? echo $this->lang->line('field_kebijakan4') ?></label>
    <div class="col-sm-9">
      <textarea class="col-xs-10 col-sm-5 limited" id="caseheader" name="caseheader" maxlength="200"><? echo $detail->caseHeader ?></textarea>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-3 control-label no-padding-right"><? echo $this->lang->line('field_kebijakan4') ?></label>
    <div class="col-xs-10 col-sm-5">
      <input type="file" id="caseFile" name="caseFile" />
    </div>
  </div>
  <div class="hr hr-16 hr-dotted"></div>
  <div class="clearfix form-actions">
    <div class="col-md-offset-3 col-md-9">
      <input type="submit" name="action" value="Submit" class="btn btn-primary" />
      &nbsp; &nbsp; &nbsp;
      <input type="button" value="Cancel" class="btn btn-primary" onclick="document.location.replace('<?php echo base_url();?>kebijakan');" />
    </div>
  </div>
</form>
<? } else { ?>
<div class="col-sm-10 col-sm-offset-1">
	<div class="widget-box transparent">
		<div class="widget-header widget-header-large">
			<h3 class="widget-title grey lighter">
				<i class="ace-icon fa fa-leaf green"></i>
				<? echo $detail->caseTitle ?>
			</h3>
            <div class="widget-toolbar no-border invoice-info">
                <span class="invoice-info-label"><? echo $this->lang->line('list_kebijakan3') ?> :</span>
                <span class="red"><? echo $detail->caseAuthor ?></span>

                <br />
                <span class="invoice-info-label"><? echo $this->lang->line('field_kebijakan2') ?> :</span>
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
                                <i class="ace-icon fa fa-caret-right blue"></i><? echo $this->lang->line('field_kebijakan3') ?> : <b class="red"><? echo $detail->locationName ?></b>
                            </li>
                            <li>
                                <i class="ace-icon fa fa-caret-right blue"></i><? echo $this->lang->line('field_kebijakan4') ?> : <b class="red"><? echo $detail->caseHeader ?></b>
                            </li>
                         </ul>
                    </div>
                </div><!-- /.col -->
         	</div><!-- /.row -->
            <div class="space"></div>
            <h3 class="header smaller lighter blue">
                <i class="ace-icon fa fa-leaf green"></i> Detail
            </h3>
            <p><? echo $detail->caseContent ?></p>
        </div>
        </div>
        <div class="hr hr-16 hr-dotted"></div>
          <div class="clearfix ">
            <div class="col-md-offset-3 col-md-9">
              <input type="button" value="Cancel" class="btn btn-primary" onclick="document.location.replace('<?php echo base_url();?>kebijakan');" />
            </div>
          </div>
    </div>
</div>
<? } ?>
