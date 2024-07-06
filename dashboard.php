<?php 
    include 'functions.php';

    //cek login
    if ($_SESSION['login'] == 0) {
        header("Location: login_form.php");
    }

    $nama_user = ucwords($_SESSION['nama_user']);

    $sql = "SELECT * FROM tb_transaksi
    INNER JOIN tb_member ON tb_transaksi.id_member = tb_member.id_member
    INNER JOIN tb_user   ON tb_transaksi.id_user   = tb_user.id_user
   
    ORDER BY id_transaksi DESC";
    $eksekusi = mysqli_query($koneksi, $sql);
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Management</title>
    <link rel="icon" href="img/logo-motofix.png">
</head>
<body>
    <?php include 'nav.php'; ?>

    <div class="container mt-3">
        <h2></h2>
    <div class="alert alert-info text-center">
        <h4><b>Selamat Datang <b><?= $nama_user; ?></b></b></h4>
    </div>
            <h4>Beranda</h4>
            
            <div class="row">
                
                <div class="col mx-1 text-white bg-info rounded pt-2 pb-2">
                    <h1>
                        <i class="fa fa-user"></i>
                        <span class="pull-right">
                            <?php 
                                $sql_transaksi = "SELECT *, count(tb_transaksi.id_transaksi) as jml_transaksi FROM tb_transaksi";
                                $eksekusi_jml_transaksi = mysqli_query($koneksi, $sql_transaksi);
                                $data_jml_transaksi = mysqli_fetch_assoc($eksekusi_jml_transaksi);
                                echo $data_jml_transaksi['jml_transaksi'];
                            ?>
                        </span>
                    </h1>
                        <div>Jumlah Transaksi</div>
                </div>      
                
                <a href="transaksi_show.php?status=Baru" class="text-decoration-none col mx-1 text-white bg-primary rounded pt-2 pb-2">
                    <h1>
                        <i class="fa fa-retweet"></i> 
                        <span class="pull-right">
                            <?php   
                                $sql_baru = "SELECT *, count(tb_transaksi.status) as jml_baru FROM tb_transaksi WHERE status = 'Baru'";
                                $eksekusi_jml_baru = mysqli_query($koneksi, $sql_baru);
                                $data_jml_baru = mysqli_fetch_assoc($eksekusi_jml_baru);
                                echo $data_jml_baru['jml_baru'];
                            ?>
                        </span>
                    </h1>
                    <div>Jumlah Motor baru</div>
                </a>      

                <a href="transaksi_show.php?status=Proses" class="text-decoration-none col mx-1 text-white bg-warning rounded pt-2 pb-2">
                    <h1>
                        <i class="fab fa-algolia"></i> 
                        <span class="pull-right">
                            <?php   
                                $sql_proses = "SELECT *, count(tb_transaksi.status) as jml_proses FROM tb_transaksi WHERE status = 'Proses'";
                                $eksekusi_jml_proses = mysqli_query($koneksi, $sql_proses);
                                $data_jml_proses = mysqli_fetch_assoc($eksekusi_jml_proses);
                                echo $data_jml_proses['jml_proses'];
                            ?>
                        </span>
                    </h1>
                    <div>Jumlah Motor Diservice</div>
                </a>      

                <a href="transaksi_show.php?status=Selesai" class="text-decoration-none col mx-1 text-white bg-danger rounded pt-2 pb-2">
                    <h1>
                        <i class="fa fa-info-circle"></i> 
                        <span class="pull-right">
                            <?php 
                                $sql_proses = "SELECT *, count(tb_transaksi.status) as jml_proses FROM tb_transaksi WHERE status = 'Selesai'";
                                $eksekusi_jml_proses = mysqli_query($koneksi, $sql_proses);
                                $data_jml_proses = mysqli_fetch_assoc($eksekusi_jml_proses);
                                echo $data_jml_proses['jml_proses'];
                            ?>
                        </span>
                    </h1>
                    <div>Jumlah Motor Selesai</div>
                </a>              

                <a href="transaksi_show.php?status=Diambil" class="text-decoration-none col mx-1 text-white bg-success rounded pt-2 pb-2">
                    <h1>
                        <i class="fa fa-check-circle"></i> 
                        <span class="pull-right">
                            <?php 
                                $sql_proses = "SELECT *, count(tb_transaksi.status) as jml_proses FROM tb_transaksi WHERE status = 'Diambil'";
                                $eksekusi_jml_proses = mysqli_query($koneksi, $sql_proses);
                                $data_jml_proses = mysqli_fetch_assoc($eksekusi_jml_proses);
                                echo $data_jml_proses['jml_proses'];
                            ?>
                        </span>
                    </h1>
                    <div>Jumlah Motor Diambil</div>
                </a>              
            </div>      
    
    <div class="mt-3">
        <div>
            <h4>Riwayat Transaksi Terakhir</h4>
        </div>
        <div>
            <table class="table table-striped" id="Table" style="width: 110%; margin-left: -5%">
            <thead class="text-white" style="background-color: #CD1818;">
                <tr>
                    <th width="1%">NO</th>
                    <th width="1%">INVOICE</th>
                    <th width="15%">MEMBER</th>
                    <th width="15%">TANGGAL</th>
                    <th width="15%">BATAS WAKTU</th>
                    <th width="15%">TANGGAL BAYAR</th>
                    <th width="1%">BAYAR</th>
                    <th>STATUS</th>
                    <th>USER</th>
                </tr>
            </thead>
            <tbody>
                <?php $i=1; while ($data = mysqli_fetch_array($eksekusi)) : ?>
                <tr>
                    <td><?= $i++; ?></td>
                    <td><a href="detail_transaksi_show.php?id_transaksi=<?= $data['id_transaksi']; ?>" style="text-decoration: none; font-weight: bold;"><?= $data['kode_invoice']; ?></a></td>
                    <td><a href="member_show.php?id_member=<?= $data['id_member']; ?>" style="text-decoration: none; font-weight: bold;"><?= strlen($data['nama_member']) > 12 ? substr($data['nama_member'],0,12)."..." : $data['nama_member']; ?></a></td>
                    <td><?= $data['tanggal']; ?></td>
                    <td><?= $data['batas_waktu']; ?></td>
                    <td><?= $data['tanggal_bayar']; ?></td>
                    <td>
                    <?php if ($data['dibayar'] == 'Belum Dibayar'): ?>
                        <a onclick="return confirm('Apakah anda ingin membayar transaksi ini ? ')" href="invoice.php?id_transaksi=<?= $data['id_transaksi']; ?>" class="badge badge-pill badge-success">$ Bayar</a>
                    <?php else: ?>
                        <a href="invoice.php?id_transaksi=<?= $data['id_transaksi']; ?>" class="badge badge-pill badge-info text-white">DiBayar</a>
                    <?php endif ?>
                    <td>
                        <form action="transaksi_status.php" method="GET">
                            <?php if ($data['status'] == 'Baru'): ?>
                                <a onclick="return confirm('Apakah Anda Ingin Memproses Motor Ini?')" class="badge badge-pill badge-primary" href="transaksi_status.php?id_transaksi=<?= $data['id_transaksi']; ?>">baru</a>
                            <?php elseif ($data['status'] == 'Proses'): ?>
                                <a onclick="return confirm('Apakah Anda Ingin Menyuci Motor Ini?')" class="text-white badge badge-pill badge-warning" href="transaksi_status.php?id_transaksi=<?= $data['id_transaksi']; ?>">Proses</a>
                            <?php elseif ($data['status'] == 'Selesai'): ?>
                                <?php if ($data['dibayar'] == 'Belum Dibayar'): ?>
                                    <a onclick="return alert('Mohon Bayar Transaksi Terlebih Dahulu !')" class="badge badge-pill badge-danger text-white">Selesai</a>
                                <?php else: ?>
                                    <a onclick="return confirm('Apakah Anda Ingin Menyelesaikan Motor Ini?')" class="badge badge-pill badge-danger" href="transaksi_status.php?id_transaksi=<?= $data['id_transaksi']; ?>">Selesai</a>
                                <?php endif ?>
                            <?php else : ?>
                                <a class="badge badge-pill badge-success" href="detail_transaksi_show.php?id_transaksi=<?= $data['id_transaksi']?>">Diambil</a>
                            <?php endif ?>
                        </form>
                    </td>
                    <td><?= ucfirst($data['username']); ?></td>
                </tr>
                <?php endwhile ?>
            </tbody>
        </table>
        </div>
    </div>
</div>
    
</body>

<?php include 'footer.php'; ?>

</html>