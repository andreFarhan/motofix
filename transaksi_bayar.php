<?php 

	include 'functions.php';

	//cek login
	if ($_SESSION['login'] == 0) {
		header("Location: login_form.php");
	}

	

	if (isset($id_transaksi)) {
		$id_transaksi = $_GET['id_transaksi'];
	}
	else{
		header("Location: index.php");
	}

	$tanggal_bayar = date('Y-m-d\TH:i:s');
	$sql_bayar = "UPDATE tb_transaksi SET dibayar = 'Dibayar', tanggal_bayar = '$tanggal_bayar' WHERE id_transaksi = '$id_transaksi'";
	$eksekusi_bayar = mysqli_query($koneksi, $sql_bayar);

	if ($eksekusi_bayar) {
		echo "
		<script>
		alert('Transaksi Berhasil Dibayar!')
		document.location.href='transaksi_show.php'
		</script>
		";
	}
	else{
		echo "
		<script>
		alert('Transaksi Gagal Dibayar!')
		</script>
		";	
	}


 ?>