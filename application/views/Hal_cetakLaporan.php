<!DOCTYPE html>
<html>
<head>
	<title>Pegawai -  Cetak Laporan</title>
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
	<h3>Cetak Laporan</h3>
	<br>
</div>
<div class="container border">
	<h5>Per-Tanggal</h5>
	<br>
	<form class="form-horizontal" action="<?php echo base_url("auth/filter");?> " method="POST" target="_blank">
	  <div class="form-group">
	  	<div class="col-sm-10">
	      <input type="hidden" class="form-control" name="nilaifilter" id="nilaifilter" value="1">
	    </div>
	    <label  class="col-sm-2 control-label">Tanggal Awal</label>
	    <div class="col-sm-10">
	      <input type="date" class="form-control" name="tanggalAwal" id="tanggalAwal" required="">
	    </div>
	  </div>
	  <div class="form-group">
	    <label class="col-sm-2 control-label">Tanggal Akhir</label>
	    <div class="col-sm-10">
	      	<input type="date" class="form-control" name="tanggalAkhir" id="tanggalAkhir" required="">
	    </div>
	  </div>
	  <div class="form-group">
	    <div class="col-sm-offset-2 col-sm-10">
	      <button type="submit" class="btn btn-primary" value="print">Submit</button>
	    </div>
	  </div>
	</form>
</div>

<br><br>
<div class="container border">
	<h5>Filter by Bulan</h5>
	<br>
	<form class="form-horizontal" action="<?php echo base_url('auth/filter');?>" method="POST" target="_blank">
	<div class="col-sm-10">
	      <input type="hidden" class="form-control" name="nilaifilter" id="nilaifilter" value="2">
	    </div>
	<small>Pilih Tahun</small>
	<div class="col-sm-10">
	     <select name="tahun1" id="tahun1" required="">
			<?php foreach ($tahun as $row): ?>
				<option name="<?php echo $row->tahun ;?>" id="<?php echo $row->tahun ;?>" value="<?php echo $row->tahun ;?>"><?php echo $row->tahun; ?></option>
			<?php endforeach ?>
		</select>
	 </div>
	  <div class="form-group">
	    <label  class="col-sm-2 control-label">Bulan Awal</label>
	    <div class="col-sm-10">
	     	<select id="bulanAwal" name="bulanAwal" required="">
	     		<option value="1">Januari</option>
	     		<option value="2">Februari</option>
				<option value="3">Maret</option>
				<option value="4">April</option>
	     		<option value="5">Mei</option>
				<option value="6">Juni</option>
				<option value="7">Juli</option>
	     		<option value="8">Agustus</option>
				<option value="9">September</option>
				<option value="10">Oktober</option>
	     		<option value="11">November</option>
				<option value="12">Desember</option>
	     	</select>
	    </div>
	  </div>
	  <div class="form-group">
	    <label class="col-sm-2 control-label">Bulan Akhir</label>
	    <div class="col-sm-10">
	      	<select id="bulanAkhir" name="bulanAkhir" required="">
	     		<option value="1">Januari</option>
	     		<option value="2">Februari</option>
				<option value="3">Maret</option>
				<option value="4">April</option>
	     		<option value="5">Mei</option>
				<option value="6">Juni</option>
				<option value="7">Juli</option>
	     		<option value="8">Agustus</option>
				<option value="9">September</option>
				<option value="10">Oktober</option>
	     		<option value="11">November</option>
				<option value="12">Desember</option>
	     	</select>
	    </div>
	  </div>
	  <div class="form-group">
	    <div class="col-sm-offset-2 col-sm-10">
	      <button type="submit" class="btn btn-primary" value="print">Submit</button>
	    </div>
	  </div>
	</form>
</div>

<br><br>
<div class="container border">
	<h5>Filter by Tahun</h5>
	<br>
	<form class="form-horizontal" action="<?php echo base_url('auth/filter');?> " method="POST" target="_blank">
	<div class="col-sm-10">
	      <input type="hidden" class="form-control" name="nilaifilter" id="nilaifilter" value="3">
	 </div>
	<small>Pilih Tahun</small>
	<div class="col-sm-10">
	     <select name="tahun2" required="">
		<?php foreach ($tahun as $row): ?>
			<option value="<?php echo $row->tahun?>"><?php echo $row->tahun; ?></option>
		<?php endforeach ?>
	</select>
	 </div>
	<br>
	  <div class="form-group">
	    <div class="col-sm-offset-2 col-sm-10">
	      <button type="submit" class="btn btn-primary" value="print">Submit</button>
	    </div>
	  </div>
	</form>
</body>
</html>
