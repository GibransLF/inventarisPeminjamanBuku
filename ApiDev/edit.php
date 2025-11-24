<?php
include('firebase.php');

$id = $_GET['id'];

$ref = "buku/$id";
$dataSnapshot = $database->getReference($ref)->getSnapshot();
$data = $dataSnapshot->getValue();

// Jika disubmit
$notif = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $updated = [
        'judul' => $_POST['judul'],
        'kategori' => $_POST['kategori'],
        'stok' => (int)$_POST['stok'],
        'pengarang' => $_POST['pengarang'],
        'tahun' => (int)$_POST['tahun']
    ];

    $database->getReference($ref)->update($updated);

    echo "<script>alert('Buku berhasil diupdate!'); window.location='index.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Buku</title>

    <style>
        body {
            margin: 0;
            font-family: "Segoe UI", sans-serif;
            background: #eef2f7;
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
            font-size: 24px;
        }

        .container {
            width: 40%;
            margin: 40px auto;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0px 4px 12px rgba(0,0,0,0.15);
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 6px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 18px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
            transition: 0.2s;
        }

        input:focus {
            border-color: #2980b9;
            box-shadow: 0px 0px 5px rgba(41, 128, 185, 0.4);
        }

        .btn-submit {
            width: 100%;
            padding: 12px;
            background: #f1c40f;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            color: white;
            cursor: pointer;
            transition: 0.2s;
        }

        .btn-submit:hover {
            background: #d4ac0d;
        }

        .back {
            text-decoration: none;
            display: inline-block;
            margin-bottom: 12px;
            color: #2980b9;
            font-size: 14px;
        }

    </style>

</head>
<body>

<header>
    <h2>✏ Edit Data Buku</h2>
</header>

<div class="container">

    <a href="index.php" class="back">← Kembali ke daftar buku</a>

    <div class="card">

        <form method="POST">

            <label>Judul Buku</label>
            <input type="text" name="judul" value="<?= $data['judul'] ?>" required>

            <label>Kategori</label>
            <input type="text" name="kategori" value="<?= $data['kategori'] ?>" required>

            <label>Stok</label>
            <input type="number" name="stok" value="<?= $data['stok'] ?>" required>

            <label>Pengarang</label>
            <input type="text" name="pengarang" value="<?= $data['pengarang'] ?>" required>

            <label>Tahun Terbit</label>
            <input type="number" name="tahun" value="<?= $data['tahun'] ?>" required>

            <button type="submit" class="btn-submit">Update Buku</button>

        </form>

    </div>

</div>

</body>
</html>
