<?php 

	include 'functions.php';

	//cek login
	if ($_SESSION['login'] == 0) {
		header("Location: login_form.php");
	}

	if (isset($_POST['submit'])) {
		if (tambahService($_POST) > 0) {
			setAlert('Berhasil!','Data Berhasil Ditambahkan','success');
			header("Location: service_show.php");
			die;
		}
		else{
			setAlert('Gagal!','Data Gagal Ditambahkan','error');
			header("Location: service_show.php");
			die;
		}
	}

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Tambah Service</title>
	<link rel="icon" href="img/logo-motofix.png">
</head>
<body>
	<?php include 'nav.php'; ?>
	<div class="container mt-5 mb-5 text-white">
		<div class="row justify-content-center">
			<div class="col-md-6 rounded" style="background-color: #005082;">
				<form method="POST">
					<h3 class="mt-3">TAMBAH SERVICE</h3>
					<input type="hidden" name="id_outlet" value="<?= $id_outlet; ?>">
					<div class="form-group">
						<label for="jenis">JENIS SERVICE</label>
						<select name="jenis" id="jenis" class="form-control" required>
							<option hidden>-- Pilih Service --</option>
							<option value='Isi Angin'>Isi Angin</option>
							<option value='Oli'>Oli</option>
							<option value='Busi'>Busi</option>
							<option value='Karburator'>Karburator</option>
							<option value='Lampu'>Lampu</option>
							<option value='Rem'>Rem</option>
							<option value='Rantai'>Rantai</option>
							<option value='Gir'>Gir</option>
							<option value='Kopling'>Kopling</option>
							<option value='Aki'>Aki</option>
							<option value='Lain-lain'>Lain-lain</option>
						</select>
					</div>				
					<div class="form-group">
						<label for="nama_service">NAMA SERVICE</label>
						<input type="text" class="form-control" name="nama_service" required>
					</div>
					<div class="form-group">
						<label for="harga">HARGA</label>
						<input type="number" class="form-control" name="harga" required>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary" name="submit">TAMBAH <i class="fa fa-paper-plane"></i></button>
						<a class="btn btn-outline-primary" href="service_show.php">BATAL</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>

<?php include 'footer.php'; ?>

</html>