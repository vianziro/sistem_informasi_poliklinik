<?php 
	include '../konek.php';
	include '../lib.php';
	$act = $_GET['act'];
	$id = $_GET['id'];
	if($act == "hapus"){
		$query = "DELETE FROM obat WHERE KodeObat = '$id' ";
		$q = $konek->query($query);
		if($q){
			echo '<script>window.alert("Berhasil menghapus data obat");window.location=("../index.php?hal=obat&act=view");</script>';	
		}
		else{
			echo '<script>window.alert("Gagal menghapus data obat");window.location=("../index.php?hal=obat&act=edit&id=");</script>';	
		}
	}
	else{		
		$kodeobat = $_POST['kodeobat'];
		$namaobt = $_POST['namaobt'];
		$merk = $_POST['merk'];
		$satuan = $_POST['satuan'];
		$hrgjl = $_POST['hrgjl'];
		$rand = rand(100000,999999);
		$enc_rand = base_convert($rand,30,36);
		$kdobat = "obt-".$enc_rand;
		if(!isset($kodeobat)){		
			//$query = "INSERT INTO obat values('$nopas','$namapas','$almpas','$telppas','$tgllhrpas','$kelpas','$tglrgs')";
			$query = "INSERT INTO obat values('$kdobat','$namaobt','$merk','$satuan','$hrgjl')";
			$q = $konek->query($query);
			if($q){
				echo '<script>window.alert("Berhasil menambahkan obat");window.location=("../index.php?hal=obat&act=view");</script>';	
			}
			else{
				echo '<script>window.alert("Gagal menambahkan obat");window.location=("../index.php?hal=obat&act=tambah");</script>';	
			}	
		}
		else{			
			$query = "UPDATE obat SET NmObat = '$namaobt', Merk = '$merk', Satuan = '$satuan', HargaJual = '$hrgjl' WHERE KodeObat = '$kodeobat'";
			$q = $konek->query($query);
			if($q){
				echo '<script>window.alert("Berhasil merubah data obat");window.location=("../index.php?hal=obat&act=view");</script>';	
			}
			else{
				echo '<script>window.alert("Gagal merubah data obat");window.location=("../index.php?hal=obat&act=edit&id=");</script>';	
			}
		}
	}
?>