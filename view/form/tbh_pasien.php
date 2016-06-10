<?php 
	include '../../konek.php';
	include '../../lib.php';
	$id = $_GET['id'];
	$act = $_GET['act'];
	if($act == "edit"){
		$query = "SELECT * FROM pasien WHERE NoPasien = '".$id."' ";
		$q = $konek->query($query);
		$fetch = $q->fetch_assoc();
		$usr = "<input type='hidden' name='nopasien' class='ipt-text' value='$id'>";
	}
	else{
		$usr = "";
	}
?>				
				<script type="text/javascript">
					$(document).ready(function(){
						$("#biasa").on('submit',function(e){
							e.preventDefault();
							$.post('modul/act_pasien.php', $("#biasa").serialize(), function(){
								loadpage('view/page/lht_pasien.php');
								window.alert("Input Sukses Besar Boss!");
							});
						});
					});
				</script>
				<div id="toolbar" class="dokter">
					<div id="group-btn">
						<button class="btn back btn-tb" onclick="loadpage('view/page/lht_pasien.php')"></button>
					</div>
				</div>
				<div id="isi">
					<form id="biasa">
						<?php echo $usr; ?>
						<p>Nama Pasien</p>
						<input type="text" name="namapas" class="ipt-text" required value="<?php echo $fetch['NamaPas']; ?>" >
						<p>Alamat</p>
						<input type="text" name="almpas" class="ipt-text" required value="<?php echo $fetch['AlmPas']; ?>" >
						<p>Nomor Telepon</p>
						<input type="text" name="telppas" class="ipt-text" required value="<?php echo $fetch['TelpPas']; ?>" >
						<p>Tanggal Lahir</p>
						<input type="date" name="tgllhrpas" class="ipt-text" required value="<?php echo $fetch['TglLahirPas']; ?>" >
						<p>Jenis Kelamin</p>
						<select name="kelpas" require>
							<option value="<?php echo $fetch['JnsKelPas']; ?>"><?php echo $fetch['JnsKelPas']; ?></option>
							<option value="Lk">Laki-Laki</option>
							<option value="Pr">Perempuan</option>
						</select>
						<p></p>
						<input type="submit" name="sbt" class="sbt-btn">
					</form>
				</div>