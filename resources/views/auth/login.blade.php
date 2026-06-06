<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - AmikomEventHub</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen flex items-center justify-center bg-gradient-to-r from-indigo-500 via-purple-500 to-fuchsia-500">

    <div class="bg-white w-full max-w-md p-8 rounded-3xl shadow-2xl">

        <!-- Logo -->
        <div class="flex justify-center mb-5">
            <div class="w-20 h-20 rounded-full bg-gradient-to-r from-indigo-500 via-purple-500 to-fuchsia-500 flex items-center justify-center text-white text-3xl font-bold shadow-lg">
                AH
            </div>
        </div>

        <!-- Judul -->
        <h1 class="text-3xl font-bold text-center text-slate-800">
            Admin Login
        </h1>

        <p class="text-center text-slate-500 mt-2 mb-8">
            Selamat Datang di
            <span class="font-semibold text-purple-600">
                AmikomEventHub
            </span>
        </p>

        <!-- Error -->
        @if($errors->any())
            <div class="bg-red-100 border border-red-300 text-red-700 p-3 rounded-xl mb-4">
                {{ $errors->first() }}
            </div>
        @endif

        <!-- Form Login -->
        <form action="{{ route('admin.login.post') }}" method="POST">

            @csrf

            <!-- Email -->
            <div class="mb-4">
                <label class="block mb-2 font-semibold text-slate-700">
                    Email
                </label>

                <input
                    type="email"
                    name="email"
                    required
                    placeholder="Masukkan email admin"
                    class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500">
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label class="block mb-2 font-semibold text-slate-700">
                    Password
                </label>

                <input
                    id="password"
                    type="password"
                    name="password"
                    required
                    placeholder="Masukkan password"
                    class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500">
            </div>

            <!-- Show Password -->
            <div class="mb-6">
                <label class="flex items-center gap-2 text-sm text-slate-600">
                    <input type="checkbox" onclick="togglePassword()">
                    Tampilkan Password
                </label>
            </div>

            <!-- Tombol Login -->
            <button
                type="submit"
                class="w-full bg-gradient-to-r from-indigo-500 via-purple-500 to-fuchsia-500 hover:opacity-90 text-white py-3 rounded-xl font-bold shadow-lg transition duration-300">

                Login Dashboard

            </button>

        </form>

        <!-- Footer -->
        <div class="text-center mt-8 text-sm text-slate-500">
            © 2026 AmikomEventHub
        </div>

    </div>

    <script>
        function togglePassword() {
            let password = document.getElementById('password');

            if (password.type === 'password') {
                password.type = 'text';
            } else {
                password.type = 'password';
            }
        }
    </script>

</body>
</html>