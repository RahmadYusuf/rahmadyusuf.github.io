<?php
require "koneksi.php";

// Menyiapkan array assosiatif untuk menyimpan data
$daftarkerja = [];

// Memeriksa apakah ada parameter pencarian
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    // Query SQL untuk mencari data berdasarkan nama
    $sql = mysqli_query($conn, "SELECT * FROM pendaftaran WHERE nama LIKE '%$search%'");
} else {
    // Jika tidak ada pencarian, ambil semua data
    $sql = mysqli_query($conn, "SELECT * FROM pendaftaran");
}

// Memindahkan data dari $sql ke array $daftarkerja
while ($row = mysqli_fetch_assoc($sql)) {
    $daftarkerja[] = $row;
}

$time = date("d/m/Y h:i:sa");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CRUD | JOB-SITE</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="daftar.css" />
</head>

<body>
    <main class="data-kerja-section">
        <img class="Gambar1" src="job-site.png" alt="Gambar">
        <h2 class="data-kerja-title">Data Manajemen Daftar Kerja</h2>
        <div class="status-container">
            <form action="" method="GET" class="search-bar-daftar">
                <input type="text" name="search" placeholder="Cari nama Pendaftaran" class="search-placedaftar" />
                <button type="submit" class="search-daftar">
                    <i class="fa-solid fa-magnifying-glass fa-xl"></i>
                </button>
            </form>
        </div>
        <div class="container">
            <a href="tambah.php">
                <button class="tambah">
                    <i class="fa-solid fa-plus"><p>Daftar</p></i>
                </button>
            </a>
            <a href="index.php">
                <button class="kembali">
                    <i class="fa-solid fa-backward"><p>Kembali</p></i>
                </button>
            </a>
        </div>

        <div class="job-table-container">
            <table class="table-kerja">
                <thead>
                    <tr class="table-kerja-row">
                        <th class="table-kerja-header">NO</th>
                        <th class="table-kerja-header">FOTO</th>
                        <th class="table-kerja-header">NAMA</th>
                        <th class="table-kerja-header">UMUR</th>
                        <th class="table-kerja-header">POSISI PEKERJAAN</th>
                        <th class="table-kerja-header">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; foreach ($daftarkerja as $dk) : ?>
                        <tr class="table-kerja-row">
                            <td class="table-kerja-data"><?php echo $i; ?></td>
                            <td class="table-kerja-data">
                                <img src="images/<?php echo $dk['foto']; ?>" alt="foto mahasiswa" width="100px" height="100px" style="display: block; margin: 0 auto;">
                            </td>
                            <td class="table-kerja-data"><?php echo $dk['nama']; ?></td>
                            <td class="table-kerja-data"><?php echo $dk['umur']; ?></td>
                            <td class="table-kerja-data"><?php echo $dk['posisi_pekerjaan']; ?></td>
                            <td class="table-kerja-data">
                                <div class="button-UD">
                                    <a href="edit.php?id=<?php echo $dk['id']; ?>">
                                        <button class="edit-data">
                                            <i class="fa-solid fa-pen-to-square"><p>Edit</p></i>
                                        </button>
                                    </a>
                                    <a href="delete.php?id=<?php echo $dk['id']; ?>" onclick="return confirm('Yakin ingin menghapus data ini?');">
                                        <button class="hapus-data">
                                            <i class="fa-solid fa-trash-can"><p>Delete</p></i>
                                        </button>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php $i++; endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>

    <script src="script.js"></script>
</body>

</html>