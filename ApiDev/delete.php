<?php
include('firebase.php');

$id = $_GET['id'];

$database->getReference("buku/$id")->remove();

echo "<script>alert('Buku berhasil dihapus!'); window.location='index.php';</script>";
?>
