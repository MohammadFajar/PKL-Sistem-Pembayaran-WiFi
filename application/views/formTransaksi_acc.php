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
<div class="container">
<h3>Transaksi Terbayar</h3>	
  <table class="table">
    <thead class="thead-light">
      <tr>
        <th>No.</th>
        <th>ID Transaksi</th>
        <th>Tanggal Pembayaran</th>
        <th>Nama Pelanggan</th>
        <th>Jenis Transaksi</th>
        <th>Jenis Pembayaran</th>
        <th>Nominal</th>
        <th>Keterangan</th>
      </tr>
    </thead>
    <tbody>
       <?php 
      $no= $this->uri->segment('3') +1;
      foreach($dataTransaksi->result() as $rows){ ?>
      <tr>
         <td><?php echo $no++; ?></td>
         <td><?php echo $rows->ID_TRANSAKSI ?></td>
         <td><?php echo $rows->TANGGAL_PEMBAYARAN ?></td>
         <td><?php echo $rows->NAMA_PELANGGAN?></td>
         <td><?php echo $rows->JENIS_TRANSAKSI ?></td>
         <td><?php echo $rows->JENIS_PEMBAYARAN ?></td>
         <td><?php echo number_format($rows->NOMINAL, 0, ',','.') ?></td>
         <td><?php echo $rows->KETERANGAN ?></td>
         </td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
  <div class="row">
        <div class="col">
            <!--Tampilkan pagination-->
            <?php echo $pagination; ?>
        </div>
    </div>

</div>
</body>
</html>