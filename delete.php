<?php
include 'koneksi.php';

// Pastikan id dikirimkan lewat URL
if (!isset($_GET['id'])) {
    echo "<script>alert('ID tidak ditemukan.'); window.location='peminjaman.php';</script>";
    exit;
}

$id = $_GET['id'];

// Query hapus data
$query = "DELETE FROM peminjaman WHERE id = '$id'";
$result = mysqli_query($conn, $query);

if ($result) {
    echo "<script>
            alert('Data berhasil dihapus');
            window.location='peminjaman.php';
          </script>";
} else {
    echo "<script>
            alert('Gagal menghapus data!');
            window.location='peminjaman.php';
          </script>";
}
?>
