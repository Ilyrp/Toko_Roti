<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Shopping Cart</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>
</head>

<body class="bg-gray-100 flex flex-col min-h-screen">
  <?php include '../utiliti/navbar.php'; ?>  
  <div class="container mx-auto mt-20 flex-1">
    <div class="bg-white p-8 rounded-lg shadow-lg">
      <h2 class="text-2xl font-bold text-gray-800 mb-6">Shopping Cart</h2>

      <!-- Cart Item 1 -->
      <div class="flex items-center border-b border-gray-300 py-4">
        <img src="/assets/image/tradisional.jpeg" alt="Molen" class="w-24 h-auto rounded-md shadow-md mr-4">
        <div class="flex-1">
          <h3 class="text-lg font-bold text-gray-800">Molen</h3>
          <p class="text-gray-600">Rp. 3,000</p>
        </div>
        <div class="flex items-center">
          <div class="mr-4">
            <button class="bg-gray-200 text-gray-700 px-2 py-1 rounded" onclick="decrementQuantity(this)">-</button>
            <input type="number" value="1" min="1" max="99" class="w-12 text-center border border-gray-300 rounded mx-2">
            <button class="bg-gray-200 text-gray-700 px-2 py-1 rounded" onclick="incrementQuantity(this)">+</button>
          </div>
          <div class="text-lg font-bold text-gray-800">Rp. 20,000</div>
          <button class="text-red-500 ml-4" onclick="removeCartItem(this)">Remove</button>
        </div>
      </div>

      <!-- Cart Item 2 -->
      <div class="flex items-center border-b border-gray-300 py-4">
        <img src="/assets/image/tart.jpeg" alt="Tart" class="w-24 h-auto rounded-md shadow-md mr-4">
        <div class="flex-1">
          <h3 class="text-lg font-bold text-gray-800">Tart</h3>
          <p class="text-gray-600">Rp. 10,000</p>
        </div>
        <div class="flex items-center">
          <div class="mr-4">
            <button class="bg-gray-200 text-gray-700 px-2 py-1 rounded" onclick="decrementQuantity(this)">-</button>
            <input type="number" value="1" min="1" max="99" class="w-12 text-center border border-gray-300 rounded mx-2">
            <button class="bg-gray-200 text-gray-700 px-2 py-1 rounded" onclick="incrementQuantity(this)">+</button>
          </div>
          <div class="text-lg font-bold text-gray-800">Rp. 25,000</div>
          <button class="text-red-500 ml-4" onclick="removeCartItem(this)">Remove</button>
        </div>
      </div>

      <!-- Cart Item 3 -->
      <div class="flex items-center border-b border-gray-300 py-4">
        <img src="/assets/image/donut.jpeg" alt="Donat" class="w-24 h-auto rounded-md shadow-md mr-4">
        <div class="flex-1">
          <h3 class="text-lg font-bold text-gray-800">Donat</h3>
          <p class="text-gray-600">Rp. 5,000</p>
        </div>
        <div class="flex items-center">
          <div class="mr-4">
            <button class="bg-gray-200 text-gray-700 px-2 py-1 rounded" onclick="decrementQuantity(this)">-</button>
            <input type="number" value="1" min="1" max="99" class="w-12 text-center border border-gray-300 rounded mx-2">
            <button class="bg-gray-200 text-gray-700 px-2 py-1 rounded" onclick="incrementQuantity(this)">+</button>
          </div>
          <div class="text-lg font-bold text-gray-800">Rp. 15,000</div>
          <button class="text-red-500 ml-4" onclick="removeCartItem(this)">Remove</button>
        </div>
      </div>

      <!-- Subtotal and Checkout Button -->
      <div class="flex justify-between items-center mt-8">
        <div class="text-2xl font-bold text-gray-800">Subtotal: Rp. 70,000</div>
        <button class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">Checkout</button>
      </div>
    </div>
  </div>
  
 <?php include '../utiliti/footer.php'; ?>

  <script>
    function incrementQuantity(button) {
      const input = button.parentElement.querySelector('input[type="number"]');
      let value = parseInt(input.value);
      input.value = isNaN(value) ? 1 : value + 1;
    }

    function decrementQuantity(button) {
      const input = button.parentElement.querySelector('input[type="number"]');
      let value = parseInt(input.value);
      input.value = isNaN(value) || value < 2 ? 1 : value - 1;
    }

    function removeCartItem(button) {
      const cartItem = button.closest('.flex');
      cartItem.remove();
    }
  </script>
</body>

</html>
