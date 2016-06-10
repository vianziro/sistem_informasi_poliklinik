<?php 
	include '../../konek.php';
	include '../../lib.php';
	$id = $_GET['id'];
	$act = $_GET['act'];
	if($act == "edit"){
		$query = "SELECT * FROM poliklinik WHERE KodePoli = '".$id."' ";
		$q = $konek->query($query);
		$fetch = $q->fetch_assoc();
		$usr = "<input type='hidden' name='kodepoli' class='ipt-text' value='$id'";
	}
	else{
		$usr = "";
	}
?>			<script type="text/javascript">
					$(document).ready(function(){
						$("#biasa").on('submit',function(e){
							e.preventDefault();
							$.post('modul/act_poliklinik.php', $("#biasa").serialize(), function(){
								loadpage('view/page/lht_poliklinik.php');
								window.alert("Input Sukses Besar Boss!");
							});
						});
					});
				</script>
				<div id="toolbar" class="poliklinik">
					<div id="group-btn">
						<button class="btn back btn-tb" onclick="loadpage('view/page/lht_poliklinik.php')"></button>
					</div>
				</div>
				<div id="isi">
					<form id="biasa">
						<?php echo $usr; ?>
						<p>Nama Poli</p>
						<input type="text" name="namapoli" class="ipt-text" required value="<?php echo $fetch['NamaPoli']; ?>" >
						<p></p>
						<input type="submit" name="sbt" class="sbt-btn">
					</form>
				</div>