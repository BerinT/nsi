
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Planer odmora</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url();?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url();?>assets/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="<?php echo base_url();?>assets/dist/css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url();?>assets/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="<?php echo base_url();?>assets/bower_components/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url();?>assets/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">


	<link rel="stylesheet" href="<?php echo base_url();?>assets/bootstrap-calendar/css/calendar.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	
	
	 <!-- jQuery -->
    <script src="<?php echo base_url();?>assets/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url();?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url();?>assets/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <!--<script src="<?php echo base_url();?>assets/bower_components/raphael/raphael-min.js"></script>
    <script src="<?php echo base_url();?>assets/bower_components/morrisjs/morris.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/morris-data.js"></script>-->

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url();?>assets/dist/js/sb-admin-2.js"></script>
	
	<script type="text/javascript" src="<?php echo base_url();?>assets/bootstrap-calendar/components/underscore/underscore-min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/bootstrap-calendar/components/bootstrap2/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/bootstrap-calendar/components/jstimezonedetect/jstz.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/bootstrap-calendar/js/calendar.min.js"></script>
	
	<!-- Registracija novog korisnika -->
	<link href="<?php echo base_url();?>assets/css/register.css" rel="stylesheet">

	
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-static-top" role="navigation" style="margin-bottom: 0">
		
			 <div class="container">
	  
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
		  
					<a class="navbar-brand" ><?php echo "Dobrodošao ".$this->session->userdata('username');?></a>
				</div>
		
		
				<div id="navbar" class="collapse navbar-collapse navbar-right">
				  <ul class="nav navbar-nav">
					<li class="active"><a href="<?php echo base_url();?>index.php/user/login">Home</a></li>
					<li><a href="#about">About</a></li>
					<li><a href="#contact">Contact</a></li>
					<li><a href="<?=site_url('user/logout')?>" style="float:left;">Logout</a></li>
				  </ul>
				</div><!--/.nav-collapse -->
			</div>
            <!-- /.navbar-header -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        
                        <li>
                            <a href="<?php echo base_url();?>index.php/user/dodaj_korisnika"><i class="fa fa-male fa-fw"></i> Dodaj korisnika</a>
                        </li>
						
                        <li>
                            <a href="<?php echo base_url();?>index.php/user/vidi_sve_korisnike"><i class="fa fa-list-alt fa-fw"></i> Vidi sve korisnike</a>
                        </li>
						
						<li>
                            <a href="<?php echo base_url();?>index.php/user/vidi_korisnike_na_odmoru"><i class="fa fa-calendar-o fa-fw"></i> Vidi sve korisnike na odmoru</a>
                        </li>
						
						<li>
                            <a href="<?php echo base_url();?>index.php/user/vidi_zahtjeve_na_cekanju"><i class="fa fa-clock-o fa-fw"></i> Zahtjevi na cekanju</a>
                        </li>
						
						
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
