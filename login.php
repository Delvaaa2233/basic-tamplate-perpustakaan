<?php
include "inc/koneksi.php";
   
?>


<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Login | SI Perpustakaan</title>
	<link rel="icon" href="dist/img/logosmp2.png">
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.6 -->
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="dist/css/AdminLTE.min.css">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <!-- Background image -->
			 <style>
  body {
    background-image: url('dist/img/smp.png') !important;
    background-size: cover !important;
    background-repeat: no-repeat !important;
    background-position: center !important;
    }
 .login-box-body {
  background: rgba(255, 255, 255, 0.01); /* transparan tipis */
  border: 1px solid rgba(255, 255, 255, 0.3); /* garis batas halus */
  border-radius: 12px;
  padding: 30px;
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
  backdrop-filter: blur(8px);
  transition: all 0.3s ease-in-out;
  color: #fff;
}

    .login-box-body input {
  background: rgba(0, 0, 0, 0.3);
  color: #fff;
  border: none;
}

.login-box-body input::placeholder {
  color: #ddd;
}

</style>
			
</head>

<body class="hold-transition login-page">
	<div class="login-box">
		<div class="login-logo">
			<h3>
				<font color="green">
					<b>SMPN 2 AMPEK ANGKEK</b>
				</font>
			</h3>
			</a>
		</div>
		<!-- /.login-logo -->
		<div class="login-box-body">
			<center>
				<img src="dist/img/logosmp2.png" width=160px />
			</center>
			<br>
			<p class="login-box-msg" style="color: black;">LOGIN PERPUSTAKAAN</p>
			<form action="#" method="post">
				<div class="form-group has-feedback">
					<input type="text" class="form-control" name="username" placeholder="Username" required>
					<span class="glyphicon glyphicon-user form-control-feedback"></span>
				</div>
				<div class="form-group has-feedback">
					<input type="password" class="form-control" name="password" placeholder="Password" required>
					<span class="glyphicon glyphicon-lock form-control-feedback"></span>
				</div>
				<div class="row">
					<div class="col-xs-8">

					</div>
					<!-- /.col -->
					<div class="row">
 						 <div class="col-xs-12" style="text-align: center;">
    					<button type="submit" class="btn btn-success btn-flat" name="btnLogin" title="Masuk Sistem" style="width: 100px;">
      					<b>Masuk</b>
    					</button>
  						</div>
					</div>
					<!-- /.col -->
				</div>
			</form>
			<!-- /.social-auth-links -->

		</div>
		<!-- /.login-box-body -->
	</div>
	<!-- /.login-box -->

	<!-- jQuery 2.2.3 -->
	<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
	<!-- Bootstrap 3.3.6 -->
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<!-- iCheck -->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
	<!-- sweet alert -->
</body>

</html>


<?php 
include "inc/koneksi.php";

		if (isset($_POST['btnLogin'])) {  
		
		

			$username=mysqli_real_escape_string($koneksi,$_POST['username']);
			$password=mysqli_real_escape_string($koneksi,md5($_POST['password']));


		$sql_login = "SELECT * FROM tb_pengguna WHERE BINARY username='$username' AND password= '$password'";
		$query_login = mysqli_query($koneksi, $sql_login);
		$data_login = mysqli_fetch_array($query_login,MYSQLI_BOTH);
		$jumlah_login = mysqli_num_rows($query_login);
        

            if ($jumlah_login == 1 ){
              session_start();
              $_SESSION["ses_id"]=$data_login["id_pengguna"];
              $_SESSION["ses_nama"]=$data_login["nama_pengguna"];
              $_SESSION["ses_username"]=$data_login["username"];
              $_SESSION["ses_password"]=$data_login["password"];
              $_SESSION["ses_level"]=$data_login["level"];
			  $_SESSION["nama"] = $data_login["nama_pengguna"];
			  
                
              echo "<script>
                    Swal.fire({title: 'Login Berhasil',
						text: '',
						icon: 'success',
						confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.value) {
                            window.location = 'index.php';
                        }
                    })</script>";
              }else{
              echo "<script>
                    Swal.fire({title: 'Login Gagal',
						text: '',
						icon: 'error',
						confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.value) {
                            window.location = 'login.php';
                        }
                    })</script>";
                }
			  }
