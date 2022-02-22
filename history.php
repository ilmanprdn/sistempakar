<?php
    include "conf/inc.koneksi.php"
?>
<table border="1">
		<tr>
			<th>Nama</th>
			<th>Jenis Kelamin</th>
            <th>Alamat</th>
			<th>Pekerjaan</th>
			<th>Penyakit</th>
            <th>Tanggal</th>
		</tr>
		<?php 
		$data = mysqli_query($koneksi,"select * from tb_analisa");
		while($d = mysqli_fetch_array($data)){
			?>
			<tr>
				<td><?php echo $d['nama']; ?></td>
				<td><?php echo $d['kelamin']; ?></td>
				<td><?php echo $d['alamat']; ?></td>
                <td><?php echo $d['pekerjaan']; ?></td>
				<td><?php echo $d['id_penyakit']; ?></td>
                <td><?php echo $d['tanggal']; ?></td>
			</tr>
			<?php 
		}
		?>
	</table>

