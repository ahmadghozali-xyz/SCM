<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Informasi Pengguna</title>
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

        .home {
            margin-left: 1px; /* Space for sidebar */
            padding: 1px;
        }

        h2 {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #3498db; /* Header background color */
            color: white; /* Header text color */
        }

        tr:hover {
            background-color: #f1f1f1; /* Row hover effect */
        }

        .btn-add {
            background-color: #28a745; /* Green button */
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-add:hover {
            background-color: #218838; /* Darker green on hover */
        }

        .form-container {
          display: none; /* Hide the form by default */
          margin-top: 20px; 
          padding: 15px; 
          border-radius: 5px; 
          background-color: #ffffff; 
          box-shadow: 0 2px 5px rgba(0,0,0,0.1); 
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
        <h2>Informasi Pengguna</h2>

        <?php if(session('success')): ?>
          <div style='color: green;'><?php echo e(session('success')); ?></div>
        <?php endif; ?>

        <!-- Tombol untuk menampilkan form tambah pengguna -->
        <button id="toggleFormButton" class="btn-add">+ Tambah Pengguna</button>

        <!-- Form untuk menambahkan pengguna -->
<div id="formContainer" class="form-container">
    <form action="<?php echo e(route('tambah-pengguna.store')); ?>" method="POST">
        <?php echo csrf_field(); ?> <!-- Token CSRF -->
        <label for="name">Nama:</label>
        <input type="text" name="name" required><br>
        <label for="username">Username:</label>
        <input type="text" name="username" required><br>
        <label for="password">Password:</label>
        <input type="text" name="password" required><br> <!-- Ubah type menjadi password -->
        <label for="email">Email:</label>
        <input type="email" name="email" required><br>
        <button type="submit" class="btn-add">Simpan Pengguna</button>
    </form>
</div>

      <!-- Tabel untuk menampilkan data -->
      <table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Username</th>
            <th>Password</th> <!-- Tambahkan kolom Password -->
            <th>Email</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $dataInformasi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($info->id); ?></td> 
                <td><?php echo e($info->name); ?></td> 
                <td><?php echo e($info->username); ?></td> 
                <td><?php echo e($info->password); ?></td> <!-- Tampilkan Password -->
                <td><?php echo e($info->email); ?></td> 
            </tr> 
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
    </tbody> 
</table>

      <!-- Kembali ke halaman beranda -->
      <a href="<?php echo e(route('beranda')); ?>">Kembali ke Beranda</a>

    </section>

    <!-- JavaScript -->
    <script src="<?php echo e(asset('js/script.js')); ?>"></script>

    <!-- Inline Script -->
    <script>
      const btn_menu = document.querySelector(".btn-menu");
      const side_bar = document.querySelector(".sidebar");
      const toggleFormButton = document.getElementById("toggleFormButton");
      const formContainer = document.getElementById("formContainer");

      btn_menu.addEventListener("click", function () {
          side_bar.classList.toggle("expand");
          changebtn();
      });

      toggleFormButton.addEventListener("click", function() {
          // Toggle visibility of the form
          if (formContainer.style.display === "none" || formContainer.style.display === "") {
              formContainer.style.display = "block";
          } else {
              formContainer.style.display = "none";
          }
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
</html>
<?php /**PATH C:\laragon\www\utsframework\resources\views/informasi.blade.php ENDPATH**/ ?>