<?php

session_start();


//Koneksi Database
$server = "localhost";
$user = "root";
$pass = "";
$database = "dosen";

$koneksi = mysqli_connect($server, $user, $pass, $database) or die(mysqli_error($koneksi));

if (isset($_POST['login'])) {
	$sql = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '" . $_POST['username'] . "' AND password = '" . md5($_POST['password']) . "'");
	if ($sql->num_rows != 0) {
		$data = mysqli_fetch_array($sql);
		$_SESSION['username'] = $data['username'];
		$_SESSION['nama'] = $data['nama'];
	}else{
		echo "<script>
						alert('Username atau password salah');
						document.location='index.php';
				     </script>";
	}
}

?>

<!DOCTYPE html>
<html>

<head>
	<title>CRUD PHP & MySQL + Bootstrap 4 BNSP</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<style>
		html,
		body {
			height: 100%;
		}

		.form-signin {
			width: 100%;
			max-width: 330px;
			padding: 15px;
			margin: 0 auto;
		}

		.form-signin .checkbox {
			font-weight: 400;
		}

		.form-signin .form-control {
			position: relative;
			box-sizing: border-box;
			height: auto;
			padding: 10px;
			font-size: 16px;
		}

		.form-signin .form-control:focus {
			z-index: 2;
		}

		.form-signin input[type="email"] {
			margin-bottom: -1px;
			border-bottom-right-radius: 0;
			border-bottom-left-radius: 0;
		}

		.form-signin input[type="password"] {
			margin-bottom: 10px;
			border-top-left-radius: 0;
			border-top-right-radius: 0;
		}
	</style>
</head>

<body class="text-center">
	<?php isset($_SESSION['username']) ? include "navbar.php" : '' ?>
	<br /><br /><br /><br />
	<div class="container">
		<?php if (isset($_SESSION['username'])) : ?>
			<div class="jumbotron mt-3">
				<h1>Selamat Datang di ITB SWADHARMA</h1>
				<img src="./img/logo.png" width="200">
				<p class="lead">Sistem Informasi Data Mengajar Dosen</p>
			</div>
		<?php else : ?>
			<form class="form-signin" method="post" action="">
				<img class="mb-4" src="./img/logo.png" alt="" width="72" height="72">
				<h1 class="h3 mb-3 font-weight-normal">ITB SWADHARMA</h1>
				<label for="inputUsername" class="sr-only">Username</label>
				<input type="text" name="username" id="inputUsername" class="form-control" placeholder="Username" required autofocus>
				<label for="inputPassword" class="sr-only">Password</label>
				<input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
				<div class="checkbox mb-3">
					&nbsp;
				</div>
				<button class="btn btn-lg btn-primary btn-block" type="submit" name="login">Login</button>
				<p class="mt-5 mb-3 text-muted">&copy; M. Renaldi</p>
			</form>
	</div>
<?php endif; ?>
</body>

</html>