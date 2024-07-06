<?php 

	include 'functions.php';

	//cek login
	if ($_SESSION['login'] == 0) {
		header("Location: login_form.php");
	}

	if (isset($_POST['submit'])) {
		$cek = tambahTransaksi($_POST);
		if ($cek > 0) {
			setAlert('Berhasil!','Data Berhasil Ditambahkan','success');
			header("Location: detail_transaksi_tambah.php?id_transaksi=".$cek);
			die;
		}
		else{
			setAlert('Gagal!','Data Gagal Ditambahkan','error');
			header("Location: transaksi_show.php");
			die;
		}
	}

	$id_user = $_SESSION['id_user'];

	$sql_member = "SELECT * FROM tb_member ORDER BY id_member DESC";
	$eksekusi_member = mysqli_query($koneksi, $sql_member);

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Tambah Transaksi</title>
	<link rel="icon" href="img/logo-motofix.png">
</head>
<body>
	<?php include 'nav.php'; ?>
	<div class="container mt-5 mb-5 text-white">
		<div class="row justify-content-center">
			<div class="col-md-6 rounded" style="background-color: #005082;">
				<form method="POST">
					<h3 class="mt-3">TAMBAH TRANSAKSI</h3>
					<div class="form-group">
						<label for="id_member">MEMBER</label>
						<select class="form-control" name="id_member" id="id_member" required>
							<option value="1" hidden>-- Tanpa Member --</option>
							<?php while ($data_member = mysqli_fetch_array($eksekusi_member)) : ?>
								<option value="<?= $data_member['id_member']; ?>"><?= $data_member['nama_member']; ?></option>
							<?php endwhile ?>
						</select>
					</div>
					<div class="form-group">
						<label for="plat_nomor">NOMOR PLAT</label>
						<input type="text" name="plat_nomor" class="form-control">
					</div>
					<input type="hidden" name="tanggal" value="<?= date('Y-m-d\TH:i:s'); ?>">
					<div class="form-group">
						<label for="batas_waktu">BATAS WAKTU</label>
						<input class="form-control" type="date-local" name="batas_waktu" value="<?= date('Y-m-d'); ?>">
					</div>
					<div class="form-group">
						<label for="biaya_tambahan">BIAYA TAMBAHAN</label>
						<input type="number" name="biaya_tambahan" class="form-control">
					</div>
					<div class="form-group">
						<label for="diskon">DISKON %</label>
						<input type="number" name="diskon" class="form-control">
					</div>
					<div class="form-group">
						<label for="pajak">PAJAK %</label>
						<input type="number" name="pajak" class="form-control">
					</div>
					<input type="hidden" name="status" value="baru">
					<input type="hidden" value="<?= $id_user; ?>" name="id_user">
					<div class="form-group">
						<button type="submit" class="btn btn-primary" name="submit">BERIKUTNYA <i class="fa fa-arrow-right"></i></button>
						<a class="btn btn-outline-primary" href="transaksi_show.php">BATAL</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>

<?php include 'footer.php'; ?>

</html>