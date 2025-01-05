<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background: rgb(238,174,202);
            background: radial-gradient(circle, rgba(238,174,202,1) 0%, rgba(148,187,233,1) 100%);
            background-size: 300% 300%;
            animation: gradientBG 5s ease infinite;
        }

        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            25% { background-position: 100% 50%; }
            50% { background-position: 100% 0%; }
            75% { background-position: 0% 0%; }
            100% { background-position: 0% 50%; }
        }

        .login-container {
            background-color: rgba(31, 41, 55, 0.9);
            backdrop-filter: blur(15px);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.5);
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen">

<div class="login-container rounded-lg shadow-lg p-10 w-96">
    <h2 class="text-3xl font-bold mb-6 text-center text-white">Login</h2>

    <!-- Form login -->
    <form action="{{ url('/login') }}" method="POST">
        @csrf
        
        <div class="mb-4">
            <input type="text" name="username" placeholder="Username" required class="w-full p-3 border border-gray-600 rounded-md focus:outline-none focus:ring focus:ring-blue-500 bg-gray-700 text-white" />
        </div>
        <div class="mb-6 relative">
            <input type="password" id="password" name="password" placeholder="Password" required class="w-full p-3 border border-gray-600 rounded-md focus:outline-none focus:ring focus:ring-blue-500 bg-gray-700 text-white" />
            <button type="button" id="togglePassword" class="absolute right-3 top-3 text-gray-400 hover:text-white focus:outline-none">
                👁️
            </button>
        </div>
        <button type="submit" class="w-full bg-blue-600 text-white p-3 rounded-md hover:bg-blue-700 transition duration-200">Login</button>
    </form>

    <!-- Tombol untuk menampilkan form registrasi -->
    <button id="showRegisterForm" class="w-full bg-green-600 text-white p-3 rounded-md hover:bg-green-700 transition duration-200 mt-4">Registrasi</button>

    <!-- Form registrasi (disembunyikan secara default) -->
    <div id="registerForm" class="hidden mt-6">
        <h2 class="text-xl font-bold mb-4 text-center text-white">Registrasi</h2>
        <form action="{{ url('/register') }}" method="POST"> <!-- Pastikan action mengarah ke rute registrasi -->
            @csrf
            
            <div class="mb-4">
                <input type="text" name="name" placeholder="Nama Lengkap" required class="w-full p-3 border border-gray-600 rounded-md focus:outline-none focus:ring focus:ring-blue-500 bg-gray-700 text-white" />
            </div>
            <div class="mb-4">
                <input type="text" name="username" placeholder="Username" required class="w-full p-3 border border-gray-600 rounded-md focus:outline-none focus:ring focus:ring-blue-500 bg-gray-700 text-white" />
            </div>
            <div class="mb-4">
                <input type="email" name="email" placeholder="Email" required class="w-full p-3 border border-gray-600 rounded-md focus:outline-none focus:ring focus:ring-blue-500 bg-gray-700 text-white" />
            </div>
            <div class="mb-6 relative">
                <input type="password" id="register_password" name="password" placeholder="Password" required class="w-full p-3 border border-gray-600 rounded-md focus:outline-none focus:ring focus:ring-blue-500 bg-gray-700 text-white" />
                <button type="button" id="toggleRegisterPassword" class="absolute right-3 top-3 text-gray-400 hover:text-white focus:outline-none">
                    👁️
                </button>
            </div>
            <button type="submit" class="w-full bg-green-600 text-white p-3 rounded-md hover:bg-green-700 transition duration-200">Registrasi</button>
        </form>
    </div>

</div>

<script>
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');

    togglePassword.addEventListener('click', function () {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.textContent = type === 'password' ? '👁️' : '🙈';
    });

    const toggleRegisterPassword = document.getElementById('toggleRegisterPassword');
    const registerPasswordInput = document.getElementById('register_password');

    toggleRegisterPassword.addEventListener('click', function () {
        const type = registerPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        registerPasswordInput.setAttribute('type', type);
        this.textContent = type === 'password' ? '👁️' : '🙈';
    });

    // Menampilkan atau menyembunyikan form registrasi
    const showRegisterFormButton = document.getElementById('showRegisterForm');
    const registerForm = document.getElementById('registerForm');

    showRegisterFormButton.addEventListener('click', function () {
        registerForm.classList.toggle('hidden');
    });
</script>

</body> 
</html>
