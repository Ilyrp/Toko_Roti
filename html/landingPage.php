<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Index</title>
  <!-- Tailwind CSS -->
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <script src="https://kit.fontawesome.com/d3b2ed7825.js" crossorigin="anonymous"></script>
</head>

<body class="bg-gray-100">
  <!-- Navigation -->
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

  <!-- Image Section -->
  <div class="pt-16">
    <div class="container mx-auto flex flex-wrap justify-center py-8">
      <div class="w-full md:w-1/4 p-2">
        <img src="../assets/image/produk/45e2840fa111763eabe6cfd83b561535.jpg" alt="Product Image 1" class="w-full rounded-lg shadow-lg">
      </div>
      <div class="w-full md:w-1/4 p-2">
        <img src="../assets/image/produk/f2554052524946b15996540517849e67.jpg" alt="Product Image 2" class="w-full rounded-lg shadow-lg">
      </div>
      <div class="w-full md:w-1/4 p-2">
        <img src="../assets/image/produk/kuecubit.jpg" alt="Product Image 3" class="w-full rounded-lg shadow-lg">
      </div>
      <div class="w-full md:w-1/4 p-2">
        <img src="../assets/image/produk/cookies.jpg" alt="Product Image 4" class="w-full rounded-lg shadow-lg">
      </div>
    </div>
  </div>

  <!-- Content Section -->
  <div class="container mx-auto py-8">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
      <div class="p-4 bg-gray-200 rounded-lg">
        <h1 class="text-xl font-bold mb-2">Raja Pesanan</h1>
        <p>Ini Toko berpengalaman menangani pesanan roti dalam jumlah besar (hingga 35.000 item sehari) sejak 2010. Berapapun jumlah pesanan Anda, Kami layani.</p>
      </div>
      <div class="p-4 bg-gray-200 rounded-lg">
        <h1 class="text-xl font-bold mb-2">Fresh from Oven</h1>
        <p>Seluruh produk pesanan selalu dibuat paling lama 24 jam sebelum waktu pengambilan pesanan. Roti kami tahan 2-3 hari dari pembelian Anda di outlet Laritta</p>
      </div>
      <div class="p-4 bg-gray-200 rounded-lg">
        <h1 class="text-xl font-bold mb-2">Varian Terbanyak</h1>
        <p>Ini Toko menyediakan lebih dari 243 varian produk. Kami juga secara rutin menambah varian produk baru kami tiap beberapa bulan.</p>
      </div>
      <div class="p-4 bg-gray-200 rounded-lg">
        <h1 class="text-xl font-bold mb-2">Gratis Antar</h1>
        <p>Ini Toko menyediakan layanan antar pesanan dalam kota (Surabaya & Sidoarjo), hingga ke luar kota kota (Malang, Batu, Gresik, Pasuruan, Mojokerto, Bangkalan, Sampang, Pamekasan, dan kota lain di Jawa Timur).</p>
      </div>
      <div class="p-4 bg-gray-200 rounded-lg">
        <h1 class="text-xl font-bold mb-2">Membership</h1>
        <p>Program keanggotaan (membership) Ini Toko gratis dan menawarkan berbagai keuntungan khusus member.</p>
      </div>
      <div class="p-4 bg-gray-200 rounded-lg">
        <h1 class="text-xl font-bold mb-2">Jaminan Kualitas</h1>
        <p>Ini Toko senantiasa menjaga kualitas produk dan layanan untuk pelanggan setia kami. Kami memberi garansi uang kembali hingga 100% jika Anda tidak puas dengan produk atau layanan kami.</p>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer class="bg-white shadow-md mt-8">
    <?php include '../utiliti/footer.php'; ?>
  </footer>

  <script src="https://kit.fontawesome.com/d3b2ed7825.js" crossorigin="anonymous"></script>
</body>

</html>
