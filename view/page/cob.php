		<?php
			include "../../konek.php";
			include "../../lib.php";
			//$search = $_GET['act'];
			//$name = $_GET['name'];
			//$by = $_GET['by'];
			//if ($search == 'search') {
			//	$query="SELECT alat.*, kategori.jenis_alat, pembuat.nm_pembuat, label_alat.label_alat
			//		FROM alat LEFT JOIN kategori ON alat.kd_kategori = kategori.kd_kategori
			//		LEFT JOIN pembuat ON alat.kd_pembuat = pembuat.kd_pembuat
			//		LEFT JOIN label_alat ON alat.kd_alat = label_alat.kd_alat WHERE $by LIKE '%".$name."%'";
			//}
			//else {
			//	$query="SELECT alat.*, kategori.jenis_alat, pembuat.nm_pembuat, label_alat.label_alat
			//		FROM alat LEFT JOIN kategori ON alat.kd_kategori = kategori.kd_kategori
			//		LEFT JOIN pembuat ON alat.kd_pembuat = pembuat.kd_pembuat
			//		LEFT JOIN label_alat ON alat.kd_alat = label_alat.kd_alat";
			//}

			if(isset($_POST['cr'])){
				$name = $_POST['ipt-cari'];
				$query = "SELECT pegawai.*, login.UserName, login.TypeUser FROM pegawai LEFT JOIN login ON pegawai.NIP = login.NIP WHERE pegawai.NamaPeg LIKE '%$name%' ";
			}
			else{
				$query = "SELECT pegawai.*, login.UserName, login.TypeUser FROM pegawai LEFT JOIN login ON pegawai.NIP = login.NIP";
			}
		?>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#search").on('submit',function(e){
				var by = document.getElementById('option').value;
				var name = document.getElementById('ipt_cari').value;
				var judul = $('#toolbar').attr('class');
				//var berdasar = $('#option').html;
					e.preventDefault();
					$.post('', $("#search").serialize(), function(){						
						load('view/page/dftr_'+judul+'.php?act=search&name='+name+'&by='+by);
						//load('view/page/bu_alt.php?act=search&name='+name+'&by='+by);
						$("#tittle").html('Hasil Pencarian dari "'+name+'"');
					});
				});
			});
		</script>
		<div id="toolbar" class="alat">
			<div id="group-btn">
				<input type="button" class="ipt-act" id="ipt-cr" onclick="toogle_show_hide('search')">	
				<input type="button" class="ipt-act" id="ipt-tbh" onclick="load('view/form/tbh_alat.php?act=tambah')">	
				<input type="button" class="ipt-act" id="ipt-sunting" onclick="sunting()" disabled style="display:none">	
				<input type="button" class="ipt-act" id="ipt-hapus" onclick="del()" disabled style="display:none">
				<input type="button" class="ipt-act" id="ipt-print" onclick="printDocument()">				
				<form name="cari" id="search" style="display:none">
					<input type="text" name="ipt-cari" id="ipt_cari">
					<select name="by" id="option">
						<option value="label_alat" class="opt">Nama Alat</option>
						<option value="jenis_alat">Kategori</option>
						<option value="model">Model</option>
						<option value="merk">Merk</option>
						<option value="nm_pembuat">Produsen</option>
						<option value="thn_buat">Tahun Pembuatan</option>
						<option value="kd_alat">Kode Alat</option>
					</select>
					<button type="submit" id="btn_cari" name="sbt-cr" class="active"></button>
				</form>
				<input type="button" class="ipt-act" id="ipt-dot" onclick="cari()">
			</div>
			<div id="menu-sm" style="display:none">
				<input type="button" class="btn-mn-sm" id="btn-refresh" value="Refresh">
			</div>
		</div>
		<div id="ubah">
			<table id="daftar">
				<thead>
					<tr id="table-header">
						<th>NIP</th>
						<th>Nama</th>
						<th>Alamat</th>
						<th>Telepon</th>
						<th>Tanggal Lahir</th>
						<th>Jenis Kelamin</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>				
				<?php
					$hh = $konek->query($query);
					while ($fetch = $hh->fetch_assoc()) {
				?>
					<tr id="induk-<?php echo $fetch['NIP']; ?>" onclick="selectRecord('#induk-<?php echo $fetch['NIP']; ?>')" class="">
						<td><?php echo $fetch['NIP']; ?></td>
						<td><?php echo $fetch['NamaPeg']; ?></td>
						<td><?php echo $fetch['AlmPeg']; ?></td>
						<td><?php echo $fetch['TelpPeg']; ?></td>
						<td><?php echo $fetch['TglLhrPeg']; ?></td>
						<td><?php echo $jkel; ?></td>
					</tr>
				<?php
					}
				?>
				</tbody>
			</table>
		</div>