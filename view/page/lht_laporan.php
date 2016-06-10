<?php
	include '../../konek.php';
	$id = $_GET['id'];
	session_start();
	$query = "SELECT pasien.*, pendaftaran.*, jenisbiaya.*, jadwalpraktek.*, dokter.*, pemeriksaan.*, resep.*, obat.*, pegawai.*
					FROM pendaftaran
					LEFT JOIN pasien ON pendaftaran.NoPasien = pasien.NoPasien
					LEFT JOIN pegawai ON pendaftaran.NIP = pegawai.NIP
					LEFT JOIN jadwalpraktek ON pendaftaran.KodeJadwal = jadwalpraktek.KodeJadwal
					LEFT JOIN jenisbiaya ON pendaftaran.IDJenisBiaya = jenisbiaya.IDJenisBiaya
					LEFT JOIN dokter ON jadwalpraktek.KodeDokter = dokter.KodeDokter
					LEFT JOIN pemeriksaan ON pendaftaran.NoPendaftaran = pemeriksaan.NoPendaftaran
					LEFT JOIN resep ON pemeriksaan.NoPemeriksaan = resep.NoPemeriksaan
					LEFT JOIN obat ON resep.KodeObat = obat.KodeObat
					WHERE pendaftaran.NoPendaftaran = '$id' ";
	$q = $konek->query($query);
	$fetch = $q->fetch_assoc();
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="../../css/stylelap.css" />
		<title>Laporan Pasien - Poliklinik Sehat Selalu</title>
		<script type="text/javascript" language="javascript">
			//get.document.ready
			//mywindow.print();
		</script>
	</head>
	<body>
		<div id="wrapper">
			<div id="header">
				<img src="../../images/logo_white.png" class="logo">
				<h2>Poliklinik Sehat Selalu</h2>
				<p>Jl. Ahmad Yani No. 2345 Solo. Telp. 0271-4124317</p>
				<p>Petugas: <?php echo $fetch['NamaPeg'] ?></p>
				<p>Nomor Pendaftaran: <?php echo $fetch['NoPendaftaran'] ?></p>
			</div>
			<table>
				<tr>
					<td>Nama Pasien</td>
					<td> : </td>
					<td><?php echo $fetch['NamaPas'] ?></td>
				</tr>
				<tr>
					<td>Tanggal Registrasi</td>
					<td> : </td>
					<td><?php echo $fetch['TglRegistrasi'] ?></td>
				</tr>
				<tr>
					<td>Alamat Pasien</td>
					<td> : </td>
					<td><?php echo $fetch['AlmPas'] ?></td>
				</tr>
				<tr>
					<td>Telepon Pasien</td>
					<td> : </td>
					<td><?php echo $fetch['TelpPas'] ?></td>
				</tr>
				<tr>
					<td>Tanggal Lahir Pasien</td>
					<td> : </td>
					<td><?php echo $fetch['TglLahirPas'] ?></td>
				</tr>
				<tr>
					<td>Jenis Kelamin</td>
					<td> : </td>
					<td><?php echo $fetch['JnsKelPas'] ?></td>
				</tr>
				<tr>
					<td>Berat Badan</td>
					<td> : </td>
					<td><?php echo $fetch['BeratBadan'] ?></td>
				</tr>
				<tr>
					<td>Tensi Diastolik</td>
					<td> : </td>			
					<td><?php echo $fetch['TensiDiastolik'] ?></td>
				</tr>
				<tr>
					<td>Tensi Sistolik</td>
					<td> : </td>
					<td><?php echo $fetch['TensiSistolik'] ?></td>
				</tr>
				<tr>
					<td>Keluhan</td>
					<td> : </td>
					<td><?php echo $fetch['Keluhan'] ?></td>
				</tr>
				<tr>
					<td>Diagnosa</td>
					<td> : </td>
					<td><?php echo $fetch['Diagnosa'] ?></td>
				</tr>
				<tr>
					<td>Tindakan</td>
					<td> : </td>
					<td><?php echo $fetch['Tindakan'] ?></td>
				</tr>
				<tr>
					<td>Resep Obat</td>
					<td> : </td>
					<td><?php echo $fetch['NmObat'] ?></td>
				</tr>
				<tr>
					<td>Dokter Pemeriksa</td>
					<td> : </td>
					<td><?php echo $fetch['NmDokter'] ?></td>
				</tr>
				<tr>
					<td>Nomor Telepon Dokter</td>
					<td> : </td>
					<td><?php echo $fetch['TelpDokter'] ?></td>
				</tr>
				<tr>
					<td>Nama Biaya</td>
					<td> : </td>
					<td><?php echo $fetch['NamaBiaya'] ?></td>
				</tr>
				<tr>
					<td>Tarif</td>
					<td> : </td>
					<td><?php echo $fetch['Tarif'] ?></td>
				</tr>
			</table>
		</div>
	</body>
</html>