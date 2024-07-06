<?php 

	include 'functions.php';

	//cek login
	if ($_SESSION['login'] == 0) {
		header("Location: login_form.php");
	}

	$sql = "SELECT * FROM tb_user
			ORDER BY id_user DESC
			";
	$eksekusi = mysqli_query($koneksi, $sql);

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>User</title>
	<link rel="icon" href="img/logo-motofix.png">
</head>
<body>
	<?php include 'nav.php'; ?>
	<div class="container mt-5 mb-5">
		<h3 class="mt-3">USER</h3>
		<table class="table table-striped" id="Table">
			<thead class="text-white" style="background-color: #CD1818">
				<tr>
					<th width="1%">NO</th>
					<th>NAMA</th>
					<th>JENIS KELAMIN</th>
					<th>ALAMAT</th>
					<th>NO. TELEPON</th>
					<th width="1%">AKSI</th>
				</tr>
			</thead>
			<tbody>
				<?php $i=1; while ($data = mysqli_fetch_array($eksekusi)) : ?>
				<tr>
					<td><?= $i++; ?></td>
					<td><?= ucwords($data['nama_user']); ?></td>
					<td><?= $data['jenis_kelamin']; ?></td>
					<td><?= $data['alamat_user']; ?></td>
					<td><?= $data['telp_user']; ?></td>
					<td>
						<a id="tombol-hapus" href="user_ubah.php?id_user=<?= $data['id_user']; ?>" class="badge badge-success"><i class="fa fa-edit"></i></a>
						<a onclick="return confirm('Apakah Anda Ingin Menghapus <?= ucwords($data['username']); ?> ?')" href="user_hapus.php?id_user=<?= $data['id_user']; ?>" class="badge badge-danger"><i class="fa fa-trash"></i></a>
					</td>
				</tr>
				<?php endwhile ?>
			</tbody>
		</table>
	</div>
</body>

<?php include 'footer.php'; ?>

</html>
