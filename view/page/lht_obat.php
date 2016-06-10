<?php
	//if($_SESSION['hak'] !== "apoteker"){
	//	echo '<script>window.alert("Anda Bukan Apoteker!");window.location=("login.php");</script>';
	//}
	include '../../konek.php';
	include '../../lib.php';
	$act = $_GET['act'];
	if($act == "search"){
		$name = $_GET['name'];
		$query = "SELECT * FROM obat WHERE NmObat LIKE '%$name%' ";
	}
	else{
		$query = "SELECT * FROM obat";
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
				<div id="toolbar" class="obat">
					<div id="group-btn">
						<button class="btn edit btn-tb" id="edit-btn" style="display:none" onclick="sunting()"></button>
						<button class="btn delete btn-tb" id="del-btn" style="display:none" onclick="del()"></button>
						<button class="btn eye btn-tb" id="daftar-btn" style="display:none" onclick="daftar()"></button>
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
						<tr id="table-header">
							<th>Nama Obat</th>
							<th>Merek</th>
							<th>Satuan</th>
							<th>Harga Jual</th>
							<!--<th>Aksi</th>-->
						</tr>
						<?php
							//$query = "SELECT pegawai.*, login.UserName, login.TypeUser FROM pegawai LEFT JOIN login ON pegawai.NIP = login.NIP";
							$q = $konek->query($query);
							while ($fetch = $q->fetch_assoc()){
						?>
						<tr id="<?php echo $fetch['KodeObat']; ?>" onclick="selectRecord('#<?php echo $fetch['KodeObat']; ?>')" class="pointer">
							<td><?php echo $fetch['NmObat']; ?></td>
							<td><?php echo $fetch['Merk']; ?></td>
							<td><?php echo $fetch['Satuan']; ?></td>
							<td><?php echo $fetch['HargaJual']; ?></td>
							<!--<td><a href="index.php?hal=<?php //echo $hal ?>&act=edit&id=<?php //echo $fetch['KodeObat']; ?>">Edit  </a><a href="../../modul/act_<?php //echo $hal ?>.php?act=hapus&id=<?php //echo $fetch['KodeObat']; ?>">Hapus  </a></td>-->
						</tr>
						<?php
							};
						?>
					</table>
				</div>			
				<div id="tambah">
					<button class="btn add bg-blue btn-act" onclick="tambah()"></button>
				</div>