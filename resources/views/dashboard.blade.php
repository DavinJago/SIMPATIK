<!DOCTYPE html>
<html lang="id" x-data="{}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMPATIK - Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
        * { font-family: 'Plus Jakarta Sans', sans-serif; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-zinc-900 text-zinc-100 min-h-screen flex">

    {{-- SIDEBAR --}}
    <aside class="w-56 min-h-screen border-r flex flex-col py-6 px-4 fixed top-0 left-0 h-full shadow-sm z-20" style="background-color: #D9D9D9;">
        <div class="flex items-center gap-2 mb-10 px-2">
            <div class="w-8 h-8 rounded-lg overflow-hidden">
                <img src="{{ asset('images/simpatik.png') }}" alt="SIMPATIK" class="w-full h-full object-cover">
            </div>
            <span class="text-lg font-bold tracking-tight text-zinc-800">SIMPATIK</span>
        </div>

        <nav class="flex flex-col gap-1 flex-1">
            @php
            $menus = [
                ['icon' => 'dashboard.png',  'label' => 'Dashboard',  'url' => '/dashboard', 'active' => true],
                ['icon' => 'jadwal.png',     'label' => 'Jadwal',      'url' => '/jadwal',    'active' => false],
                ['icon' => 'Nilai.png',      'label' => 'Nilai Siswa', 'url' => '/nilai',     'active' => false],
                ['icon' => 'Bank.png',       'label' => 'Bank Soal',   'url' => '/banksoal',  'active' => false],
            ];
            @endphp

            @foreach($menus as $menu)
            <a href="{{ $menu['url'] }}" class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium transition-all duration-150
                {{ $menu['active'] ? 'text-white font-semibold rounded-xl' : 'text-zinc-600 hover:text-zinc-800 rounded-xl' }}"
                @if($menu['active']) style="background-color: #8B8B8B;" @endif>
                <img src="{{ asset('images/' . $menu['icon']) }}"
                    alt="{{ $menu['label'] }}"
                    class="w-5 h-5 shrink-0 object-contain">
                {{ $menu['label'] }}
            </a>
            @endforeach

            <div class="my-3 border-t border-zinc-300"></div>

            <form method="POST" action="{{ route('logout') }}" class="w-full">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-zinc-500 hover:bg-zinc-200 hover:text-zinc-800 transition-all border-none bg-transparent cursor-pointer">
                    <img src="{{ asset('images/Pintu.png') }}" 
                    alt="Keluar" 
                    class="shrink-0 object-contain opacity-60"
                    style="width: 20px; height: 20px;">
                    Keluar
                </button>
            </form>

            <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-zinc-500 hover:bg-zinc-200 hover:text-zinc-800 transition-all">
                <img src="{{ asset('images/Settings-black.png') }}" 
                alt="Pengaturan" 
                class="shrink-0 object-contain opacity-60"
                style="width: 20px; height: 20px;">
                Pengaturan
            </a>
        </nav>
    </aside>

    {{-- MAIN --}}
    <main class="ml-56 flex-1 p-8 overflow-y-auto">

        {{-- Flash Message --}}
        @if(session('success'))
        <div class="mb-4 px-4 py-3 bg-green-50 border border-green-200 text-green-700 rounded-xl text-sm font-medium flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
            {{ session('success') }}
        </div>
        @endif

        {{-- Header --}}
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-2xl font-bold text-white">Dashboard</h1>
                <p class="text-sm text-zinc-400 mt-0.5">Sistem Manajemen Praktikum Terpadu</p>
            </div>
        </div>

        {{-- Stats Cards --}}
        <div class="grid grid-cols-4 gap-4 mb-8">
            {{-- Card 1: Modul Praktikum --}}
            <div class="rounded-xl p-4" style="background-color: #8B8B8B;">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-medium text-zinc-300 mb-1">Modul Praktikum</p>
                        <p class="text-3xl font-bold text-white">6</p>
                    </div>
                    <svg class="w-8 h-8 text-zinc-200 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="3" width="7" height="7" rx="1.5"/>
                        <rect x="14" y="3" width="7" height="7" rx="1.5"/>
                        <rect x="3" y="14" width="7" height="7" rx="1.5"/>
                        <rect x="14" y="14" width="7" height="7" rx="1.5"/>
                    </svg>
                </div>
            </div>

            {{-- Card 2: Praktikum Aktif --}}
            <div class="rounded-xl p-4" style="background-color: #8B8B8B;">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-medium text-zinc-300 mb-1">Praktikum Aktif</p>
                        <p class="text-3xl font-bold text-white">25</p>
                    </div>
                    <svg class="w-8 h-8 text-zinc-200 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <circle cx="10" cy="7" r="3.5" fill="currentColor"/>
                        <path d="M2 22c0-4 3.6-7 8-7h2.5" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"/>
                    </svg>
                </div>
            </div>

            {{-- Card 3: Peserta Aktif --}}
            <div class="rounded-xl p-4" style="background-color: #8B8B8B;">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-medium text-zinc-300 mb-1">Peserta Aktif</p>
                        <p class="text-3xl font-bold text-white">120</p>
                    </div>
                    <svg class="w-8 h-8 text-zinc-200 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/>
                    </svg>
                </div>
            </div>

            {{-- Card 4: Asisten Aktif --}}
            <div class="rounded-xl p-4" style="background-color: #8B8B8B;">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-medium text-zinc-300 mb-1">Asisten Aktif</p>
                        <p class="text-3xl font-bold text-white">15</p>
                    </div>
                    <svg class="w-8 h-8 text-zinc-200 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Chart and Info Section --}}
        <div class="grid grid-cols-3 gap-4">
            {{-- Bar Chart Section --}}
            <div class="col-span-2 rounded-xl p-6" style="background-color: #8B8B8B;">
                <div class="mb-6">
                    <h2 class="text-lg font-bold text-white">Aktivitas Mingguan</h2>
                    <p class="text-sm text-zinc-300 mt-1">Sesi praktikum berjalan per hari</p>
                </div>
                <div class="flex items-end justify-between gap-3" style="height: 150px;">
                    @php
                    $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                    $values = [65, 78, 55, 82, 70, 48];
                    @endphp
                    @foreach($days as $index => $day)
                    <div class="flex flex-col items-center flex-1">
                        <div class="w-full rounded-t-md transition-all hover:opacity-80" style="background-color: #6b6b6b; height: {{ ($values[$index] / 100) * 120 }}px;"></div>
                        <span class="text-xs font-medium text-zinc-300 mt-2">{{ substr($day, 0, 3) }}</span>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Info Section --}}
            <div class="rounded-xl p-6" style="background-color: #8B8B8B;">
                <h3 class="text-lg font-bold text-white mb-4">Informasi</h3>
                <div class="space-y-4">
                    <div class="pb-4 border-b border-zinc-600">
                        <p class="text-xs text-zinc-300 mb-1">Total Modul</p>
                        <p class="text-2xl font-bold text-white">6</p>
                    </div>
                    <div class="pb-4 border-b border-zinc-600">
                        <p class="text-xs text-zinc-300 mb-1">Kelulusan Rate</p>
                        <p class="text-2xl font-bold text-white">87%</p>
                    </div>
                    <div>
                        <p class="text-xs text-zinc-300 mb-1">Status Sistem</p>
                        <p class="text-sm font-semibold text-green-400">✓ Aktif</p>
                    </div>
                </div>
    </main>

</body>
</html>