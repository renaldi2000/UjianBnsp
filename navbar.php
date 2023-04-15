<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="index.php"><img class="mb-4" src="./img/logo.png" alt="" width="72" height="72"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" 
    aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav mr-auto">
            <a class="nav-item nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
            <a class="nav-item nav-link" href="mahasiswa.php">Dosen</a>
            <a class="nav-item nav-link" href="matkul.php">Mata Kuliah</a>
            <a class="nav-item nav-link" href="matkuldiambil.php">Data Mengajar</a>
        </div>
        <a class="btn btn-primary" href="logout.php">Logout (<?= $_SESSION['nama'] ?>)</a>
    </div>
</nav>