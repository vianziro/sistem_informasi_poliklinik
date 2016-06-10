<?php 
	include '../../konek.php';
	include '../../lib.php';
	$id = $_GET['id'];
	$act = $_GET['act'];
	if($act == "edit"){
		$query = "SELECT dokter.*, jadwalpraktek.*, poliklinik.* 
						FROM dokter 
						LEFT JOIN jadwalpraktek ON dokter.KodeDokter = jadwalpraktek.KodeDokter 
						LEFT JOIN poliklinik ON dokter.KodePoli = poliklinik.KodePoli 
						WHERE dokter.KodeDokter = '".$id."' ";
		$q = $konek->query($query);
		$fetch = $q->fetch_assoc();
		$usr = "<input type='hidden' name='kodedokter' class='ipt-text' value='$id'>
					<input type='hidden' name='kodejadwal' class='ipt-text' value='".$fetch['KodeJadwal']."'>";
	}
	else{
		$usr = "";
	}
?>				
				<script type="text/javascript">
					$(document).ready(function(){
						$("#biasa").on('submit',function(e){
							e.preventDefault();
							$.post('modul/act_dokter.php', $("#biasa").serialize(), function(){
								loadpage('view/page/lht_dokter.php');
								window.alert("Input Sukses Besar Boss!");
							});
						});
					});
				</script>
				<div id="toolbar" class="dokter">
					<div id="group-btn">
						<button class="btn back btn-tb" onclick="loadpage('view/page/lht_dokter.php')"></button>
					</div>
				</div>
				<div id="isi">
					<form id="biasa">
						<?php
							echo $usr;
						?>
						<p>Nama Dokter</p>
						<input type="text" name="namadok" class="ipt-text" required value="<?php echo $fetch['NmDokter']; ?>" >
						<p>Alamat Dokter</p>
						<input type="text" name="almdok" class="ipt-text" required value="<?php echo $fetch['AlmDokter']; ?>" >
						<p>Nomor Telepon</p>
						<input type="text" name="telpdok" class="ipt-text" required value="<?php echo $fetch['TelpDokter']; ?>" >
						<p>Hari Masuk</p>
						<input type="day" name="hari" class="ipt-text" required value="<?php echo $fetch['Hari']; ?>" >
						<p>Mulai Praktek</p>
						<input type="time" name="mpraktek" class="ipt-text" required value="<?php echo $fetch['JamMulai']; ?>" >
						<p>Selesai Praktek</p>
						<input type="time" name="spraktek" class="ipt-text" required value="<?php echo $fetch['JamSelesai']; ?>" >
						<p>Praktek di</p>
						<select name="kdpoli" require>
							<option value="<?php echo $fetch['kdpoli']; ?>"><?php echo $fetch['NamaPoli']; ?></option>
							<?php
								$query_poli = "SELECT * FROM poliklinik";
								$q_poli = $konek->query($query_poli);
								while ($fetch_poli = $q_poli->fetch_assoc()){
							?>
							<option value="<?php echo $fetch_poli['KodePoli']; ?>"><?php echo $fetch_poli['NamaPoli']; ?></option>
							<?php
								}
							?>
						</select>
						<input type="hidden" name="act" class="ipt-text" value="<?php echo $act; ?>" >
						<p></p>
						<input type="submit" name="sbt" class="sbt-btn">
					</form>
				</div>