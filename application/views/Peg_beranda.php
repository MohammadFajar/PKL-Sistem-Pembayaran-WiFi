<!DOCTYPE html>
<html>
<head>
	<title>Pegawai - Beranda</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="<?php echo base_url('/assets/icon.png');?>" type="image/gif"> 
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<script src='https://kit.fontawesome.com/a076d05399.js'></script> 	
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
          <a class="nav-link" href="<?php echo base_url('auth/Peg_beranda')?>">Beranda</a>
        </li>
         <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url('auth/Hal_cetakLaporan')?>">Cetak Laporan</a>
        </li>
      </ul>
      <a href="<?php echo site_url('auth/logout')?>"><img class="p-l-3" src="<?php echo base_url('assets/logout.png')?>"></a>
   </div>
</nav>
<br>
<div class="container">
	<h3>Selamat Datang Pegawai</h3>
<br>
<br>
	<div class="container border">
	 <h3>Transakasi</h3>
	 <br>
	 <button type="button" class="btn btn-info mb-3"><a class="text-white" href="<?php echo site_url('auth/formCari_pelanggan') ?>">Tambah Transaksi</a></button>
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
      foreach($transaksi->result() as $rows){ ?>
      <tr>
         <td><?php echo $no++; ?></td>
         <td><?php echo $rows->ID_TRANSAKSI ?></td>
         <td><?php echo $rows->TANGGAL_PEMBAYARAN ?></td>
         <td><?php echo $rows->NAMA_PELANGGAN?></td>
         <td><?php echo $rows->JENIS_TRANSAKSI ?></td>
         <td><?php echo $rows->JENIS_PEMBAYARAN ?></td>
         <td><?php echo $rows->NOMINAL ?></td>
         <td><?php echo $rows->KETERANGAN ?></td>
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