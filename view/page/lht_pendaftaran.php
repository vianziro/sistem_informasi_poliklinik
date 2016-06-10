<?php
	//if($_SESSION['hak'] == "admin"){
	//	echo '<script>window.alert("Anda Bukan Resepsionis!");window.location=("login.php");</script>';
	//}
	include '../../konek.php';
	include '../../lib.php';
	$act = $_GET['act'];
	if($act == "search"){
		$name = $_GET['name'];
		$query = "SELECT pendaftaran.*, pasien.NamaPas, jenisbiaya.*, dokter.NmDokter 
						FROM pendaftaran 
						LEFT JOIN pasien ON pendaftaran.NoPasien = pasien.NoPasien 
						LEFT JOIN jenisbiaya ON pendaftaran.IDJenisBiaya = jenisbiaya.IDJenisBiaya 
						LEFT JOIN jadwalpraktek ON pendaftaran.KodeJadwal = jadwalpraktek.KodeJadwal 
						LEFT JOIN dokter ON jadwalpraktek.KodeDokter = dokter.KodeDokter 
						WHERE pasien.NamaPas LIKE '%$name%' ";
	}
	else{
		$query = "SELECT pendaftaran.*, pasien.NamaPas, jenisbiaya.*, dokter.NmDokter 
						FROM pendaftaran 
						LEFT JOIN pasien ON pendaftaran.NoPasien = pasien.NoPasien 
						LEFT JOIN jenisbiaya ON pendaftaran.IDJenisBiaya = jenisbiaya.IDJenisBiaya 
						LEFT JOIN jadwalpraktek ON pendaftaran.KodeJadwal = jadwalpraktek.KodeJadwal 
						LEFT JOIN dokter ON jadwalpraktek.KodeDokter = dokter.KodeDokter";
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
				<div id="toolbar" class="pendaftaran">
					<div id="group-btn">
						<button class="btn edit btn-tb" id="edit-btn" style="display:none" onclick="sunting()"></button>
						<button class="btn delete btn-tb" id="del-btn" style="display:none" onclick="del()"></button>
						<button class="btn clock btn-tb" id="report-btn" style="display:none" onclick="periksa()"></button>
						<button class="btn print btn-tb" id="daftar-btn" style="display:none" onclick="report()"></button>
						<button class="btn find btn-tb"></button>
					</div>				
					<form name="cari" id="search" style="display:block">
						<input type="text" name="ipt-cari" id="ipt_cari">
						<button type="submit" id="btn_cari" name="sbt-cr" class="active"></button>
					</form>
				</div>
				<div id="isi">
					<table>
						<thead>
							<tr id="table-header">
								<th>Nama Pasien</th>
								<th>Tanggal Pendaftaran</th>
								<th>Nomor Urut</th>
								<th>Nama Dokter</th>
								<th>Nama Biaya</th>
								<th>Tarif</th>
								<!--<th>Aksi</th>-->
							</tr>
						</thead>
						<tbody>
						<?php
							//$query = "SELECT pegawai.*, login.UserName, login.TypeUser FROM pegawai LEFT JOIN login ON pegawai.NIP = login.NIP";
							$q = $konek->query($query);
							while ($fetch = $q->fetch_assoc()){
						?>
							<tr id="<?php echo $fetch['NoPendaftaran']; ?>" name="<?php echo $fetch['NoPasien']; ?>" onclick="selectRecord('#<?php echo $fetch['NoPendaftaran']; ?>')" class="pointer">
								<td><?php echo $fetch['NamaPas']; ?></td>
								<td><?php echo $fetch['TglPendaftaran']; ?></td>
								<td><?php echo $fetch['NoUrut']; ?></td>
								<td><?php echo $fetch['NmDokter']; ?></td>
								<td><?php echo $fetch['NamaBiaya']; ?></td>
								<td><?php echo $fetch['Tarif']; ?></td>
								<?php
									if($_SESSION['hak'] == "apoteker"){
										$nopas = $fetch['NoPasien'];
										$nopen = $fetch['NoPendaftaran'];
										//$aksinya = "<a href='index.php?hal=$hal&act=tambah&id=$fetch['NoPendaftaran']'>Pemeriksaan</a>";
										$aksinya = "<a href='index.php?hal=pemeriksaan&act=tambah&id=$nopas '>Pemeriksaan  </a><a href='view/page/lht_laporan.php?id=$nopen ' target='blank'>Laporan</a>";
									}
									if($_SESSION['hak'] == "resepsionis"){
										$nopen = $fetch['NoPendaftaran'];
										//$aksinya = "<a href='index.php?hal=$hal&act=tambah&id=$fetch['NoPendaftaran']'>Pemeriksaan</a>";
										$aksinya = "<a href='index.php?hal=pendaftaran&act=edit&id=$nopen '>Edit  </a><a href='index.php?hal=pendaftaran&act=hapus&id=$nopen '>Hapus  </a>";
									}							
								?>						
								<!--<td><?php //echo $aksinya; ?></td>-->
							</tr>
						<?php
							};
						?>
						</tbody>
					</table>
				</div>