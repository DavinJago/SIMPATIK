<!DOCTYPE html>
<html lang="id" x-data="{ showTambah: false, showEdit: false, showHapus: false, selected: null }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMPATIK - Jadwal Praktikum</title>
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
                ['icon' => 'dashboard.png',  'label' => 'Dashboard',  'url' => '/dashboard', 'active' => false],
                ['icon' => 'jadwal.png',     'label' => 'Jadwal',      'url' => '/jadwal',    'active' => true],
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

                <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-zinc-500 hover:bg-zinc-200 hover:text-zinc-800 transition-all">
                <img src="{{ asset('images/Pintu.png') }}" 
                alt="Keluar" 
                class="shrink-0 object-contain opacity-60"
                style="width: 20px; height: 20px;">
            Keluar
            </a>

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
    <main class="ml-56 flex-1 p-8">

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
                <h1 class="text-2xl font-bold text-white">Jadwal Praktikum TI'25</h1>
                <p class="text-sm text-zinc-400 mt-0.5">Kelola jadwal dan data mahasiswa praktikum</p>
            </div>
            <div class="flex items-center gap-3">
                <button @click="showTambah = true" type="button"
                    class="flex items-center gap-2 bg-green-500 hover:bg-green-600 text-white text-sm font-semibold px-4 py-2.5 rounded-xl transition-colors shadow-sm">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah Mahasiswa
                </button>
            </div>
        </div>

        {{-- Filter --}}
        <div class="flex items-center gap-3 mb-6">
            @foreach(['Semua Kelas', 'Struktur Data'] as $filter)
            <div class="flex items-center gap-2 border border-zinc-300 rounded-xl px-4 py-2.5 text-sm font-medium text-zinc-700 cursor-pointer transition-colors shadow-sm" style="background-color: #D9D9D9;">
                @if($loop->first)
                <svg class="w-4 h-4 text-zinc-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                @endif
                {{ $filter }}
                <svg class="w-4 h-4 text-zinc-400 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
            </div>
            @endforeach
        </div>

        {{-- Table --}}
        <div class="rounded-2xl shadow-sm overflow-hidden" style="background-color: #8B8B8B; border: 1px solid #8B8B8B;">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b" style="border-color: #6b6b6b; background-color: #8B8B8B;">
                        <th class="text-left px-4 py-3.5 text-xs font-semibold uppercase tracking-wider" style="color: #ffffff;">Nama Asprak</th>
                        <th class="text-left px-4 py-3.5 text-xs font-semibold uppercase tracking-wider" style="color: #ffffff;">NIM</th>
                        <th class="text-left px-4 py-3.5 text-xs font-semibold uppercase tracking-wider" style="color: #ffffff;">Kelas</th>
                        <th class="text-left px-4 py-3.5 text-xs font-semibold uppercase tracking-wider" style="color: #ffffff;">Mata Kuliah</th>
                        <th class="text-left px-4 py-3.5 text-xs font-semibold uppercase tracking-wider" style="color: #ffffff;">Hari</th>
                        <th class="text-left px-4 py-3.5 text-xs font-semibold uppercase tracking-wider" style="color: #ffffff;">Jam</th>
                        <th class="text-left px-4 py-3.5 text-xs font-semibold uppercase tracking-wider" style="color: #ffffff;">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y" style="border-color: #7a7a7a;">
                    @forelse($mahasiswa as $mhs)
                    <tr class="transition-colors" style="background-color: #D9D9D9;" onmouseover="this.style.backgroundColor='#c8c8c8'" onmouseout="this.style.backgroundColor='#D9D9D9'">
                        <td class="px-4 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-green-400 to-green-600 flex items-center justify-center text-xs font-bold text-white shrink-0">
                                    {{ strtoupper(substr($mhs->nama, 0, 1)) }}
                                </div>
                                <span class="font-medium text-zinc-800">{{ $mhs->nama }}</span>
                            </div>
                        </td>
                        <td class="px-4 py-4 text-zinc-600 font-mono text-xs">{{ $mhs->nim }}</td>
                        <td class="px-4 py-4">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold text-white" style="background-color: #8B8B8B;">
                                {{ $mhs->kelas }}
                            </span>
                        </td>
                        {{-- Kolom Mata Kuliah --}}
                        <td class="px-4 py-4">
                            @if($mhs->mata_kuliah)
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-xs font-semibold bg-blue-50 text-blue-700">
                                <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                                {{ $mhs->mata_kuliah }}
                            </span>
                            @else
                            <span class="text-xs text-zinc-400">-</span>
                            @endif
                        </td>
                        <td class="px-4 py-4">
                            @php
                            $warna = match($mhs->hari) {
                                'Senin'  => 'bg-red-50 text-red-700',
                                'Selasa' => 'bg-orange-50 text-orange-700',
                                'Rabu'   => 'bg-yellow-50 text-yellow-700',
                                'Kamis'  => 'bg-green-50 text-green-700',
                                'Jumat'  => 'bg-purple-50 text-purple-700',
                                'Sabtu'  => 'bg-pink-50 text-pink-700',
                                default  => 'bg-zinc-100 text-zinc-600',
                            };
                            @endphp
                            <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-semibold {{ $warna }}">
                                {{ $mhs->hari ?? '-' }}
                            </span>
                        </td>
                        <td class="px-4 py-4">
                            <div class="flex items-center gap-1 text-xs text-zinc-600">
                                <svg class="w-3.5 h-3.5 text-zinc-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ $mhs->jam_mulai ? \Carbon\Carbon::parse($mhs->jam_mulai)->format('H:i') : '-' }}
                                –
                                {{ $mhs->jam_selesai ? \Carbon\Carbon::parse($mhs->jam_selesai)->format('H:i') : '-' }}
                            </div>
                        </td>
                        <td class="px-4 py-4">
                            <div class="flex items-center gap-2">
                                <button @click="selected = {{ $mhs }}; showEdit = true" type="button"
                                    class="p-1.5 rounded-lg text-blue-500 hover:bg-blue-50 transition-colors">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </button>
                                <button @click="selected = {{ $mhs }}; showHapus = true" type="button"
                                    class="p-1.5 rounded-lg text-red-500 hover:bg-red-50 transition-colors">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-5 py-12 text-center text-zinc-400">
                            <svg class="w-10 h-10 mx-auto mb-2 opacity-30" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                            Belum ada data mahasiswa
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <p class="text-xs text-zinc-400 mt-4">Menampilkan {{ $mahasiswa->count() }} mahasiswa</p>
    </main>

    {{-- ======================== MODAL TAMBAH ======================== --}}
    <div x-show="showTambah" x-cloak class="fixed inset-0 z-50 flex items-center justify-center">
        <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" @click="showTambah = false"></div>
        <div class="relative rounded-2xl shadow-xl w-full max-w-md mx-4 p-6 max-h-[90vh] overflow-y-auto" style="background-color: #D9D9D9;">
            <h2 class="text-lg font-bold text-zinc-900 mb-5">Tambah Mahasiswa</h2>
            <form action="{{ route('mahasiswa.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-semibold text-zinc-500 mb-1.5">Nama Lengkap</label>
                    <input type="text" name="nama" required placeholder="Contoh: Budi Santoso"
                        class="w-full px-4 py-2.5 rounded-xl border border-zinc-300 text-zinc-800 text-sm focus:outline-none focus:ring-2 focus:ring-green-400" style="background-color: #ffffff;">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-zinc-500 mb-1.5">NIM</label>
                    <input type="text" name="nim" required placeholder="Contoh: 24051204209"
                        class="w-full px-4 py-2.5 rounded-xl border border-zinc-300 text-zinc-800 text-sm focus:outline-none focus:ring-2 focus:ring-green-400" style="background-color: #ffffff;">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-zinc-500 mb-1.5">Kelas</label>
                    <input type="text" name="kelas" required placeholder="Contoh: TI 2024G"
                        class="w-full px-4 py-2.5 rounded-xl border border-zinc-300 text-zinc-800 text-sm focus:outline-none focus:ring-2 focus:ring-green-400" style="background-color: #ffffff;">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-zinc-500 mb-1.5">Mata Kuliah</label>
                    <input type="text" name="mata_kuliah" placeholder="Contoh: Struktur Data"
                        class="w-full px-4 py-2.5 rounded-xl border border-zinc-300 text-zinc-800 text-sm focus:outline-none focus:ring-2 focus:ring-green-400" style="background-color: #ffffff;">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-zinc-500 mb-1.5">Hari</label>
                    <select name="hari" required
                        class="w-full px-4 py-2.5 rounded-xl border border-zinc-300 text-zinc-800 text-sm focus:outline-none focus:ring-2 focus:ring-green-400" style="background-color: #ffffff;">
                        <option value="">-- Pilih Hari --</option>
                        @foreach(['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'] as $hari)
                        <option value="{{ $hari }}">{{ $hari }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-semibold text-zinc-500 mb-1.5">Jam Mulai</label>
                        <input type="time" name="jam_mulai" required
                            class="w-full px-4 py-2.5 rounded-xl border border-zinc-300 text-zinc-800 text-sm focus:outline-none focus:ring-2 focus:ring-green-400" style="background-color: #ffffff;">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-zinc-500 mb-1.5">Jam Selesai</label>
                        <input type="time" name="jam_selesai" required
                            class="w-full px-4 py-2.5 rounded-xl border border-zinc-300 text-zinc-800 text-sm focus:outline-none focus:ring-2 focus:ring-green-400" style="background-color: #ffffff;">
                    </div>
                </div>
                <div class="flex gap-3 pt-2">
                    <button type="button" @click="showTambah = false"
                        class="flex-1 px-4 py-2.5 rounded-xl border border-zinc-400 text-sm font-semibold text-zinc-700 transition-colors" style="background-color: #ffffff;">
                        Batal
                    </button>
                    <button type="submit"
                        class="flex-1 px-4 py-2.5 rounded-xl bg-green-500 hover:bg-green-600 text-white text-sm font-semibold transition-colors">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- ======================== MODAL EDIT ======================== --}}
    <div x-show="showEdit" x-cloak class="fixed inset-0 z-50 flex items-center justify-center">
        <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" @click="showEdit = false"></div>
        <div class="relative rounded-2xl shadow-xl w-full max-w-md mx-4 p-6 max-h-[90vh] overflow-y-auto" style="background-color: #D9D9D9;">
            <h2 class="text-lg font-bold text-zinc-900 mb-5">Edit Mahasiswa</h2>
            <form :action="`/mahasiswa/${selected?.id}`" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-xs font-semibold text-zinc-500 mb-1.5">Nama Lengkap</label>
                    <input type="text" name="nama" required :value="selected?.nama"
                        class="w-full px-4 py-2.5 rounded-xl border border-zinc-300 text-zinc-800 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400" style="background-color: #ffffff;">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-zinc-500 mb-1.5">NIM</label>
                    <input type="text" name="nim" required :value="selected?.nim"
                        class="w-full px-4 py-2.5 rounded-xl border border-zinc-300 text-zinc-800 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400" style="background-color: #ffffff;">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-zinc-500 mb-1.5">Kelas</label>
                    <input type="text" name="kelas" required :value="selected?.kelas"
                        class="w-full px-4 py-2.5 rounded-xl border border-zinc-300 text-zinc-800 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400" style="background-color: #ffffff;">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-zinc-500 mb-1.5">Mata Kuliah</label>
                    <input type="text" name="mata_kuliah" :value="selected?.mata_kuliah" placeholder="Contoh: Struktur Data"
                        class="w-full px-4 py-2.5 rounded-xl border border-zinc-300 text-zinc-800 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400" style="background-color: #ffffff;">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-zinc-500 mb-1.5">Hari</label>
                    <select name="hari" required
                        class="w-full px-4 py-2.5 rounded-xl border border-zinc-300 text-zinc-800 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400" style="background-color: #ffffff;">
                        @foreach(['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'] as $hari)
                        <option value="{{ $hari }}" x-bind:selected="selected?.hari === '{{ $hari }}'">{{ $hari }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-semibold text-zinc-500 mb-1.5">Jam Mulai</label>
                        <input type="time" name="jam_mulai" required :value="selected?.jam_mulai"
                            class="w-full px-4 py-2.5 rounded-xl border border-zinc-300 text-zinc-800 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400" style="background-color: #ffffff;">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-zinc-500 mb-1.5">Jam Selesai</label>
                        <input type="time" name="jam_selesai" required :value="selected?.jam_selesai"
                            class="w-full px-4 py-2.5 rounded-xl border border-zinc-300 text-zinc-800 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400" style="background-color: #ffffff;">
                    </div>
                </div>
                <div class="flex gap-3 pt-2">
                    <button type="button" @click="showEdit = false"
                        class="flex-1 px-4 py-2.5 rounded-xl border border-zinc-400 text-sm font-semibold text-zinc-700 transition-colors" style="background-color: #ffffff;">
                        Batal
                    </button>
                    <button type="submit"
                        class="flex-1 px-4 py-2.5 rounded-xl bg-blue-500 hover:bg-blue-600 text-white text-sm font-semibold transition-colors">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- ======================== MODAL HAPUS ======================== --}}
    <div x-show="showHapus" x-cloak class="fixed inset-0 z-50 flex items-center justify-center">
        <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" @click="showHapus = false"></div>
        <div class="relative rounded-2xl shadow-xl w-full max-w-sm mx-4 p-6 text-center" style="background-color: #D9D9D9;">
            <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-6 h-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
            </div>
            <h2 class="text-lg font-bold text-zinc-900 mb-1">Hapus Mahasiswa?</h2>
            <p class="text-sm text-zinc-500 mb-6">Data <span class="font-semibold text-zinc-700" x-text="selected?.nama"></span> akan dihapus permanen.</p>
            <form :action="`/mahasiswa/${selected?.id}`" method="POST">
                @csrf
                @method('DELETE')
                <div class="flex gap-3">
                    <button type="button" @click="showHapus = false"
                        class="flex-1 px-4 py-2.5 rounded-xl border border-zinc-400 text-sm font-semibold text-zinc-700 transition-colors" style="background-color: #ffffff;">
                        Batal
                    </button>
                    <button type="submit"
                        class="flex-1 px-4 py-2.5 rounded-xl bg-red-500 hover:bg-red-600 text-white text-sm font-semibold transition-colors">
                        Hapus
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="//unpkg.com/alpinejs" defer></script>
</body>
</html>