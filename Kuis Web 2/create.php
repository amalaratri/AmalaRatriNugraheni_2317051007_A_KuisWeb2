<?php include "db.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Akun</title>
</head>
<body>
    <h2>Tambah Akun</h2> 
    <form method="POST"> 
        <label>Username</label> 
        <input type="text" name="username" required> 

        <label>Password</label> 
        <input type="password" name="password" required> 

        <button type="submit" name="simpan">Simpan</button> 
        <a href="home.php" class="btn btn-secondary">Kembali</a> 
    </form> 

    <?php 
    if (isset($_POST['simpan'])) { 
        $username = $_POST['username']; 
        $password = $_POST['password']; 
        
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO akun (username, password) VALUES ('$username', '$hashedPassword')";
        if (mysqli_query($conn, $query)) {
            echo "<div class='alert alert-success mt-3'>Data berhasil disimpan.</div>";
            echo "<script>alert('Data Berhasil Ditambah'); window.location.href = 'home.php';</script>";
        } else {
            echo "<div class='alert alert-danger mt-3'>Gagal menyimpan data.</div>";
        }
    } 
    ?> 
</body>
</html>
