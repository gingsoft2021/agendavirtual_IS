<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Agenda Academica</title>
  <script src="<?php echo base_url();?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/iCheck/square/blue.css">


</head>

<body style="background:#4b6cb7;
background: -webkit-linear-gradient(to right, #182848, #4b6cb7);
background: linear-gradient(to right, #182848, #4b6cb7); ">
<div class="login-box">


  <div class="login-box-body">
      <div class="login-logo" style="float:left;margin-left: 100px; margin-top: 20px;">
    <img src="<?php echo base_url();?>assets/img/servicio-420.png" style="max-width: 240px;width:100%;" alt="">


  </div>
      <div style="height: 50px;"></div>
  <div class="row" style="float:left; text-align: center; align-content:center; margin-left: 200px; border: #ffffff;"> 
      <h2><span style="color:white;">Iniciar sesión</span></h2>

    <form action="<?php echo base_url();?>C_Login/ingresar" method="POST" id="login_usuarios" name="login_usuarios">

      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="nombre_usu" id="nombre_usu" autofocus placeholder="Nombre de Usuario">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
     </div>

       <span class="hide" id="msg_pn" style="color:red;">Este campo no puede quedar en blanco</span>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="pass_usu" id="pass_usu" placeholder="Contraseña">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        <span class="hide" id="msg_pn" style="color:red;">Este campo no puede quedar en blanco</span>
      </div>
        <span style="color:red;" ><?php echo $mensaje ?></span>
      <div class="row">
        <!--<div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <a href="#">He olvidado mi Contraseña</a><br>
            </label>
          </div>
        </div> -->

        <!-- /.col -->
        <div class="col-xs-6" style="margin-left: 50px;">
          <input type="submit" class="btn btn-primary btn-block btn-flat" value="Ingresar" name="Ingresar" id="Ingresar">
        </div>
        <!-- /.col -->
      </div>
    </form>
  </div>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url();?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?php echo base_url();?>assets/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>
