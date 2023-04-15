<?php
include("koneksi.php");

$jkel = [
	'L' => 'Laki-laki',
	'P' => 'Perempuan'
];

//jika tombol simpan diklik
if (isset($_POST['bsimpan'])) {
	//Pengujian Apakah data akan diedit atau disimpan baru
	if ($_GET['hal'] == "edit") {
		//Data akan di edit
		$edit = mysqli_query($koneksi, "UPDATE 	mengajar set
											 	mahasiswa_id = '$_POST[mahasiswa_id]',
											 	matkul_id = '$_POST[matkul_id]'
											 WHERE id = '$_GET[id]'
										   ");
		if ($edit) //jika edit sukses
		{
			echo "<script>
						alert('Edit data suksess!');
						document.location='matkuldiambil.php';
				     </script>";
		} else {
			echo "<script>
						alert('Edit data GAGAL!!');
						document.location='matkuldiambil.php';
				     </script>";
		}
	} else {
		//Data akan disimpan Baru
		$simpan = mysqli_query($koneksi, "INSERT INTO mengajar (mahasiswa_id, matkul_id)
										  VALUES ('$_POST[dosen_id]', 
										  		 '$_POST[matkul_id]')
										 ");
		if ($simpan) //jika simpan sukses
		{
			echo "<script>
						alert('Simpan data suksess!');
						document.location='matkuldiambil.php';
				     </script>";
		} else {
			echo "<script>
						alert('Simpan data GAGAL!!');
						document.location='matkuldiambil.php';
				     </script>";
		}
	}
}


//Pengujian jika tombol Edit / Hapus di klik
if (isset($_GET['hal'])) {
	//Pengujian jika edit Data
	if ($_GET['hal'] == "edit") {
		//Tampilkan Data yang akan diedit
		$tampil = mysqli_query($koneksi, "SELECT * FROM mengajar WHERE id = '$_GET[id]' ");
		$data = mysqli_fetch_array($tampil);
	} else if ($_GET['hal'] == "hapus") {
		//Persiapan hapus data
		$hapus = mysqli_query($koneksi, "DELETE FROM mengajar WHERE id = '$_GET[id]' ");
		if ($hapus) {
			echo "<script>
						alert('Hapus Data Suksess!!');
						document.location='matkuldiambil.php';
				     </script>";
		}
	}
}

?>

<!DOCTYPE html>
<html>

<head>
	<title>CRUD PHP & MySQL + Bootstrap 4</title>
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
					Form Input Data Matakuliah Diambil
				</div>
				<div class="card-body">
					<form method="post" action="">
						<div class="form-group">
							<label>Dosen</label>
							<select class="form-control" name="dosen_id" required>
								<?php 
									$sql = mysqli_query($koneksi, "SELECT * FROM dosen");
									while($data=mysqli_fetch_array($sql)):
								?>
									<option value="<?= $data['id'] ?>" <?= $data['id'] == @$data['matkul_id'] ? "selected" : "" ?>><?= $data['nama'] ?></option>
								<?php endwhile; ?>
							</select>
						</div>
						<div class="form-group">
							<label>Matapelajaran</label>
							<select class="form-control" name="matkul_id" required>
								<?php 
									$sql = mysqli_query($koneksi, "SELECT * FROM dmatkul");
									while($data=mysqli_fetch_array($sql)):
								?>
									<option value="<?= $data['id'] ?>" <?= $data['id'] == @$data['matkul_id'] ? "selected" : "" ?>><?= $data['matkul'] ?></option>
								<?php endwhile; ?>
							</select>
						</div>

						<a href="matkuldiambil.php" class="btn btn-primary">Kembali</a>
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
					Daftar Mengajar
					<div class="float-right">
						<a href="matkuldiambil.php?hal=tambah" class="btn btn-primary">
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
							<th>SKS</th>
							<th>Semester</th>
							<th>Aksi</th>
						</tr>
						<?php
						$no = 1;
						$tampil = mysqli_query($koneksi, "SELECT dosen.id, dmatkul.kodematkul, dosen.nama as dosen, 
                        dmatkul.matkul as matkul, dmatkul.sks as sks, dmatkul.smt as smt from mengajar 
                        left join dosen on dosen.id = mengajar.mahasiswa_id 
                        left join dmatkul on dmatkul.id = mengajar.matkul_id  order by id asc");
						while ($data = mysqli_fetch_array($tampil)) :

						?>
							<tr>
								<td><?= $no++; ?></td>
								<td class="text-center"><?= $data['kodematkul'] ?></td>
								<td><?= $data['matkul'] ?></td>
								<td class="text-center"><?= $data['sks'] ?></td>
								<td class="text-center"><?= $data['smt'] ?></td>
								<td class="text-center	">
									<a href="matkuldiambil.php?hal=edit&id=<?= $data['id'] ?>" class="btn btn-warning"> Edit </a>
									<a href="matkuldiambil.php?hal=hapus&id=<?= $data['id'] ?>" onclick="return confirm
                                    ('Apakah yakin ingin menghapus data ini?')" class="btn btn-danger"> Hapus </a>
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