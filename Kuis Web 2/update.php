<?php
include "db.php";
session_start();

if (!isset($_GET['id'])) {
    echo "ID tidak ditemukan!";
    exit();
}

$id = $_GET['id'];

$stmt = $conn->prepare("SELECT username FROM akun WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$akun = $result->fetch_assoc();

if (!$akun) {
    echo "Data akun tidak ditemukan!";
    exit();
}

if (isset($_POST['update'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $hashedPassword = !empty($password) ? password_hash($password, PASSWORD_DEFAULT) : null;

    if ($hashedPassword) {
        $query = "UPDATE akun SET username = ?, password = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssi", $username, $hashedPassword, $id);
    } else {
        $query = "UPDATE akun SET username = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("si", $username, $id);
    }

    if ($stmt->execute()) {
        echo "<script>alert('Data Berhasil Diperbarui'); window.location.href = 'home.php';</script>";
    } else {
        echo "<div class='alert alert-danger'>Gagal memperbarui data.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Akun</title>
</head>
<body>
    <h2>Update Akun</h2>
    <form method="POST">
        <label>Username</label>
        <input type="text" name="username" value="<?= htmlspecialchars($akun['username']); ?>" required>

        <label>Password (kosongkan jika tidak ingin mengubah)</label>
        <input type="password" name="password">

        <button type="submit" name="update">Update</button>
        <a href="home.php">Kembali</a>
    </form>
</body>
</html>
