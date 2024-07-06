<?php 
	include 'functions.php';

	//cek login
	if ($_SESSION['login'] == 0) {
		header("Location: login_form.php");
	}

	$id_service = $_GET['id_service'];

	if (hapusService($id_service) > 0) {
		setAlert('Berhasil!','Data Berhasil Dihapus','success');
		header("Location: service_show.php");
		die;
	}
	else{
		setAlert('Gagal!','Data Gagal Dihapus','error');
		header("Location: service_show.php");
		die;
	}
 ?>