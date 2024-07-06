<?php 
	include 'functions.php';

	//cek login
	if ($_SESSION['login'] == 0) {
		header("Location: login_form.php");
	}

	$id_member = $_GET['id_member'];

	if (hapusMember($id_member) > 0) {
		setAlert('Berhasil!','Data Berhasil Dihapus','success');
		header("Location: member_show.php");
		die;
	}
	else{
		setAlert('Gagal!','Data Gagal Dihapus','error');
		header("Location: member_show.php");
		die;
	}
?>