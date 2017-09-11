<script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.maskedinput.min.js"></script>
<div class="page-header">
  <h1>Cases Parameter</h1>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$.mask.definitions['~']='[+-]';
	$('#maxsign').mask('99999');
	$('#debate').mask('999999');

	jQuery.validator.addMethod("maxsign", function (value, element) {
	return this.optional(element) || /^\(\d{5}\) ( x\d{1,6})?$/.test(value);
	}, "Enter a valid number.");
	jQuery.validator.addMethod("debate", function (value, element) {
	return this.optional(element) || /^\(\d{6}\) ( x\d{1,6})?$/.test(value);
	}, "Enter a valid number.");

	$("#parameter_form").validate({
		errorElement: 'div',
		errorClass: 'help-block',
		rules: {
			maxsign: { required:true }, debate: { required:true }
		},
		messages : {
			maxsign : { required : " Insert Max Signature for Petitions." }, debate : { required : " Insert Max Signature for Petitions (Debate)." }
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
<form method="post" id="parameter_form" name="parameter_form" class="form-horizontal" role="form" enctype="multipart/form-data" >
  <input type="hidden" name="parameterId" value="<? echo $getparam->parameterId ?>" />
 	<h4 class="blue">
        <i class="ace-icon fa fa-check bigger-110"></i>
        Petitions
    </h4>
  	<div class="form-group">
    	<label class="col-sm-3 control-label no-padding-right">Petition Max. Signature</label>
    	<div class="col-sm-9">
      <input id="maxsign" name="maxsign" type="text" maxlength="20" class="col-xs-10 col-sm-5" value="<? echo $getparam->maxsign ?>" />
    	</div>
   </div>
  <div class="form-group">
    	<label class="col-sm-3 control-label no-padding-right">Petition Max. Signature (Debate)</label>
    	<div class="col-sm-9">
      <input id="debate" name="debate" type="text" maxlength="20" class="col-xs-10 col-sm-5" value="<? echo $getparam->debate ?>" />
    	</div>
   </div>
  <div class="hr hr-double"></div>
  <div class="form-group">
    <div class="col-md-offset-3 col-md-9">
      <input type="submit" name="action" value="Submit" class="btn btn-primary" />
      &nbsp; &nbsp; &nbsp;
      <input type="button" value="Cancel" class="btn btn-primary" onclick="document.location.replace('<?php echo base_url();?>newcase');" />
    </div>
  </div>
</form>