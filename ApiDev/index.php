<?php
include('firebase.php');

// Ambil data dari Firebase
$ref = 'buku';
$bukuSnapshot = $database->getReference($ref)->getSnapshot();
$books = $bukuSnapshot->getValue();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Buku</title>

    <style>
        body {
            margin: 0;
            font-family: "Segoe UI", sans-serif;
            background: #f6f9fc;
        }

        header {
            background: #2c3e50;
            padding: 20px;
            color: white;
            text-align: center;
            box-shadow: 0px 2px 8px rgba(0,0,0,0.3);
        }

        h2 {
            margin: 0;
            font-size: 26px;
            letter-spacing: 1px;
        }

        .container {
            width: 80%;
            margin: 30px auto;
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0px 2px 12px rgba(0,0,0,0.15);
        }

        /* Button group */
        .button-group {
            display: flex;
            gap: 10px;
            margin-bottom: 15px;
        }

        .btn {
            padding: 10px 14px;
            font-size: 14px;
            border-radius: 6px;
            color: white;
            text-decoration: none;
            display: inline-block;
            transition: 0.25s;
        }

        .btn-add {
            background: #27ae60;
        }
        .btn-add:hover {
            background: #1e8449;
        }

        .btn-search {
            background: #2980b9;
        }
        .btn-search:hover {
            background: #1c6289;
        }

        /* Buttons edit/delete */
        .btn-edit {
            background: #f1c40f;
            padding: 6px 10px;
            border-radius: 5px;
            color: white;
            font-size: 13px;
        }
        .btn-edit:hover {
            background: #d4ac0d;
        }
        .btn-delete {
            background: #e74c3c;
            padding: 6px 10px;
            border-radius: 5px;
            color: white;
            font-size: 13px;
        }
        .btn-delete:hover {
            background: #c0392b;
        }

        /* Tabel */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        thead {
            background: #34495e;
            color: white;
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }

        tr:hover {
            background: #f2f7fa;
        }

        td:first-child {
            font-weight: bold;
            color: #34495e;
        }

        .nodata {
            text-align: center;
            padding: 20px;
            font-size: 18px;
            color: #555;
        }
    </style>

</head>
<body>

<header>
    <h2>📚 Sistem Manajemen Buku Perpustakaan</h2>
</header>

<div class="container">

    <div class="button-group">
        <a href="add.php" class="btn btn-add">➕ Tambah Buku</a>
        <a href="cari_buku.php" class="btn btn-search">🔍 Cari Buku</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID Buku</th>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Stok</th>
                <th>Pengarang</th>
                <th>Tahun</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>

        <?php if ($books): ?>
            <?php foreach ($books as $id => $row): ?>
                <tr>
                    <td><?= $id ?></td>
                    <td><?= $row['judul'] ?></td>
                    <td><?= $row['kategori'] ?></td>
                    <td><?= $row['stok'] ?></td>
                    <td><?= $row['pengarang'] ?></td>
                    <td><?= $row['tahun'] ?></td>
                    <td>
                        <a class="btn-edit" href="edit.php?id=<?= $id ?>">✏ Edit</a>
                        <a class="btn-delete" href="delete.php?id=<?= $id ?>" onclick="return confirm('Yakin ingin menghapus buku ini?');">🗑 Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="7" class="nodata">Belum ada data buku.</td>
            </tr>
        <?php endif; ?>

        </tbody>
    </table>

</div>

</body>
</html>
