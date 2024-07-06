<?php 
	
	include 'functions.php';

	//cek login
	if ($_SESSION['login'] == 0) {
		header("Location: login_form.php");
	}
	
	$id_transaksi = $_GET['id_transaksi'];

	$sql = "SELECT * FROM tb_detail_transaksi
			INNER JOIN tb_transaksi ON tb_transaksi.id_transaksi = tb_detail_transaksi.id_transaksi
			INNER JOIN tb_service ON tb_service.id_service = tb_detail_transaksi.id_service
			INNER JOIN tb_member ON tb_member.id_member = tb_transaksi.id_member
			WHERE tb_detail_transaksi.id_transaksi = '$id_transaksi'
			ORDER BY tb_detail_transaksi.id_detail_transaksi DESC
	";
	$eksekusi = mysqli_query($koneksi, $sql);
	$data = mysqli_fetch_assoc($eksekusi);

	if ($data['id_detail_transaksi'] == 0) {
		header("Location: detail_transaksi_tambah.php?id_transaksi=$id_transaksi");
	}

	$sql_member = "SELECT * FROM tb_detail_transaksi
			INNER JOIN tb_transaksi ON tb_transaksi.id_transaksi = tb_detail_transaksi.id_transaksi
			INNER JOIN tb_service ON tb_service.id_service = tb_detail_transaksi.id_service
			INNER JOIN tb_member ON tb_member.id_member = tb_transaksi.id_member
			WHERE tb_detail_transaksi.id_transaksi = '$id_transaksi'
	";
	$eksekusi_member = mysqli_query($koneksi, $sql_member);
	$data_member = mysqli_fetch_assoc($eksekusi_member);
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Detail Transaksi</title>
	<link rel="icon" href="img/logo-motofix.png">
</head>
<body>
	<?php include 'nav.php'; ?>
	<div class="container mt-5 mb-5">
		<h3 class="mt-3">DETAIL TRANSAKSI - <?= $data_member['nama_member']; ?> | <?= $data['kode_invoice']; ?></h3>
		<div class="pt-1 pb-3">			
		<?php if ($data['dibayar'] == 'Belum Dibayar'): ?>
			<?php if ($data['status'] == 'Selesai'): ?>
			<?php else: ?>
			<a href="detail_transaksi_tambah.php?id_transaksi=<?= $data['id_transaksi']; ?>" class="btn btn-primary"> <i class="fa fa-archive"></i> TAMBAH SERVICE</a>
			<?php endif ?>
		<?php endif ?>
		</div>
		<table class="table table-striped" id="Table">
			<thead>
				<tr>
					<th width="1%">NO</th>
					<th>SERVICE</th>
					<th width="1%">HARGA</th>
					<th width="1%">JUMLAH</th>
					<th width="12%">SUB TOTAL</th>
					<th>KETERANGAN</th>
					<th width="1%">AKSI</th>
				</tr>
			</thead>
			<tbody>
				<?php $i=1; foreach($eksekusi as $data) : ?>
				<tr>
					<td><?= $i++; ?></td>
					<td><?= $data['jenis']; ?> - <?= $data['nama_service']; ?></td>
					<td>Rp <?= str_replace(",", ".", number_format($data['harga'])); ?></td>
					<td><?= $data['qty']; ?></td>
					<td>Rp <?= str_replace(",", ".", number_format($data['harga']*$data['qty'])); ?></td>
					<td><textarea disabled class="form-control"><?= $data['keterangan']; ?></textarea></td>
					<td>
						<a class="badge badge-success" href="detail_transaksi_ubah.php?id_detail_transaksi=<?= $data['id_detail_transaksi']; ?>" >  <i class="fa fa-edit"></i></a>
						<a onclick="return confirm('Apakah Anda Ingin Menghapus Service Ini ?')" class="badge badge-danger" href="detail_transaksi_hapus.php?id_detail_transaksi=<?= $data['id_detail_transaksi']; ?>" >  <i class="fa fa-trash"></i></a>
					</td>
				</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
</body>

<?php include 'footer.php'; ?>

</html>