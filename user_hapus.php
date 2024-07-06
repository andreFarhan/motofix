<?php 
	include 'functions.php';

	//cek login
	if ($_SESSION['login'] == 0) {
		header("Location: login_form.php");
	}

	$id_user = $_GET['id_user'];

	if (isset($id_user)) {
		if (hapusUser($id_user) > 0) {
			setAlert('Berhasil!','Data Berhasil Dihapus','success');
			header("Location: user_show.php");
			die;
		}
		else{
			setAlert('Gagal!','Data Gagal Dihapus','error');
			header("Location: user_show.php");
			die;
		}
	}
 ?>