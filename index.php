<?php
	include 'konek.php';
	include 'lib.php';
	session_start();
	if($_SESSION['user']  == ""){
		//echo '<script>window.alert("Anda Belum Login!");window.location=("login.php");</script>';		
		header('location:login.php');
	}
	$hak = $_SESSION['hak'];
	$nipnya = $_SESSION['nip'];
	$username = $_SESSION['user'];
	$query_pegawai = "SELECT pegawai.*, login.* FROM login LEFT JOIN pegawai ON login.NIP = pegawai.NIP WHERE login.NIP LIKE '%$nipnya%' ";
	$nyoh = $konek->query($query_pegawai);
	$dapat = $nyoh->fetch_assoc();
	if($hak == "admin"){
		$haknya = "Administrator";
	}
	elseif($hak == "apoteker"){
		$haknya = "Apoteker";
	}
	elseif($hak == "resepsionis"){
		$haknya = "Resepsionis";
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>SISADMIN POLIKLINIK</title>
	<link rel="stylesheet" type="text/css" id="ceeses" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/login.css">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="css/ripple.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/ripple.min.js"></script>
	<script type="text/javascript" src="js/script.js"></script>
	<script type="text/javascript">
		$(function() {
			$(document).on('click', '[type="button"]', function(e) { e.preventDefault(); })
			window.rippler = $.ripple('.btn:not(.no-bind), .area', {
				debug: true,
				multi: true
			});
			$.ripple('.no-bind.demo', {
				on: 'mouseleave',
				multi: true
			});
			$.ripple('.no-bind.jakiestfu', {
				on: 'mouseenter',
				multi: true
			});

			//$('.btn-side').on('click', function(){
//
//			})
		});

		function disableButtonsDown(e) { 
    		if ((e.which || e.keyCode) == 116 ) e.preventDefault(); 
			if (e.ctrlKey && e.keyCode == 82)  e.preventDefault();
		};

		$(document).on("keydown", disableButtonsDown);
		$(document).ready(function(){			
			//window.history.forward();
			window.history.forward(1);
			loadpage('view/page/dashboard.php');
			//alert("akjdsfhjsdf");
		})

		function toogle_menu() {
			if(document.getElementById("side-menu").style.display == "block") {				
				document.getElementById("side-menu").style.display = "none";
				$(".toogle-menu").removeClass("menu-close");
				$(".toogle-menu").addClass("hamburger");
				//$("#side-menu").slideUp(750);
				//$("#side-menu").slideDown(750);
				//$("#side-menu").slideLeft(750);
				//$("#side-menu").slideRight(750);
			}
			else {
				document.getElementById("side-menu").style.display = "block";
				$(".toogle-menu").removeClass("hamburger");
				$(".toogle-menu").addClass("menu-close");
				//$("#side-menu").slideUp(750);
				//$("#side-menu").slideDown(750);
				//$("#side-menu").slideLeft(750);
				//$("#side-menu").slideRight(750);
			}
		}

		function loadpage(id){
			$("#content").load(id);
			//$("#judul").html('Poliklinik Material | Daftar "'+name+'"');
		}

		function sidemenu(id){
			loadpage(id);
			var judul = $('#toolbar').attr('class');
			//$('.btn-side-mn').addClass('active');
			//var anu = $('.active').html;
			$("#judul").html('Poliklinik Material | Daftar '+judul);
		}

		function tambah() {			
			var judul = $('#toolbar').attr('class');
			$("#judul").html('Tambah '+judul);
			$('#content').load("view/form/tbh_"+judul+".php");
		}

		function sunting() {
			var datid = $('.selected').attr('id');
			var judul = $('#toolbar').attr('class');
			$("#judul").html('Sunting '+judul);
			//var element = document.querySelector("tr.selected");
			//window.location = "view/form/tbh_"+judul+".php?act=edit&id="+element.id.replace(/[^0-9]/g, "");			
			//window.location = "view/form/tbh_"+judul+".php?act=edit&id="+datid;			
			//$('#content').load("view/form/tbh_"+judul+".php?act=edit&id="+element.id.replace(/[^0-9]/g, ""));
			$('#content').load("view/form/tbh_"+judul+".php?act=edit&id="+datid);
			//$('#content').load('view/form/tbh_pegawai.php?act=edit&id='+element.id.replace(/[^0-9]/g,'');
		}

		function daftar() {
			var datid = $('.selected').attr('id');
			var judul = $('#toolbar').attr('class');
			$("#judul").html('Poliklinik Material | Tambah Pendaftaran');
			$('#content').load("view/form/tbh_pendaftaran.php?act=tambah&id="+datid);
		}

		function dash(id){
			loadpage(id);
			$("#judul").html('Poliklinik Material | Dashboard');
		}

		function periksa() {
			var datid = $('.selected').attr('name');
			var judul = $('#toolbar').attr('class');
			$("#judul").html('Poliklinik Material | Hasil Pemeriksaan');
			$('#content').load("view/form/tbh_pemeriksaan.php?act=tambah&id="+datid);
		}

		function report() {
			var datid = $('.selected').attr('id');
			$("#judul").html('Poliklinik Material | Tambah Pendaftaran');
			$('#content').load("view/page/lht_laporan.php?id="+datid);
		}

		function logout(){
			window.location =("login.php?act=out");
		}

		function del() {
			var datid = $('.selected').attr('id');
			//var element = document.querySelector("tr.selected");
			var judul = $('#toolbar').attr('class');
			if(confirm('Hapus Data?')) {
				//$('#content').load('modul/act_'+judul+'.php?act=hapus&id='+element.id.replace(/[^0-9]/g, ""));
				$('#content').load('modul/act_'+judul+'.php?act=hapus&id='+datid);
			}
		}

		function ganti() {
			//if($("#myonoffswitch").is(':checked')){	
			if($("#myonoffswitch").prop('checked')){	
				//document.getElementById("side-menu").style.display = "block";
				//$("#ceeses").attr('href') = "anu.css";
				//$("#ceeses").setAttribute("href", "css/dark.css");
				var a = document.getElementById('ceeses'); //or grab it by tagname etc
				a.href = "css/style-dark.css"
			}
			else {
				//document.getElementById("side-menu").style.display = "none";
				//$("#ceeses").setAttribute("href", "css/style.css");
				var a = document.getElementById('ceeses'); //or grab it by tagname etc
				a.href = "css/style.css"
			}
		}

	</script>
</head>
<body>
	<nav>
		<!--<input type="button" class="btn-common hamburger float-left toogle-menu" onclick="toogle_menu()">-->
		<button class="btn btn-common hamburger float-left toogle-menu" onclick="toogle_menu()" style="color:#FFF"></button> 
		<h3 class="float-left tittle" id="judul">Poliklinik Material</h3>	
		<div id="switch-color">
			<h4>Dark Theme</h4>
	    	<div class="onoffswitch">
        		<input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch" onclick="ganti()">
        		<label class="onoffswitch-label" for="myonoffswitch"></label>
    		</div>
    	</div>
	</nav>
	<div id="side-menu" style="display:none">
		<li>
			<div id="banner">
			</div>
		</li>
		<li>
			<button class="btn btn-side-mn" data-color="grey" onclick="dash('view/page/dashboard.php')"><i class="fa fa-home pointer mrten mlten"></i>Dashboard</button>
		</li>
		<li>
			<button class="btn btn-side-mn" data-color="grey" onclick="sidemenu('view/page/lht_pegawai.php')"><i class="fa fa-user pointer mrten mlten"></i>Pegawai</button>
		</li>
		<li>
			<button class="btn btn-side-mn" data-color="grey" onclick="sidemenu('view/page/lht_poliklinik.php')"><i class="fa fa-hospital-o pointer mrten mlten"></i>Poliklinik</button>
		</li>
		<li>
			<button class="btn btn-side-mn" data-color="grey" onclick="sidemenu('view/page/lht_dokter.php')"><i class="fa fa-user-md pointer mrten mlten"></i>Dokter</button>
		</li>
		<li>
			<button class="btn btn-side-mn" data-color="grey" onclick="sidemenu('view/page/lht_pasien.php')"><i class="fa fa-wheelchair pointer mrten mlten"></i>Pasien</button>
		</li>
		<li>
			<button class="btn btn-side-mn" data-color="grey" onclick="sidemenu('view/page/lht_pendaftaran.php')"><i class="fa fa-book pointer mrten mlten"></i>Pendaftaran</button>
		</li>
		<li>
			<button class="btn btn-side-mn" data-color="grey" onclick="sidemenu('view/page/lht_pemeriksaan.php')"><i class="fa fa-stethoscope pointer mrten mlten"></i>Pemeriksaan</button>
		</li>
		<li>
			<button class="btn btn-side-mn" data-color="grey" onclick="sidemenu('view/page/lht_resep.php')"><i class="fa fa-medkit pointer mrten mlten"></i>Resep</button>
		</li>
		<li>
			<button class="btn btn-side-mn" data-color="grey" onclick="sidemenu('view/page/lht_obat.php')"><i class="fa fa-adjust pointer mrten mlten"></i>Obat</button>
		</li>
	</div>
	<div id="user-menu">

	</div>
	<div id="side-content">
		<img src="images/user/<?php echo $dapat['UserImage']; ?>" class="usr-img-xl round">
		<p class="usr-info"><?php echo $dapat['NamaPeg']; ?></p>
		<p class="usr-info"><?php echo $haknya; ?></p>
		<button class="logout" onclick="logout()">Logout</button>
	</div>
	<div id="content">
	</div>
</body>
</html>