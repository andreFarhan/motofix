<?php 
	
	session_start();

	$host = "localhost";
	$user = "root";
	$password = "";
	$database = "db_motofix";

	$koneksi = mysqli_connect($host,$user,$password,$database);

	date_default_timezone_set('asia/jakarta');

	function tambahUser($data){
		global $koneksi;
		$username = $data['username'];
		$password = $data['password'];
		$password2 = $data['password2'];
		$nama_user = ucwords(strtolower($data['nama_user']));
		$jenis_kelamin = $data['jenis_kelamin'];
		$alamat_user = $data['alamat_user'];
		$telp_user = $data['telp_user'];

		$result = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE username = '$username'");

		if (mysqli_fetch_assoc($result)) {
			setAlert('Gagal!','Username Telah Digunakan','error');
			header("Location: user_tambah.php");
			die;
		}
		if ($password !== $password2) {
			setAlert('Gagal!','Konfirmasi Password Salah','error');
			header("Location: user_tambah.php");
			die;
		}

		$password = password_hash($password, PASSWORD_DEFAULT);

		$sql = "INSERT INTO tb_user VALUES('','$nama_user','$jenis_kelamin','$alamat_user','$telp_user','$username','$password')";
		$eksekusi = mysqli_query($koneksi, $sql);

		return mysqli_affected_rows($koneksi);

	}

	function tambahService($data){
		global $koneksi;
		$jenis = $data['jenis'];
		$nama_service = ucwords(strtolower($data['nama_service']));
		$harga = $data['harga'];

		$result = mysqli_query($koneksi, "SELECT * FROM tb_service WHERE nama_service = '$nama_service'");

		if (mysqli_fetch_assoc($result)) {
			echo "
			<script>
			alert('Nama Service Sudah Digunakan!')
			</script>
			";
		}

		$sql = "INSERT INTO tb_service VALUES('','$jenis','$nama_service','$harga')";
		$eksekusi = mysqli_query($koneksi, $sql);

		return mysqli_affected_rows($koneksi);
	}

	function tambahMember($data){
		global $koneksi;
		$nama_member = ucwords(strtolower($data['nama_member']));
		$jenis_kelamin = $data['jenis_kelamin'];
		$alamat_member = $data['alamat_member'];
		$telp_member = $data['telp_member'];

		$result = mysqli_query($koneksi, "SELECT * FROM tb_member WHERE nama_member = '$nama_member'");

		if (mysqli_fetch_assoc($result)) {
			echo "
			<script>
			alert('Nama Pelanggan Sudah Digunakan!')
			</script>
			";	
		}

		$sql = "INSERT INTO tb_member VALUES('','$nama_member','$jenis_kelamin','$alamat_member','$telp_member')";
		$eksekusi = mysqli_query($koneksi, $sql);

		return mysqli_affected_rows($koneksi);
	}

	function tambahTransaksi($data){
		global $koneksi;
		$kode_invoice = 'INV' . date('mdHis') . random_int(00, 99);
		$id_member = $data['id_member'];
		$plat_nomor = $data['plat_nomor'];
		$tanggal = $data['tanggal'];
		$batas_waktu = $data['batas_waktu'];
		$biaya_tambahan = $data['biaya_tambahan'];
		$diskon = $data['diskon'];
		$pajak = $data['pajak'];
		$status = $data['status'];
		$id_user = $data['id_user'];


		$sql = "INSERT INTO tb_transaksi VALUES('','$kode_invoice','$id_member','$plat_nomor','$tanggal','$batas_waktu','','$biaya_tambahan','$diskon','$pajak','$status','Belum Dibayar','$id_user')";
		$eksekusi = mysqli_query($koneksi, $sql);

		return mysqli_insert_id($koneksi);
	}

	function tambahDetailTransaksi($data){
		global $koneksi;
		$id_transaksi 	= $data['id_transaksi'];
		$id_service		= $data['id_service'];
		$qty 			= $data['qty'];
		$keterangan 	= $data['keterangan'];

		$sql = "INSERT INTO tb_detail_transaksi VALUES('','$id_transaksi','$id_service','$qty','$keterangan')";
		$eksekusi = mysqli_query($koneksi, $sql);

		return mysqli_affected_rows($koneksi);
	}

	function ubahUser($data){
		global $koneksi;
		$id_user = $data['id_user'];
		$username = $data['username'];
		$password = $data['password'];
		$password_hash = password_hash($password, PASSWORD_DEFAULT);
		$password2 = $data['password2'];
		$password_lama = $data['password_lama'];
		$nama_user = ucwords(strtolower($data['nama_user']));
		$jenis_kelamin = $data['jenis_kelamin'];
		$alamat_user = $data['alamat_user'];
		$telp_user = $data['telp_user'];

		$result = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE username = '$username'");
		$fetch = mysqli_fetch_assoc($result);
		$password_lama_verify = password_verify($password_lama, $fetch['password']);

		if ($password !== $password2) {
			echo "
			<script>
			alert('Konfirmasi Password tidak sama!')
			</script>
			";
			return false;
		}

		if ($password_lama_verify) {
			$sql = "UPDATE tb_user SET nama_user = '$nama_user', password = '$password_hash', jenis_kelamin = '$jenis_kelamin', alamat_user = '$alamat_user', telp_user = '$telp_user' WHERE id_user = '$id_user'";
			$eksekusi = mysqli_query($koneksi, $sql);

			return mysqli_affected_rows($koneksi);
		}else{
			echo "
			<script>
			alert('Password Lama tidak benar!')
			</script>
			";
			return false;
		}

	}

	function ubahService($data){
		global $koneksi;
		$id_service = $data['id_service'];
		$jenis = $data['jenis'];
		$nama_service = ucwords(strtolower($data['nama_service']));
		$harga = $data['harga'];

		$sql = "UPDATE tb_service SET jenis = '$jenis', nama_service = '$nama_service', harga = '$harga' WHERE id_service = '$id_service'";
		$eksekusi = mysqli_query($koneksi, $sql);

		return mysqli_affected_rows($koneksi);
	}

	function ubahMember($data){
		global $koneksi;
		$id_member = $data['id_member'];
		$nama_member = ucwords(strtolower($data['nama_member']));
		$alamat_member = $data['alamat_member'];
		$jenis_kelamin = $data['jenis_kelamin'];
		$telp_member = $data['telp_member'];

		$sql = "UPDATE tb_member SET nama_member = '$nama_member', alamat_member = '$alamat_member', jenis_kelamin = '$jenis_kelamin', telp_member = '$telp_member' WHERE id_member = '$id_member'";
		$eksekusi = mysqli_query($koneksi, $sql);

		return mysqli_affected_rows($koneksi);
	}

	function ubahTransaksi($data){
		global $koneksi;
		$id_transaksi = $data['id_transaksi'];
		$kode_invoice = $data['kode_invoice'];
		$id_member = $data['id_member'];
		$plat_nomor = $data['plat_nomor'];
		$tanggal = $data['tanggal'];
		$batas_waktu = $data['batas_waktu'];
		$tanggal_bayar = $data['tanggal_bayar'];
		$biaya_tambahan = $data['biaya_tambahan'];
		$diskon = $data['diskon'];
		$pajak = $data['pajak'];
		$status = $data['status'];
		$id_user = $data['id_user'];

		$sql = "UPDATE tb_transaksi SET kode_invoice = '$kode_invoice', id_member = '$id_member', plat_nomor = '$plat_nomor', tanggal = '$tanggal', batas_waktu = '$batas_waktu', tanggal_bayar = '$tanggal_bayar', biaya_tambahan = '$biaya_tambahan', diskon = '$diskon', pajak = '$pajak', status = '$status', id_user = '$id_user' WHERE id_transaksi = '$id_transaksi'";
		$eksekusi = mysqli_query($koneksi, $sql);

		return mysqli_affected_rows($koneksi);
	}

	function ubahDetailTransaksi($data){
		global $koneksi;
		$id_detail_transaksi = $data['id_detail_transaksi'];
		$id_service = $data['id_service'];
		$qty = $data['qty'];
		$keterangan = $data['keterangan'];

		$sql = "UPDATE tb_detail_transaksi SET id_service = '$id_service', qty = '$qty', keterangan = '$keterangan' WHERE tb_detail_transaksi.id_detail_transaksi = '$id_detail_transaksi'";
		$eksekusi = mysqli_query($koneksi, $sql);

		return mysqli_affected_rows($koneksi);
	}

	function hapusOutlet($id){
		global $koneksi;
		$sql = "DELETE FROM tb_outlet WHERE id_outlet = '$id'";
		$eksekusi = mysqli_query($koneksi, $sql);

		return mysqli_affected_rows($koneksi);
	}

	function hapusUser($id){
		global $koneksi;
		$sql = "DELETE FROM tb_user WHERE id_user = '$id'";
		$eksekusi = mysqli_query($koneksi, $sql);

		return mysqli_affected_rows($koneksi);
	}
	
	function hapusService($id){
		global $koneksi;
		$sql = "DELETE FROM tb_service WHERE id_service = '$id'";
		$eksekusi = mysqli_query($koneksi, $sql);

		return mysqli_affected_rows($koneksi);
	}

	function hapusMember($id){
		global $koneksi;
		$sql = "DELETE FROM tb_member WHERE id_member = '$id'";
		$eksekusi = mysqli_query($koneksi, $sql);

		return mysqli_affected_rows($koneksi);
	}

	function hapusTransaksi($id){
		global $koneksi;
		$sql = "DELETE FROM tb_transaksi WHERE id_transaksi = '$id'";
		$eksekusi = mysqli_query($koneksi, $sql);

		return mysqli_affected_rows($koneksi);
	}

	function hapusDetailTransaksi($id){
		global $koneksi;
		$sql = "DELETE FROM tb_detail_transaksi WHERE id_detail_transaksi = '$id'";
		$eksekusi = mysqli_query($koneksi, $sql);

		return mysqli_affected_rows($koneksi);
	}

	function setAlert($title='',$text='',$type='',$buttons=''){

		$_SESSION["alert"]["title"]		= $title;
		$_SESSION["alert"]["text"] 		= $text;
		$_SESSION["alert"]["type"] 		= $type;
		$_SESSION["alert"]["buttons"]	= $buttons; 

	}

	if (isset($_SESSION['alert'])) {

		function alert(){
			$title 		= $_SESSION["alert"]["title"];
			$text 		= $_SESSION["alert"]["text"];
			$type 		= $_SESSION["alert"]["type"];
			$buttons	= $_SESSION["alert"]["buttons"];

			echo"
			<div id='msg' data-title='".$title."' data-type='".$type."' data-text='".$text."' data-buttons='".$buttons."'></div>
			<script>
				let title 		= $('#msg').data('title');
				let type 		= $('#msg').data('type');
				let text 		= $('#msg').data('text');
				let buttons		= $('#msg').data('buttons');

				if(text != '' && type != '' && title != ''){
					Swal.fire({
						title: title,
						text: text,
						icon: type,
					});
				}
			</script>
			";
			unset($_SESSION["alert"]);
		}
	}
 ?>