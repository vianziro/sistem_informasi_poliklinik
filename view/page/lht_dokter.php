<?php
//	if($_SESSION['hak'] !== "admin"){
//		echo '<script>window.alert("Anda Bukan Admin!");window.location=("login.php");</script>';
//	}
	include '../../konek.php';
	include '../../lib.php';
	$act = $_GET['act'];
	if($act == "search"){
		$name = $_GET['name'];
		$query = "SELECT dokter.*, jadwalpraktek.*, poliklinik.* FROM dokter LEFT JOIN jadwalpraktek ON dokter.KodeDokter = jadwalpraktek.KodeDokter LEFT JOIN poliklinik ON dokter.KodePoli = poliklinik.KodePoli WHERE dokter.NmDokter LIKE '%$name%' ";
	}
	else{
		$query = "SELECT dokter.*, jadwalpraktek.*, poliklinik.* FROM dokter LEFT JOIN jadwalpraktek ON dokter.KodeDokter = jadwalpraktek.KodeDokter LEFT JOIN poliklinik ON dokter.KodePoli = poliklinik.KodePoli";
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
				<div id="toolbar" class="dokter">
					<div id="group-btn">
						<button class="btn edit btn-tb" id="edit-btn" style="display:none" onclick="sunting()"></button>
						<button class="btn delete btn-tb" id="del-btn" style="display:none" onclick="del()"></button>
						<button class="btn add btn-tb"></button>
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
						<thead>
							<tr id="table-header">
								<th>Nama Dokter</th>
								<th>Alamat</th>
								<th>Telepon</th>
								<th>Tempat Praktek</th>
								<th>Hari Kerja</th>
								<th>Jam Mulai</th>
								<th>Jam Selesai</th>
							</tr>
						</thead>
						<tbody>
						<?php
							$q = $konek->query($query);
							while ($fetch = $q->fetch_assoc()){
						?>
							<tr id="<?php echo $fetch['KodeDokter']; ?>" onclick="selectRecord('#<?php echo $fetch['KodeDokter']; ?>')" class="pointer">
								<td><?php echo $fetch['NmDokter']; ?></td>
								<td><?php echo $fetch['AlmDokter']; ?></td>
								<td><?php echo $fetch['TelpDokter']; ?></td>
								<td><?php echo $fetch['NamaPoli']; ?></td>
								<td><?php echo $fetch['Hari']; ?></td>
								<td><?php echo $fetch['JamMulai']; ?></td>
								<td><?php echo $fetch['JamSelesai']; ?></td>
							</tr>
						<?php
							};
						?>
						</tbody>
					</table>
				</div>				
				<div id="tambah">
					<button class="btn add bg-blue btn-act" onclick="tambah()"></button>
				</div>