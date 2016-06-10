<?php 
	include '../konek.php';
	include '../lib.php';
	//session_start();
	$act = $_GET['act'];
	$id = $_GET['id'];
	if($act == "hapus"){
		$query = "DELETE FROM pendaftaran WHERE NoPendaftaran = '$id' ";
		$q = $konek->query($query);
		$query2 = "DELETE FROM pemeriksaan WHERE NoPendaftaran = '$id' ";
		$q2 = $konek->query($query2);		
		if($q & $q2){
			echo "<script> loadpage('view/page/lht_pendaftaran.php'); window.alert(\"Data berhasil dihapus.!\"); </script>";
		}
		else{
			echo "<script>loadpage('view/page/lht_pendaftaran.php'); window.alert('Data gagal dihapus');</script>";
		}
	}
	else{		
		$nopendaf = $_POST['nopendaf'];
		$tglpendaf = date(dmy);
		$nourut = $_POST['nourut'];
		$nopas = $_POST['nopas'];
		$idjnsbiaya = $_POST['idjnsbiaya'];
		$kdjadwal = $_POST['kdjadwal'];
		$nip = $_POST['nip'];
		$nmbiya = $_POST['nmbiya'];
		$tarif = $_POST['tarif'];
		$rand = rand(100,999);
		$enc_rand = base_convert($rand,30,36);
		$idjenisbiaya = "b-".$enc_rand;
		$rand2 = rand(100000,999999);
		$enc_rand2 = base_convert($rand2,30,36);
		$nopendaftaran = "pen-".$enc_rand2;
		if(!isset($nopendaf)){				
			$query = "INSERT INTO pendaftaran values('$nopendaftaran','$tglpendaf','$nourut','$nopas','$idjenisbiaya','$kdjadwal','$nip' )";
			$q = $konek->query($query);
			$query2 = "INSERT INTO jenisbiaya values ('$idjenisbiaya','$nmbiya','$tarif','$nopendaftaran')";
			$q2 = $konek->query($query2);
			if($q & $q2){
				echo '<script>window.alert("Berhasil manambahkan pendaftaran");window.location=("../index.php?hal=pendaftaran&act=view");</script>';	
			}
			else{
				echo '<script>window.alert("Gagal manambahkan pendaftaran");window.location=("../index.php?hal=pendaftaran&act=tambah");</script>';	
			}	
		}
		else{	
			$query = "UPDATE pendaftaran SET NIP = '$nip', KodeJadwal = '$kdjadwal' WHERE NoPendaftaran = '$nopendaf'";
			$q = $konek->query($query);
			$query2 = "UPDATE jenisbiaya SET NamaBiaya = '$nmbiya', Tarif = '$tarif' WHERE IDJenisBiaya = '$idjnsbiaya'";
			$q2 = $konek->query($query2);
			if($q & $q2){
				echo '<script>window.alert("Berhasil mengubah data pendaftaran");window.location=("../index.php?hal=pendaftaran&act=view");</script>';	
			}
			else{
				echo '<script>window.alert("Gagal mengubah data pendaftaran");window.location=("../index.php?hal=pendaftaran&act=edit&id=");</script>';	
			}
		}
	}
?>