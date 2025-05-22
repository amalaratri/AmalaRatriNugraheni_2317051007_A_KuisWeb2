<?php include "db.php"; ?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>
<body class="container mt-5"> 
  <h2>Data Akun</h2> 
  <a href="create.php" class="btn btn-primary mb-3">+ Tambah Akun</a> 
  <table class="table table-bordered"> 
    <thead class="table-dark"> 
      <tr><th>No</th><th>Akun</th><th>Aksi</th></tr> 
    </thead> 
    <tbody> 
      <?php 
      $no = 1; 
      $result = mysqli_query($conn, "SELECT * FROM akun"); 
      while ($row = mysqli_fetch_assoc($result)) { 
        echo "<tr> 
                <td>$no</td> 
                <td>{$row['username']}</td> 
                <td> 
                  <a href='update.php?id={$row['id']}' class='btn btnwarning btn-sm'>Edit</a> 
                  <a href='delete.php?id={$row['id']}' class='btn btndanger btn-sm' onclick='return confirm(\"Hapus data ini?\")'>Hapus</a> 
                </td> 
              </tr>"; 
        $no++; 
      } 
      ?> 
    </tbody> 
  </table>
</body>
</html>
