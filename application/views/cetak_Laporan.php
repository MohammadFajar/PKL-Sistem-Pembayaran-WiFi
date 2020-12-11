<!DOCTYPE html>
<html>
<head>
	<title>Cetak Laporan</title>
  <link rel="icon" href="<?php echo base_url('/assets/icon.png');?>" type="image/gif"> 
	<title>Cetak Laporan</title>
	   <style>
      table, td, th {
		  border: 1px solid black;
		}

		table {
		  width: 100%;
		  border-collapse: collapse;
		} 
        img{
            width: 50px;
            height: 50px;
            float: left;
        }
        h3{
            float: left;
            padding: 3px;
            text-align: justify;
        }
        h4 {
            text-align: center;
        }
        p{
            text-align: center;
        }
        .clearfix {
          overflow: auto;
        }
    </style>
</head>
<body onload="window.print()">
<div class="kop">
    <div class="clearfix">
       	<img src="<?php echo base_url('assets/icon.png')?>" /> 
       		<h3>Sistem Pembayaran WiFi</h3>
    </div> 
       <h4><?php echo $title; ?></h4>
       <p>Periode : <?php echo $subtitle; ?> </p>
  </div><br>
	<br><br>
	 <table>
      <tr>
        <th>No</th>
		<th>ID Transaksi</th>
		<th>Tanggal</th>
		<th>Nama Pelanggan</th>
		<th>Jenis Transaksi</th>
		<th>Jenis Pembayaran</th>
		<th>Nominal</th>
      </tr>
     <?php 
			$no=1;
			foreach ($datafilter as $row): ?>
			<tr>
					<td><?php echo $no++; ?></td>
					<td><?php echo $row->ID_TRANSAKSI; ?></td>
					<td><?php echo $row->TANGGAL_PEMBAYARAN; ?></td>
					<td><?php echo $row->NAMA_PELANGGAN?></td>
			        <td><?php echo $row->JENIS_TRANSAKSI ?></td>
			        <td><?php echo $row->JENIS_PEMBAYARAN ?></td>
			        <td><?php echo $row->NOMINAL ?></td>
			  
				<?php endforeach ?>	

			</tr>
     
    </table>
	
</body>
</html>