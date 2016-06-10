<?php 
	include '../konek.php';
	include '../lib.php';
	$act = $_GET['act'];
	$id = $_GET['id'];	
	$subid = substr($id, 6,10);
	if($act == "hapus"){
		$query = "DELETE FROM pegawai WHERE NIP = '$subid' ";
		$q = $konek->query($query);
		$query2 = "DELETE FROM login WHERE NIP = '$subid' ";
		$q2 = $konek->query($query2);		
		if($q & $q2){
			echo "<script> loadpage('view/page/lht_pegawai.php'); window.alert(\"Data berhasil dihapus.!\"); </script>";
		}
		else{
			echo "<script>loadpage('view/page/lht_pegawai.php'); window.alert('Data gagal dihapus');</script>";
		}
	}
	else{		
		$nip = $_POST['nip'];
		$namapeg = $_POST['namapeg'];
		$almpeg = $_POST['almpeg'];
		$telppeg = $_POST['telppeg'];
		$tglpeg = $_POST['tglpeg'];
		$jnskel = $_POST['jnskel'];
		$user = $_POST['user'];
		$pass = $_POST['pass'];
		$typeuser = $_POST['typeuser'];
		$userimg = "user-".strtolower(substr($namapeg,0,1)).".svg";
		$enc = md5($pass);
		if(!isset($user)){			
			$query = "UPDATE pegawai SET NamaPeg = '$namapeg', AlmPeg = '$almpeg', TelpPeg = '$telppeg', TglLhrPeg = '$tglpeg', JnsKelPeg = '$jnskel' WHERE NIP = '$nip'";
			$q = $konek->query($query);
			$query2 = "UPDATE login SET TypeUser = '$typeuser' WHERE NIP = '$nip'";
			$q2 = $konek->query($query2);
			if($q & $q2){
				echo '<script>window.alert("Berhasil mengubah data pagawai");window.location=("../index.php?hal=pegawai&act=view");</script>';	
			}
			else{
				echo '<script>window.alert("Gagal mengubah data pagawai");window.location=("../index.php?hal=pegawai&act=edit&id=");</script>';	
			}
		}
		else{			
			$query = "INSERT INTO pegawai values('$nip','$namapeg','$almpeg','$telppeg','$tglpeg','$telppeg')";
			$q = $konek->query($query);
			$query2 = "INSERT INTO login values ('$user','$enc','$typeuser','$nip','$userimg')";
			$q2 = $konek->query($query2);
			if($q & $q2){
				echo '<script>window.alert("Berhasil manambahkan pagawai");window.location=("../index.php?hal=pegawai&act=view");</script>';	
			}
			else{
				echo '<script>window.alert("Gagal manambahkan pagawai");window.location=("../index.php?hal=pegawai&act=tambah");</script>';	
			}
		}
	}
?>