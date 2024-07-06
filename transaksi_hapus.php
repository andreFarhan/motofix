<?php 

	include 'functions.php';

	//cek login
	if ($_SESSION['login'] == 0) {
		header("Location: login_form.php");
	}

	$id_transaksi = $_GET['id_transaksi'];

	if (hapusTransaksi($id_transaksi) > 0) {
		setAlert('Berhasil!','Data Berhasil Dihapus','success');
		header("Location: transaksi_show.php");
		die;
	}else{
		setAlert('Gagal!','Data Gagal Dihapus','error');
		header("Location: transaksi_show.php");
		die;
	}
 ?>
