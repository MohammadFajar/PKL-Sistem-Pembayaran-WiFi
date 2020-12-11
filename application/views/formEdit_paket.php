
<!DOCTYPE html>
<html>
<head>
	<title>Admin - Edit Paket</title>
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
          <a class="nav-link" href="#">Beranda</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Transaksi</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Olah Data
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
           	<a class="dropdown-item" href="<?php echo base_url('auth/Data_user')?>">Data Admin</a>
            <a class="dropdown-item" href="<?php echo base_url('auth/Data_paket')?>">Data Paket</a>
            <a class="dropdown-item" href="#">Data Pelanggan</a>
          </div>
        </li>
      </ul>
      <a href="<?php echo site_url('auth/logout')?>"><img class="p-l-3" src="<?php echo base_url('assets/logout.png')?>"></a>
   </div>
</nav>
<br>
<?php
  if($dataEditPaket){
    $id= $dataEditPaket->ID_PAKET;
    $namaPaket = $dataEditPaket->NAMA_PAKET;
    $kecepatan = $dataEditPaket->KECEPATAN;
    $harga= $dataEditPaket->HARGA;
  }else{
    $namaPaket = "";
    $kecepatan="";
    $harga="";
}
?>

<div class="container">
  <div class="card">
    <div class="card-header bg-primary text-white"><h4>Edit User</h4></div>
    <div class="card-body">
      <form action="<?php echo site_url('auth/updatePaket/'. $id)?>" method="POST">
            <a href="<?php echo site_url('auth/Data_paket') ?>">KEMBALI  </a>
        
        <div class="form-group">
          <label for="namaPaket">Nama Paket</label>
          <input type="text" class="form-control" id="namaPaket" name="namaPaket" value="<?php echo $namaPaket ?>"style="width: 75%">
        </div>
        <div class="form-group">
          <label for="kecepatanPaket">Kecepatan(Mbps)</label>
           <input type="text" class="form-control" id="kecepatanPaket" name="kecepatanPaket" value="<?php echo $kecepatan ?>" style="width: 75%">
        </div>
        <div class="form-group">
          <label for="hargaPaket">Harga</label>
           <input type="text" class="form-control" id="hargaPaket" name="hargaPaket" value="<?php echo $harga ?>"style="width: 75%">
        </div>
        <div class="form-group">
            <input type="submit" name="simpan" value="SIMPAN" class="btn btn-primary btn-sm" >
            <a href="<?php echo site_url('auth/Data_user') ?>"></a>
         </div>

      </form>
    </div>
  </div>
</div>
</body>
</html>