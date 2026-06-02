<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        Admin Dashboard - AmikomEventHub
    </title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap"
          rel="stylesheet">

    <style>

        body{
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        html{
            scroll-behavior: smooth;
        }

    </style>

</head>

<body class="bg-gradient-to-br from-slate-50 via-indigo-50 to-slate-100 text-slate-900 flex min-h-screen">

    <!-- ========================= -->
    <!-- SIDEBAR -->
    <!-- ========================= -->

    <aside class="w-72 bg-gradient-to-b from-indigo-900 to-indigo-800 text-indigo-100 flex flex-col p-6 space-y-8 sticky top-0 h-screen shadow-2xl">

        <!-- Logo -->
        <div class="flex items-center gap-4">

            <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center text-indigo-900 font-black text-xl shadow-lg">

                AH

            </div>

            <div>

                <h1 class="text-2xl font-black text-white tracking-tight">

                    AmikomEventHub

                </h1>

                <p class="text-xs text-indigo-300">

                    Admin Dashboard

                </p>

            </div>

        </div>

        <!-- Menu -->
        <nav class="flex-1 space-y-3">

            <p class="text-[11px] font-black uppercase tracking-[3px] text-indigo-400 mb-5 px-2">

                Main Menu

            </p>

            <!-- Dashboard -->
            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center gap-4 px-5 py-4 rounded-2xl font-bold transition-all duration-300 hover:bg-indigo-700 hover:translate-x-1
               {{ request()->is('admin/dashboard') ? 'bg-white/10 shadow-lg border border-white/10 text-white' : '' }}">

                <div class="w-10 h-10 rounded-xl bg-indigo-700 flex items-center justify-center">

                    📊

                </div>

                Dashboard

            </a>

            <!-- Event -->
            <a href="{{ route('admin.events.index') }}"
               class="flex items-center gap-4 px-5 py-4 rounded-2xl font-bold transition-all duration-300 hover:bg-indigo-700 hover:translate-x-1
               {{ request()->is('admin/events*') ? 'bg-white/10 shadow-lg border border-white/10 text-white' : '' }}">

                <div class="w-10 h-10 rounded-xl bg-pink-500/20 flex items-center justify-center">

                    🎉

                </div>

                Kelola Event

            </a>

            <!-- Partner -->
            <a href="/admin/partners"
               class="flex items-center gap-4 px-5 py-4 rounded-2xl font-bold transition-all duration-300 hover:bg-indigo-700 hover:translate-x-1
               {{ request()->is('admin/partners*') ? 'bg-white/10 shadow-lg border border-white/10 text-white' : '' }}">

                <div class="w-10 h-10 rounded-xl bg-orange-500/20 flex items-center justify-center">

                    🤝

                </div>

                Partner

            </a>

            <!-- Kategori -->
            <a href="{{ route('admin.categories.index') }}"
               class="flex items-center gap-4 px-5 py-4 rounded-2xl font-bold transition-all duration-300 hover:bg-indigo-700 hover:translate-x-1
               {{ request()->is('admin/categories*') ? 'bg-white/10 shadow-lg border border-white/10 text-white' : '' }}">

                <div class="w-10 h-10 rounded-xl bg-green-500/20 flex items-center justify-center">

                    📂

                </div>

                Kategori

            </a>

            <!-- Transaksi -->
            <a href="{{ route('admin.transactions.index') }}"
               class="flex items-center gap-4 px-5 py-4 rounded-2xl font-bold transition-all duration-300 hover:bg-indigo-700 hover:translate-x-1
               {{ request()->is('admin/transactions*') ? 'bg-white/10 shadow-lg border border-white/10 text-white' : '' }}">

                <div class="w-10 h-10 rounded-xl bg-cyan-500/20 flex items-center justify-center">

                    💳

                </div>

                Laporan Transaksi

            </a>

        </nav>

<!-- Bottom -->
<div class="space-y-5">

    <!-- Mini Card -->
    <div class="bg-white/10 border border-white/10 rounded-3xl p-5 backdrop-blur-md">

        <p class="text-sm text-indigo-200 mb-2">
            Total Event Aktif
        </p>

        <h3 class="text-3xl font-black text-white">
            8 Event
        </h3>

    </div>

    <!-- Logout -->
    <div class="pt-5 border-t border-indigo-700">

        <form action="{{ route('admin.logout') }}" method="POST">

            @csrf

            <button
                type="submit"
                class="w-full flex items-center gap-4 px-5 py-4 rounded-2xl text-indigo-200 hover:bg-red-500 hover:text-white transition-all duration-300 font-bold">

                <div class="w-10 h-10 rounded-xl bg-red-500/20 flex items-center justify-center">
                    🚪
                </div>

                <span>Keluar</span>

            </button>

        </form>

    </div>

</div>

</aside>

    <!-- ========================= -->
    <!-- MAIN CONTENT -->
    <!-- ========================= -->

    <main class="flex-1 p-10 overflow-y-auto">

        <!-- Top Header -->
        <header class="flex flex-col md:flex-row md:items-center md:justify-between gap-6 mb-10">


            </div>

            <!-- Profile -->
            <div class="flex items-center gap-4 bg-white px-5 py-3 rounded-3xl shadow-sm border border-slate-100">

                <div class="text-right hidden md:block">

                    <p class="font-black text-slate-800">

                        Admin Super

                    </p>

                    <p class="text-sm text-slate-400">

                        Penyelenggara Utama

                    </p>

                </div>

                <div class="w-14 h-14 bg-gradient-to-br from-indigo-500 to-indigo-700 rounded-2xl shadow-lg flex items-center justify-center overflow-hidden">

                    <img src="https://ui-avatars.com/api/?name=Admin+Super&background=6366f1&color=fff"
                         class="rounded-2xl">

                </div>

            </div>

        </header>

        <!-- Content -->
        @yield('content')

    </main>

</body>

</html>