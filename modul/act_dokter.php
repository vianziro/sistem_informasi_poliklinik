<?php 
	include '../konek.php';
	include '../lib.php';
	$act = $_GET['act'];
	$id = $_GET['id'];
	if($act == "hapus"){
		$query = "DELETE FROM dokter WHERE KodeDokter = '$id' ";
		$q = $konek->query($query);
		$query2 = "DELETE FROM dokter WHERE KodeDokter = '$id' ";
		$q2 = $konek->query($query2);		
		if($q & $q2){
			echo "<script> loadpage('view/page/lht_dokter.php'); window.alert(\"Data berhasil dihapus.!\"); </script>";
		}
		else{
			echo "<script>loadpage('view/page/lht_dokter.php'); window.alert('Data gagal dihapus');</script>";
		}
	}
	else{		
		$kodedokter = $_POST['kodedokter'];
		$kodejadwal = $_POST['kodejadwal'];
		$namadok = $_POST['namadok'];
		$almdok = $_POST['almdok'];
		$telpdok = $_POST['telpdok'];
		$hari = $_POST['hari'];
		$kdpoli = $_POST['kdpoli'];
		$mpraktek = $_POST['mpraktek'];
		$spraktek = $_POST['spraktek'];
		$rand = rand(100,999);
		$enc_rand = base_convert($rand,30,36);
		$kddktr = "d-".$enc_rand;
		$kdjwl = "j-".$enc_rand;
		if(!isset($kodedokter)){		
			$query = "INSERT INTO dokter values('$kddktr','$namadok','$almdok','$telpdok','$kdpoli')";
			$q = $konek->query($query);
			$query2 = "INSERT INTO jadwalpraktek values ('$kdjwl', '$hari','$mpraktek','$spraktek','$kddktr')";
			$q2 = $konek->query($query2);
			if($q & $q2){
				echo '<script>window.alert("Berhasil menambahkan dokter");window.location=("../index.php?hal=dokter&act=view");</script>';	
			}
			else{
				echo '<script>window.alert("Gagal menambahkan dokter");window.location=("../index.php?hal=dokter&act=tambah");</script>';	
			}	
		}
		else{			
			$query = "UPDATE dokter SET NmDokter = '$namadok', AlmDokter = '$almdok', TelpDokter = '$telpdok', KodePoli = '$kdpoli' WHERE KodeDokter = '$kodedokter'";
			$q = $konek->query($query);
			$query2 = "UPDATE jadwalpraktek SET Hari = '$hari', JamMulai = '$mpraktek', JamSelesai = '$spraktek' WHERE KodeJadwal = '$kodejadwal' ";
			$q2 = $konek->query($query2);
			if($q & $q2){
				echo '<script>window.alert("Berhasil merubah data pagawai");window.location=("../index.php?hal=dokter&act=view");</script>';	
			}
			else{
				echo '<script>window.alert("Gagal merubah data pagawai");window.location=("../index.php?hal=dokter&act=edit&id=");</script>';	
			}
		}
	}
?>