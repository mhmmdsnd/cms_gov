<?php  defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <meta charset="utf-8" />
    <title><?php echo $title;?></title>
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?php echo base_url();?>assets/font-awesome/4.5.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/fonts.googleapis.com.css" />
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/ace-skins.min.css" />
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/ace-rtl.min.css" />
	<!--[if lte IE 9]>
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
          <link rel="stylesheet" href="<?php echo base_url();?>assets/css/ace-ie.min.css" />
    <![endif]-->
    <script src="<?php echo base_url();?>assets/js/ace-extra.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/jquery-2.1.4.min.js"></script>
	<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='<?php echo base_url();?>assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
	</script>
	<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/ace-elements.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/ace.min.js"></script>
	<!--[if lte IE 8]>
    <script src="<?php echo base_url();?>assets/js/html5shiv.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/respond.min.js"></script>
    <![endif]-->
    <? 	$session = $this->session->userdata('logged_in'); ?>
</head>
<body class="no-skin">
<!-- START NAVBAR HEADER -->
<div id="navbar" class="navbar navbar-default ace-save-state">
    <div class="navbar-container ace-save-state" id="navbar-container">
        <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
            <span class="sr-only">Toggle sidebar</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <div class="navbar-header pull-left">
            <a href="/" class="navbar-brand">
                <small><i class="fa fa-leaf"></i>eParticipation</small>
            </a>
        </div>
        <div class="navbar-buttons navbar-header pull-right" role="navigation">
            <ul class="nav ace-nav">
                <li class="light-blue dropdown-modal">
                    <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                        <img class="nav-user-photo" src="<?php echo base_url();?>assets/images/avatar2.png" alt="" />
                        <span class="user-info">
                            <small>Welcome, </small><? echo $session['loginname'] ?></span>
                        <i class="ace-icon fa fa-caret-down"></i>
                    </a>
                    <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                        <li>
                            <a href="<?php echo base_url();?>cpanel/logout"><i class="ace-icon fa fa-power-off"></i> Logout </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div><!-- /.navbar-container -->
</div>
<!-- END NAVBAR HEADER -->
<!-- START NAVBAR SIDEBAR -->
<div class="main-container ace-save-state" id="main-container">
    <script type="text/javascript">
        try{ace.settings.loadState('main-container')}catch(e){}
    </script>
	<!-- START NAVBAR SIDEBAR -->
    <div id="sidebar" class="sidebar responsive ace-save-state">
        <script type="text/javascript">
            try{ace.settings.loadState('sidebar')}catch(e){}
        </script>

        <ul class="nav nav-list">
            <li class="">
                <a href="<?php echo base_url(); ?>cpanel">
                    <i class="menu-icon fa fa-tachometer"></i>
                    <span class="menu-text"> Dashboard </span>
                </a>
                <b class="arrow"></b>
            </li>
            <?php 
                //$session = $this->session->userdata('logged_in');
                $groupId = $session['groupId'];
                
                //$tt = str_replace("/","",$_SERVER['REQUEST_URI']);
                $multilevel = $this->groupuser_model->all_menu($parent=0,$groupId);
                //recursive menu
                function print_recursive_menu($data)
                {
                    $str = "";
					$tt = str_replace("/","",$_SERVER['REQUEST_URI']);
                    foreach($data as $list)
                    {
                        if($tt == $list['moduleUrl']) $str .="<li class='active'>";
                        else $str .="<li class=''>";
                        $str .= "<a href=".base_url()."".$list['moduleUrl'].">";
                        $str .= "<i class='menu-icon fa fa-caret-right'></i> ".$list['menuName']."</a><b class='arrow'></b>";
                        $subchild = print_recursive_menu($list['parentId']);
                        if($subchild != '')
                            $str .= "<ul class=submenu>".$subchild."</ul>";
                        $str .= "</li>";
                    }
                    return $str;
                }
                foreach ($multilevel as $data)
                 {
                     echo '<li class="active open">';
                     echo '<a href="#" class="dropdown-toggle"><i class="menu-icon fa fa-desktop"></i>';
                     echo '<span class="menu-text">'.$data['menuName'].'</span><b class="arrow fa fa-angle-down"></b></a><b class="arrow"></b>';
                     echo '<ul class="submenu">';
                     echo print_recursive_menu($data['parentId']);
                     echo '</ul>';
                 }
            ?>
            </ul>
        <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
            <i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
        </div>
    </div>
    <!-- END NAVBAR SIDEBAR-->
	<!-- MAINBAR -->
    <div class="main-content">
        <div class="main-content-inner">
            <div class="breadcrumbs ace-save-state" id="breadcrumbs">
                <ul class="breadcrumb">
                    <li>
                        <i class="ace-icon fa fa-home home-icon"></i>
                        <a href="#">Home</a>
                    </li>
                    <li class="active"><?php echo $title;?></li>
                </ul>
            </div>
            <div class="page-content">
                <div class="row">
                    <div class="col-xs-12">
                         <?php echo $contents; ?>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.page-content -->
        </div>
    </div><!-- END MAINBAR -->
</div><!-- /.main-container -->
</body>
</html>
