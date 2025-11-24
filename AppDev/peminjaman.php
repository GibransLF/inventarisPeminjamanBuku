<?php
include('koneksi.php');

// Ambil data peminjaman
$query = "SELECT * FROM peminjaman ORDER BY id DESC";
$result = mysqli_query($conn, $query);

// Simpan data ke array untuk foreach
$peminjaman = [];
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $peminjaman[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peminjaman Buku</title>

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- DataTables CDN -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css">
</head>
<body class="bg-light">

    <!-- Topbar -->
    <?php include('template/topbar.php'); ?>

    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="fw-bold text-primary">Daftar Peminjaman Buku</h3>
            <a href="addPeminjaman.php" class="btn btn-success">+ Tambah Peminjaman</a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <table id="tabelPeminjaman" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID Buku Firebase</th>
                            <th>Judul</th>
                            <th>Nama Peminjam</th>
                            <th>Tanggal Pinjam</th>
                            <th>Jumlah</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php 
                         $no = 0;
                        foreach ($peminjaman as $p) : 
                            $no++;
                            ?>
                        <tr>
                            <td><?= $no; ?></td>
                            <td><?= $p['idBukuFirebase']; ?></td>
                            <td><?= $p['judul']; ?></td>
                            <td><?= $p['namaPeminjam']; ?></td>
                            <td><?= $p['tanggalPinjam']; ?></td>
                            <td><?= $p['jumlah']; ?></td>
                            <td><?= $p['status']; ?></td>
                            <td>
                                <a href="edit.php?id=<?= $p['id']; ?>" class="btn btn-sm btn-primary">
                                    Ubah
                                </a>
                                <a href="delete.php?id=<?= $p['id']; ?>"
                                   onclick="return confirm('Yakin ingin menghapus data?')"
                                   class="btn btn-sm btn-danger">
                                   Hapus
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#tabelPeminjaman').DataTable();
        });
    </script>

</body>
</html>
