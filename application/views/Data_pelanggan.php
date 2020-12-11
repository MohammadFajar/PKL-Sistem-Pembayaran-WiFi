<!DOCTYPE html>
<html>
<head>
	<title>Admin - Edit Pelanggan</title>
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
	<h3>BERANDA</h>
<br>
<br>
<h5>Data Paket</h5>	
  <table class="table">
    <button type="submit" class="btn btn-info">
    <a class="text-white" href="<?php echo site_url('auth/formTambah_pelanggan') ?>">Tambah Data</a>     
  </button>
    <thead class="thead-light">
      <th>No</th>
      <th>Nama Pelanggan</th>
      <th>Alamat</th>
      <th>No. Telepon</th>
      <th>Password</th>
      <th>Paket</th>
      <th>Aksi</th>
    </thead>
    <tbody>
      <?php 
      $no= 1;
      foreach($pelanggan as $rows){ 
        ?>
      <tr>
        <td><?php echo $no++; ?></td>
        <td><?php echo $rows->NAMA_PELANGGAN; ?></td>
        <td><?php echo $rows->ALAMAT; ?></td>
        <td><?php echo $rows->NO_TELEPON; ?></td>
        <td><?php echo $rows->PASS_PEL; ?></td>
        <td><?php echo $rows->NAMA_PAKET;    ?></td>

        <td>
          <button type="submit" class="btn btn-success" >
           <a class="text-white" href="<?php echo site_url('auth/formEdit_pelanggan/'. $rows->ID_PELANGGAN) ?>">Edit</a>
          </button>
            <button type="submit" class="btn btn-danger"   >
          <a class="text-white" href="<?php echo site_url('auth/deletePelanggan/'. $rows->ID_PELANGGAN) ?>" onclick="return confirm('Anda yakin ingin menghapus ?')">Hapus</a>
        </button>
        </td>
      </tr>
      <?php } ?>
    </tbody>

  </table>


</div>
</body>
</html>