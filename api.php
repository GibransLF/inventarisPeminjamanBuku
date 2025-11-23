<?php 
$data = file_get_contents('https://buku-perpustakaan-a7500-default-rtdb.asia-southeast1.firebasedatabase.app/buku.json');

$books = json_decode($data, true);

function getFirebaseBook($id) {
    $url = "https://buku-perpustakaan-a7500-default-rtdb.asia-southeast1.firebasedatabase.app/buku/$id.json";
    $response = file_get_contents($url);
    return json_decode($response, true);
}

function fetchAllBooksFromFirebase() {
    $url = "https://buku-perpustakaan-a7500-default-rtdb.asia-southeast1.firebasedatabase.app/buku.json";

    // coba ambil data dengan file_get_contents
    $data = @file_get_contents($url);

    // convert JSON ke array
    $books = json_decode($data, true);

    // menghindari error jika null
    return is_array($books) ? $books : [];
}

?>

