<?php 
	include '../konek.php';
	include '../lib.php';
	$act = $_GET['act'];
	$id = $_GET['id'];
	if($act == "hapus"){
		$query = "DELETE FROM poliklinik WHERE KodePoli = '$id' ";
		$q = $konek->query($query);
		if($q){
			echo "<script> loadpage('view/page/lht_poliklinik.php'); window.alert(\"Data berhasil dihapus.!\"); </script>";
		}
		else{
			echo "<script>loadpage('view/page/lht_poliklinik.php'); window.alert('Data gagal dihapus');</script>";
		}
	}
	else{		
		$kodepoli = $_POST['kodepoli'];
		$namapoli = $_POST['namapoli'];		
		$rand = rand(100,999);
		$enc_rand = base_convert($rand,30,36);
		$kdpl = "p-".$enc_rand;
		if(!isset($kodepoli)){			
			$query = "INSERT INTO poliklinik values('$kdpl','$namapoli')";
			$q = $konek->query($query);
			if($q){
				echo '<script>window.alert("Berhasil manambahkan poliklinik");window.location=("../index.php?hal=poliklinik&act=view");</script>';	
			}
			else{
				echo '<script>window.alert("Gagal manambahkan poliklinik");window.location=("../index.php?hal=poliklinik&act=tambah");</script>';	
			}	
		}
		else{		
			$query = "UPDATE poliklinik SET NamaPoli = '$namapoli' WHERE KodePoli = '$kodepoli'";
			$q = $konek->query($query);
			if($q){
				echo '<script>window.alert("Berhasil mengubah data poliklinik");window.location=("../index.php?hal=poliklinik&act=view");</script>';	
			}
			else{
				echo '<script>window.alert("Gagal mengubah data poliklinik");window.location=("../index.php?hal=poliklinik&act=edit&id=");</script>';	
			}
		}
	}
?>