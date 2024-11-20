<?php
$koneksi = mysqli_connect("localhost", "root", "", "toko_roti");

if ($koneksi->connect_error) {
    die("Connection failed: " . $koneksi->connect_error);
}

$data = json_decode(file_get_contents("php://input"));

if (isset($data->id_jenis)) {
    $id_jenis = $data->id_jenis;

    $sql = "UPDATE jenis_roti SET is_active = 1 WHERE id_jenis = $id_jenis";

    if ($koneksi->query($sql) === TRUE) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $koneksi->error]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid input']);
}

$koneksi->close();
?>
