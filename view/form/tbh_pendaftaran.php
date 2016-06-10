<?php 
	include '../../konek.php';
	include '../../lib.php';
	$id = $_GET['id'];
	$act = $_GET['act'];
	if($act == "edit"){
		$query = "SELECT pendaftaran.*, pasien.*, jenisbiaya.*, dokter.NmDokter 
						FROM pendaftaran 
						LEFT JOIN pasien ON pendaftaran.NoPasien = pasien.NoPasien 
						LEFT JOIN jenisbiaya ON pendaftaran.IDJenisBiaya = jenisbiaya.IDJenisBiaya 
						LEFT JOIN jadwalpraktek ON pendaftaran.KodeJadwal = jadwalpraktek.KodeJadwal 
						LEFT JOIN dokter ON jadwalpraktek.KodeDokter = dokter.KodeDokter
						WHERE pendaftaran.NoPendaftaran = '".$id."' ";
		$q = $konek->query($query);
		$fetch = $q->fetch_assoc();
		$usr = "<input type='hidden' name='nopendaf' class='ipt-text' value='".$fetch['NoPendaftaran']."'>
					<input type='hidden' name='idjnsbiaya' class='ipt-text' value='".$fetch['IDJenisBiaya']."'>
					<input type='hidden' name='nip' class='ipt-text' value='".$_SESSION['nip']."'>
					<input type='hidden' name='nopas' class='ipt-text' value='".$fetch['NoPasien']."'>";
	}
	else{
		$query = "SELECT * FROM pasien	WHERE NoPasien = '".$id."' ";
		$q = $konek->query($query);
		$fetch = $q->fetch_assoc();
		$usr = "<input type='hidden' name='nopas' class='ipt-text' value='".$fetch['NoPasien']."'>
					<input type='hidden' name='nip' class='ipt-text' value='".$_SESSION['nip']."'>";
	}
?>				
				<script type="text/javascript">
					$(document).ready(function(){
						$("#biasa").on('submit',function(e){
							e.preventDefault();
							$.post('modul/act_pendaftaran.php', $("#biasa").serialize(), function(){
								loadpage('view/page/lht_pendaftaran.php');
								window.alert("Input Sukses Besar Boss!");
							});
						});
					});
				</script>
				<div id="toolbar" class="pendaftaran">
					<div id="group-btn">
						<button class="btn back btn-tb" onclick="loadpage('view/page/lht_pasien.php')"></button>
					</div>
				</div>
				<div id="isi">
					<form id="biasa">
						<?php
							echo $usr;
						?>
						<p>Nama Pasien</p>
						<input type="text" name="namapas" class="ipt-text" required value="<?php echo $fetch['NamaPas']; ?>"  disabled>
						<p>No Urut</p>
						<input type="text" name="nourut" class="ipt-text" required value="<?php echo $fetch['NoUrut']; ?>" >
						<p>Nama Dokter</p>
						<select name="kdjadwal" require>
							<option value="<?php echo $fetch['KodeJadwal']; ?>"><?php echo $fetch['NmDokter']; ?></option>
						<?php
							$tglrgs = date(D);
							if($tglrgs == "Sun"){
								$hari = "Minggu";
							}
							if($tglrgs == "Mon"){
								$hari = "Senin";
							}
							if($tglrgs == "Tues"){
								$hari = "Selasa";
							}
							if($tglrgs == "Wed"){
								$hari = "Rabu";
							}
							if($tglrgs == "Thu"){
								$hari = "Kamis";
							}
							if($tglrgs == "Fri"){
								$hari = "Jum'at'";
							}
							if($tglrgs == "Sat"){
								$hari = "Sabtu";
							}
							$query2 = "SELECT dokter.*, jadwalpraktek.* 
											FROM dokter 
											LEFT JOIN jadwalpraktek ON dokter.KodeDokter = jadwalpraktek.KodeDokter 
											WHERE jadwalpraktek.Hari = '$hari' ";
							$q2 = $konek->query($query2);
							while($fetch2 = $q2->fetch_assoc()){
								?>
							<option value="<?php echo $fetch2['KodeJadwal']; ?>"><?php echo $fetch2['NmDokter']; ?></option>
							<?php
							}
						?>
						</select>
						<p></p>
						<input type="submit" name="sbt" class="sbt-btn">
					</form>
				</div>