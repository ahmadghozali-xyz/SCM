<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Stok Bahan</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}" />
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }


        .nav-links a {
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
        }

        .nav-links a:hover {
            color: #3498db; /* Hover color */
        }

        .home {
            margin-left: 1px; /* Space for sidebar */
            padding: 1px;
        }

        h2 {
            margin-bottom: 1px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #ffffff; /* White background for the table */
            box-shadow: 0 2px 5px rgba(0,0,0,0.1); /* Shadow effect */
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd; /* Bottom border for table rows */
        }

        th {
            background-color: #3498db; /* Header background color */
            color: white; /* Header text color */
        }

        tr:hover {
            background-color: #f1f1f1; /* Row hover effect */
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
        <li><a href="{{ route('beranda') }}"><i class="bx bx-home-alt-2"></i><span class="title">Home</span></a><span class="tooltip">Home</span></li>

        @if(session('role') === 'admin') <!-- Jika pengguna adalah admin -->
            <li><a href="{{ route('informasi') }}"><i class="bx bx-user-circle"></i><span class="title">Informasi</span></a><span class="tooltip">Informasi</span></li>
            <li><a href="{{ route('input_bahan') }}"><i class="bx bx-edit"></i><span class="title">Input Bahan</span></a><span class="tooltip">Input Bahan</span></li>
            <li><a href="{{ route('stok') }}"><i class="bx bxs-package"></i><span class="title">Stok</span></a><span class="tooltip">Stok</span></li>
            <li><a href="{{ route('laporan') }}"><i class="bx bx-file"></i><span class="title">Laporan</span></a><span class="tooltip">Laporan</span></li>
        @endif

        <li><a href="{{ route('order_bahan') }}"><i class="bx bx-shopping-bag"></i><span class="title">Order</span></a><span class="tooltip">Order</span></li>
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
    <h2>Stok Bahan Baku</h2>

    <!-- Tabel untuk menampilkan data stok -->
    <table>
      <thead>
          <tr>
              <th>ID</th>
              <th>Nama Bahan</th>
              <th>Kategori</th>
              <th>Jumlah</th>
              <th>Pemasok</th>
              <th>Harga</th>
          </tr>
      </thead>
      <tbody>
          @foreach($dataStok as $bahan)
              <tr>
                  <td>{{ $bahan->id }}</td> 
                  <td>{{ $bahan->nama_bahan }}</td> 
                  <td>{{ $bahan->kategori }}</td> 
                  <td>{{ $bahan->jumlah }}</td> 
                  <td>{{ $bahan->pemasok }}</td> 
                  <td>{{ number_format($bahan->harga, 2, ',', '.') }}</td> <!-- Format harga -->
              </tr> 
          @endforeach 
      </tbody> 
    </table>

    <!-- Kembali ke halaman beranda -->
    <a href="{{ route('beranda') }}">Kembali ke Beranda</a>

</section>

<!-- JavaScript -->
<script src="{{ asset('js/script.js') }}"></script>

<!-- Inline Script -->
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
</html>
