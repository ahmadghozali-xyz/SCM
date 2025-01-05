<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Order</title>
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
            color: #3498db;
        }

        .home {
            margin-left: 1px;
            padding: 20px;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .category-section {
            margin-bottom: 40px;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .category-title {
            color: #2c3e50;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid #3498db;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }

        .product-card {
            background: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            text-align: center;
        }

        .product-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 4px;
            margin-bottom: 10px;
        }

        .product-title {
            font-size: 1.1em;
            margin: 10px 0;
            color: #2c3e50;
        }

        .product-price {
            color: #e74c3c;
            font-weight: bold;
            margin: 10px 0;
        }

        .order-form {
            margin-top: 15px;
        }

        .quantity-input {
            width: 80px;
            padding: 8px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .order-button {
            background-color: #2ecc71;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .order-button:hover {
            background-color: #27ae60;
        }

        .success-message {
            color: #2ecc71;
            margin-top: 10px;
            padding: 10px;
            background-color: #f1f9f1;
            border-radius: 4px;
            display: none;
        }

        .size-select {
            width: 100px;
            padding: 8px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
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

<section class="home">
    <h2>Katalog</h2>

    <?php if(session('success')): ?>
        <div class="success-message" style="display: block;">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <!-- Kaos Section -->
    <div class="category-section">
        <h3 class="category-title">Kaos</h3>
        <div class="product-grid">
            <div class="product-card">
                <img src="<?php echo e(asset('images/kaos-placeholder.jpg')); ?>" alt="Kaos" class="product-image">
                <h4 class="product-title">Kaos Premium</h4>
                <p class="product-price">Rp 65.000</p>
                <form action="<?php echo e(route('order.store')); ?>" method="POST" class="order-form">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="kategori" value="kaos">
                    <input type="hidden" name="harga" value="65000">
                    <select name="ukuran" class="size-select" required>
                        <option value="">Pilih Ukuran</option>
                        <option value="S">S</option>
                        <option value="M">M</option>
                        <option value="L">L</option>
                        <option value="XL">XL</option>
                    </select>
                    <input type="number" name="jumlah" class="quantity-input" min="1" placeholder="Jumlah" required>
                    <button type="submit" class="order-button">Pesan Sekarang</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Kemeja Section -->
    <div class="category-section">
        <h3 class="category-title">Kemeja</h3>
        <div class="product-grid">
            <div class="product-card">
                <img src="<?php echo e(asset('images/kemeja-placeholder.jpg')); ?>" alt="Kemeja" class="product-image">
                <h4 class="product-title">Kemeja Formal</h4>
                <p class="product-price">Rp 90.000</p>
                <form action="<?php echo e(route('order.store')); ?>" method="POST" class="order-form">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="kategori" value="kemeja">
                    <input type="hidden" name="harga" value="90000">
                    <select name="ukuran" class="size-select" required>
                        <option value="">Pilih Ukuran</option>
                        <option value="S">S</option>
                        <option value="M">M</option>
                        <option value="L">L</option>
                        <option value="XL">XL</option>
                    </select>
                    <input type="number" name="jumlah" class="quantity-input" min="1" placeholder="Jumlah" required>
                    <button type="submit" class="order-button">Pesan Sekarang</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Baju Olahraga Section -->
    <div class="category-section">
        <h3 class="category-title">Baju Olahraga</h3>
        <div class="product-grid">
            <div class="product-card">
                <img src="<?php echo e(asset('images/sport-placeholder.jpg')); ?>" alt="Baju Olahraga" class="product-image">
                <h4 class="product-title">Baju Olahraga Premium</h4>
                <p class="product-price">Rp 80.000</p>
                <form action="<?php echo e(route('order.store')); ?>" method="POST" class="order-form">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="kategori" value="sport">
                    <input type="hidden" name="harga" value="80000">
                    <select name="ukuran" class="size-select" required>
                        <option value="">Pilih Ukuran</option>
                        <option value="S">S</option>
                        <option value="M">M</option>
                        <option value="L">L</option>
                        <option value="XL">XL</option>
                    </select>
                    <input type="number" name="jumlah" class="quantity-input" min="1" placeholder="Jumlah" required>
                    <button type="submit" class="order-button">Pesan Sekarang</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Jaket Section -->
    <div class="category-section">
        <h3 class="category-title">Jaket</h3>
        <div class="product-grid">
            <div class="product-card">
                <img src="<?php echo e(asset('images/jaket-placeholder.jpg')); ?>" alt="Jaket" class="product-image">
                <h4 class="product-title">Jaket Premium</h4>
                <p class="product-price">Rp 100.000</p>
                <form action="<?php echo e(route('order.store')); ?>" method="POST" class="order-form">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="kategori" value="jaket">
                    <input type="hidden" name="harga" value="100000">
                    <select name="ukuran" class="size-select" required>
                        <option value="">Pilih Ukuran</option>
                        <option value="S">S</option>
                        <option value="M">M</option>
                        <option value="L">L</option>
                        <option value="XL">XL</option>
                    </select>
                    <input type="number" name="jumlah" class="quantity-input" min="1" placeholder="Jumlah" required>
                    <button type="submit" class="order-button">Pesan Sekarang</button>
                </form>
            </div>
        </div>
    </div>
</section>

<script src="<?php echo e(asset('js/script.js')); ?>"></script>
<script>
    const btn_menu = document.querySelector(".btn-menu");
    const side_bar = document.querySelector(".sidebar");

    btn_menu.addEventListener("click", function () {
        side_bar.classList.toggle("expand");
        changebtn();
    });

    function changebtn() {
        if (side_bar.classList.contains("expand")) {
            btn_menu.classList.replace("bx-menu", "bx-menu-alt-right");
        } else {
            btn_menu.classList.replace("bx-menu-alt-right", "bx-menu");
        }
    }

    // Menghitung total harga saat jumlah berubah
    document.querySelectorAll('.quantity-input').forEach(input => {
        input.addEventListener('input', function() {
            const form = this.closest('form');
            const harga = parseInt(form.querySelector('input[name="harga"]').value);
            const jumlah = parseInt(this.value) || 0;
            const totalHarga = harga * jumlah;
            
            const priceElement = form.closest('.product-card').querySelector('.product-price');
            if (jumlah > 0) {
                priceElement.textContent = `Rp ${totalHarga.toLocaleString('id-ID')}`;
            } else {
                const originalHarga = parseInt(form.querySelector('input[name="harga"]').value);
                priceElement.textContent = `Rp ${originalHarga.toLocaleString('id-ID')}`;
            }
        });
    });
</script>

</body>
</html><?php /**PATH C:\laragon\www\utsframework\resources\views/order_bahan.blade.php ENDPATH**/ ?>