<?php
include 'koneksi.php';

$data = mysqli_query($conn, "SELECT * FROM absensi ORDER BY id DESC");

// hitung summary
$total = mysqli_num_rows($data);
$masuk = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absensi WHERE status='Masuk'"));
$izin = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absensi WHERE status='Izin'"));
$sakit = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absensi WHERE status='Sakit'"));
?>

<!DOCTYPE html>
<html>
<head>
  <title>Absensi</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: #f4f6f9;
      font-family: 'Segoe UI', sans-serif;
    }
    .card {
      border: none;
      border-radius: 12px;
    }
    .stat {
      padding: 15px;
      border-radius: 12px;
      background: white;
      box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }
    .stat h5 {
      margin: 0;
      font-size: 18px;
    }
    .stat small {
      color: gray;
    }
    .badge-masuk { background:#d1fae5; color:#065f46; }
    .badge-izin { background:#fef3c7; color:#92400e; }
    .badge-sakit { background:#fee2e2; color:#991b1b; }
  </style>
</head>

<body>

<div class="container mt-5">

  <!-- HEADER -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h4 class="fw-bold mb-0">Employee Attendance</h4>
      <small class="text-muted">Monitoring kehadiran karyawan</small>
    </div>
    <a href="tambah.php" class="btn btn-primary">+ Absen</a>
  </div>

  <!-- SUMMARY -->
  <div class="row mb-4">
    <div class="col-md-3">
      <div class="stat">
        <h5><?= $total ?></h5>
        <small>Total Data</small>
      </div>
    </div>
    <div class="col-md-3">
      <div class="stat">
        <h5><?= $masuk ?></h5>
        <small>Masuk</small>
      </div>
    </div>
    <div class="col-md-3">
      <div class="stat">
        <h5><?= $izin ?></h5>
        <small>Izin</small>
      </div>
    </div>
    <div class="col-md-3">
      <div class="stat">
        <h5><?= $sakit ?></h5>
        <small>Sakit</small>
      </div>
    </div>
  </div>

  <!-- TABLE -->
  <div class="card shadow-sm p-3">
    <table class="table align-middle mb-0">
      <thead class="text-muted">
        <tr>
          <th>No.</th>
          <th>Nama</th>
          <th>Tanggal</th>
          <th>Status</th>
          <th>Foto</th>
          <th></th>
        </tr>
      </thead>

      <tbody>
        <?php $no=1; while($row = mysqli_fetch_assoc($data)) { ?>
        <tr>
          <td><?= $no++ ?></td>
          <td class="fw-medium"><?= $row['nama'] ?></td>
          <td><?= date('d M Y', strtotime($row['tanggal'])) ?></td>

          <td>
            <?php if($row['status']=="Masuk") { ?>
              <span class="badge badge-masuk">Masuk</span>
            <?php } elseif($row['status']=="Izin") { ?>
              <span class="badge badge-izin">Izin</span>
            <?php } else { ?>
              <span class="badge badge-sakit">Sakit</span>
            <?php } ?>
          </td>

          <td>
            <img src="uploads/<?= $row['foto'] ?>" width="50" style="border-radius:8px;">
          </td>

          <td>
            <a href="hapus.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-outline-danger">
              Hapus
            </a>
          </td>
        </tr>
        <?php } ?>
      </tbody>

    </table>
  </div>

</div>

</body>
</html>