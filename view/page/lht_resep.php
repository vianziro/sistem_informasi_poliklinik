<?php
	//if($_SESSION['hak'] !== "apoteker"){
	//	echo '<script>window.alert("Anda Bukan Apoteker!");window.location=("login.php");</script>';
	//}
include '../../konek.php';
	include '../../lib.php';
	$act = $_GET['act'];
	if($act == "search"){
		$name = $_GET['name'];
		$query = "SELECT pemeriksaan.*, pasien.*, obat.*, resep.*
						FROM pemeriksaan LEFT JOIN pendaftaran ON pemeriksaan.NoPendaftaran = pendaftaran.NoPendaftaran
						LEFT JOIN pasien ON pendaftaran.NoPasien = pasien.NoPasien
						LEFT JOIN resep ON pemeriksaan.NoPemeriksaan = resep.NoPemeriksaan
						LEFT JOIN obat ON resep.KodeObat = obat.KodeObat
						WHERE pasien.NamaPas LIKE '%$name%' ";
	}
	else{
		$query = "SELECT pemeriksaan.*, pasien.*, obat.*, resep.*
						FROM pemeriksaan LEFT JOIN pendaftaran ON pemeriksaan.NoPendaftaran = pendaftaran.NoPendaftaran
						LEFT JOIN pasien ON pendaftaran.NoPasien = pasien.NoPasien
						LEFT JOIN resep ON pemeriksaan.NoPemeriksaan = resep.NoPemeriksaan
						LEFT JOIN obat ON resep.KodeObat = obat.KodeObat";
	}
?>
				<script type="text/javascript">
					$(document).ready(function(){
						$("#search").on('submit',function(e){
						var name = document.getElementById('ipt_cari').value;
						var judul = $('#toolbar').attr('class');
						//var berdasar = $('#option').html;
							e.preventDefault();
							$.post('', $("#search").serialize(), function(){						
								loadpage('view/page/lht_'+judul+'.php?act=search&name='+name);
								//load('view/page/bu_alt.php?act=search&name='+name+'&by='+by);
								$("#judul").html('Poliklinik Material | Hasil Pencarian dari "'+name+'"');
							});
						});
					});
				</script>
				<div id="toolbar" class="resep">
					<div id="group-btn">
						<button class="btn find btn-tb"></button>
						<button class="btn print btn-tb"></button>
					</div>				
					<form name="cari" id="search" style="display:block">
						<input type="text" name="ipt-cari" id="ipt_cari">
						<button type="submit" id="btn_cari" name="sbt-cr" class="active"></button>
					</form>
				</div>
				<div id="isi">
					<table>
						<tr id="table-header">
							<th>Nama Pasien</th>
							<th>Keluhan</th>
							<th>Diagnosa</th>
							<th>Perawatan</th>
							<th>Tindakan</th>
							<th>Resep</th>
						</tr>
						<?php
							//$query = "SELECT pegawai.*, login.UserName, login.TypeUser FROM pegawai LEFT JOIN login ON pegawai.NIP = login.NIP";
							$q = $konek->query($query);
							while ($fetch = $q->fetch_assoc()){
						?>
						<tr class="anak">
							<td><?php echo $fetch['NamaPas']; ?></td>
							<td><?php echo $fetch['Keluhan']; ?></td>
							<td><?php echo $fetch['Diagnosa']; ?></td>
							<td><?php echo $fetch['Perawatan']; ?></td>
							<td><?php echo $fetch['Tindakan']; ?></td>
							<td><?php echo $fetch['NmObat'] ; echo "<br>Dosis: ".$fetch['Dosis']; echo "<br>Jumlah: "; echo $fetch['Jumlah']; ?></td>
						</tr>
						<?php
							};
						?>
					</table>
				</div>