<?php
include('firebase.php');

// Jika form disubmit
$notif = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $data = [
        'judul' => $_POST['judul'],
        'kategori' => $_POST['kategori'],
        'stok' => (int)$_POST['stok'],
        'pengarang' => $_POST['pengarang'],
        'tahun' => (int)$_POST['tahun'],
    ];

    // Generate ID otomatis
    $idBuku = $database->getReference('buku')->push()->getKey();

    // Simpan ke Firebase
    $database->getReference('buku/'.$idBuku)->set($data);

    // Redirect otomatis ke halaman index
    header("Location: index.php?notif=success");
    exit();
}
?>
 