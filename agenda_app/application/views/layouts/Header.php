<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Agenda Docente</title>
  <!-- Bootstrap Core CSS -->
  <link href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- MetisMenu CSS -->
  <link href="<?php echo base_url();?>assets/metisMenu/metisMenu.min.css" rel="stylesheet">
  <!-- Social Buttons CSS -->
  <link href="<?php echo base_url();?>assets/bootstrap-social/bootstrap-social.css" rel="stylesheet">
  <!-- Custom CSS -->
  <link href="<?php echo base_url();?>assets/css/sb-admin-2.css" rel="stylesheet">
  <!-- Custom Fonts -->
  <link href="<?php echo base_url();?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>
<link href="<?php echo base_url();?>assets/img/logo-32.ico" type="image/x-icon" rel="shortcut icon" />
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <body>
   <!-- <?php var_dump($_SESSION);   ?>   -->
      <div id="wrapper">

          <!-- Navigation -->
          <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
              <div class="navbar-header">
                  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                      <span class="sr-only">Toggle navigation</span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                  </button>
                  <a><img src="<?php echo base_url();?>assets/img/logo-4.png"></a>
              </div>
              <!-- /.navbar-header -->

              <ul class="nav navbar-top-links navbar-right">

                  <li class="dropdown">
                      <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                          <i class="fa fa-user fa-fw"></i>
                          <span class="hidden-xs"><?php echo $this->session->userdata('s_usuario'); ?></span>
                          <i class="fa fa-caret-down"></i>
                      </a>
                      <ul class="dropdown-menu dropdown-user">
                          <li><a href="<?php echo base_url();?>C_Perfil"><i class="fa fa-user fa-fw"></i>Perfil</a>
                          </li>
                          <li><a href="#"><i class="fa fa-gear fa-fw"></i>Opciones</a>
                          </li>
                          <li class="divider"></li>
                          <li><a id="salir" href=" <?php  echo base_url('index.php/C_Login/salir'); ?>"><i class="fa fa-sign-out fa-fw"></i>Salir</a>
                          </li>
                      </ul>
                      <!-- /.dropdown-user -->
                  </li>
                  <!-- /.dropdown -->
                  <li class="dropdown">
                   <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                   <i class="fa fa-fw fa-university"> </i>
                   <span><?php echo $this->session->userdata('sucursal');?></span>
                   </a>
                  </li>
              </ul>
              <!-- /.navbar-top-links -->
            
     <div class="row" id="flashMessage">
<?php
if ($this->session->flashdata("flashError")) {
?>
<br/>
<div class="alert alert-danger alert-dismissable" style="margin-left: 30px;margin-top: 50px; width: 400px;">
<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>

<p><?php echo $this->session->flashdata("flashError"); ?>.</p>
</div>
<?php
}
if ($this->session->flashdata("flashSuccess")) {
?>
<br/>
<div class="alert alert-success alert-dismissable" style="float:left;margin-left: 0px;margin-top: 50px; width: 300px;">
<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>

<p><?php echo $this->session->flashdata("flashSuccess"); ?>.</p>
</div>
<?php
}
?>
<?php
if ($this->session->flashdata("emailSuccess")) {
?>
<br/>
<div class="alert alert-success alert-dismissable" style="float:left;margin-left: 50px;margin-top: 30px; width: 400px;">
<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>

<p><?php echo $this->session->flashdata("emailSuccess"); ?>.</p>
</div>
<?php
}
?>


</div>
