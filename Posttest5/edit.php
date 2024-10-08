<?php
require "koneksi.php";

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  
  $query = "SELECT * FROM pendaftaran WHERE id = $id";
  $result = mysqli_query($conn, $query);
  

  if (mysqli_num_rows($result) > 0) {
    $data = mysqli_fetch_assoc($result); 
  } else {
    echo "<script>alert('Data tidak ditemukan!'); document.location.href = 'CRUD.php';</script>";
    exit;
  }
}

if (isset($_POST['update'])) { 
  $nama = $_POST['nama']; 
  $umur = $_POST['umur']; 
  $posisi_pekerjaan = $_POST['posisi_pekerjaan']; 

  // Menulis query SQL
  $sql = "UPDATE pendaftaran SET nama='$nama', umur='$umur', posisi_pekerjaan='$posisi_pekerjaan' WHERE id=$id";

  // Mengeksekusi query SQL pada database
  $result = mysqli_query($conn, $sql);

  if ($result) {
    echo "
          <script>
              alert('Berhasil memperbarui data Daftar Kerja!');
              document.location.href = 'CRUD.php';
          </script>";
  } else {
    echo "
          <script>
              alert('Gagal memperbarui data Daftar Kerja!');
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
    <title>Update Data Kerja</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="daftar.css" />

  </head>
  <body>
    <section class="daftar-card">
      <hgroup>
        <h1 class="daftar-title">
          Update Data Kerja
        </h1>
        <p class="daftar-description">
          Silakan Perbarui Data Pekerjaan
        </p>
      </hgroup>
      
      <form action="" method='post' class="daftar-form-container">
        <input type="hidden" name="id" value="<?php echo $id; ?>"> <!-- Menyimpan ID untuk update -->
        
        <div class="daftar-form-group">
          <label for="username" class="daftar-form-title">Nama</label>
          <input type="text" placeholder="Masukkan Nama" name="nama" id="username" class="daftar-form-input" value="<?php echo isset($data['nama']) ? $data['nama'] : ''; ?>" required>
        </div>

        <div class="daftar-form-group">
          <label for="Umur" class="daftar-form-title">Umur</label>
          <input type="number" placeholder="Umur" name="umur" id="Umur" class="daftar-form-input" value="<?php echo isset($data['umur']) ? $data['umur'] : ''; ?>" required>
        </div> 
        
        <div class="daftar-form-group">
          <label for="job-select" class="daftar-form-title">Posisi Pekerjaan</label>
          <select id="job-select" name="posisi_pekerjaan" class="daftar-form-input" required>
            <option value="">Pilih Pekerjaan</option>
            <option value="Web Developer" <?php echo (isset($data['posisi_pekerjaan']) && $data['posisi_pekerjaan'] == 'Web Developer') ? 'selected' : ''; ?>>Web Developer</option>
            <option value="Data Scientist" <?php echo (isset($data['posisi_pekerjaan']) && $data['posisi_pekerjaan'] == 'Data Scientist') ? 'selected' : ''; ?>>Data Scientist</option>
            <option value="Desainer Grafis" <?php echo (isset($data['posisi_pekerjaan']) && $data['posisi_pekerjaan'] == 'Desainer Grafis') ? 'selected' : ''; ?>>Desainer Grafis</option>
            <option value="Software Engineer" <?php echo (isset($data['posisi_pekerjaan']) && $data['posisi_pekerjaan'] == 'Software Engineer') ? 'selected' : ''; ?>>Software Engineer</option>
            <option value="Mobile Developer" <?php echo (isset($data['posisi_pekerjaan']) && $data['posisi_pekerjaan'] == 'Mobile Developer') ? 'selected' : ''; ?>>Mobile Developer</option>
            <option value="Backend Developer" <?php echo (isset($data['posisi_pekerjaan']) && $data['posisi_pekerjaan'] == 'Backend Developer') ? 'selected' : ''; ?>>Backend Developer</option>
            <option value="Frontend Developer" <?php echo (isset($data['posisi_pekerjaan']) && $data['posisi_pekerjaan'] == 'Frontend Developer') ? 'selected' : ''; ?>>Frontend Developer</option>
            <option value="UI/UX Designer" <?php echo (isset($data['posisi_pekerjaan']) && $data['posisi_pekerjaan'] == 'UI/UX Designer') ? 'selected' : ''; ?>>UI/UX Designer</option>
            <option value="DevOps Engineer" <?php echo (isset($data['posisi_pekerjaan']) && $data['posisi_pekerjaan'] == 'DevOps Engineer') ? 'selected' : ''; ?>>DevOps Engineer</option>
            <option value="Product Manager" <?php echo (isset($data['posisi_pekerjaan']) && $data['posisi_pekerjaan'] == 'Product Manager') ? 'selected' : ''; ?>>Product Manager</option>
            <option value="Data Analyst" <?php echo (isset($data['posisi_pekerjaan']) && $data['posisi_pekerjaan'] == 'Data Analyst') ? 'selected' : ''; ?>>Data Analyst</option>
            <option value="Digital Marketing" <?php echo (isset($data['posisi_pekerjaan']) && $data['posisi_pekerjaan'] == 'Digital Marketing') ? 'selected' : ''; ?>>Digital Marketing</option>
            <option value="Business Analyst" <?php echo (isset($data['posisi_pekerjaan']) && $data['posisi_pekerjaan'] == 'Business Analyst') ? 'selected' : ''; ?>>Business Analyst</option>
            <option value="Quality Assurance" <?php echo (isset($data['posisi_pekerjaan']) && $data['posisi_pekerjaan'] == 'Quality Assurance') ? 'selected' : ''; ?>>Quality Assurance</option>
            <option value="Network Engineer" <?php echo (isset($data['posisi_pekerjaan']) && $data['posisi_pekerjaan'] == 'Network Engineer') ? 'selected' : ''; ?>>Network Engineer</option>
            <option value="System Administrator" <?php echo (isset($data['posisi_pekerjaan']) && $data['posisi_pekerjaan'] == 'System Administrator') ? 'selected' : ''; ?>>System Administrator</option>
            <option value="Cloud Engineer" <?php echo (isset($data['posisi_pekerjaan']) && $data['posisi_pekerjaan'] == 'Cloud Engineer') ? 'selected' : ''; ?>>Cloud Engineer</option>
            <option value="Security Analyst" <?php echo (isset($data['posisi_pekerjaan']) && $data['posisi_pekerjaan'] == 'Security Analyst') ? 'selected' : ''; ?>>Security Analyst</option>
            <option value="Sales Executive" <?php echo (isset($data['posisi_pekerjaan']) && $data['posisi_pekerjaan'] == 'Sales Executive') ? 'selected' : ''; ?>>Sales Executive</option>
            <option value="Content Writer" <?php echo (isset($data['posisi_pekerjaan']) && $data['posisi_pekerjaan'] == 'Content Writer') ? 'selected' : ''; ?>>Content Writer</option>
            <option value="Graphic Designer" <?php echo (isset($data['posisi_pekerjaan']) && $data['posisi_pekerjaan'] == 'Graphic Designer') ? 'selected' : ''; ?>>Graphic Designer</option>
          </select>
        </div>

        <input class="daftar-button" type="submit" value="Perbarui Data" name="update" />
      </form>
    </section>
  </body>
</html>
