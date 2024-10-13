<?php
require "koneksi.php";

// Mengambil ID yang dilempar oleh link
$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM pendaftaran WHERE id = $id");

// Periksa jika data ditemukan
if (mysqli_num_rows($result) > 0) {
    $daftarkerja = mysqli_fetch_assoc($result);
} else {
    // Data tidak ditemukan, bisa mengalihkan atau memberikan pesan error
    echo "
    <script>
        alert('Data tidak ditemukan!');
        document.location.href = 'CRUD.php';
    </script>";
    exit; // Keluar dari skrip
}

if (isset($_POST['ubah'])) { 
    $nama = $_POST['nama']; 
    $umur = $_POST['umur']; 
    $posisi_pekerjaan = $_POST['posisi_pekerjaan']; 
    $oldImg = $daftarkerja['foto'] ?? null; // Menggunakan null jika 'foto' tidak ada

    // Fungsi untuk memperbarui data
    function updatedaftar($conn, $id, $nama, $umur, $posisi_pekerjaan, $file_name = null) {
        // Siapkan query UPDATE
        if ($file_name) {
            // Jika ada file baru, perbarui foto
            $sql = "UPDATE pendaftaran SET nama='$nama', umur='$umur', posisi_pekerjaan='$posisi_pekerjaan', foto='$file_name' WHERE id=$id";
        } else {
            // Jika tidak ada file baru, jangan ubah kolom foto
            $sql = "UPDATE pendaftaran SET nama='$nama', umur='$umur', posisi_pekerjaan='$posisi_pekerjaan' WHERE id=$id";
        }

        // Eksekusi query
        $result = mysqli_query($conn, $sql);
        
        // Pengecekan hasil
        if ($result) {
            // Pesan sukses dan redirect
            echo "
            <script>
                alert('Data berhasil diubah!');
                document.location.href = 'CRUD.php';
            </script>";
        } else {
            // Pesan gagal dan redirect
            echo "
            <script>
                alert('Data gagal diubah!');
                document.location.href = 'CRUD.php';
            </script>";
        }
    }

    if ($_FILES['foto']['error'] === 4) { // cek apakah ada file yg diupload
        // Jika tidak ada file baru, gunakan foto lama jika ada
        if ($oldImg) {
            updatedaftar($conn, $id, $nama, $umur, $posisi_pekerjaan, $oldImg);
        } else {
            // Jika tidak ada foto lama, perbarui tanpa kolom foto
            updatedaftar($conn, $id, $nama, $umur, $posisi_pekerjaan);
        }
    } else {
        $tmp_name = $_FILES['foto']['tmp_name']; // mengambil path temporary file
        $file_name = $_FILES['foto']['name']; // mengambil nama file

        // cek apakah yang diupload adalah file gambar
        $validExtensions = ['png', 'jpg', 'jpeg'];
        $fileExtension = explode('.', $file_name);
        $fileExtension = strtolower(end($fileExtension));
        if (!in_array($fileExtension, $validExtensions)) {
            echo "
            <script>
                alert('Tolong upload file gambar!');
            </script>";
        } else {
            $newFileName = date('Y-m-d H.i.s') . '-' . $file_name;
            move_uploaded_file($tmp_name, 'images/' . $newFileName);
            if ($oldImg) {
                unlink('images/' . $oldImg); // menghapus gambar lama dari folder images jika ada
            }
            updatedaftar($conn, $id, $nama, $umur, $posisi_pekerjaan, $newFileName);
        }
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
      
      <form action="" method='post'class="daftar-form-container" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $id; ?>"> <!-- Menyimpan ID untuk update -->
        
        <!-- menambahkan input hidden untuk menyimpan foto lama -->
        <input type="hidden" name="oldimg" value="<?= $daftarkerja['foto'] ?>">
        
        <div class="daftar-form-group">
          <label for="username" class="daftar-form-title">Nama</label>
          <input type="text" placeholder="Masukkan Nama" name="nama" id="username" class="daftar-form-input" value="<?php echo isset($daftarkerja['nama']) ? $daftarkerja['nama'] : ''; ?>" required>
        </div>

        <div class="daftar-form-group">
          <label for="Umur" class="daftar-form-title">Umur</label>
          <input type="number" placeholder="Umur" name="umur" id="Umur" class="daftar-form-input" value="<?php echo isset($daftarkerja['umur']) ? $daftarkerja['umur'] : ''; ?>" required>
        </div> 
        
        <div class="daftar-form-group">
          <label for="job-select" class="daftar-form-title">Posisi Pekerjaan</label>
          <select id="job-select" name="posisi_pekerjaan" class="daftar-form-input" required>
            <option value="">Pilih Pekerjaan</option>
            <option value="Web Developer" <?php echo (isset($daftarkerja['posisi_pekerjaan']) && $daftarkerja['posisi_pekerjaan'] == 'Web Developer') ? 'selected' : ''; ?>>Web Developer</option>
            <option value="Data Scientist" <?php echo (isset($daftarkerja['posisi_pekerjaan']) && $daftarkerja['posisi_pekerjaan'] == 'Data Scientist') ? 'selected' : ''; ?>>Data Scientist</option>
            <option value="Desainer Grafis" <?php echo (isset($daftarkerja['posisi_pekerjaan']) && $daftarkerja['posisi_pekerjaan'] == 'Desainer Grafis') ? 'selected' : ''; ?>>Desainer Grafis</option>
            <option value="Software Engineer" <?php echo (isset($daftarkerja['posisi_pekerjaan']) && $daftarkerja['posisi_pekerjaan'] == 'Software Engineer') ? 'selected' : ''; ?>>Software Engineer</option>
            <option value="Mobile Developer" <?php echo (isset($daftarkerja['posisi_pekerjaan']) && $daftarkerja['posisi_pekerjaan'] == 'Mobile Developer') ? 'selected' : ''; ?>>Mobile Developer</option>
            <option value="Backend Developer" <?php echo (isset($daftarkerja['posisi_pekerjaan']) && $daftarkerja['posisi_pekerjaan'] == 'Backend Developer') ? 'selected' : ''; ?>>Backend Developer</option>
            <option value="Frontend Developer" <?php echo (isset($daftarkerja['posisi_pekerjaan']) && $daftarkerja['posisi_pekerjaan'] == 'Frontend Developer') ? 'selected' : ''; ?>>Frontend Developer</option>
            <option value="UI/UX Designer" <?php echo (isset($daftarkerja['posisi_pekerjaan']) && $daftarkerja['posisi_pekerjaan'] == 'UI/UX Designer') ? 'selected' : ''; ?>>UI/UX Designer</option>
            <option value="DevOps Engineer" <?php echo (isset($daftarkerja['posisi_pekerjaan']) && $daftarkerja['posisi_pekerjaan'] == 'DevOps Engineer') ? 'selected' : ''; ?>>DevOps Engineer</option>
            <option value="Product Manager" <?php echo (isset($daftarkerja['posisi_pekerjaan']) && $daftarkerja['posisi_pekerjaan'] == 'Product Manager') ? 'selected' : ''; ?>>Product Manager</option>
            <option value="Data Analyst" <?php echo (isset($daftarkerja['posisi_pekerjaan']) && $daftarkerja['posisi_pekerjaan'] == 'Data Analyst') ? 'selected' : ''; ?>>Data Analyst</option>
            <option value="Digital Marketing" <?php echo (isset($daftarkerja['posisi_pekerjaan']) && $daftarkerja['posisi_pekerjaan'] == 'Digital Marketing') ? 'selected' : ''; ?>>Digital Marketing</option>
            <option value="Business Analyst" <?php echo (isset($daftarkerja['posisi_pekerjaan']) && $daftarkerja['posisi_pekerjaan'] == 'Business Analyst') ? 'selected' : ''; ?>>Business Analyst</option>
            <option value="Quality Assurance" <?php echo (isset($daftarkerja['posisi_pekerjaan']) && $daftarkerja['posisi_pekerjaan'] == 'Quality Assurance') ? 'selected' : ''; ?>>Quality Assurance</option>
            <option value="Network Engineer" <?php echo (isset($daftarkerja['posisi_pekerjaan']) && $daftarkerja['posisi_pekerjaan'] == 'Network Engineer') ? 'selected' : ''; ?>>Network Engineer</option>
            <option value="System Administrator" <?php echo (isset($daftarkerja['posisi_pekerjaan']) && $daftarkerja['posisi_pekerjaan'] == 'System Administrator') ? 'selected' : ''; ?>>System Administrator</option>
            <option value="Cloud Engineer" <?php echo (isset($daftarkerja['posisi_pekerjaan']) && $daftarkerja['posisi_pekerjaan'] == 'Cloud Engineer') ? 'selected' : ''; ?>>Cloud Engineer</option>
            <option value="Security Analyst" <?php echo (isset($daftarkerja['posisi_pekerjaan']) && $daftarkerja['posisi_pekerjaan'] == 'Security Analyst') ? 'selected' : ''; ?>>Security Analyst</option>
            <option value="Sales Executive" <?php echo (isset($daftarkerja['posisi_pekerjaan']) && $daftarkerja['posisi_pekerjaan'] == 'Sales Executive') ? 'selected' : ''; ?>>Sales Executive</option>
            <option value="Content Writer" <?php echo (isset($daftarkerja['posisi_pekerjaan']) && $daftarkerja['posisi_pekerjaan'] == 'Content Writer') ? 'selected' : ''; ?>>Content Writer</option>
            <option value="Graphic Designer" <?php echo (isset($daftarkerja['posisi_pekerjaan']) && $daftarkerja['posisi_pekerjaan'] == 'Graphic Designer') ? 'selected' : ''; ?>>Graphic Designer</option>
          </select>
        </div>
         <!-- menambahkan input type file -->
         <div class="daftar-form-group" style="border: 1px solid rgba(0, 0, 0, 0.6); border-radius: 9px; padding: 7px 10px; font-size:16px">
          <label for="foto" class="daftar-form-title">Foto</label>
          <input type="file" name="foto" id="foto" class="daftar-form-input" >
          <br>
          <img src="images/<?= isset($daftarkerja['foto']) ? $daftarkerja['foto'] : 'default.jpg' ?>" alt="<?= isset($daftarkerja['foto']) ? $daftarkerja['foto'] : 'default.jpg' ?>" width="80px" height="100px">
         </div>

        <input class="daftar-button" type="submit" value="Perbarui Data" name="ubah" />
      </form>
    </section>
  </body>
</html>
