<?php 
	include '../../konek.php';
	include '../../lib.php';
	$id = $_GET['id'];
	$act = $_GET['act'];
	$subid = substr($id, 6,10);
	if($act == "edit"){
		$query = "SELECT pegawai.*, login.UserName, login.TypeUser FROM pegawai LEFT JOIN login ON pegawai.NIP = login.NIP where pegawai.NIP = '".$subid."' ";
		$q = $konek->query($query);
		$fetch = $q->fetch_assoc();
		$usr = "<input type='hidden' name='nip' class='ipt-text' value='$subid'";
	}
	else{
		$usr = "
					<p>Nomor Induk Pegawai</p>
					<input type='text' name='nip' class='ipt-text' required >
					<p>User Pegawai</p>
					<input type='text' name='user' class='ipt-text' required  >
					<p>Password Pegawai</p>
					<input type='password' name='pass' class='ipt-text' required >";
	}
?>					
				<script type="text/javascript">
					$(document).ready(function(){
						$("#biasa").on('submit',function(e){
							e.preventDefault();
							$.post('modul/act_pegawai.php', $("#biasa").serialize(), function(){
								loadpage('view/page/lht_pegawai.php');
								window.alert("Input Sukses Besar Boss!");
							});
						});
					});
				</script>
				<div id="toolbar" class="pegawai">
					<div id="group-btn">
						<button class="btn back btn-tb" onclick="loadpage('view/page/lht_pegawai.php')"></button>
					</div>
				</div>
				<div id="isi">
					<form id="biasa">
						<?php
							echo $usr;
						?>
						<p>Nama Pegawai</p>
						<input type="text" name="namapeg" class="ipt-text" required value="<?php echo $fetch['NamaPeg']; ?>" >
						<p>Alamat Pegawai</p>
						<input type="text" name="almpeg" class="ipt-text" required value="<?php echo $fetch['AlmPeg']; ?>" >
						<p>Nomor Telepon Pegawai</p>
						<input type="text" name="telppeg" class="ipt-text" required value="<?php echo $fetch['TelpPeg']; ?>" >
						<p>Tanggal Lahir Pegawai</p>
						<input type="date" name="tglpeg" class="ipt-text" required value="<?php echo $fetch['TglLhrPeg']; ?>" >
						<p>Jenis Kelamin Pegawai</p>
						<select name="jnskel" require>
							<option value="<?php echo $fetch['JnsKelPeg']; ?>"><?php echo $fetch['JnsKelPeg']; ?></option>
							<option value="Lk">Laki-Laki</option>
							<option value="Pr">Perempuan</option>
						</select>
						<input type="hidden" name="act" class="ipt-text" value="<?php echo $act; ?>" >
						<p>Hak Akses Pegawai</p>
						<select name="typeuser" require>
							<option value="<?php echo $fetch['TypeUser']; ?>"><?php echo $fetch['TypeUser']; ?></option>
							<option value="admin">Admin</option>
							<option value="apoteker">Apoteker</option>
							<option value="resepsionis">Resepsionis</option>
						</select>
						<p></p>
						<input type="submit" name="sbt" class="sbt-btn">
					</form>
				</div>