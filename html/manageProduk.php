<?php
session_start();
$koneksi = mysqli_connect("localhost", "root", "", "toko_roti");

// Periksa apakah pengguna telah login sebagai admin, jika tidak, alihkan ke halaman login
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: landingPage.php");
    exit();
}

$user_name = $_SESSION['user_name'];
$qryjenis = "SELECT * FROM jenis_roti";
$resultJenis = mysqli_query($koneksi, $qryjenis);

$error_message = '';
$success_message = '';

// Handle form submissions for create, update, and delete actions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action == 'create') {
        $nama_produk = $_POST['nama_produk'] ?? '';
        $harga = $_POST['harga'] ?? '';
        $id_jenis = $_POST['id_jenis'] ?? '';
        $gambar = $_FILES['gambar'] ?? null;

        if ($gambar && $gambar['name']) {
            $file_ext = pathinfo($gambar['name'], PATHINFO_EXTENSION);
            $file_name = uniqid('img_', true) . '.' . $file_ext;
            $upload_path = $file_name; // Disimpan di direktori kerja aplikasi

            $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
            if (!in_array(strtolower($file_ext), $allowed_extensions)) {
                $error_message = "Format file tidak didukung. Hanya JPG, JPEG, PNG, dan GIF.";
            } else if (move_uploaded_file($gambar['tmp_name'], $upload_path)) {
                $query = "INSERT INTO produk (nama_produk, harga, id_jenis, gambar) VALUES ('$nama_produk', '$harga', '$id_jenis', '$file_name')";
                if (mysqli_query($koneksi, $query)) {
                    $success_message = "Produk berhasil ditambahkan.";
                } else {
                    $error_message = "Gagal menambahkan produk.";
                }
            } else {
                $error_message = "Gagal mengunggah gambar.";
            }
        } else {
            $error_message = "Gambar harus diunggah.";
        }
    } elseif ($action == 'update') {
        $id_produk = $_POST['id_produk'] ?? '';
        $nama_produk = $_POST['nama_produk'] ?? '';
        $harga = $_POST['harga'] ?? '';
        $id_jenis = $_POST['id_jenis'] ?? '';
        $gambar = $_FILES['gambar'] ?? null;

        $query = "UPDATE produk SET nama_produk = '$nama_produk', harga = '$harga', id_jenis = '$id_jenis'";

        if ($gambar && $gambar['name']) {
            $file_ext = pathinfo($gambar['name'], PATHINFO_EXTENSION);
            $file_name = uniqid('img_', true) . '.' . $file_ext;
            $upload_path = $file_name;

            $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
            if (!in_array(strtolower($file_ext), $allowed_extensions)) {
                $error_message = "Format file tidak didukung. Hanya JPG, JPEG, PNG, dan GIF.";
            } else if (move_uploaded_file($gambar['tmp_name'], $upload_path)) {
                $query .= ", gambar = '$file_name'";
            } else {
                $error_message = "Gagal mengunggah gambar.";
            }
        }

        $query .= " WHERE id_produk = $id_produk";

        if (mysqli_query($koneksi, $query)) {
            $success_message = "Produk berhasil diperbarui.";
        } else {
            $error_message = "Gagal memperbarui produk.";
        }
    } elseif ($action == 'delete') {
        $id_produk = $_POST['id_produk'] ?? '';

        $query = "DELETE FROM produk WHERE id_produk = $id_produk";
        if (mysqli_query($koneksi, $query)) {
            $success_message = "Produk berhasil dihapus.";
        } else {
            $error_message = "Gagal menghapus produk.";
        }
    }
}

// Fetch data for listing
$resultProduk = mysqli_query($koneksi, "SELECT produk.*, jenis_roti.nama AS nama_jenis FROM produk JOIN jenis_roti ON produk.id_jenis = jenis_roti.id_jenis");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Manage Produk - Toko Roti</title>
    <style>
        .floating-form {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 400px;
            max-height: 90vh;
            overflow-y: auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            display: none;
        }
    </style>
</head>

<body class="bg-gray-100">
    <div class="flex h-screen bg-gray-200">
        <!-- Sidebar -->
        <div class="w-64 bg-green-800 text-white">
            <div class="p-4">
                <h2 class="mt-6 text-center text-xl font-bold">Admin Dashboard</h2>
            </div>
            <nav class="mt-10">
                <a href="dasbordAdmin.php" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-green-600">Dashboard</a>
                <a href="manageProduk.php" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-green-600">Manage Products</a>
            </nav>
        </div>

        <!-- Main content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="flex justify-between items-center py-4 px-6 bg-white border-b-4 border-green-800">
                <h1 class="text-2xl font-semibold text-gray-700">Selamat datang, <?php echo $user_name; ?>!</h1>
                <a href="landingPage.php" class="text-gray-700 hover:text-green-600"><span class="font-medium">Logout</span></a>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
                <?php if ($success_message) : ?>
                    <div id="success_message" class="absolute top-0 left-0 right-0 mx-auto w-full bg-green-500 text-white p-4 rounded mb-4 max-w-4xl"><?php echo $success_message; ?></div>
                <?php endif; ?>
                <?php if ($error_message) : ?>
                    <div class="bg-red-500 text-white p-4 rounded mb-4 max-w-md mx-auto"><?php echo $error_message; ?></div>
                <?php endif; ?>

                <div class="mt-8 max-w-md mx-auto">
                    <div class="bg-white p-8 rounded-lg shadow-lg">
                        <h3 class="text-xl font-semibold text-gray-700 mb-4">Tambah Produk</h3>
                        <form action="manageProduk.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="action" value="create">
                            <label>Nama Produk: <input type="text" name="nama_produk" required></label>
                            <label>Harga: <input type="number" name="harga" required></label>
                            <label>Jenis: 
                                <select name="id_jenis" required>
                                    <?php while ($jenis = mysqli_fetch_assoc($resultJenis)) : ?>
                                        <option value="<?php echo $jenis['id_jenis']; ?>"><?php echo $jenis['nama']; ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </label>
                            <label>Gambar: <input type="file" name="gambar" required></label>
                            <button type="submit">Tambah Produk</button>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>

</html>
