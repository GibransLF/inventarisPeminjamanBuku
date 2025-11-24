<?php 
include 'api.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buku List</title>

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- DataTables CDN -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css">
</head>
<body class="bg-light">

    <!-- Topbar -->
    <?php include('template/topbar.php') ?>

    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="fw-bold text-primary">Daftar Peminjaman Buku</h3>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <table id="tabelPeminjaman" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Pengarang</th>
                            <th>Stok</th>
                            <th>Tahun</th>
                        </tr>
                    </thead>
                    <tbody>
<?php if (!empty($books)): ?>
    <?php $no = 1; ?>
    <?php foreach ($books as $id => $book): ?>
        <tr>
            <td><?= $no ?></td>
            <td><?= $book['judul'] ?></td>
            <td><?= $book['kategori'] ?></td>
            <td><?= $book['pengarang'] ?></td>
            <td><?= $book['stok'] ?></td>
            <td><?= $book['tahun'] ?></td>
        </tr>
        <?php $no++; ?>
    <?php endforeach; ?>
<?php endif; ?>

</tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#tabelPeminjaman').DataTable();
        });
    </script>

</body>
</html>
