<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Laporan</title>
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

        .report-section {
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .section-title {
            color: #2c3e50;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .report-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }

        .report-card {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            border: 1px solid #dee2e6;
        }

        .report-card h4 {
            color: #2c3e50;
            margin-top: 0;
            margin-bottom: 10px;
        }

        .report-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .report-table th,
        .report-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #dee2e6;
        }

        .report-table th {
            background-color: #e9ecef;
            color: #2c3e50;
        }

        .total-section {
            background: #e9ecef;
            padding: 15px;
            border-radius: 8px;
            margin-top: 20px;
        }

        .total-amount {
            font-size: 1.2em;
            color: #2c3e50;
            font-weight: bold;
        }

        .category-total {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #dee2e6;
        }

        .category-total:last-child {
            border-bottom: none;
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
    <h2>Laporan</h2>

    <!-- Laporan Stok Bahan -->
    <div class="report-section">
        <h3 class="section-title">Laporan Stok Bahan</h3>
        <div class="report-grid">
            <?php $__currentLoopData = $stokBahan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bahan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="report-card">
                <h4><?php echo e(ucfirst($bahan->kategori)); ?></h4>
                <div class="category-total">
                    <span>Total Stok:</span>
                    <span><?php echo e($bahan->total_stok); ?> unit</span>
                </div>
                <div class="category-total">
                    <span>Total Nilai:</span>
                    <span>Rp <?php echo e(number_format($bahan->total_nilai, 0, ',', '.')); ?></span>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>

    <!-- Laporan Stok Produk -->
    <div class="report-section">
        <h3 class="section-title">Laporan Stok Produk</h3>
        <div class="report-grid">
            <?php $__currentLoopData = $stokProduk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $produk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="report-card">
                <h4><?php echo e(ucfirst($produk->kategori)); ?></h4>
                <div class="category-total">
                    <span>Total Pesanan:</span>
                    <span><?php echo e($produk->total_pesanan); ?> unit</span>
                </div>
                <div class="category-total">
                    <span>Total Pendapatan:</span>
                    <span>Rp <?php echo e(number_format($produk->total_pendapatan, 0, ',', '.')); ?></span>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>

    <!-- Laporan Pengeluaran -->
    <div class="report-section">
        <h3 class="section-title">Laporan Pengeluaran</h3>
        <div class="total-section">
            <div class="category-total">
                <span>Total Pengeluaran Input Bahan:</span>
                <span class="total-amount">Rp <?php echo e(number_format($totalPengeluaran, 0, ',', '.')); ?></span>
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
</script>

</body>
</html><?php /**PATH C:\laragon\www\utsframework\resources\views/laporan.blade.php ENDPATH**/ ?>