  <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="bootstrap/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="font-awesome/css/all.min.css">

<style type="text/css">
    .container {
        margin-top: 30px;
    }
    .dropdown-toggle,
    .dropdown-menu {
        border-radius: 0px !important;
    }
    .dropdown-item:hover {
        color: white;
        background-color: #0f4c81;
    }
    .btn-danger {
        width: 55%;
    }
    .dropdown:hover>.dropdown-menu {
      display: block;
    }
</style>

<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #820000">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <?php if ($_SERVER['REQUEST_URI'] == '/motofix/dashboard.php'): ?>
        <li class="nav-item active">
          <a class="nav-link" href="dashboard.php"><i class="fa fa-home"></i> Home</a>
        </li>
      <?php else: ?>
        <li class="nav-item">
          <a class="nav-link" href="dashboard.php"><i class="fa fa-home"></i> Home</a>
        </li>
      <?php endif ?>

    <?php if ($_SERVER['REQUEST_URI'] == '/motofix/user_show.php' OR $_SERVER['REQUEST_URI'] == '/motofix/user_tambah.php' OR $_SERVER['SCRIPT_NAME'] == '/motofix/user_ubah.php'): ?>
    <li class="nav-item dropdown active">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-user-alt"></i> User
      </a>
      <div class="dropdown-menu mt-n2" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="user_show.php"><i class="fa fa-user-alt"></i> User</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="user_tambah.php"><i class="fa fa-user-plus"></i> Tambah User</a>
      </div>
    </li>
    <?php else: ?>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-user-alt"></i> User
      </a>
      <div class="dropdown-menu mt-n2" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="user_show.php"><i class="fa fa-user-alt"></i> User</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="user_tambah.php"><i class="fa fa-user-plus"></i> Tambah User</a>
      </div>
    </li>
    <?php endif ?>

    <?php if ($_SERVER['REQUEST_URI'] == '/motofix/service_show.php' OR $_SERVER['REQUEST_URI'] == '/motofix/service_tambah.php' OR $_SERVER['SCRIPT_NAME'] == '/motofix/service_ubah.php'): ?>
    <li class="nav-item dropdown active">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-wrench"></i> Service
      </a>
      <div class="dropdown-menu mt-n2" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="service_show.php"><i class="fa fa-wrench"></i> Service</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="service_tambah.php"><i class="fa fa-wrench"></i><strong>+</strong> Tambah Service</a>
      </div>
    </li>
    <?php else: ?>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-wrench"></i> Service
      </a>
      <div class="dropdown-menu mt-n2" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="service_show.php"><i class="fa fa-wrench"></i> Service</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="service_tambah.php"><i class="fa fa-wrench"></i><strong>+</strong> Tambah Service</a>
      </div>
    </li>
    <?php endif ?>

      <?php if ($_SERVER['REQUEST_URI'] == '/motofix/member_show.php' OR $_SERVER['REQUEST_URI'] == '/motofix/member_tambah.php' OR $_SERVER['SCRIPT_NAME'] == '/motofix/member_ubah.php' OR $_SERVER['SCRIPT_NAME'] == '/motofix/member_show.php'): ?>
      <li class="nav-item dropdown active">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fa fa-users"></i> Member
        </a>
        <div class="dropdown-menu mt-n2" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="member_show.php"><i class="fa fa-users"></i> Member</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="member_tambah.php"><i class="fa fa-user-plus"></i> Tambah Member</a>
        </div>
      </li>
      <?php else: ?>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fa fa-users"></i> Member
        </a>
        <div class="dropdown-menu mt-n2" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="member_show.php"><i class="fa fa-users"></i> Member</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="member_tambah.php"><i class="fa fa-user-plus"></i> Tambah Member</a>
        </div>
      </li>
      <?php endif ?>

      <?php if ($_SERVER['REQUEST_URI'] == '/motofix/transaksi_show.php' OR $_SERVER['REQUEST_URI'] == '/motofix/transaksi_tambah.php' OR $_SERVER['SCRIPT_NAME'] == '/motofix/transaksi_ubah.php' OR $_SERVER['SCRIPT_NAME'] == '/motofix/detail_transaksi_show.php' OR $_SERVER['SCRIPT_NAME'] == '/motofix/detail_transaksi_tambah.php' OR $_SERVER['SCRIPT_NAME'] == '/motofix/detail_transaksi_ubah.php' OR $_SERVER['SCRIPT_NAME'] == '/motofix/pembayaran.php'): ?>
      <li class="nav-item dropdown active">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fa fa-shopping-cart"></i> transaksi
        </a>
        <div class="dropdown-menu mt-n2" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="transaksi_show.php"><i class="fa fa-shopping-cart"></i> transaksi</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="transaksi_tambah.php"><i class="fa fa-cart-plus"></i> Tambah transaksi</a>
        </div>
      </li>
      <?php else: ?>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fa fa-shopping-cart"></i> transaksi
        </a>
        <div class="dropdown-menu mt-n2" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="transaksi_show.php"><i class="fa fa-shopping-cart"></i> transaksi</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="transaksi_tambah.php"><i class="fa fa-cart-plus"></i> Tambah transaksi</a>
        </div>
      </li>
      <?php endif ?>

      <li class="nav-item">
        <a onclick="return confirm('Apakah anda ingin keluar?')" class="nav-link" href="logout.php"><i class="fa fa-door-open"></i> Keluar</a>
      </li>
    </ul>
      <?php 
        $username = ucwords($_SESSION['username']);
       ?>
      <b class="mr-sm-2 mb-n1 text-white"><?= $username; ?></b>
  </div>
</nav>