<?php 

	include 'functions.php';

	//cek login
	if ($_SESSION['login'] == 0) {
		header("Location: login_form.php");
	}

	$sql = "SELECT * FROM tb_service";
	$eksekusi = mysqli_query($koneksi, $sql);
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Service</title>
	<link rel="icon" href="img/logo-motofix.png">
</head>
<body>
	<?php include 'nav.php'; ?>
	<div class="container mt-5 mb-5">
		<h3 class="mt-3">SERVICE</h3>
		<table class="table table-striped" id="Table">
			<thead class="text-white" style="background-color: #CD1818">
				<tr>
					<th width="1%">NO</th>
					<th>JENIS</th>
					<th>NAMA</th>
					<th>HARGA</th>
					<th width="1%">AKSI</th>
				</tr>
			</thead>
			<tbody>
				<?php $i=1; while ($data = mysqli_fetch_array($eksekusi)) : ?>
				<tr>
					<td><?= $i++; ?></td>
					<td><?= ucwords($data['jenis']); ?></td>
					<td><?= $data['nama_service']; ?></td>
					<td>Rp <?= str_replace(",", ".", number_format($data['harga'])); ?></td>
					<td>
						<a href="service_ubah.php?id_service=<?= $data['id_service']; ?>" class="badge badge-success"><i class="fa fa-edit"></i></a>
						<a onclick="return confirm('Apakah anda ingin menghapus service <?= $data['nama_service']; ?> ?')" href="service_hapus.php?id_service=<?= $data['id_service']; ?>" class="badge badge-danger"><i class="fa fa-trash"></i></a>
					</td>
				</tr>
				<?php endwhile ?>
			</tbody>
		</table>
	</div>
</body>

<?php include 'footer.php'; ?>

</html>