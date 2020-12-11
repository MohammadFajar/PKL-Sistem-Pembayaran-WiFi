<!DOCTYPE html>
<html lang="en">
<head>
  <title>Pegawai - Form Bayar</title>
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
    <img src="icon.png" width="30" height="30" class="d-inline-block align-top" alt="">Sistem Pembayaran WiFi</a>
 	 <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
 
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url('auth/Peg_beranda')?>">Beranda</a>
        </li>
      </ul> 
      <a href="<?php echo site_url('auth/logout')?>"><img class="p-l-3" src="<?php echo base_url('assets/logout.png')?>"></a>
   </div>
</nav>
<br>
<div class="container border">
    <form action="<?php echo site_url('auth/bayar')?>" method="POST">
      <h2>Cari Pelanggan</h2>
    <div class="form-group">
      <label for="cari">ID Transaksi</label>
      <input type="text" class="form-control" id="idTransaksi" name="idTransaksi" value="TR<?php echo sprintf("%04s", $ID_TRANSAKSI) ?>" readonly>
    </div>
   <div class="form-group">
      <label for="pwd">ID Pelanggan</label>
      <input type="text" class="form-control" id="idPelanggan"  name="idPelanggan" value=" <?php  foreach ($cari as $data) {echo $data->ID_PELANGGAN;} ?>"  readonly>
    </div>
     <div class="form-group">
      <label for="pwd">Nama Pelanggan</label>
      <input type="text" class="form-control" id="namaPelanggan"  name="namaPelanggan" value=" <?php  foreach ($cari as $data) {echo $data->NAMA_PELANGGAN;} ?>"  readonly>
    </div>
    <div class="form-group">
      <label>Nama Paket WiFi</label>
      <input type="text" class="form-control" id="namaPaket" name="namaPaket" value=" <?php  foreach ($paket as $d) {echo $d->NAMA_PAKET;} ?>"  readonly>
    </div>
    <div class="form-group">
      <label>Harga</label>
      <input type="text" class="form-control" id="harga"   name="harga" value=" <?php  foreach ($paket as $d) {echo $d->HARGA;} ?>" readonly>
    </div>
      <div class="form-group">
        <label>Tanggal</label>
        <input type="date" class="form-control" id="tgl"  name="tgl">
     </div>
    <div class="form-group">
        <label for="sel1">Jenis Pembayaran</label>
          <select class="form-control" name="jPembayaran" id="jPembayaran">
            <option>Tunai</option>
            <option>Transfer Bank</option>
            <option>OVO</option>
            <option>GOPAY</option>
          </select>
      </div> 
    <div class="form-group">
        <label for="sel1">Jenis Transaksi</label>
          <select class="form-control" name="jTransaksi" id="jTransaksi">
            <option>Bayar Wifi</option>
            <option>Perbaikan Alat</option>
          </select>
      </div>
     <div class="form-group">
      <label>Biaya Tambahan(isi jika selain bayar wifi)</label>
      <input type="text" class="form-control" id="biayaTambahan" name="biayaTambahan" >
    </div>
     <div class="form-group">
      <label for="pwd">TOTAL BAYAR</label>
      <input type="text" class="form-control" id="total"   name="total">
    </div>
    <div class="form-group">
      <label for="pwd">Keterangan</label>
      <input type="text" class="form-control" id="keterangan"   value="Belum Ter-ACC" name="keterangan" readonly>
    </div>
    <button type="submit" class="btn btn-primary">Bayar</button>
    <a href="<?php echo site_url('auth/Peg_beranda') ?>"></a>
    </form>
</div>
</body>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#harga, #biayaTambahan").keyup(function() {
            var tharga=<?php  foreach ($paket as $d) {echo $d->HARGA;} ?>;
            var harga  = $("#harga").val();
            var biayaTambahan = $("#biayaTambahan").val();

            var total = parseInt(harga) + parseInt(biayaTambahan);
            $("#total").val(total);
        });
    });
</script>
</html>
