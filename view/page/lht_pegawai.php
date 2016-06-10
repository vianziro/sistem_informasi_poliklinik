<?php
	//if($_SESSION['hak'] !== "admin"){
	//	echo '<script>window.alert("Anda Bukan Admin!");window.location=("login.php");</script>';
	//}
	include '../../konek.php';
	include '../../lib.php';
	$act = $_GET['act'];
	if($act == "search"){
		$name = $_GET['name'];
		$query = "SELECT pegawai.*, login.UserName, login.TypeUser FROM pegawai LEFT JOIN login ON pegawai.NIP = login.NIP WHERE pegawai.NamaPeg LIKE '%$name%' ";
	}
	else{
		$query = "SELECT pegawai.*, login.UserName, login.TypeUser FROM pegawai LEFT JOIN login ON pegawai.NIP = login.NIP";
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
				<div id="toolbar" class="pegawai">
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
								<th>NIP</th>
								<th>Nama</th>
								<th>Alamat</th>
								<th>Telepon</th>
								<th>Tanggal Lahir</th>
								<th>Jenis Kelamin</th>
							</tr>
						</thead>
						<tbody>
						<?php
							//$query = "SELECT pegawai.*, login.UserName, login.TypeUser FROM pegawai LEFT JOIN login ON pegawai.NIP = login.NIP";
							$q = $konek->query($query);
							while ($fetch = $q->fetch_assoc()){
								$tgl = date('d-m-Y',strtotime($fetch['TglLhrPeg']));
								if($fetch['JnsKelPeg'] == "Lk"){
									$jkel = "Laki-laki";
								}
								elseif ($fetch['JnsKelPeg'] == "Pr"){
									$jkel = "Perempuan";
								}
						?>
							<tr id="induk-<?php echo $fetch['NIP']; ?>" onclick="selectRecord('#induk-<?php echo $fetch['NIP']; ?>')" class="pointer">
								<td><?php echo $fetch['NIP']; ?></td>
								<td><?php echo $fetch['NamaPeg']; ?></td>
								<td><?php echo $fetch['AlmPeg']; ?></td>
								<td><?php echo $fetch['TelpPeg']; ?></td>
								<td><?php echo $tgl; ?></td>
								<td><?php echo $jkel; ?></td>
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