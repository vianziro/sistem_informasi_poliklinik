<?php 
	include '../../konek.php';
	include '../../lib.php';
	$id = $_GET['id'];
	$act = $_GET['act'];
	if($act == "edit"){
		//$query = "SELECT pemeriksaan.*, pasien.*
		//				FROM pemeriksaan LEFT JOIN pendaftaran ON pemeriksaan.NoPendaftaran = pendaftaran.NoPendaftaran
		//				LEFT JOIN pasien ON pendaftaran.NoPasien = pasien.NoPasien
		//				WHERE pemeriksaan.NoPemeriksaan = '".$id."' ";
		$query = "SELECT pemeriksaan.*, pasien.*, obat.*, resep.*
						FROM pemeriksaan LEFT JOIN pendaftaran ON pemeriksaan.NoPendaftaran = pendaftaran.NoPendaftaran
						LEFT JOIN pasien ON pendaftaran.NoPasien = pasien.NoPasien
						LEFT JOIN resep ON pemeriksaan.NoPemeriksaan = resep.NoPemeriksaan
						LEFT JOIN obat ON resep.KodeObat = obat.KodeObat
						WHERE pemeriksaan.NoPemeriksaan = '".$id."' ";
		$q = $konek->query($query);
		$fetch = $q->fetch_assoc();
		$usr = "<input type='hidden' name='nopem' class='ipt-text' value='".$fetch['NoPemeriksaan']."'>
					<input type='hidden' name='nopendaf' class='ipt-text' value='".$fetch['NoPendaftaran']."'>
					<input type='hidden' name='nosrp' class='ipt-text' value='".$fetch['NoResep']."'>";
	}
	else{
		$query = "SELECT pendaftaran.*, pasien.NamaPas FROM pendaftaran LEFT JOIN pasien ON pendaftaran.NoPasien = pasien.NoPasien
						WHERE pendaftaran.NoPasien = '".$id."' ";
		$q = $konek->query($query);
		$fetch = $q->fetch_assoc();
		$usr = "<input type='hidden' name='nopendaf' class='ipt-text' value='".$fetch['NoPendaftaran']."'>
					<input type='hidden' name='nosrp' class='ipt-text' value='".$fetch['NoResep']."'>";
	}
?>				
				<script type="text/javascript">
					$(document).ready(function(){
						$("#biasa").on('submit',function(e){
							e.preventDefault();
							$.post('modul/act_pemeriksaan.php', $("#biasa").serialize(), function(){
								loadpage('view/page/lht_pemeriksaan.php');
								window.alert("Input Sukses Besar Boss!");
							});
						});
					});
				</script>
				<div id="toolbar" class="dokter">
					<div id="group-btn">
						<button class="btn back btn-tb" onclick="loadpage('view/page/lht_pemeriksaan.php')"></button>
					</div>
				</div>
				<div id="isi">
					<form id="biasa">
						<?php
							echo $usr;
						?>
						<p>Nama Pasien</p>
						<input type="text" name="namapas" class="ipt-text" required value="<?php echo $fetch['NamaPas']; ?>"  disabled>
						<p>Keluhan</p>
						<input type="text" name="keluhan" class="ipt-text" required value="<?php echo $fetch['Keluhan']; ?>" >
						<p>Diagnosa</p>
						<input type="text" name="diagnosa" class="ipt-text" required value="<?php echo $fetch['Diagnosa']; ?>" >
						<p>Perawatan</p>
						<input type="text" name="perawatan" class="ipt-text" required value="<?php echo $fetch['Perawatan']; ?>" >
						<p>Tindakan</p>
						<input type="text" name="tindakan" class="ipt-text" required value="<?php echo $fetch['Tindakan']; ?>" >
						<p>BeratBadan</p>
						<input type="number" name="berat" class="ipt-text" required value="<?php echo $fetch['BeratBadan']; ?>" >
						<p>Tensi Diastolik</p>
						<input type="number" name="td" class="ipt-text" required value="<?php echo $fetch['TensiDiastolik']; ?>" >
						<p>Tensi Sistolik</p>
						<input type="number" name="ts" class="ipt-text" required value="<?php echo $fetch['TensiSistolik']; ?>" >
						<p>Resep obat</p>
						<select name="kdobt" required>
							<option value="<?php echo $fetch['KodeObat'] ?>"><?php echo $fetch['NmObat'] ?></option>
							<?php
							$query2 = "SELECT * FROM obat";
							$q2 = $konek->query($query2);
							while($fetch2 = $q2->fetch_assoc()){
								?>
							<option value="<?php echo $fetch2['KodeObat']; ?>"><?php echo $fetch2['NmObat']; ?></option>
							<?php
							}
							?>
						</select>
						<p>Dosis obat</p>
						<input type="text" name="dsobt" class="ipt-text" required value="<?php echo $fetch['Dosis']; ?>" >
						<p>Jumlah obat</p>
						<input type="number" name="jmlobt" class="ipt-text" required value="<?php echo $fetch['Jumlah']; ?>" >
						<p></p>
						<input type="submit" name="sbt" class="sbt-btn">
					</form>
				</div>