<?php
include("config.php");
include("fungsi/fungsi_indotgl.php");
include("fungsi/fungsi_rupiah.php");
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Laporan</title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
	</head>
	<body>
	<?php
	header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename=Data Transaksi Service Motor.xls");
	?>
		
		
							<center>
								<h3></h3>
								<h3>Data Transaksi Service</h3>
								<p>&nbsp;</p>
							</center>

							<table>
							  <thead>
								<tr>
								  <th>No Invoice</th>
								  <th>Tanggal Transaksi</th>
								  <th>No Polisi</th>
								  <th>Tipe Motor</th>
								  <th>Alamat</th>
								  <th>No Sparepart</th>
								  <th>Nama Sparepart</th>
								  <th>Harga Sparepart</th>
								  <th>Jumlah</th>
								  <th>Discount</th>
								  <th>Total</th>
								</tr>
							  </thead>
							  <tbody>
								<?php
									$no = 1;
									$total_semua = 0;
									$sqlquery = 'SELECT keuangan.no_invoice, tanggal_transaksi, qty,discount,total, pelanggan.no_polisi, tipe_motor, alamat, sparepart.no_sparepart, nama_sparepart, harga_sparepart, service.jenis_service from pelanggan join service on pelanggan.no_polisi=service.no_polisi join sparepart on service.yss_code=sparepart.yss_code join keuangan on sparepart.no_sparepart=keuangan.no_sparepart';

									if ($result = mysqli_query($koneksi, $sqlquery)) {
										while ($row = mysqli_fetch_assoc($result)) {
										$total = ($row["harga_sparepart"] * $row["qty"] - $row["discount"]);
										$total_semua += $total;
		
	
									?>
									<tr>
									<td><?php echo $row["no_invoice"];?></td>
									<td><?php echo tgl_indo($row["tanggal_transaksi"]);?></td>
									<td><?php echo $row["no_polisi"];?></td>
									<td><?php echo $row["tipe_motor"];?></td>
									<td><?php echo $row["alamat"];?></td>
									<td><?php echo $row["no_sparepart"];?></td>
									<td><?php echo $row["nama_sparepart"];?></td>
									<td><?php echo rupiah($row["harga_sparepart"]);?></td>
									<td><?php echo $row["jenis_service"];?></td>
									<td><?php echo $row["qty"];?></td>
									<td><?php echo rupiah ($row["discount"]);?></td>
									<td><?php echo rupiah($total);?></td>
								<?php
									$no++;}
								?>
								<tr>
								<td colspan='8'>Grand Total</td>
								<td colspan='2'><?php echo rupiah($total_semua); ?></td>
								</tr>
								<?php
										mysqli_free_result($result);
									}
									mysqli_close($koneksi);
									?>
							  </tbody>
							</table>
							<p>
							<div class='pull-right'>
							Cikarang, <?php echo tgl_indo($hari_ini); ?><br>
							<b><center>311810030 Service</center></b>
							<p>&nbsp;</p>
							<p>&nbsp;</p>
							<b><center>Wahyu Eka Saputra</center></b>
							</div>
						
		
	
</html>
