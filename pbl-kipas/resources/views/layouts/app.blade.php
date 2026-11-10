
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'StayCool')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

    <div class="app-container">

        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-brand">
                <h2>StayCool</h2>
                <span>IoT Fan Monitoring</span>
            </div>

            
            <nav class="sidebar-menu">

                <a href="{{ route('dashboard') }}"
                class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <span>▦</span>
                    Dashboard
                </a>

                <a href="{{ route('fans.index') }}"
                class="menu-item {{ request()->routeIs('fans.*') ? 'active' : '' }}">
                    <span>◉</span>
                    Perangkat Kipas
                </a>

                <a href="{{ route('histories.index') }}"
                class="menu-item {{ request()->routeIs('histories.*') ? 'active' : '' }}">
                    <span>◷</span>
                    Riwayat
                </a>

                <a href="#"
                class="menu-item">
                    <span>▥</span>
                    Laporan
                </a>

            </nav>

            <div class="sidebar-bottom">
                <a href="#" class="menu-item">
                    <span>♙</span>
                    Profil Pengguna
                </a>

                <a href="#" class="menu-item">
                    <span>↪</span>
                    Keluar
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">

            <header class="topbar">
                <div>
                    <h3>@yield('page-heading', 'Dashboard')</h3>
                    <p>Selamat datang di StayCool</p>
                </div>

                <div class="user-info">
                    <div class="user-avatar">U</div>
                    <span>Pengguna</span>
                </div>
            </header>

            <section class="page-content">
                @yield('content')
            </section>

        </main>

    </div>

</body>
</html>
