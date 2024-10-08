<?php
require "koneksi.php";

if (isset($_POST['tambah'])) { 
  $nama = $_POST['nama']; 
  $umur = $_POST['umur']; 
  $posisi_pekerjaan = $_POST['posisi_pekerjaan']; 

  // Menulis query SQL
  $sql = "INSERT INTO pendaftaran VALUES (null, '$nama', '$umur', '$posisi_pekerjaan' )";

  // Mengeksekusi query SQL pada database
  $result = mysqli_query($conn, $sql);

  if ($result) {
    echo "
          <script>
              alert('Berhasil menambah data Daftar Kerja!');
              document.location.href = 'CRUD.php';
          </script>";
  } else {
    echo "
          <script>
              alert('Gagal menambah data Daftar Kerja!');
              document.location.href = 'CRUD.php';
          </script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Daftar Kerja</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="daftar.css" />

  </head>
  <body>
    <section class="daftar-card">
      <hgroup>
        <h1 class="daftar-title">
          Pendaftaran Kerja
        </h1>
        <p class="daftar-description">
          Silakan Mendaftar Pekerjaan
        </p>
      </hgroup>
      
      <form action="" method ='post'class="daftar-form-container">
        <div class="daftar-form-group">
          <label for="username" class="daftar-form-title">Nama</label>
          <input type="text" placeholder="Masukkan Nama" name="nama" id="username" class="daftar-form-input" required>
        </div>

        <div class="daftar-form-group">
          <label for="Umur" class="daftar-form-title">Umur</label>
          <input type="number" placeholder="Umur" name="umur" id="Umur" class="daftar-form-input" required>
        </div> 
        <div class="daftar-form-group">
          <label for="job-select" class="daftar-form-title">Posisi Pekerjaan</label>
          <select id="job-select" name="posisi_pekerjaan" class="daftar-form-input" required>
            <option value=""> Pilih Pekerjaan </option>
            <option value="Web Developer">Web Developer</option>
            <option value="Data Scientist">Data Scientist</option>
            <option value="Desainer Grafis">Desainer Grafis</option>
            <option value="Software Engineer">Software Engineer</option>
            <option value="Mobile Developer">Mobile Developer</option>
            <option value="Backend Developer">Backend Developer</option>
            <option value="Frontend Developer">Frontend Developer</option>
            <option value="UI/UX Designer">UI/UX Designer</option>
            <option value="DevOps Engineer">DevOps Engineer</option>
            <option value="Product Manager">Product Manager</option>
            <option value="Data Analyst">Data Analyst</option>
            <option value="Digital Marketing">Digital Marketing</option>
            <option value="Business Analyst">Business Analyst</option>
            <option value="Quality Assurance">Quality Assurance</option>
            <option value="Network Engineer">Network Engineer</option>
            <option value="System Administrator">System Administrator</option>
            <option value="Cloud Engineer">Cloud Engineer</option>
            <option value="Security Analyst">Security Analyst</option>
            <option value="Sales Executive">Sales Executive</option>
            <option value="Content Writer">Content Writer</option>
            <option value="Graphic Designer">Graphic Designer</option>
        </select>
      
        <input class="daftar-button" type="submit" value="Daftar" name="tambah">

      </form>
    </section>
  </body>
</html>
