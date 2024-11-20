<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
<nav class="bg-green-800 fixed w-full">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-16">
        <!-- Logo dan Menu -->
        <div class="flex items-center">
          <!-- Logo -->
          <div class="flex-shrink-0">
            <img class="h-8 w-auto" src="/assets/image/WhatsApp Image 2024-05-01 at 11.37.02_c6c61df6.jpg"
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
</body>
</html>
<!-- <nav class="bg-green-800 fixed w-full">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-16">
        <!-- Logo dan Menu -->
        <div class="flex items-center">
          <!-- Logo -->
          <div class="flex-shrink-0">
            <img class="h-8 w-auto" src="/assets/image/WhatsApp Image 2024-05-01 at 11.37.02_c6c61df6.jpg"
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