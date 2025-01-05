<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Input Bahan</title>
    <link rel="stylesheet" href="<?php echo e(asset('css/styles.css')); ?>" />
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        

        .nav-links a:hover {
            color: #3498db; /* Hover color */
        }

        h2 {
            margin-bottom: 20px;
        }

        form {
            background-color: #ffffff; /* White background for the form */
            padding: 20px; 
            border-radius: 5px; 
            box-shadow: 0 2px 5px rgba(0,0,0,0.1); 
        }

        label {
            display: block; 
            margin-bottom: 5px; 
        }

        input[type="text"], input[type="number"], select {
            width: calc(100% - 22px); /* Full width minus padding */
            padding: 10px; 
            margin-bottom: 15px; 
            border-radius: 5px; 
            border: 1px solid #ddd; 
        }

        button[type="submit"] {
            background-color: #28a745; /* Green button */
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #218838; /* Darker green on hover */
        }

        .total-price {
          margin-top: 10px; 
          font-weight: bold; 
          color: #333; 
        }
    </style>
</head>
<body>
<section class="sidebar">
    <div class="nav-header">
        <p class="logo">SCM</p>
        <i class="bx bx-menu-alt-right btn-menu"></i>
    </div>
    <ul class="nav-links">
        <li><a href="<?php echo e(route('beranda')); ?>"><i class="bx bx-home-alt-2"></i><span class="title">Home</span></a><span class="tooltip">Home</span></li>

        <?php if(session('role') === 'admin'): ?> <!-- Jika pengguna adalah admin -->
            <li><a href="<?php echo e(route('informasi')); ?>"><i class="bx bx-user-circle"></i><span class="title">Informasi</span></a><span class="tooltip">Informasi</span></li>
            <li><a href="<?php echo e(route('input_bahan')); ?>"><i class="bx bx-edit"></i><span class="title">Input Bahan</span></a><span class="tooltip">Input Bahan</span></li>
            <li><a href="<?php echo e(route('stok')); ?>"><i class="bx bxs-package"></i><span class="title">Stok</span></a><span class="tooltip">Stok</span></li>
            <li><a href="<?php echo e(route('laporan')); ?>"><i class="bx bx-file"></i><span class="title">Laporan</span></a><span class="tooltip">Laporan</span></li>
        <?php endif; ?>

        <li><a href="<?php echo e(route('order_bahan')); ?>"><i class="bx bx-shopping-bag"></i><span class="title">Order</span></a><span class="tooltip">Order</span></li>
    </ul>

    <!-- Theme Wrapper -->
    <div class="theme-wrapper">
        <i class="bx bxs-moon theme-icon"></i>
        <p>Dark Theme</p>
        <div class="theme-btn">
            <span class="theme-ball"></span>
        </div>
    </div>
</section>

<!-- Home Section -->
<section class="home">
    <h2>Input Bahan Baku</h2>

    <?php if(session('success')): ?>
      <div style='color: green;'><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <!-- Form untuk menambahkan bahan -->
    <form action="<?php echo e(route('input_bahan.store')); ?>" method="POST" id="inputBahanForm">
      <?php echo csrf_field(); ?> <!-- Token CSRF -->
      
      <label for="nama_bahan">Nama Bahan:</label>
      <input type="text" name="nama_bahan" required>

      <label for="kategori">Kategori:</label>
      <select name="kategori" id="kategori" required onchange="updatePrice()">
          <option value="">Pilih Kategori</option>
          <option value="kaos">Kaos - Rp.40.000</option>
          <option value="kemeja">Kemeja - Rp.60.000</option>
          <option value="sport">Sport - Rp.50.000</option>
          <option value="jaket">Jaket - Rp.80.000</option>
      </select>

      <label for="jumlah">Jumlah:</label>
      <input type="number" name="jumlah" id="jumlah" required min="1" oninput="updatePrice()">

      <!-- Pemasok -->
      <label for="pemasok">Pemasok:</label>
      <select name="pemasok" required>
          <option value="">Pilih Pemasok</option>
          <option value="impor">Impor</option>
          <option value="lokal">Lokal</option>
      </select>

      <!-- Harga -->
      <label for="harga">Harga:</label>
      <input type="number" name="harga" id="harga" readonly>

      <!-- Total Harga -->
      <div id='totalPrice' class='total-price'>Total Harga: Rp. 0</div>

      <!-- Simpan Bahan Button -->
      <button type="submit">Simpan Bahan</button>

    </form>

    <!-- Kembali ke halaman informasi -->
    <a href="<?php echo e(route('informasi')); ?>">Kembali ke Informasi</a>

</section>

<!-- JavaScript -->
<script src="<?php echo e(asset('js/script.js')); ?>"></script>

<!-- Inline Script -->
<script>
// Function to update price based on category and quantity
function updatePrice() {
    const categorySelect = document.getElementById("kategori");
    const quantityInput = document.getElementById("jumlah");
    const priceInput = document.getElementById("harga");
    
    let pricePerItem = 0;

    switch (categorySelect.value) {
        case "kaos":
            pricePerItem = 40000;
            break;
        case "kemeja":
            pricePerItem = 60000;
            break;
        case "sport":
            pricePerItem = 50000;
            break;
        case "jaket":
            pricePerItem = 80000;
            break;
    }

    // Update the price input and total price display
    priceInput.value = pricePerItem;

    const totalPriceDisplay = document.getElementById("totalPrice");
    const totalPrice = quantityInput.value * pricePerItem;

    totalPriceDisplay.innerText = `Total Harga: Rp.${totalPrice}`;
}

// Sidebar toggle functionality
const btn_menu = document.querySelector(".btn-menu");
const side_bar = document.querySelector(".sidebar");

btn_menu.addEventListener("click", function () {
    side_bar.classList.toggle("expand");
});

</script>

</body>
</html>
<?php /**PATH C:\laragon\www\utsframework\resources\views/input_bahan.blade.php ENDPATH**/ ?>