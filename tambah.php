<!DOCTYPE html>
<html>
<head>
  <title>Tambah Absensi</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: #f5f6fa;
    }
    .card {
      border-radius: 12px;
      border: none;
    }
  </style>
</head>

<body>

<div class="container mt-5">
  <div class="card shadow-sm p-4">
    <h5 class="mb-3">Tambah Absensi</h5>

    <form method="POST" enctype="multipart/form-data">
      <input type="text" name="nama" class="form-control mb-3" placeholder="Nama" required>
      <input type="date" name="tanggal" class="form-control mb-3" required>

      <select name="status" class="form-control mb-3">
        <option>Masuk</option>
        <option>Izin</option>
        <option>Sakit</option>
      </select>

      <input type="file" name="foto" class="form-control mb-3" required>

      <div class="d-flex gap-2">
        <button class="btn btn-primary">Simpan</button>
        <a href="index.php" class="btn btn-light border">Kembali</a>
      </div>
    </form>
  </div>
</div>

</body>
</html>

<?php
include 'koneksi.php';

if ($_POST) {
    $nama = $_POST['nama'];
    $tanggal = $_POST['tanggal'];
    $status = $_POST['status'];

    $file = $_FILES['foto']['name'];
    $tmp = $_FILES['foto']['tmp_name'];

    move_uploaded_file($tmp, "uploads/" . $file);

    mysqli_query($conn, "INSERT INTO absensi (nama, tanggal, status, foto)
    VALUES ('$nama', '$tanggal', '$status', '$file')");

    header("Location: index.php");
}
?>