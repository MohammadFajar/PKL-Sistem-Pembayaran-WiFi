<!DOCTYPE html>
<html>
<head>
	<title>Admin | Beranda</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<script src='https://kit.fontawesome.com/a076d05399.js'></script> 	
  <link rel="icon" href="<?php echo base_url('/assets/icon.png');?>" type="image/gif"> 
</head>
<body>	
	<nav class="navbar navbar-expand-lg navbar-dark  bg-primary">
 	<a class="navbar-brand" href="#">
    <img src="<?php echo base_url('assets/icon.png'); ?>" width="30" height="30" class="d-inline-block align-top" alt="">Sistem Pembayaran WiFi</a>
 	 <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent"> 
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url('auth/Adm_beranda')?>">Beranda</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Olah Data
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="<?php echo base_url('auth/Data_user')?>">Data Pengguna</a>
            <a class="dropdown-item" href="<?php echo base_url('auth/Data_paket')?>">Data Paket</a>
            <a class="dropdown-item" href="<?php echo base_url('auth/Data_pelanggan')?>">Data Pelanggan</a>
          </div>
        </li>
      </ul>
      <a href="<?php echo site_url('auth/logout')?>"><img class="p-l-3" src="<?php echo base_url('assets/logout.png')?>"></a>
   </div>
</nav>
<br>
  <div class="container  p-3 my-3 border">
  	<h3>Selamat Datang Admin</h>
  <br><br>
  <br>

      <div class="row">
        <div class="col-md-4">
          <div class="text-center">
            <button type="submit" class="btn btn-success btn-lg">
              <a class="text-white" href="<?php echo site_url('auth/formTransaksi_acc/') ?>">Transaksi Terbayar</a>
            </button>
            <br>
            <label><?php echo $acc; ?></label>
          </div>

        </div>
        <div class="col-md-4">
         <div class="text-center">  
            <button type="submit" class="btn btn-danger btn-lg">
              <a class="text-white" href="<?php echo site_url('auth/formTransaksi_noacc/') ?>">Transaksi Belum Terbayar</a>
            </button>
            <br>
            <label><?php echo $noacc; ?></label>
          </div>
      </div> 
    </div>

  </div>
</body>
</html>