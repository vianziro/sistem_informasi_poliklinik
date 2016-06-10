<?php 
	include '../konek.php';
	include '../lib.php';
	session_start();
	$act = $_GET['act'];
	$id = $_GET['id'];
	if($act == "hapus"){
		$query = "DELETE FROM pemeriksaan WHERE NoPemeriksaan = '$id' ";
		$q = $konek->query($query);
		$query2 = "DELETE FROM resep WHERE NoPemeriksaan = '$id' ";
		$q2 = $konek->query($query2);		
		if($q & $q2){
			echo '<script>window.alert("Berhasil menghapus data pemeriksaan");window.location=("../index.php?hal=pemeriksaan&act=view");</script>';	
		}
		else{
			echo '<script>window.alert("Gagal menghapus data pemeriksaan");window.location=("../index.php?hal=pemeriksaan&act=edit&id=");</script>';	
		}
	}
	else{		
		$nopem = $_POST['nopem'];
		$norsp = $_POST['norsp'];
		$keluhan =$_POST['keluhan'];
		$diagnosa = $_POST['diagnosa'];
		$perawatan = $_POST['perawatan'];
		$tindakan = $_POST['tindakan'];
		$berat = $_POST['berat'];
		$td = $_POST['td'];
		$ts = $_POST['ts'];
		$kdobt = $_POST['kdobt'];
		$dsobt = $_POST['dsobt'];
		$jmlobt = $_POST['jmlobt'];
		$nopendaf= $_POST['nopendaf'];
		$rand = rand(100,999);
		$enc_rand = base_convert($rand,30,36);
		$noresep = "r-".$enc_rand;
		$rand2 = rand(100000,999999);
		$enc_rand2 = base_convert($rand2,30,36);
		$nopemeriksaan = "pem-".$enc_rand2;
		$querya = "SELECT * from obat WHERE KodeObat = '$kdobt' ";
		$qa = $konek->query($querya);
		$fetcha = $qa->fetch_assoc();
		//echo $fetcha['HargaJual'];
		$biayatotal = ($fetcha['HargaJual']*$jmlobt)+25000;
		$namabiaya = "Pemeriksaan dan Obat";
		if(!isset($nopem)){				
			$query = "INSERT INTO pemeriksaan values('$nopemeriksaan','$keluhan','$diagnosa','$perawatan','$tindakan','$berat','$td' ,'$ts','$nopendaf')";
			$q = $konek->query($query);
			$query2 = "INSERT INTO resep values ('$noresep','$dsobt','$jmlobt','$kdobt','$nopemeriksaan')";
			$q2 = $konek->query($query2);
			$query3 = "UPDATE jenisbiaya SET Tarif = '$biayatotal', NamaBiaya = '$namabiaya' WHERE NoPendaftaran = '$nopendaf'";
			$q3 = $konek->query($query3);
			if($q & $q2 & $q3){
				echo '<script>window.alert("Berhasil manambahkan pemeriksaan");window.location=("../index.php?hal=pemeriksaan&act=view");</script>';	
			}
			else{
				echo '<script>window.alert("Gagal manambahkan pemeriksaan");window.location=("../index.php?hal=pemeriksaan&act=tambah");</script>';	
			}	
		}
		else{	
			$query = "UPDATE pemeriksaan SET Keluhan = '$keluhan', Tindakan = '$tindakan', Perawatan = '$perawatan', Diagnosa ='$diagnosa', BeratBadan = '$berat', TensiDiastolik = '$td', TensiSistolik = '$ts'    WHERE NoPemeriksaan = '$nopem'  ";
			$q = $konek->query($query);
			$query2 = "UPDATE resep SET Dosis = '$dsobt', Jumlah = '$jmlobt', KodeObat = '$kdobt' WHERE NoPemeriksaan = '$nopem'";
			$q2 = $konek->query($query2);
			$query3 = "UPDATE jenisbiaya SET Tarif = '$biayatotal', NamaBiaya = '$namabiaya' WHERE NoPendaftaran = '$nopendaf'";
			$q3 = $konek->query($query3);
			if($q & $q2 & $q3){
				echo '<script>window.alert("Berhasil mengubah data pemeriksaan");window.location=("../index.php?hal=pemeriksaan&act=view");</script>';	
			}
			else{
				echo '<script>window.alert("Gagal mengubah data pemeriksaan");window.location=("../index.php?hal=pemeriksaan&act=edit&id=");</script>';	
			}
		}
	}
?>