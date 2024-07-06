<?php 
	include 'functions.php';
	$id_transaksi = $_GET['id_transaksi'];

	$sql = "SELECT * FROM tb_transaksi
	INNER JOIN tb_member ON tb_member.id_member = tb_transaksi.id_member
	INNER JOIN tb_detail_transaksi ON tb_detail_transaksi.id_transaksi = tb_transaksi.id_transaksi
	WHERE tb_transaksi.id_transaksi = '$id_transaksi'";
	$eksekusi = mysqli_query($koneksi, $sql);
	$data = mysqli_fetch_assoc($eksekusi);

	$sql_service = "SELECT * FROM tb_service";
	$eksekusi_service = mysqli_query($koneksi, $sql_service);

	$sql_detail = "SELECT * FROM tb_detail_transaksi";
	$eksekusi_detail = mysqli_query($koneksi, $sql_detail);

	$bayar = $sql_pembayaran = mysqli_query($koneksi, "SELECT * FROM tb_pembayaran");
	$sql_pembayaran = mysqli_query($koneksi, "SELECT * FROM tb_pembayaran WHERE id_transaksi = '$id_transaksi'");
  	$fetch_pembayaran = mysqli_fetch_assoc($sql_pembayaran);

  	if ($data['id_detail_transaksi'] == 0) {
  		header("Location: detail_transaksi_tambah.php?id_transaksi=".$id_transaksi);
  	}
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Invoice</title>
	<link rel="icon" href="img/logo-motofix.png">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.css">
	<link rel="stylesheet" href="font-awesome/css/fontawesome.min.css">
	<link rel="stylesheet" href="font-awesome/css/all.min.css">
	<style>
	@media print{ 
	.hilang{
		display: none;
		}
	}
	</style>
</head>
<body style="background-color: white !important;">
	<div class="container mt-5">
		<a href="transaksi_show.php" class="hilang btn btn-primary">&laquo; Kembali</a>
	<table>
		<tr>
			<td rowspan="3"><img src="img/logo-motofix.png" width="100"></td>
			<td><h5>MOTOFIX</h5></td>
		</tr>
		<tr>
			<td>Jl. Margasatwa No.30, RT.1/RW.7, Cilandak Tim., Ps. Minggu, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12560</td>
		</tr>
		<tr>
			<td>085809381004</td>
		</tr>
	</table>
		<div class="text-right mt-n5">
			<h1>INVOICE</h1>
		</div>
		<hr class="bg-dark"><hr class="bg-dark mt-n2">
	
	<h5>Kepada Yth.</h5>
	<div class="row justify-content-center">
		<div class="col-md-6">
			<table class="table">
				<tr>
					<th>Nama</th>
					<td class="px-5"><?= $data['nama_member']; ?></td>
				</tr>
				<tr>
					<th>Alamat</th>
					<td class="px-5"><?= $data['alamat_member']; ?></td>
				</tr>
				<tr>
					<th width="24%">Jenis Kelamin</th>
					<?php if ($data['jenis_kelamin'] == 'L'): ?>
					<td class="px-5">Laki-laki</td>
					<?php else: ?>
					<td class="px-5">Perempuan</td>
					<?php endif ?>
				</tr>
				<tr>
					<th>Telp</th>
					<td class="px-5"><?= $data['telp_member']; ?></td>
				</tr>
			</table>
		</div>
		<div class="col-md-6">
			<table class="table">
				<tr>
					<th>No. Invoice</th>
					<th class="px-5"><?= $data['kode_invoice']; ?></th>
				</tr>
				<tr>
					<th>Tanggal Dibayar</th>
					<?php if ($data['tanggal_bayar'] > 0): ?>
					<td class="px-5"><?= $data['tanggal_bayar']; ?></td>
					<?php else: ?>
					<td class="px-5"> - </td>
					<?php endif ?>
				</tr>
				<tr>
					<th>Tanggal Masuk</th>
					<td class="px-5"><?= $data['tanggal']; ?></td>
				</tr>
				<tr>
					<th>Tanggal Selesai</th>
					<td class="px-5"><?= $data['batas_waktu']; ?></td>
				</tr>
				<tr>
					<th>Status</th>
					<?php if ($data['status'] == 'Baru'): ?>
								<td class="px-5">baru</td>
							<?php elseif ($data['status'] == 'Proses'): ?>
								<td class="px-5">Proses</td>
							<?php elseif ($data['status'] == 'Selesai'): ?>
								<td class="px-5">Selesai</td>
							<?php else : ?>
								<td class="px-5">Diambil</td>
					<?php endif ?>
				</tr>

			</table>
		</div>
	</div>
	
<?php if (mysqli_num_rows($sql_pembayaran)> 0): ?>
	
	<div class="row mt-3">
        <div class="col">
          <h5 class="font-weight-bold">Total Pembayaran</h5>
        </div>
        <div class="col text-right">
          <h5 class="font-weight-bold">RP <?= str_replace(",", ".", number_format($fetch_pembayaran['total_pembayaran'])); ?>,-</h5>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <h5 class="font-weight-bold">Uang yang dibayar</h5>
        </div>
        <div class="col text-right">
          <h5 class="font-weight-bold">Rp. <?= str_replace(",", ".", number_format($fetch_pembayaran['uang_bayar'])); ?>,-</h5>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <h5 class="font-weight-bold">Kembalian</h5>
        </div>
        <div class="col text-right">
          <h5 class="font-weight-bold">Rp. <?= str_replace(",", ".", number_format($fetch_pembayaran['kembalian'])); ?>,-</h5>
        </div>
      </div>
<?php endif ?>
<?php if (!mysqli_num_rows($sql_pembayaran)> 0): ?>
		<a href="pembayaran.php?id_transaksi=<?= $id_transaksi ?>" class="btn btn-primary mt-2 hilang" name="bayar">BAYAR</a>
<?php endif ?>
		<button class="btn btn-success hilang mt-2" onclick="window.print()">PRINT</button>
	</div>
</body>

<?php include 'footer.php'; ?>

</html>