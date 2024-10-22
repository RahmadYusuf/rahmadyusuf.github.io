<?php
require "koneksi.php";
session_start(); // Pastikan session dimulai

if (isset($_POST["submit"])) {
    // Ambil dan sanitasi input
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = $_POST["password"];
    
    // Query untuk mendapatkan data user berdasarkan username
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $query);
    
    // Cek apakah username ditemukan
    if (mysqli_num_rows($result) === 1) {
        // Ambil data pengguna
        $user = mysqli_fetch_assoc($result);
        
        // Verifikasi password
        if (password_verify($password, $user['password'])) {
            // Set session login jika berhasil
            $_SESSION['login'] = true;

            // Cek role pengguna
            if ($user['role'] === 'Admin') {
                $_SESSION['role'] = 'admin'; // Session untuk admin
                echo "
                <script>
                    alert('Login berhasil! Selamat datang Admin.');
                    document.location.href = 'CRUD.php';
                </script>
                ";
            } else {
                $_SESSION['role'] = 'user'; // Session untuk user
                echo "
                <script>
                    alert('Login berhasil! Selamat datang User.');
                    document.location.href = 'tambah.php';
                </script>
                ";
            }
        } else {
            // Jika password salah
            echo "
            <script>
                alert('Password salah!');
                document.location.href = 'login.php';
            </script>
            ";
        }
    } else {
        // Jika username tidak ditemukan
        echo "
        <script>
            alert('Username tidak ditemukan!');
            document.location.href = 'login.php';
        </script>
        ";
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

<body>
  <section class="daftar-card">
    <hgroup>
      <h1 class="daftar-title">Login </h1>
      <p class="daftar-description">Silakan Login Agar Bisa Mendaftar</p>
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

      <button type="submit" name="submit" class="daftar-button">LOGIN</button>
      <a href="registrasi.php">Gak Punya Akun?</a>
    </form>
  </section>

  <script src="/scripts/script.js"></script>
</body>

</html>