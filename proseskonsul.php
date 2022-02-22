<?php 
include "conf/inc.koneksi.php";
	
# Baca variabel Form (If Register Global ON)
$RbPilih 	= $_REQUEST['RbPilih'];
$TxtIdGejala= $_REQUEST['TxtIdGejala'];

# Mendapatkan No IP
$NOIP 		= $_SERVER['REMOTE_ADDR'];

# Fungsi untuk menambah data ke tmp_analisa
function AddTmpAnalisa($koneksi,  $idgejala, $NOIP) {
	$sql_solusi = "SELECT tb_rules.* FROM tb_rules,tmp_penyakit WHERE tb_rules.id_penyakit=tmp_penyakit.id_penyakit AND noip='$NOIP' ORDER BY tb_rules.id_penyakit,tb_rules.id_gejala";
	$qry_solusi = mysqli_query($koneksi, $sql_solusi);
	while ($data_solusi = mysqli_fetch_array($qry_solusi)) {
		$sqltmp = "INSERT INTO tmp_analisa (noip, id_penyakit,id_gejala)
					VALUES ('$NOIP','$data_solusi[id_penyakit]','$data_solusi[id_gejala]')";
		mysqli_query($koneksi, $sqltmp);
	}
}

# Fungsi hapus tabel tmp_gejala
function AddTmpGejala($koneksi, $idgejala, $NOIP) {
	$sql_gejala = "INSERT INTO tmp_gejala (noip,id_gejala) VALUES ('$NOIP','$idgejala')";
	mysqli_query($koneksi, $sql_gejala);
}

# Fungsi hapus tabel tmp_sakit
function DelTmpSakit($koneksi, $NOIP) {
	$sql_del = "DELETE FROM tmp_penyakit WHERE noip='$NOIP'";
	mysqli_query($koneksi, $sql_del);
}

# Fungsi hapus tabel tmp_analisa
function DelTmpAnlisa($koneksi,  $NOIP) {
	$sql_del = "DELETE FROM tmp_analisa WHERE noip='$NOIP'";
	mysqli_query($koneksi, $sql_del);
}

# PEMERIKSAAN
if ($RbPilih == "YA") {
	$sql_analisa = "SELECT * FROM tmp_analisa where noip='$NOIP' ";
	$qry_analisa = mysqli_query($koneksi, $sql_analisa);
	$data_cek = mysqli_num_rows($qry_analisa);
	if ($data_cek >= 1) {
		# Kode saat tmp_analisa tidak kosong
		DelTmpSakit($koneksi,  $NOIP);
		$sql_tmp = "SELECT * FROM tmp_analisa 
					WHERE id_gejala='$TxtIdGejala' 
					AND noip='$NOIP'";
		$qry_tmp = mysqli_query($koneksi, $sql_tmp);
		while ($data_tmp = mysqli_fetch_array($qry_tmp)) {
			$sql_rsolusi = "SELECT * FROM tb_rules 
							WHERE id_penyakit='$data_tmp[id_penyakit]' 
							GROUP BY id_penyakit";
			$qry_rsolusi = mysqli_query($koneksi, $sql_rsolusi);
			while ($data_rsolusi = mysqli_fetch_array($qry_rsolusi)) {
				// Data solusi gizi yang mungkin dimasukkan ke tmp
				$sql_input = "INSERT INTO tmp_penyakit (noip,id_penyakit)
							 VALUES ('$NOIP','$data_rsolusi[id_penyakit]')";
				mysqli_query($koneksi, $sql_input);
			}
		} 
		// Gunakan Fungsi
		DelTmpAnlisa($koneksi, $NOIP);
		AddTmpAnalisa($koneksi,  $TxtIdGejala, $NOIP);
		AddTmpGejala($koneksi,  $TxtIdGejala, $NOIP);
	}	
	else {
		# Kode saat tmp_analisa kosong
		$sql_rgejala = "SELECT * FROM tb_rules WHERE id_gejala='$TxtIdGejala'";
		$qry_rgejala = mysqli_query($koneksi, $sql_rgejala);
		while ($data_rgejala = mysqli_fetch_array($qry_rgejala)) {
			$sql_rsolusi = "SELECT * FROM tb_rules 
						   WHERE id_penyakit='$data_rgejala[id_penyakit]' 
						   GROUP BY id_penyakit";
			$qry_rsolusi = mysqli_query($koneksi, $sql_rsolusi);
			while ($data_rsolusi = mysqli_fetch_array($qry_rsolusi)) {
				// Data solusi gizi yang mungkin dimasukkan ke tmp
				$sql_input = "INSERT INTO tmp_penyakit (noip,id_penyakit)
							 VALUES ('$NOIP','$data_rsolusi[id_penyakit]')";
				mysqli_query($koneksi, $sql_input);
			}
		} 
		// Menggunakan Fungsi
		AddTmpAnalisa($koneksi,  $TxtIdGejala, $NOIP);
		AddTmpGejala($koneksi, $TxtIdGejala, $NOIP);
	}
	echo "<meta http-equiv='refresh' content='0; url=index.php?page=start'>";
}

if ($RbPilih == "TIDAK") {
	$sql_analisa = "SELECT * FROM tmp_analisa where noip='$NOIP' ";
	$qry_analisa = mysqli_query($koneksi, $sql_analisa);
	$data_cek = mysqli_num_rows($qry_analisa);
	if ($data_cek >= 1) {
		# Kode saat tmp_analisa tidak kosong
		$sql_rule = "SELECT * FROM tmp_analisa WHERE id_gejala='$TxtIdGejala'";
		$qry_rule = mysqli_query($koneksi, $sql_rule);
		while($hsl_rule = mysqli_fetch_array($qry_rule)){
			// Hapus daftar rule yang sudah tidak mungkin dari tabel tmp
			$sql_deltmp = "DELETE FROM tmp_analisa 
							WHERE id_penyakit='$hsl_rule[id_penyakit]' 
							AND noip='$NOIP'";
			mysqli_query($koneksi, $sql_deltmp);
			
			// Hapus daftar solusi gizi yang sudah tidak ada kemungkinan
			$sql_deltmp2 = "DELETE FROM tmp_penyakit
						    WHERE id_penyakit='$hsl_rule[id_penyakit]' 
						    AND noip='$NOIP'";
			mysqli_query($koneksi, $sql_deltmp2);
		}		
	}
	else {
		# Pindahkan data relsi ke tmp_analisa
		$sql_rule= "SELECT * FROM tb_rules ORDER BY id_penyakit,id_gejala";
		$qry_rule= mysqli_query($koneksi, $sql_rule);
		while($hsl_rule=mysqli_fetch_array($qry_rule)){
			$sql_intmp = "INSERT INTO tmp_analisa (noip, id_penyakit,id_gejala)
						  VALUES ('$NOIP','$hsl_rule[id_penyakit]',
						  '$hsl_rule[id_gejala]')";
			mysqli_query($koneksi, $sql_intmp);
			
			// Masukkan data solusi gizi yang mungkin terjangkit
			$sql_intmp2 = "INSERT INTO tmp_penyakit(noip,id_penyakit)
						   VALUES ('$NOIP','$hsl_rule[id_penyakit]')";
			mysqli_query($koneksi, $sql_intmp2);				
		}
		
		# Hapus tmp_analisa yang tidak sesuai
		$sql_rule2 = "SELECT * FROM tb_rules WHERE id_gejala='$TxtIdGejala'";
		$qry_rule2 = mysqli_query($koneksi, $sql_rule2);
		while($hsl_rule2 = mysqli_fetch_array($qry_rule2)){
			$sql_deltmp = "DELETE FROM tmp_analisa 
						   WHERE id_penyakit='$hsl_rule2[id_penyakit]' 
						   AND noip='$NOIP'";
			mysqli_query($koneksi, $sql_deltmp);
			
			// Hapus solusi gizi yang sudah tidak mungkin
			$sql_deltmp2 = "DELETE FROM tmp_penyakit
							WHERE id_penyakit='$hsl_rule2[id_penyakit]' 
							AND noip='$NOIP'";
			mysqli_query($koneksi, $sql_deltmp2);
		}
	}
	echo "<meta http-equiv='refresh' content='0; url=index.php?page=start'>";
}
?>