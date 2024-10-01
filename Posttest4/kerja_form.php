<?php
 if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = htmlspecialchars($_POST['username']);
    $umur = htmlspecialchars($_POST['Umur']);
    $job = htmlspecialchars($_POST['job-select']);

    echo "<h2>Data Pendaftaran:</h2>";
    echo "<p>Nama: $username</p>";
    echo "<p>Umur: $umur</p>";
    echo "<p>Posisi Pekerjaan: $job</p>";
}
?>