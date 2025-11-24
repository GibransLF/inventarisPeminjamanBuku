<?php
include 'koneksi.php';
include 'api.php'; // ambil fungsi firebase

// Cek apakah ID diberikan
if (!isset($_GET['id'])) {
    echo "<script>alert('ID tidak ditemukan.'); window.location='peminjaman.php';</script>";
    exit;
}

$id = $_GET['id'];

// Ambil semua data buku dari Firebase
$books = fetchAllBooksFromFirebase();

// Ambil data peminjaman berdasarkan ID
$query = "SELECT * FROM peminjaman WHERE id = '$id'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 0) {
    echo "<script>alert('Data tidak ditemukan.'); window.location='peminjaman.php';</script>";
    exit;
}

$data = mysqli_fetch_assoc($result);
$idBukuFirebase = $data['idBukuFirebase']; // ID buku Firebase yang sedang dipinjam

// =============================
// HITUNG STOK TERSEDIA (UNTUK DITAMPILKAN)
// =============================

// 1. stok Firebase
$stokFirebase = isset($books[$idBukuFirebase]['stok']) ? (int)$books[$idBukuFirebase]['stok'] : 0;

// 2. total semua pinjaman lain (kecuali data ini)
$sql = "SELECT SUM(jumlah) AS totalDipinjam
        FROM peminjaman
        WHERE idBukuFirebase = '$idBukuFirebase'
        AND status = 'dipinjam'
        AND id != '$id'";

$resultTotal = mysqli_query($conn, $sql);
$rowTotal = mysqli_fetch_assoc($resultTotal);
$totalDipinjamLain = (int)$rowTotal['totalDipinjam'];

// 3. stok tersedia
$stokTersedia = $stokFirebase - $totalDipinjamLain;


// =============================
// PROSES UPDATE DATA
// =============================
if (isset($_POST['update'])) {

    $jumlahBaru = (int)$_POST['jumlah'];
    $statusBaru = $_POST['status'];

    // VALIDASI STOK — hanya jika status dipinjam
    if ($statusBaru == "dipinjam") {

        if ($jumlahBaru > $stokTersedia) {
            echo "<script>
                    alert('Gagal! Jumlah melebihi stok tersedia. Stok tersedia: $stokTersedia');
                    window.history.back();
                  </script>";
            exit;
        }
    }

    // UPDATE DATA
    $updateQuery = "UPDATE peminjaman 
                    SET jumlah = '$jumlahBaru', status = '$statusBaru'
                    WHERE id = '$id'";

    if (mysqli_query($conn, $updateQuery)) {
        echo "<script>
                alert('Data berhasil diperbarui!');
                window.location='peminjaman.php';
              </script>";
        exit;
    } else {
        echo "<script>alert('Gagal memperbarui data!');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Peminjaman</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="m-0">Edit Peminjaman</h5>
        </div>
        <div class="card-body">

            <form method="POST">

                <div class="mb-3">
                    <label class="form-label">
                        Jumlah 
                        <span class="text-muted">(Stok tersedia: <?= $stokTersedia ?>)</span>
                    </label>
                    <input type="number" name="jumlah" class="form-control"
                           value="<?= $data['jumlah']; ?>" min="1" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select" required>
                        <option value="dipinjam" <?= $data['status'] == 'dipinjam' ? 'selected' : ''; ?>>Dipinjam</option>
                        <option value="kembali" <?= $data['status'] == 'kembali' ? 'selected' : ''; ?>>Kembali</option>
                    </select>
                </div>

                <button type="submit" name="update" class="btn btn-success">Simpan Perubahan</button>
                <a href="peminjaman.php" class="btn btn-secondary">Batal</a>

            </form>

        </div>
    </div>
</div>

</body>
</html>
