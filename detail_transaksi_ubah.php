<?php  
	
	include 'functions.php';

	//cek login
	if ($_SESSION['login'] == 0) {
		header("Location: login_form.php");
	}

	$id_detail_transaksi = $_GET['id_detail_transaksi'];
	$sql = "SELECT * FROM tb_detail_transaksi INNER JOIN tb_service ON tb_detail_transaksi.id_service = tb_service.id_service WHERE tb_detail_transaksi.id_detail_transaksi = $id_detail_transaksi";
	$eksekusi = mysqli_query($koneksi, $sql);
	$data = mysqli_fetch_assoc($eksekusi);

	if (isset($_POST['submit'])) {
		if (ubahDetailTransaksi($_POST) > 0 ) {
			setAlert('Berhasil!','Data Berhasil Diubah','success');
			header("Location: transaksi_show.php");
			die;
		}
		else{
			setAlert('Gagal!','Data Gagal Diubah','error');
			header("Location: detail_transaksi_show.php?id_transaksi=$id_transaksi");
			die;
		}
	}

	$sql_service = "SELECT * FROM tb_service ORDER BY id_service DESC";
	$eksekusi_service = mysqli_query($koneksi, $sql_service);

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Ubah detail_transaksi</title>
	<link rel="icon" href="img/logo-motofix.png">
</head>
<body>
	<?php include 'nav.php'; ?>
	<div class="container mt-5 mb-5 text-white">
		<div class="row justify-content-center">
			<div class="col-md-6 rounded" style="background-color: #005082;">
				<form method="POST">
					<h3 class="mt-3">UBAH DETAIL TRANSAKSI</h3>
					<input type="hidden" name="id_detail_transaksi" value="<?= $data['id_detail_transaksi']; ?>">
					<div class="form-group">
						<label for="id_service">Service</label>
						<select class="form-control" name="id_service" id="id_service" required>
								<option value="<?= $data['id_service'] ?>"><?= $data['nama_service']; ?></option>
							<?php foreach ($eksekusi_service as $data_service): ?>
								<?php if ($data['id_service'] !== $data_service['id_service']): ?>
									<option value="<?= $data_service['id_service'] ?>"><?= $data_service['nama_service']; ?></option>
								<?php endif ?>
							<?php endforeach ?>
						</select>
					</div>
					<div class="form-group">
						<label for="qty">Jumlah</label>
						<input type="number" name="qty" class="form-control" value="<?= $data['qty']; ?>">
					</div>
					<div class="form-group">
						<label for="keterangan">Keterangan</label>
						<textarea class="form-control" name="keterangan" id="keterangan"><?= $data['keterangan']; ?></textarea>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary" name="submit">UBAH <i class="fa fa-paper-plane"></i></button>
						<a class="btn btn-outline-primary" href="transaksi_show.php">BATAL</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>

<?php include 'footer.php'; ?>

</html>