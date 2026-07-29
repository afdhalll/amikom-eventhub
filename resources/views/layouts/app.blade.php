<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        AmikomEventHub - Temukan Event Seru!
    </title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap"
          rel="stylesheet">

    <style>

        body{
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .glass{
            background: rgba(255,255,255,0.7);
            backdrop-filter: blur(12px);
        }

        html{
            scroll-behavior: smooth;
        }

    </style>

</head>

<body class="bg-slate-50 text-slate-900">

    <!-- ========================= -->
    <!-- NAVBAR -->
    <!-- ========================= -->

    <nav class="glass sticky top-4 z-50 mx-4 mt-4 px-6 py-4 rounded-2xl border border-white/20 shadow-lg flex justify-between items-center">

        <!-- Logo -->
        <div class="flex items-center gap-3">

            <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center text-white font-bold text-xl">

                AH

            </div>

            <span class="text-xl font-extrabold tracking-tight">

                AmikomEventHub

            </span>

        </div>

        <!-- Menu -->
        <div class="hidden md:flex items-center gap-8 font-semibold">

            <!-- Home -->
            <a href="/"
               class="hover:text-indigo-600 transition">

                Home

            </a>

            <!-- Event -->
            <a href="#events"
               class="hover:text-indigo-600 transition">

                Event

            </a>

            <!-- Partner -->
            <a href="#partner"
               class="hover:text-indigo-600 transition">

                Partner Kami

            </a>

            <!-- Tentang -->
            <a href="#footer"
               class="hover:text-indigo-600 transition">

                Tentang Kami

            </a>

            <!-- Dashboard Admin -->
       @auth

<div class="flex items-center gap-3">

    @if(in_array(Auth::user()->role, ['admin', 'superadmin']))

        <a href="{{ route('admin.dashboard') }}"
           class="px-4 py-2 bg-indigo-600 text-white rounded-xl font-bold hover:bg-indigo-700 transition">
            Dashboard
        </a>

    @endif

    <span class="px-4 py-2 bg-green-100 text-green-700 rounded-xl font-semibold">
        Halo, {{ Auth::user()->name }}
    </span>

    <a href="{{ route('google.logout') }}"
       class="px-4 py-2 bg-red-500 text-white rounded-xl font-bold hover:bg-red-600 transition">
        Logout
    </a>

</div>

@else

<a href="{{ route('admin.login') }}"
   class="px-5 py-2.5 bg-indigo-600 text-white rounded-xl font-bold shadow-lg hover:bg-indigo-700 transition">
    Admin Dashboard
</a>

@endauth

        </div>

        <!-- Mobile -->
   <button id="menuBtn"
    class="md:hidden bg-indigo-600 text-white px-4 py-2 rounded-xl">
    ☰
</button>

    </nav>
<div id="mobileMenu"
    class="hidden md:hidden mx-4 mt-2 bg-white rounded-2xl shadow-lg p-5 space-y-4">

    <a href="/" class="block font-semibold hover:text-indigo-600">
        Home
    </a>

    <a href="#events" class="block font-semibold hover:text-indigo-600">
        Event
    </a>

    <a href="#partner" class="block font-semibold hover:text-indigo-600">
        Partner Kami
    </a>

    <a href="#footer" class="block font-semibold hover:text-indigo-600">
        Tentang Kami
    </a>

    @auth

        @if(in_array(Auth::user()->role,['admin','superadmin']))
            <a href="{{ route('admin.dashboard') }}"
               class="block font-semibold text-indigo-600">
                Dashboard
            </a>
        @endif

        <a href="{{ route('google.logout') }}"
           class="block text-red-600 font-semibold">
            Logout
        </a>

    @else

        <a href="{{ route('admin.login') }}"
           class="block text-indigo-600 font-semibold">
            Admin Dashboard
        </a>

    @endauth

</div>
    <!-- ========================= -->
    <!-- CONTENT -->
    <!-- ========================= -->

    <main>

        @yield('content')

    </main>

    <!-- ========================= -->
    <!-- FOOTER -->
    <!-- ========================= -->

    <footer id="footer"
            class="bg-indigo-900 text-indigo-100 py-20 px-6 mt-20">

        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-12">

            <!-- Logo -->
            <div class="space-y-5 col-span-2">

                <div class="flex items-center gap-3">

                    <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-indigo-900 font-bold text-xl">

                        AH

                    </div>

                    <span class="text-2xl font-extrabold text-white">

                        AmikomEventHub

                    </span>

                </div>

                <p class="max-w-md text-indigo-300 leading-relaxed">

                    Platform reservasi tiket event online terbaik untuk mahasiswa,
                    komunitas, dan penyelenggara profesional.

                </p>

            </div>

            <!-- Navigation -->
            <div>

                <h4 class="text-white font-bold mb-6">

                    Navigasi

                </h4>

                <ul class="space-y-4 text-indigo-300">

                    <li>

                        <a href="/"
                           class="hover:text-white transition">

                            Home

                        </a>

                    </li>

                    <li>

                        <a href="#events"
                           class="hover:text-white transition">

                            Semua Event

                        </a>

                    </li>

                    <li>

                        <a href="#partner"
                           class="hover:text-white transition">

                            Partner Kami

                        </a>

                    </li>

                    <li>

                        <a href="#footer"
                           class="hover:text-white transition">

                            Tentang Kami

                        </a>

                    </li>

                    <li>

                        <a href="/admin/dashboard"
                           class="hover:text-white transition">

                            Dashboard Admin

                        </a>

                    </li>

                </ul>

            </div>

            <!-- Contact -->
            <div>

                <h4 class="text-white font-bold mb-6">

                    Hubungi Kami

                </h4>

                <ul class="space-y-4 text-indigo-300">

                    <li>

                        support@amikomeventhub.com

                    </li>

                    <li>

                        +62 812 3456 7890

                    </li>

                    <li>

                        Yogyakarta, Indonesia

                    </li>

                </ul>

            </div>

        </div>

        <!-- Footer Bottom -->
        <div class="max-w-7xl mx-auto pt-12 mt-12 border-t border-indigo-800 text-center text-indigo-400 text-sm">

            © 2026 AmikomEventHub.
            Built with Laravel & Tailwind CSS.

        </div>

    </footer>
<script>
const menuBtn = document.getElementById('menuBtn');
const mobileMenu = document.getElementById('mobileMenu');

menuBtn.addEventListener('click', () => {
    mobileMenu.classList.toggle('hidden');
});
</script>
</body>

</html>