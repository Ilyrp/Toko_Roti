<?php
$koneksi = mysqli_connect("localhost", "root", "", "toko_roti");

if ($koneksi->connect_error) {
    die("Connection failed: " . $koneksi->connect_error);
}

// Menggabungkan query untuk mendapatkan gambar dan nama
$sql = "SELECT id_jenis, gambar, nama FROM jenis_roti";
$setfalse = "UPDATE jenis_roti SET is_active = 0";
$koneksi->query($setfalse);
$result = $koneksi->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>
    <title>Jenis Kue</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body class="min-h-screen flex flex-col">
  <nav class="bg-green-800 fixed w-full">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-16">
        <!-- Logo dan Menu -->
        <div class="flex items-center">
          <!-- Logo -->
          <div class="flex-shrink-0">
            <img class="h-8 w-auto" src="../assets/image/WhatsApp Image 2024-05-01 at 11.37.02_c6c61df6.jpg"
              alt="Your Company">
          </div>
          <!-- Menu -->
          <div class="hidden sm:block ml-4">
            <div class="flex space-x-4">
              <a href="landingPage.php"
                class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 text-sm font-medium">Home</a>
              <a href="jenisKue.php"
                class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 text-sm font-medium">Catalog</a>
              <a href="#about"
                class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 text-sm font-medium">About Us</a>
              <a href="#contact"
                class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 text-sm font-medium">Contact</a>
            </div>
          </div>
        </div>

        <!-- Tombol Pencarian dan Keranjang -->
        <div class="hidden sm:block">
          <div class="flex items-center">
            <!-- Tombol Pencarian -->
            <div class="relative">
              <input type="text"
                class="placeholder-gray-400 bg-gray-800 text-gray-300 rounded-full px-3 py-1 focus:outline-none"
                placeholder="Search...">
              <button type="button"
                class="absolute right-0 top-0 mt-1 mr-2 text-gray-400 hover:text-white focus:outline-none">
                <!-- Icon Pencarian -->
              </button>
            </div>
            <!-- Tombol Keranjang -->
            <div class="ml-4">
              <a href="cart.php" class="text-gray-300 hover:text-white">
                <span style='font-size:20px;'>&#128722;</span>
              </a>
            </div>
            <!-- Logo Profil -->
            <div class="ml-4">
              <a href="login.php" class="text-gray-300 hover:text-white">
                <span style='font-size:20px;'>&#128100;</span>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>
  <!-- Konten Utama -->
  <div class="flex-grow mt-16">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 justify-center mx-auto mt-10 pl-8 pr-8">
      <?php
      if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
              echo "
              <div class='card w-full bg-base-100 shadow-xl' data-id='" . $row["id_jenis"] . "'>
                <figure>
                  <img
                    src='" . $row["gambar"] . "'
                    alt='" . $row["nama"] . "'
                    class='rounded-xl w-full h-48 object-cover' 
                    onclick='updateIsActive(" . $row["id_jenis"] . ")'
                    style='cursor: pointer;'
                  />
                </figure>
                <div class='card-body items-center text-center'>
                  <h2 class='card-title text-lg font-bold'>" . $row["nama"] . "</h2>
                  <div class='card-actions'></div>
                </div>
              </div>
              ";
          }
      }
      ?>
    </div>
  </div>

  <!-- Footer -->
  <?php include("../utiliti/footer.php"); ?>

  <script src="https://kit.fontawesome.com/d3b2ed7825.js" crossorigin="anonymous"></script>
  <script>
    function updateIsActive(id) {
      fetch('update_is_active.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({ id_jenis: id })
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          window.location.href = 'catalogKue.php';
        } else {
          alert('Failed to update status');
        }
      })
      .catch(error => {
        console.error('Error:', error);
      });
    }
  </script>
</body>
</html>
