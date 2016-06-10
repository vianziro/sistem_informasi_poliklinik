<?php 
	include '../konek.php';
	include '../lib.php';
	$act = $_GET['act'];
	$id = $_GET['id'];
	if($act == "hapus"){
		$query = "DELETE FROM pasien WHERE NoPasien = '$id' ";
		$q = $konek->query($query);
		if($q){
			echo "<script> loadpage('view/page/lht_pasien.php'); window.alert(\"Data berhasil dihapus.!\"); </script>";
		}
		else{
			echo "<script>loadpage('view/page/lht_pasien.php'); window.alert('Data gagal dihapus');</script>";
		}
	}
	else{		
		$nopasien = $_POST['nopasien'];
		$namapas = $_POST['namapas'];
		$almpas = $_POST['almpas'];
		$telppas = $_POST['telppas'];
		$kelpas = $_POST['kelpas'];
		$tgllhrpas = $_POST['tgllhrpas'];
		$tglrgs = date(ymd);
		$rand = rand(100000,999999);
		$enc_rand = base_convert($rand,30,36);
		$nopas = "pas-".$enc_rand;
		if(!isset($nopasien)){		
			//$query = "INSERT INTO pasien values('$nopas','$namapas','$almpas','$telppas','$tgllhrpas','$kelpas','$tglrgs')";
			$query = "INSERT INTO pasien values('$nopas','$namapas','$almpas','$telppas','$tgllhrpas','$kelpas','$tglrgs')";
			$q = $konek->query($query);
			if($q){
				echo '<script>window.alert("Berhasil menambahkan pasien");window.location=("../index.php?hal=pasien&act=view");</script>';	
			}
			else{
				echo '<script>window.alert("Gagal menambahkan pasien");window.location=("../index.php?hal=pasien&act=tambah");</script>';	
			}	
		}
		else{			
			$query = "UPDATE pasien SET NamaPas = '$namapas', AlmPas = '$almpas', TelpPas = '$telppas', TglLahirPas = '$tgllhrpas', JnsKelPas = '$kelpas' WHERE NoPasien = '$nopasien'";
			$q = $konek->query($query);
			if($q){
				echo '<script>window.alert("Berhasil merubah data pagawai");window.location=("../index.php?hal=pasien&act=view");</script>';	
			}
			else{
				echo '<script>window.alert("Gagal merubah data pagawai");window.location=("../index.php?hal=pasien&act=edit&id=");</script>';	
			}
		}
	}
?>