<?php
	//if($_SESSION['hak'] !== "admin"){
	//	echo '<script>window.alert("Anda Bukan Admin!");window.location=("login.php");</script>';
	//}
	include '../../konek.php';
	include '../../lib.php';
	$act = $_GET['act'];
	if($act == "search"){
		$name = $_GET['name'];
		$query = "SELECT * FROM poliklinik WHERE NamaPoli LIKE '%$name%' ";
	}
	else{
		$query = "SELECT * FROM poliklinik";
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
				<div id="toolbar" class="poliklinik">
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
								<th>Nama Poli</th>
							</tr>
						</thead>
						<tbody>
						<?php
							//$query = "SELECT pegawai.*, login.UserName, login.TypeUser FROM pegawai LEFT JOIN login ON pegawai.NIP = login.NIP";
							$q = $konek->query($query);
							while ($fetch = $q->fetch_assoc()){
						?>
							<tr class="pointer"  id="<?php echo $fetch['KodePoli']; ?>" onclick="selectRecord('#<?php echo $fetch['KodePoli']; ?>')">
								<td><?php echo $fetch['NamaPoli']; ?></td>
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