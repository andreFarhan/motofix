<?php 
	include 'functions.php';

	if (isset($_POST['login'])) {
		$username = $_POST['username'];
		$password = $_POST['password'];

		$eksekusi = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE username = '$username'");
		$data 		= mysqli_fetch_array($eksekusi);

		if ($data) {
			if (password_verify($password, $data['password'])) {

				$id_user 		= $data['id_user'];
				$nama_user	= $data['nama_user'];
				$username 	= $data['username'];
				

				$_SESSION['id_user'] 		= $id_user;
				$_SESSION['nama_user'] 	= $nama_user;
				$_SESSION['username'] 	= $username;
				$_SESSION['login'] 			= 1;
			}
			else{
				echo "
				<script>
				alert('Username atau Password Salah!')
				</script>
				";
			}
		}
	}
	if (isset($_SESSION['login'])) {
		header("Location: dashboard.php");
		exit;
	}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
	<link rel="icon" href="img/logo-motofix.png">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="font-awesome/css/all.min.css">
</head>
<body style="background-image: url(img/form-login.jpg); background-repeat: no-repeat; background-size: cover;" class="img-fluid">
	<div class="container mt-5 mb-5 text-white">
		<div class="row justify-content-center">
			<div class="col-md-6 rounded" style="background-color: #E06469;">
				<form method="POST">
					<h3 class="font-weight-bold mt-3"><img src="img/logo-motofix.png" alt="Responsive image" width="100px"> HALAMAN LOGIN</h3>
					<div class="form-group">
						<label class="font-weight-bold" for="username">USERNAME</label>
						<input type="text" class="form-control" name="username" required>
					</div>
					<div class="form-group">
						<label class="font-weight-bold" for="password">PASSWORD</label>
						<input type="password" class="form-control" name="password" required>
					</div>
					<div class="form-group">
						<button type="submit" name="login" class="btn btn-primary">LOGIN <i class="fa fa-sign-in-alt"></i></button>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>

<footer class="page-footer text-center text-md-left">
	<div class="footer-copyright py-3 text-center">
      <div class="container-fluid">
        &#xA9; 2023 Copyright: Motofix
      </div>
    </div>
</footer>

<script src="bootstrap/js/jquery-3.4.1.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="font-awesome/js/all.min.js"></script>

</html>