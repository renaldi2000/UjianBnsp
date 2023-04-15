<?php
include("koneksi.php");

//jika tombol simpan diklik
if (isset($_POST['bsimpan'])) {
	//Pengujian Apakah data akan diedit atau disimpan baru
	if ($_GET['hal'] == "edit") {
		//Data akan di edit
		$edit = mysqli_query($koneksi, "UPDATE  dmatkul set
											 	kodematkul = '$_POST[kodematkul]',
											 	matkul = '$_POST[matkul]',
											 	sks = '$_POST[sks]',
												smt = '$_POST[smt]'
											 WHERE id = '$_GET[id]'
										   ");
		if ($edit) //jika edit sukses
		{
			echo "<script>
						alert('Edit data suksess!');
						document.location='matkul.php';
				     </script>";
		} else {
			echo "<script>
						alert('Edit data GAGAL!!');
						document.location='matkul.php';
				     </script>";
		}
	} else {
		//Data akan disimpan Baru
		$simpan = mysqli_query($koneksi, "INSERT INTO dmatkul (kodematkul, matkul, sks, smt)
										  VALUES ('$_POST[kodematkul]', 
										  		 '$_POST[matkul]', 
										  		 '$_POST[sks]',
												 '$_POST[smt]')
										 ");
		if ($simpan) //jika simpan sukses
		{
			echo "<script>
						alert('Simpan data suksess!');
						document.location='matkul.php';
				     </script>";
		} else {
			echo "<script>
						alert('Simpan data GAGAL!!');
						document.location='matkul.php';
				     </script>";
		}
	}
}


//Pengujian jika tombol Edit / Hapus di klik
if (isset($_GET['hal'])) {
	//Pengujian jika edit Data
	if ($_GET['hal'] == "edit") {
		//Tampilkan Data yang akan diedit
		$tampil = mysqli_query($koneksi, "SELECT * FROM dmatkul WHERE id = '$_GET[id]' ");
		$data = mysqli_fetch_array($tampil);
	} else if ($_GET['hal'] == "hapus") {
		//Persiapan hapus data
		$hapus = mysqli_query($koneksi, "DELETE FROM dmatkul WHERE id = '$_GET[id]' ");
		if ($hapus) {
			echo "<script>
						alert('Hapus Data Suksess!!');
						document.location='matkul.php';
				     </script>";
		}
	}
}

?>

<!DOCTYPE html>
<html>

<head>
	<title>CRUD 2020 PHP & MySQL + Bootstrap 4</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>

<body>
<?php include "navbar.php"; ?>
	<div class="container">

		<h1 class="text-center">CRUD PHP & MySQL + Bootstrap 4</h1>
		<h2 class="text-center">BNSP SWADHARMA</h2>
		<?php if (!empty($_GET['hal'])) : ?>
			<!-- Awal Card Form -->
			<div class="card mt-3">
				<div class="card-header bg-primary text-white">
					Form Input Data Dosen
				</div>
				<div class="card-body">
					<form method="post" action="">
						<div class="form-group">
							<label>Kode Matakuliah</label>
							<input type="text" name="kodematkul" value="<?= @$data['kodematkul'] ?>" class="form-control" placeholder="Input Kode Matakuliah disini!" required>
						</div>
						<div class="form-group">
							<label>Nama Matakuliah</label>
							<input type="text" name="matkul" value="<?= @$data['matkul'] ?>" class="form-control" placeholder="Input Matakuliah disini!" required>
						</div>
						<div class="form-group">
							<label>SKS Matakuliah</label>
							<input type="text" name="sks" value="<?= @$data['sks'] ?>" class="form-control" placeholder="Input SKS disini!" required>
						</div>
						<div class="form-group">
							<label>Semester</label>
							<input type="text" name="smt" value="<?= @$data['smt'] ?>" class="form-control" placeholder="Input Semester disini!" required>
						</div>

						<a href="matkul.php" class="btn btn-primary">Kembali</a>
						<button type="submit" class="btn btn-success" name="bsimpan">Simpan</button>
						<button type="reset" class="btn btn-danger" name="breset">Kosongkan</button>

					</form>
				</div>
			</div>
			<!-- Akhir Card Form -->
		<?php else : ?>

			<!-- Awal Card Tabel -->
			<div class="card mt-3">
				<div class="card-header bg-success text-white">
					Daftar Matakuliah
					<div class="float-right">
						<a href="matkul.php?hal=tambah" class="btn btn-primary">
							Tambah
						</a>
					</div>
				</div>
				<div class="card-body">

					<table class="table table-bordered table-striped">
						<tr class="text-center">
							<th>No.</th>
							<th>Kode Matakuliah</th>
							<th>Nama Matakuliah</th>
							<th>SKS Matakuliah</th>
							<th>Semester</th>
							<th>Aksi</th>
						</tr>
						<?php
						$no = 1;
						$tampil = mysqli_query($koneksi, "SELECT * from dmatkul order by id asc");
						while ($data = mysqli_fetch_array($tampil)) :

						?>
							<tr>
								<td><?= $no++; ?></td>
								<td class="text-center"><?= $data['kodematkul'] ?></td>
								<td><?= $data['matkul'] ?></td>
								<td class="text-center"><?= $data['sks'] ?></td>
								<td class="text-center"><?= $data['smt'] ?></td>
								<td class="text-center">
									<a href="matkul.php?hal=edit&id=<?= $data['id'] ?>" class="btn btn-warning"> Edit </a>
									<a href="matkul.php?hal=hapus&id=<?= $data['id'] ?>" onclick="return confirm('Apakah yakin ingin menghapus data ini?')" class="btn btn-danger"> Hapus </a>
								</td>
							</tr>
						<?php endwhile; //penutup perulangan while 
						?>
					</table>

				</div>
			</div>
			<!-- Akhir Card Tabel -->
		<?php endif; ?>
	</div>
							
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>

</html>