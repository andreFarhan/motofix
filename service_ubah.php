<?php  
	
	include 'functions.php';

	//cek login
	if ($_SESSION['login'] == 0) {
		header("Location: login_form.php");
	}

	$id_service = $_GET['id_service'];
	$sql = "SELECT * FROM tb_service WHERE id_service = $id_service";
	$eksekusi = mysqli_query($koneksi, $sql);
	$data = mysqli_fetch_assoc($eksekusi);

	if (isset($_POST['submit'])) {
		if (ubahService($_POST) > 0) {
			setAlert('Berhasil!','Data Berhasil Diubah','success');
			header("Location: service_show.php");
			die;
		}
		else{
			setAlert('Gagal!','Data Gagal Diubah','error');
			header("Location: service_show.php");
			die;
		}
	}

	$jenis_service = ["Isi Angin","Oli","Busi","Karburator","Lampu","Rem","Rantai","Gir","Kopling","Aki","Lain-lain"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Ubah Service</title>
	<link rel="icon" href="img/logo-motofix.png">
</head>
<body>
	<?php include 'nav.php'; ?>
	<div class="container mt-5 mb-5 text-white">
		<div class="row justify-content-center">
			<div class="col-md-6 rounded" style="background-color: #005082;">
				<form method="POST">
					<h3 class="mt-3">UBAH SERVICE</h3>
					<input type="hidden" name="id_service" value="<?= $data['id_service']; ?>">
					<input type="hidden" name="id_outlet" value="<?= $id_outlet; ?>">
					<div class="form-group">
						<label for="jenis">JENIS SERVICE</label>
						<select name="jenis" id="jenis" class="form-control">
							<?php foreach ($jenis_service as $data_jenis): ?>
								<?php if ($data["jenis"] == $data_jenis): ?>
									<option value="<?= $data_jenis ?>" selected><?= $data_jenis ?></option>
								<?php else: ?>
									<option value="<?= $data_jenis ?>"><?= $data_jenis ?></option>
								<?php endif ?>
							<?php endforeach ?>
						</select>
					</div>				
					<div class="form-group">
						<label for="nama_service">NAMA SERVICE</label>
						<input type="text" class="form-control" name="nama_service" value="<?= $data['nama_service']; ?>" required>
					</div>
					<div class="form-group">
						<label for="harga">HARGA</label>
						<input type="number" class="form-control" name="harga" value="<?= $data['harga']; ?>" required>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary" name="submit">UBAH <i class="fa fa-paper-plane"></i></button>
						<a class="btn btn-outline-primary" href="service_show.php">BATAL</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>

<?php include 'footer.php'; ?>

</html>