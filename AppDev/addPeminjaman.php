<?php
// Ambil data API & koneksi
include "koneksi.php"; 
include "api.php"; // berisi $books = json_decode($data, true);

// Jika form submit (POST)
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $namaPeminjam  = $_POST["namaPeminjam"];
    $idBuku        = $_POST["idBuku"];
    $judul     = isset($books[$idBuku]['judul']) ? $books[$idBuku]['judul'] : 'Unknown';
    $tanggalPinjam = $_POST["tanggalPinjam"];
    $jumlah        = (int)$_POST["jumlah"];
    $status        = "dipinjam";

    // 1. Ambil stok dari Firebase (array $books)
    $stokFirebase = isset($books[$idBuku]['stok']) ? (int)$books[$idBuku]['stok'] : 0;

    // 2. Hitung total buku yang sedang dipinjam
    $sql = "SELECT SUM(jumlah) AS totalDipinjam 
            FROM peminjaman 
            WHERE idBukuFirebase = '$idBuku' AND status = 'dipinjam'";

    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $totalDipinjam = (int)$row["totalDipinjam"];

    // 3. Stok tersedia
    $stokTersedia = $stokFirebase - $totalDipinjam;

    // 4. Validasi
    if ($jumlah > $stokTersedia) {
        echo "<script>alert('Gagal! Jumlah buku melebihi stok tersedia. Stok: $stokTersedia');window.history.back();</script>";
        exit;
    }

    // 5. Simpan data
    $sqlInsert = "INSERT INTO peminjaman (idBukuFirebase, namaPeminjam, tanggalPinjam, jumlah, status, judul)
                  VALUES ('$idBuku', '$namaPeminjam', '$tanggalPinjam', '$jumlah', '$status', '$judul')";

    if ($conn->query($sqlInsert) === TRUE) {
        echo "<script>alert('Peminjaman berhasil disimpan!'); window.location.href='peminjaman.php';</script>";
        exit;
    } else {
        echo "Error:" . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Peminjaman</title>

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <!-- Topbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="dashboard.php">Dashboard</a>
        </div>
    </nav>

    <div class="container mt-5" style="max-width: 600px;">
        <h3 class="fw-bold text-primary text-center mb-4">Tambah Peminjaman</h3>

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="" method="POST">

                    <!-- Nama Peminjam -->
                    <div class="mb-3">
                        <label class="form-label">Nama Peminjam</label>
                        <input type="text" name="namaPeminjam" class="form-control" required>
                    </div>

                    <!-- Pilih Buku -->
                    <div class="mb-3">
                        <label class="form-label">Pilih Buku</label>
                        <select name="idBuku" class="form-select" required>
                            <option value="">-- Pilih Buku --</option>

                            <?php if (!empty($books)): ?>
                                <?php foreach ($books as $id => $book): ?>

                                    <?php 
                                        // Hitung stok tersedia
                                        $stokFirebase = (int)$book['stok'];
                                        $sql = "SELECT SUM(jumlah) AS totalDipinjam 
                                                FROM peminjaman 
                                                WHERE idBukuFirebase = '$id' AND status = 'dipinjam'";
                                        $result = $conn->query($sql);
                                        $row = $result->fetch_assoc();
                                        $totalDipinjam = (int)$row['totalDipinjam'];
                                        $stokTersedia = $stokFirebase - $totalDipinjam;
                                    ?>

                                    <option value="<?= $id ?>">
                                        <?= $book['judul'] ?> (Tersedia: <?= $stokTersedia ?>)
                                    </option>

                                <?php endforeach; ?>
                            <?php endif; ?>

                        </select>
                    </div>

                    <!-- Tanggal Pinjam -->
                    <div class="mb-3">
                        <label class="form-label">Tanggal Pinpinjam</label>
                        <input type="date" name="tanggalPinjam" class="form-control" required>
                    </div>

                    <!-- Jumlah Buku -->
                    <div class="mb-3">
                        <label class="form-label">Jumlah Buku</label>
                        <input type="number" name="jumlah" class="form-control" min="1" required>
                    </div>

                    <input type="hidden" name="status" value="dipinjam">

                    <div class="">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="peminjaman.php" class="btn btn-secondary">Batal</a>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
