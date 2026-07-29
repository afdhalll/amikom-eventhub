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

    <aside id="sidebar"
class="fixed lg:sticky top-0 left-0 z-50
w-80 h-screen overflow-y-auto
bg-gradient-to-b from-indigo-900 to-indigo-800
text-indigo-100 flex flex-col
p-6 space-y-8 shadow-2xl
transform -translate-x-full
lg:translate-x-0
transition-transform duration-300">
        
    <div class="flex justify-end lg:hidden">

    <button id="closeSidebar"
        class="text-white text-3xl hover:text-red-300 transition">

        ✕

    </button>

</div>
    <!-- Logo -->
        <div class="flex items-center gap-3">

    <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg">

        🎫

    </div>

    <div>

        <h2 class="text-2xl font-bold text-white leading-none">

            AmikomEventHub

        </h2>

        <p class="text-xs text-indigo-200 mt-1">

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

            <!-- Organisasi -->
           @if(auth()->user()->role == 'superadmin')

<!-- Organisasi -->

<a href="{{ route('admin.organizations.index') }}"
    class="flex items-center gap-4 px-5 py-4 rounded-2xl font-bold transition-all duration-300 hover:bg-indigo-700
    {{ request()->is('admin/organizations*') ? 'bg-white/10 shadow-lg border border-white/10 text-white' : 'text-indigo-100 hover:text-white' }}">

    <div class="w-10 h-10 rounded-xl bg-purple-500/20 flex items-center justify-center">
        🏢
    </div>

    Organisasi

</a>

<!-- Kelola User -->

<a href="{{ route('admin.users.index') }}"
    class="flex items-center gap-4 px-5 py-4 rounded-2xl font-bold transition-all duration-300 hover:bg-indigo-700
    {{ request()->is('admin/users*') ? 'bg-white/10 shadow-lg border border-white/10 text-white' : 'text-indigo-100 hover:text-white' }}">

    <div class="w-10 h-10 rounded-xl bg-pink-500/20 flex items-center justify-center">
        👤
    </div>

    Kelola User

</a>

@endif

        </nav>

<!-- Bottom -->
<div class="space-y-5">

    <!-- Mini Card -->
<div class="rounded-3xl bg-gradient-to-br from-indigo-500 to-violet-700 p-6 shadow-xl">


    <p class="text-xs uppercase tracking-widest text-indigo-100">
        EVENT BERLANGSUNG
    </p>

    @php
        $totalEvents = auth()->user()->role == 'superadmin'
            ? \App\Models\Event::count()
            : \App\Models\Event::where(
                'organization_id',
                auth()->user()->organization_id
            )->count();
    @endphp

    <h2 class="text-4xl font-black text-white mt-2">
        {{ $totalEvents }}
    </h2>

    <p class="text-indigo-200 mt-1 text-sm">
        Event aktif saat ini
    </p>

</div>
   <!-- Website -->
<a href="{{ url('/') }}"
   class="w-full flex items-center gap-4 px-5 py-4 rounded-2xl bg-indigo-600 text-white hover:bg-indigo-700 transition-all duration-300 font-bold shadow-lg">

    <div class="w-10 h-10 rounded-xl bg-white/20 flex items-center justify-center">
        🌐
    </div>

    <div class="flex flex-col text-left leading-tight">
        <span class="font-bold">
            Website
        </span>

        <span class="text-xs text-indigo-200">
            Kembali ke Home
        </span>
    </div>

</a>

    <!-- Logout -->
    <form action="{{ route('admin.logout') }}" method="POST">

        @csrf

        <button
            type="submit"
            class="w-full flex items-center gap-4 px-5 py-4 rounded-2xl bg-red-500 text-white hover:bg-red-600 transition-all duration-300 font-bold">

            <div class="w-10 h-10 rounded-xl bg-white/20 flex items-center justify-center">
                🚪
            </div>

            <span>Logout</span>

        </button>

    </form>

</div>

</aside>

<div id="overlay"
     class="fixed inset-0 bg-black/50 z-40 hidden lg:hidden">
</div>

    <!-- ========================= -->
    <!-- MAIN CONTENT -->
    <!-- ========================= -->

   <main class="flex-1 p-4 md:p-6 lg:p-10 overflow-y-auto">

        <!-- Top Header -->
        <header class="flex flex-col md:flex-row md:items-center md:justify-between gap-6 mb-10">

<div class="flex items-center justify-between lg:hidden mb-4">

    <button id="openSidebar"
        class="p-3 rounded-xl bg-indigo-600 text-white shadow-lg">

        ☰

    </button>

    <h2 class="font-bold text-slate-700">
        Admin Panel
    </h2>

</div>
            

            <!-- Profile -->
            <div class="flex items-center gap-4 bg-white px-5 py-3 rounded-3xl shadow-sm border border-slate-100">

                <div class="text-right hidden md:block">

                   <p class="font-black text-slate-800">
    {{ Auth::user()->name }}
</p>

<p class="text-sm text-slate-400">
    {{ ucfirst(Auth::user()->role) }}
</p>

                </div>

                <div class="w-14 h-14 bg-gradient-to-br from-indigo-500 to-indigo-700 rounded-2xl shadow-lg flex items-center justify-center overflow-hidden">

                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=6366f1&color=fff"
                         class="rounded-2xl">

                </div>

            </div>

        </header>

        <!-- Content -->
        @yield('content')

    </main>

<script>
const sidebar = document.getElementById('sidebar');
const overlay = document.getElementById('overlay');

const openBtn = document.getElementById('openSidebar');
const closeBtn = document.getElementById('closeSidebar');

console.log(openBtn);
console.log(closeBtn);
console.log(sidebar);

openBtn?.addEventListener('click', () => {
    sidebar.classList.remove('-translate-x-full');
    overlay.classList.remove('hidden');
});

closeBtn?.addEventListener('click', () => {
    sidebar.classList.add('-translate-x-full');
    overlay.classList.add('hidden');
});

overlay?.addEventListener('click', () => {
    sidebar.classList.add('-translate-x-full');
    overlay.classList.add('hidden');
});
</script>

@stack('scripts')

</body>

</html>