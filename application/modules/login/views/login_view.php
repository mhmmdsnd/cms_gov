<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
<title>Login</title>
<style type="text/css">
#loading{
	visibility:hidden;
}
</style>
<link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/fonts.googleapis.com.css" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/cms_v7.css" />
<!-- Javascript -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/ajaxSubmit.js"></script>
<body class="login-layout">
<div class="container">
        <div class="card card-container">
            <img id="profile-img" class="profile-img-card" src="<?php echo base_url();?>assets/images/avatar_2x.png" />
            <p id="profile-name" class="profile-name-card"></p>
             <form class="form-signin" id="login" method="post">
                <span id="reauth-email" class="reauth-email"></span>
                <input type="text" id="loginname" name="loginname" class="form-control" placeholder="Email address" required autofocus>
                <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
                <button class="btn btn-lg btn-primary btn-block btn-signin" id="action" type="submit">Sign in</button>
				<div id="error" align="center">&nbsp;</div>
            </form><!-- /form -->
        </div><!-- /card-container -->
    </div><!-- /container -->
</body>
</html>
