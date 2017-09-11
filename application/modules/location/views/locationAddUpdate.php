<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>
<div class="page-header">
    <h3>Location Management</h3>
</div><!-- /.page-header -->
<?php if ($_SERVER['PATH_INFO'] == "/location/create") { ?>
<script type="text/javascript">
$(document).ready(function(){
	$("#location_form").validate({
		errorElement: 'div',
		errorClass: 'help-block',
		rules: {
			locationname: {
				required:true
			}
		},
		messages : {
			locationname : {
				required : " Insert Location Name."
			}
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
<form method="post" id="location_form" name="location_form" class="form-horizontal" role="form">
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right">Location Name</label>
<div class="col-sm-9">
<input id="locationname" name="locationname" type="text" maxlength="20" class="col-xs-10 col-sm-5" value="" />
</div></div>

<div class="form-group">
<label class="col-sm-3 control-label no-padding-right">Location Coordinate</label>
<div class="col-sm-9">
<input id="locationgps" name="locationgps" type="text" maxlength="20" class="col-xs-10 col-sm-5" value="" />
</div></div>

<div class="clearfix form-actions">
    <div class="col-md-offset-3 col-md-9">
     <input type="submit" name="action" value="Save" class="btn btn-primary" />
<input type="button" value="Cancel" class="btn btn-primary" onclick="document.location.replace('<?php echo base_url();?>location');" />
</div></div>
</form>
<?php } else { ?>

<form method="post" id="location_form" name="location_form" class="form-horizontal" role="form">
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right">Location Name</label>
<div class="col-sm-9">
<input id="locationname" name="locationname" type="text" maxlength="20" class="col-xs-10 col-sm-5" value="<?php echo $detail->locationName ?>" />
</div></div>

<div class="form-group">
<label class="col-sm-3 control-label no-padding-right">Location Coordinate</label>
<div class="col-sm-9">
<input id="locationgps" name="locationgps" type="text" maxlength="20" class="col-xs-10 col-sm-5" value="<?php echo $detail->locationGPS ?>" />
</div></div>

<div class="clearfix form-actions">
    <div class="col-md-offset-3 col-md-9">
<input type="submit" name="action" value="Update" class="btn btn-primary" />
<input type="button" value="Cancel" class="btn btn-primary" onclick="document.location.replace('<?php echo base_url();?>location');" />
</div></div>
</form>
<?php } ?>
