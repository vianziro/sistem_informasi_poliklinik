<?php
	include "konek.php";
	include "lib.php";
	$act = $_GET['act'];	
	session_start();
	if(isset($_SESSION['user'])){
		header('location:index.php');
	}
	if($act == "out"){
		session_destroy();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>LOGIN SISADMIN POLIKLINIK</title>
	<link rel="stylesheet" type="text/css" href="css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="css/login.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript">
		function show_password(){
			if(document.getElementById("passwd").type == "password"){
				$("#view-pass").removeClass("eye-slash");
				$("#view-pass").addClass("eye");
				document.getElementById("passwd").type = "text";
			}
			else{
				$("#view-pass").removeClass("eye");
				$("#view-pass").addClass("eye-slash");
				document.getElementById("passwd").type = "password";
			}
		}
	</script>
</head>
<body>
	<div id="login">
		<form id="form-log" action="" method="post">
<?php
	if(isset($_POST['user'])){
		$name = $_POST['user'];
		$query = "SELECT login.*, pegawai.* FROM login INNER JOIN pegawai ON login.NIP = pegawai.NIP WHERE login.UserName='$name' ";
		$a = $konek->query($query);
		$fetch = $a->fetch_assoc();
		$count = $a->num_rows;
		if($count > 0 & $count = 1){
?>
			<img src="images/user/user-m.svg" id="usr-img">
			<p id="name"><?php echo $fetch['NamaPeg']; ?></p>
			<input type="hidden" class="ipt-login" name="username" value="<?php echo $name; ?>">
			<div class="ipt">	
				<input type="password" class="ipt-login" name="pass" placeholder="Password" autofocus id="passwd">
				<i class="ic eye-slash pointer" id="view-pass" onclick="show_password()"></i>
			</div>		
			<input type="submit" class="btn-login" value="Next" name="login">
<?php
		}
		else{
?>
			<img src="images/user/user.svg" id="usr-img">
			<p id="name">Login</p>
			<h3 id="salah">Username Salah!</h3>
			<div class="ipt">
				<input type="text" class="ipt-login" name="user" placeholder="Username" autofocus>
				<i class="ic user"></i>
			</div>
			<input type="submit" class="btn-login" value="Next">
<?php
		}
	}
	else if(isset($_POST['username'])){		
		if (isset($_SESSION['user'])) {
			header('location:index.php');
		}
		else if(!isset($_SESSION['user'])){			
			$enc_pass = md5($_POST['pass']);
			$query = "SELECT * FROM login WHERE UserName = '".$_POST['username']."' and Password = '".$enc_pass."' ";
			$q = $konek->query($query);
			$fetch = $q->fetch_assoc();
			$hitung = $q->num_rows;
			if($hitung > 0 and $hitung = 1){
				session_start();
				$_SESSION['user'] = $fetch['UserName'];
				$_SESSION['hak'] = $fetch['TypeUser'];
				$_SESSION['nip'] = $fetch['NIP'];
				header('location:index.php');
			}
			else{
			$name = $_POST['username'];
			$query = "SELECT login.*, pegawai.* FROM login LEFT JOIN pegawai ON login.NIP = pegawai.NIP WHERE login.UserName='$name' ";
			$a = $konek->query($query);
			$fetch = $a->fetch_assoc();
		
?>
			<img src="images/user/user-m.svg" id="usr-img">
			<p id="name"><?php echo $fetch['NamaPeg']; ?></p>
			<h3 id="salah">Password Salah!</h3>
			<input type="hidden" class="ipt-login" name="username" value="<?php echo $name; ?>">
			<div class="ipt">	
				<input type="password" class="ipt-login" name="pass" placeholder="Password" autofocus id="passwd">
				<i class="ic eye-slash pointer" id="view-pass" onclick="show_password()"></i>
			</div>		
			<input type="submit" class="btn-login" value="Next" name="login">	
<?php
			}
		}
	}
	else{
?>
			<img src="images/user/user.svg" id="usr-img">
			<p id="name">Login</p>
			<div class="ipt">
				<input type="text" class="ipt-login" name="user" placeholder="Username" autofocus>
				<i class="ic user"></i>
			</div>
			<input type="submit" class="btn-login" value="Next">
<?php
	}
?>
		</form>
	</div>
</body>
</html>