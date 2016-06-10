<?php 
	include '../../konek.php';
	include '../../lib.php';
	$id = $_GET['id'];
	$act = $_GET['act'];
	if($act == "edit"){
		$query = "SELECT * FROM obat WHERE KodeObat = '".$id."' ";
		$q = $konek->query($query);
		$fetch = $q->fetch_assoc();
		$usr = "<input type='hidden' name='kodeobat' class='ipt-text' value='$id'>";
	}
	else{
		$usr = "";
	}
?>				
				<script type="text/javascript">
					$(document).ready(function(){
						$("#biasa").on('submit',function(e){
							e.preventDefault();
							$.post('modul/act_obat.php', $("#biasa").serialize(), function(){
								loadpage('view/page/lht_obat.php');
								window.alert("Input Sukses Besar Boss!");
							});
						});
					});
				</script>
				<div id="toolbar" class="dokter">
					<div id="group-btn">
						<button class="btn back btn-tb" onclick="loadpage('view/page/lht_obat.php')"></button>
					</div>
				</div>
				<div id="isi">
					<form id="biasa">
						<?php echo $usr; ?>
						<p>Nama Obat</p>
						<input type="text" name="namaobt" class="ipt-text" required value="<?php echo $fetch['NmObat']; ?>" >
						<p>Merk</p>
						<input type="text" name="merk" class="ipt-text" required value="<?php echo $fetch['Merk']; ?>" >
						<p>Satuan</p>
						<input type="text" name="satuan" class="ipt-text" required value="<?php echo $fetch['Satuan']; ?>" >
						<p>Harga Jual</p>
						<input type="number" name="hrgjl" class="ipt-text" required value="<?php echo $fetch['HargaJual']; ?>" >
						<p></p>
						<input type="submit" name="sbt" class="sbt-btn">
					</form>
				</div>