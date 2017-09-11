 <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-datepicker3.min.css" />
<script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.maskedinput.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$.mask.definitions['~']='[+-]';
	$('#phone').mask('(9999) 9999-9999');

	jQuery.validator.addMethod("phone", function (value, element) {
	return this.optional(element) || /^\(\d{4}\) \d{4}\-\d{4}( x\d{1,6})?$/.test(value);
	}, "Enter a valid phone number.");

	$('.date-picker').datepicker({
			autoclose: true,
			todayHighlight: true
	})
	//show datepicker when clicking on the icon
	.next().on(ace.click_event, function(){
		$(this).prev().focus();
	});
});
</script>
<div class="page-header">
    <h1>User Management</h1>
</div><!-- /.page-header -->
<?php if ($_SERVER['REQUEST_URI'] == "/user/create") { ?>
<script type="text/javascript">
$(document).ready(function(){
	$("#user_form").validate({
		errorElement: 'div',
		errorClass: 'help-block',
		rules: {
			loginname: { required:true },
			password : {
				required:true,
				minlength:4
			},
			repassword : {
				required: true,
				equalTo: "#password"
			},
			nik : { required:true },
			firstname : { required:true },
			lastname : { required:true },
			email : {required : true, email : true }, 
			dob : {required : true},
			phone: {
				required: true,
				phone: 'required'
			}
		},
		messages : {
			loginname : {
				required : " Insert Loginname."
			},password : {
				required : " Insert Password.",
				minlength : " Password is too short."
			},
			repassword : {
				required : " Repeat Password.",
				equalTo : " Password is not match."
			},
			email: {
				required: "Please provide a valid email.",
				email: "Please provide a valid email."
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
<form method="post" id="user_form" name="user_form" class="form-horizontal" role="form">
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right">NIK</label>
<div class="col-sm-9">
<input id="nik" name="nik" type="text" maxlength="12" class="col-xs-10 col-sm-5" value="" /><br>
</div></div>

<div class="form-group">
<label class="col-sm-3 control-label no-padding-right">First Name</label>
<div class="col-sm-9">
<input id="firstname" name="firstname" type="text" maxlength="20" class="col-xs-10 col-sm-5" value="" />
</div></div>

<div class="form-group">
<label class="col-sm-3 control-label no-padding-right">Last Name</label>
<div class="col-sm-9">
<input id="lastname" name="lastname" type="text" maxlength="20" class="col-xs-10 col-sm-5" value="" />
</div></div>

<div class="form-group">
<label class="col-sm-3 control-label no-padding-right">Email</label>
<div class="col-sm-9">
<input id="email" name="email" type="text" maxlength="100" class="col-xs-10 col-sm-5" value="" />
</div></div>

<div class="form-group">
<label class="col-sm-3 control-label no-padding-right">Date of Birth</label>
<div class="col-sm-9">
    <div class="input-group">
    	<span class="input-group-addon">
            <i class="fa fa-calendar"></i>
        </span>
        <input class="col-xs-10 col-sm-5 date-picker" readonly="readonly" id="dob" name="dob" type="text" data-date-format="dd-mm-yyyy" />
    </div>
</div></div>

<div class="form-group">
<label class="col-sm-3 control-label no-padding-right">Phone</label>
<div class="col-sm-9">
	<div class="input-group">
		<span class="input-group-addon">
            <i class="fa fa-phone"></i>
        </span>
        <input id="phone" name="phone" type="text" maxlength="100" class="col-xs-10 col-sm-5" value="" />
    </div>
</div></div>

<div class="hr hr-16 hr-dotted"></div>
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right">Login Name</label>
<div class="col-sm-9">
<input id="loginname" name="loginname" type="text" maxlength="20" class="col-xs-10 col-sm-5" value="" /><br>
</div></div>

<div class="form-group">
<label class="col-sm-3 control-label no-padding-right">Password</label>
<div class="col-sm-9">
<input id="password" name="password" type="password" maxlength="20" class="col-xs-10 col-sm-5" value="" /><br>
</div></div>

<div class="form-group">
<label class="col-sm-3 control-label no-padding-right">Confirm Password</label>
<div class="col-sm-9">
<input id="repassword" name="repassword" type="password" maxlength="20" class="col-xs-10 col-sm-5" value="" /><br>
</div></div>

<div class="hr hr-16 hr-dotted"></div>
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right">Group</label>
<div class="col-sm-9">
<?php $extra = array('class' => 'input-medium'); echo form_dropdown("groupId",$getgroup,'',$extra) ?>
</div></div>

<div class="clearfix form-actions">
    <div class="col-md-offset-3 col-md-9">
        <input type="submit" name="action" value="Save" class="btn btn-primary" />
		&nbsp;&nbsp;&nbsp;
        <input type="button" value="Cancel" class="btn btn-primary" onclick="document.location.replace('<?php echo base_url();?>user');" />
</div></div>
</form>

<?php } else { ?>
<script type="text/javascript">
$(document).ready(function(){
	$("#user_form").validate({
		errorElement: 'div',
		errorClass: 'help-block',
		rules: {
			loginname: { required:true },
			password : {
				required:false,
				minlength:4
			},
			repassword : {
				required: false,
				equalTo: "#password"
			},
			nik : { required:true },
			firstname : { required:true },
			lastname : { required:true },
			email : {required : true, email : true }, 
			dob : {required : true},
			phone: {
				required: true,
				phone: 'required'
			}
		},
		messages : {
			loginname : {
				required : " Insert Loginname."
			},password : {
				required : " Insert Password.",
				minlength : " Password is too short."
			},
			repassword : {
				required : " Repeat Password.",
				equalTo : " Password is not match."
			},
			email: {
				required: "Please provide a valid email.",
				email: "Please provide a valid email."
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
<form method="post" id="user_form" name="user_form" class="form-horizontal" role="form">
<input type="hidden" name="id" value="<?php echo $detail->id ?>" />
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right">NIK</label>
<div class="col-sm-9">
<input id="nik" name="nik" type="text" maxlength="12" class="col-xs-10 col-sm-5" value="" /><br>
</div></div>

<div class="form-group">
<label class="col-sm-3 control-label no-padding-right">First Name</label>
<div class="col-sm-9">
<input id="firstname" name="firstname" type="text" maxlength="20" class="col-xs-10 col-sm-5" value="<?php echo $detail->firstname ?>" />
</div>
</div>

<div class="form-group">
<label class="col-sm-3 control-label no-padding-right">Last Name</label>
<div class="col-sm-9">
<input id="lastname" name="lastname" type="text" maxlength="20" class="col-xs-10 col-sm-5" value="<?php echo $detail->lastname ?>" />
</div></div>

<div class="form-group">
<label class="col-sm-3 control-label no-padding-right">Email</label>
<div class="col-sm-9">
<input id="email" name="email" type="text" maxlength="100" class="col-xs-10 col-sm-5" value="" />
</div></div>

<div class="form-group">
<label class="col-sm-3 control-label no-padding-right">Date of Birth</label>
<div class="col-sm-9">
    <div class="input-group">
    	<span class="input-group-addon">
            <i class="fa fa-calendar"></i>
        </span>
        <input class="col-xs-10 col-sm-5 date-picker" id="dob" name="dob" type="text" data-date-format="dd-mm-yyyy" />
    </div>
</div></div>

<div class="form-group">
<label class="col-sm-3 control-label no-padding-right">Phone</label>
<div class="col-sm-9">
	<div class="input-group">
		<span class="input-group-addon">
            <i class="fa fa-phone"></i>
        </span>
        <input id="phone" name="phone" type="text" maxlength="100" class="col-xs-10 col-sm-5" value="" />
    </div>
</div></div>

<div class="hr hr-16 hr-dotted"></div>
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right">Login Name</label>
<div class="col-sm-9">
<input id="loginname" name="loginname" type="text" maxlength="20" class="col-xs-10 col-sm-5" value="<?php echo $detail->loginname ?>" />
</div></div>

<div class="form-group">
<label class="col-sm-3 control-label no-padding-right">Password</label>
<div class="col-sm-9">
<input id="password" name="password" type="password" maxlength="20" class="col-xs-10 col-sm-5" value="" />
</div></div>

<div class="form-group">
<label class="col-sm-3 control-label no-padding-right">Confirm Password</label>
<div class="col-sm-9">
<input id="repassword" name="repassword" type="password" maxlength="20" class="col-xs-10 col-sm-5" value="" /><br>
</div></div>

<div class="hr hr-16 hr-dotted"></div>
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right">Group</label>
<div class="col-sm-9">
<?php $extra = array('class' => 'input-medium'); echo form_dropdown("groupId",$getgroup,$detail->groupId,$extra) ?>
</div></div>

<div class="clearfix form-actions">
    <div class="col-md-offset-3 col-md-9">
        <input type="submit" name="action" value="Update" class="btn btn-primary" />
        &nbsp; &nbsp; &nbsp;
        <input type="button" value="Cancel" class="btn btn-primary" onclick="document.location.replace('<?php echo base_url();?>user');" />
    </div>
</div>
</form>
<?php } ?>
