<?php
    require "koneksi.php";

    $id = $_GET['id'];

    $query = mysqli_query($conn, "SELECT * FROM pendaftaran WHERE id=$id");
    $daftarkerja = [];
    while ($dk = mysqli_fetch_assoc($query)) {
        $daftarkerja[] = $dk;
    }

    unlink('images/' . $daftarkerja[0]['foto']);

    $result = mysqli_query($conn, "DELETE FROM pendaftaran WHERE id = $id");

    if ($result) {
        echo "
        <script>
            alert('Data berhasil dihapus!');
            document.location.href = 'CRUD.php';
        </script>";
    } else {
        echo "
        <script>
            alert('Data gagal dihapus!');
            document.location.href = 'CRUD.php';
        </script>";
    }
?>