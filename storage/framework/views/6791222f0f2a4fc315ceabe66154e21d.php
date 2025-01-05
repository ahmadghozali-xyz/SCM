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
        /* Global Styles */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
            color: #333;
        }

        /* Product Section */
        .product-section {
            margin-left: 290px;
            padding: 20px;
        }

        .category-section {
            margin-bottom: 40px;
        }

        .category-title {
            font-size: 22px;
            color: #2c3e50;
            margin-bottom: 15px;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .product-card {
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }

        .product-card:hover {
            transform: translateY(-5px);
        }

        .product-image {
            width: 100px;
            height: auto;
            margin-bottom: 10px;
        }

        .product-title {
            font-size: 16px;
            margin-bottom: 5px;
        }

        .product-price {
            font-size: 14px;
            color: #16a085;
            margin-bottom: 10px;
        }

        .order-form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .size-select, .quantity-input, .order-button {
            margin-top: 5px;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            width: 100%;
        }

        .order-button {
            background-color: #16a085;
            color: #ffffff;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .order-button:hover {
            background-color: #1abc9c;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
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
    <!-- Product Section -->
    <section class="product-section">
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
                    <h4 class="product-title">Kemeja Premium</h4>
                    <p class="product-price">Rp 80.000</p>
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
    </section>
</body>
</html>
<?php /**PATH C:\laragon\www\utsframework\resources\views/beranda.blade.php ENDPATH**/ ?>