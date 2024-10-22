<?php
require "koneksi.php";

// Cek apakah tombol submit sudah ditekan
if (isset($_POST["submit"])) {
    // Ambil dan sanitasi input
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Hash password
    $role = mysqli_real_escape_string($conn, $_POST["role"]);
    
    // Cek apakah username sudah digunakan
    $checkQuery = "SELECT * FROM users WHERE username = '$username'";
    $checkResult = mysqli_query($conn, $checkQuery);
    
    if (mysqli_num_rows($checkResult) > 0) {
        // Jika username sudah digunakan
        echo "
        <script>
            alert('Username sudah digunakan! Silakan gunakan username lain.');
            document.location.href = 'registrasi.php';
        </script>
        ";
    } else {
        // Jika username belum digunakan, lanjutkan proses registrasi
        $query = "INSERT INTO users (username, password, role) VALUES ('$username', '$password', '$role')";
        
        if (mysqli_query($conn, $query)) {
            echo "
            <script>
                alert('Registrasi berhasil!');
                document.location.href = 'login.php';
            </script>
            ";
        } else {
            echo "
            <script>
                alert('Registrasi gagal!');
                document.location.href = 'index.php';
            </script>
            ";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login | Pendataan Mahasiswa Universitas Mulawarman</title>

  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="daftar.css">

</head>

<body>
  <section class="daftar-card">
    <hgroup>
      <h1 class="daftar-title">Login Admin</h1>
      <p class="daftar-description"">Silakan login untuk mengelola website</p>
    </hgroup>

    <form action="" method="post" class="daftar-form-container">
      <div class="daftar-form-group">
        <label for="username" class="daftar-form-title">Username</label>
        <input
          type="text"
          placeholder="Username"
          name="username"
          id="username"
          class="daftar-form-input" />
      </div>

      <div class="daftar-form-group">
        <label for="password" class="daftar-form-title">Password</label>
        <input
          type="password"
          placeholder="Password"
          name="password"
          id="password"
          class="daftar-form-input" />
      </div>

    <div class="daftar-form-group">
        <label for="role" class="daftar-form-title">Role</label>
        <select name="role" id="role" class="daftar-form-input" required>
        <option name="role" value="Admin">Admin</option>
        <option name="role" value="User">User</option>
        </select>
    </div>

      <button type="submit" name="submit" class="daftar-button">LOGIN</button>

    </form>
  </section>
</body>

</html>


