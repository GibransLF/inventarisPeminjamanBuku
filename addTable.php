<?php 
require 'koneksi.php';

// Query membuat tabel
$sql = "CREATE TABLE IF NOT EXISTS peminjaman (
    id INT AUTO_INCREMENT PRIMARY KEY,
    idBukuFirebase VARCHAR(100) NOT NULL,
    judul VARCHAR(100) NOT NULL,
    namaPeminjam VARCHAR(100) NOT NULL,
    tanggalPinjam DATE NOT NULL,
    jumlah INT NOT NULL,
    status ENUM('dipinjam','kembali') NOT NULL DEFAULT 'dipinjam'
)";

// Eksekusi query
if ($conn->query($sql) === TRUE) {
    echo "Tabel peminjaman berhasil dibuat!";
} else {
    echo "Error membuat tabel: " . $conn->error;
}

$conn->close();
?>

<br>
<br>

<a href="index.php">Kembali ke index</a>