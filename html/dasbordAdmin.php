<?php
session_start();
$koneksi = mysqli_connect("localhost", "root", "", "toko_roti");

// Periksa apakah pengguna telah login sebagai admin
$user_name = $_SESSION['user_name'] ?? 'Admin';
$qryjenis = "SELECT * FROM jenis_roti";
$result = mysqli_query($koneksi, $qryjenis);

$error_message = '';
$success_message = '';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'] ?? '';
    $nama = $_POST['nama'] ?? '';
    $gambar = $_FILES['gambar'] ?? null;

    if ($action == 'create') {
        if ($gambar && $gambar['name']) {
            $fileName = $gambar['name'];

            $query = "INSERT INTO jenis_roti (nama, gambar) VALUES ('$nama', '$fileName')";
            if (mysqli_query($koneksi, $query)) {
                $success_message = "Jenis kue berhasil ditambahkan.";
            } else {
                $error_message = "Gagal menambahkan jenis kue.";
            }
        } else {
            $error_message = "Gambar harus diupload.";
        }
    } elseif ($action == 'update') {
        $id_jenis = $_POST['id_jenis'] ?? '';
        if ($gambar && $gambar['name']) {
            $fileName = $gambar['name'];
            $query = "UPDATE jenis_roti SET nama = '$nama', gambar = '$fileName' WHERE id_jenis = $id_jenis";
        } else {
            $query = "UPDATE jenis_roti SET nama = '$nama' WHERE id_jenis = $id_jenis";
        }

        if (mysqli_query($koneksi, $query)) {
            $success_message = "Jenis kue berhasil diupdate.";
        } else {
            $error_message = "Gagal mengupdate jenis kue.";
        }
    } elseif ($action == 'delete') {
        $id_jenis = $_POST['id_jenis'] ?? '';
        $query = "DELETE FROM jenis_roti WHERE id_jenis = $id_jenis";

        if (mysqli_query($koneksi, $query)) {
            $success_message = "Jenis kue berhasil dihapus.";
        } else {
            $error_message = "Gagal menghapus jenis kue.";
        }
    }
}

// Fetch data for listing
$result = mysqli_query($koneksi, "SELECT * FROM jenis_roti");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Admin Dashboard - Toko Roti</title>
</head>

<body class="bg-gray-100">
    <div class="flex h-screen bg-gray-200">
        <!-- Sidebar -->
        <div class="w-64 bg-green-800 text-white">
            <div class="p-4">
                <img class="h-8 w-auto" src="../assets/image/your-logo.jpg" alt="Your Company">
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
                <a href="landingPage.php" class="text-gray-700 hover:text-green-600 font-medium">Logout</a>
            </header>

            <!-- Main content area -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
                <!-- Form tambah jenis kue -->
                <div class="mt-8 max-w-md mx-auto">
                    <div class="bg-white p-8 rounded-lg shadow-lg">
                        <h3 class="text-xl font-semibold text-gray-700 mb-4">Tambah Jenis Kue</h3>
                        <form action="dasbordAdmin.php" method="POST" enctype="multipart/form-data" class="space-y-4">
                            <input type="hidden" name="action" value="create">
                            <div>
                                <label for="nama" class="block text-sm font-medium text-gray-700">Nama Kue:</label>
                                <input type="text" name="nama" required class="mt-1 p-2 block w-full bg-gray-100 border border-gray-300 rounded-md shadow-sm">
                            </div>
                            <div>
                                <label for="gambar" class="block text-sm font-medium text-gray-700">Gambar Kue:</label>
                                <input type="file" name="gambar" accept="image/*" required class="mt-1 block w-full text-gray-300">
                            </div>
                            <div>
                                <button type="submit" class="w-full py-2 px-4 bg-green-600 hover:bg-green-700 text-white font-medium rounded-md">Tambah</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Error and success messages -->
                <?php if ($error_message): ?>
                    <div class="absolute top-0 left-0 right-0 mx-auto bg-red-500 text-white p-4 rounded mb-4 max-w-4xl"><?php echo $error_message; ?></div>
                <?php endif; ?>
                <?php if ($success_message): ?>
                    <div class="absolute top-0 left-0 right-0 mx-auto bg-green-500 text-white p-4 rounded mb-4 max-w-4xl"><?php echo $success_message; ?></div>
                    <script>
                        setTimeout(function () {
                            document.querySelector('.bg-green-500').style.display = 'none';
                        }, 3000);
                    </script>
                <?php endif; ?>

                <!-- Grid Jenis Kue -->
                <div class="mt-8 max-w-7xl mx-auto px-4">
                    <h3 class="text-xl font-semibold text-gray-700 mb-4">Jenis Kue</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <?php while ($jenisKue = mysqli_fetch_assoc($result)): ?>
                            <div class="bg-white p-6 rounded-lg shadow-lg">
                                <img src="<?php echo $jenisKue['gambar']; ?>" alt="Gambar Kue" class="w-full h-40 object-cover rounded-t-lg">
                                <div class="mt-4">
                                    <h4 class="text-lg font-semibold text-gray-800"><?php echo $jenisKue['nama']; ?></h4>
                                    <div class="flex justify-between items-center mt-4">
                                        <form action="dasbordAdmin.php" method="POST" onsubmit="return confirm('Anda yakin ingin menghapus jenis kue ini?');">
                                            <input type="hidden" name="id_jenis" value="<?php echo $jenisKue['id_jenis']; ?>">
                                            <input type="hidden" name="action" value="delete">
                                            <button type="submit" class="text-white bg-red-500 hover:bg-red-700 px-4 py-2 rounded">Hapus</button>
                                        </form>
                                        <button class="text-white bg-blue-500 hover:bg-blue-700 px-4 py-2 rounded">Edit</button>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>

</html>
