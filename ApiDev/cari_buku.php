<?php
include('firebase.php');

// Ambil semua data buku
$ref = 'buku';
$bukuSnapshot = $database->getReference($ref)->getSnapshot();
$books = $bukuSnapshot->getValue();

// Ambil kata pencarian
$search = isset($_GET['search']) ? strtolower($_GET['search']) : '';

// Jika ada kata pencarian → filter data
if ($search !== '') {
    $filteredBooks = [];

    foreach ($books as $id => $book) {
        $text = strtolower(
            $book['judul'] . ' ' .
            $book['kategori'] . ' ' .
            $book['pengarang'] . ' ' .
            $book['tahun']
        );

        if (strpos($text, $search) !== false) {
            $filteredBooks[$id] = $book;
        }
    }

    $books = $filteredBooks;
}
?>
