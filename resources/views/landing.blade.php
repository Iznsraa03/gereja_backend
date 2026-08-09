<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Church Finder Makassar - Temukan gereja terdekat di Kota Makassar berdasarkan lokasi Anda. Didukung Formula Haversine dan data gereja terverifikasi.">
    <meta property="og:title" content="Church Finder Makassar">
    <meta property="og:description" content="Temukan gereja terdekat di genggaman Anda. Aplikasi Android gratis untuk jemaat Makassar.">
    <title>Church Finder Makassar - Temukan Gereja Terdekat</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=Work+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --color-primary: #0F172A;
            --color-secondary: #1E3A5F;
            --color-accent: #38BDF8;
            --color-gold: #F59E0B;
        }
        * { box-sizing: border-box; }
        body { font-family: 'Work Sans', sans-serif; background: #0F172A; color: #F8FAFC; overflow-x: hidden; }
        h1, h2, h3, h4 { font-family: 'Outfit', sans-serif; }

        /* Glass morphism card */
        .glass { background: rgba(30, 58, 95, 0.4); backdrop-filter: blur(12px); border: 1px solid rgba(56, 189, 248, 0.15); }

        /* Gradient background blobs */
        .blob-1 { position: absolute; width: 600px; height: 600px; background: radial-gradient(circle, rgba(56,189,248,0.12) 0%, transparent 70%); border-radius: 50%; top: -200px; right: -200px; pointer-events: none; }
        .blob-2 { position: absolute; width: 500px; height: 500px; background: radial-gradient(circle, rgba(245,158,11,0.08) 0%, transparent 70%); border-radius: 50%; bottom: -100px; left: -100px; pointer-events: none; }

        /* Animated gradient text */
        .gradient-text { background: linear-gradient(135deg, #38BDF8 0%, #818CF8 50%, #F59E0B 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }

        /* Smooth scroll */
        html { scroll-behavior: smooth; }

        /* Button glow */
        .btn-primary { background: linear-gradient(135deg, #0EA5E9, #2563EB); box-shadow: 0 0 30px rgba(14,165,233,0.35); transition: all 0.3s ease; }
        .btn-primary:hover { box-shadow: 0 0 45px rgba(14,165,233,0.55); transform: translateY(-2px); }
        .btn-gold { background: linear-gradient(135deg, #F59E0B, #D97706); box-shadow: 0 0 25px rgba(245,158,11,0.3); transition: all 0.3s ease; }
        .btn-gold:hover { box-shadow: 0 0 40px rgba(245,158,11,0.5); transform: translateY(-2px); }

        /* Feature card hover */
        .feature-card { transition: all 0.3s ease; border: 1px solid rgba(56,189,248,0.1); }
        .feature-card:hover { border-color: rgba(56,189,248,0.4); transform: translateY(-4px); background: rgba(30,58,95,0.6) !important; }

        /* Stat counter animation */
        @keyframes countUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        .stat-item { animation: countUp 0.6s ease forwards; }

        /* Nav scroll effect handled by JS */
        .nav-scrolled { background: rgba(15, 23, 42, 0.95); backdrop-filter: blur(20px); border-bottom: 1px solid rgba(56,189,248,0.1); }
    </style>
</head>
<body>

<!-- ═══════════════════════════════════════════ NAVBAR ═══════════════════════════════════════════ -->
<nav id="navbar" class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 py-4 px-6">
    <div class="max-w-7xl mx-auto flex items-center justify-between">
        <a href="/" class="flex items-center gap-3">
            <img src="{{ asset('logo/LOGO.jpeg') }}" alt="Church Finder Logo" class="w-9 h-9 rounded-xl object-cover shadow-lg shadow-sky-500/20">
            <span class="font-bold text-white text-lg tracking-tight" style="font-family:'Outfit',sans-serif">Church Finder</span>
        </a>

        <div class="hidden md:flex items-center gap-8">
            <a href="#features" class="text-slate-400 hover:text-sky-400 transition-colors text-sm font-medium cursor-pointer">Fitur</a>
            <a href="#how-it-works" class="text-slate-400 hover:text-sky-400 transition-colors text-sm font-medium cursor-pointer">Cara Kerja</a>
            <a href="#download" class="text-slate-400 hover:text-sky-400 transition-colors text-sm font-medium cursor-pointer">Unduh APK</a>

            <a href="#download" class="btn-primary text-white px-5 py-2.5 rounded-xl text-sm font-semibold cursor-pointer">
                Unduh Gratis
            </a>
        </div>

        <!-- Mobile hamburger -->
        <button id="nav-toggle" class="md:hidden text-slate-300 hover:text-white transition-colors cursor-pointer">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
        </button>
    </div>

    <!-- Mobile menu -->
    <div id="mobile-menu" class="md:hidden hidden mt-4 glass rounded-2xl p-4 mx-4 space-y-3">
        <a href="#features" class="block text-slate-300 hover:text-sky-400 py-2 px-4 rounded-lg transition-colors cursor-pointer">Fitur</a>
        <a href="#how-it-works" class="block text-slate-300 hover:text-sky-400 py-2 px-4 rounded-lg transition-colors cursor-pointer">Cara Kerja</a>
        <a href="#download" class="block text-slate-300 hover:text-sky-400 py-2 px-4 rounded-lg transition-colors cursor-pointer">Unduh APK</a>
        <a href="#download" class="block btn-primary text-white px-4 py-2.5 rounded-xl font-semibold text-center cursor-pointer">Unduh Gratis</a>
    </div>
</nav>

<!-- ═══════════════════════════════════════════ HERO ═══════════════════════════════════════════ -->
<section class="relative min-h-screen flex items-center pt-20 pb-16 overflow-hidden">
    <div class="blob-1"></div>
    <div class="blob-2"></div>

    <!-- Grid pattern background -->
    <div class="absolute inset-0 opacity-[0.03]" style="background-image: linear-gradient(rgba(56,189,248,1) 1px, transparent 1px), linear-gradient(90deg, rgba(56,189,248,1) 1px, transparent 1px); background-size: 50px 50px;"></div>

    <div class="max-w-7xl mx-auto px-6 w-full relative z-10">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <!-- Left: Text -->
            <div>
                <div class="inline-flex items-center gap-2 glass px-4 py-2 rounded-full text-sm text-sky-400 font-medium mb-8">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    {{ $stats['churches'] }} Gereja Terverifikasi di Makassar
                </div>

                <h1 class="text-5xl md:text-6xl lg:text-7xl font-black leading-[1.05] tracking-tight mb-6" style="font-family:'Outfit',sans-serif">
                    Temukan<br>
                    <span class="gradient-text">Gereja Terdekat</span><br>
                    di Makassar
                </h1>

                <p class="text-slate-400 text-lg md:text-xl leading-relaxed max-w-lg mb-10">
                    Aplikasi Android gratis yang membantu Anda menemukan gereja berdasarkan lokasi, jadwal ibadah, dan denominasi — didukung Formula Haversine untuk presisi jarak real-time.
                </p>

                <div class="flex flex-wrap gap-4">
                    <a href="#download" class="btn-gold text-slate-900 px-8 py-4 rounded-2xl font-bold text-lg flex items-center gap-3 cursor-pointer">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M17.523 15.3414c-.5511 0-.9993-.4486-.9993-.9997s.4482-.9993.9993-.9993c.5511 0 .9993.4482.9993.9993.0004.5511-.4482.9997-.9993.9997m-11.046 0c-.5511 0-.9993-.4486-.9993-.9997s.4482-.9993.9993-.9993c.5511 0 .9993.4482.9993.9993 0 .5511-.4482.9997-.9993.9997m11.4045-6.02l1.9973-3.4592a.415.415 0 00-.1521-.5676.4162.4162 0 00-.5676.1521l-2.022 3.503C15.5902 8.2435 13.8533 7.85 12 7.85s-3.5902.3935-5.1371 1.1004L4.841 5.447a.415.415 0 00-.5676-.1521.4157.4157 0 00-.1521.5676l1.9973 3.4592C2.6889 11.1867.3432 14.6589 0 18.761h24c-.3432-4.1021-2.6892-7.5743-6.1185-9.44z"/></svg>
                        Unduh APK Android
                    </a>
                    <a href="#features" class="glass text-white px-8 py-4 rounded-2xl font-semibold text-lg flex items-center gap-3 hover:bg-white/10 transition-all cursor-pointer">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        Lihat Fitur
                    </a>
                </div>

                <!-- Trust badges -->
                <div class="flex items-center gap-6 mt-10 text-slate-500 text-sm">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-emerald-400" fill="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        100% Gratis
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-sky-400" fill="currentColor" viewBox="0 0 24 24"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        Berbasis Lokasi GPS
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-amber-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                        Data Terverifikasi
                    </div>
                </div>
            </div>

            <!-- Right: App Mockup -->
            <div class="relative flex justify-center lg:justify-end">
                <div class="relative">
                    <!-- Phone mockup -->
                    <div class="relative w-72 h-[580px] bg-gradient-to-b from-slate-800 to-slate-900 rounded-[3rem] border-4 border-slate-700 shadow-2xl shadow-sky-500/10 overflow-hidden" style="box-shadow: 0 0 80px rgba(56,189,248,0.15)">
                        <!-- Status bar -->
                        <div class="h-10 bg-slate-900 flex items-center justify-between px-6 pt-2">
                            <span class="text-xs text-slate-400">9:41</span>
                            <div class="w-20 h-5 bg-slate-800 rounded-full mx-auto"></div>
                            <div class="flex gap-1 items-center">
                                <div class="w-4 h-2.5 bg-emerald-400 rounded-sm text-[6px]"></div>
                            </div>
                        </div>

                        <!-- App content mockup -->
                        <div class="p-4 space-y-3">
                            <div class="glass rounded-2xl p-4">
                                <p class="text-[10px] text-sky-400 font-semibold mb-1">TERDEKAT DARI ANDA</p>
                                <p class="text-sm font-bold text-white">Gereja Toraja Jemaat</p>
                                <p class="text-[10px] text-slate-400">Sudiang, Biringkanaya</p>
                                <div class="flex justify-between items-center mt-2">
                                    <span class="text-xs text-amber-400 font-semibold">📍 1.2 km</span>
                                    <span class="text-[10px] bg-emerald-500/20 text-emerald-400 px-2 py-0.5 rounded-full">Terverifikasi</span>
                                </div>
                            </div>
                            <div class="space-y-2">
                                @for ($i = 0; $i < 3; $i++)
                                <div class="glass rounded-xl p-3 flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-sky-500/30 to-blue-600/30 flex-shrink-0"></div>
                                    <div class="flex-1 min-w-0">
                                        <div class="h-2.5 bg-slate-600 rounded w-3/4 mb-1.5"></div>
                                        <div class="h-2 bg-slate-700 rounded w-1/2"></div>
                                    </div>
                                    <div class="text-[10px] text-sky-400">{{ 1.5 + $i * 0.8 }} km</div>
                                </div>
                                @endfor
                            </div>
                        </div>

                        <!-- Bottom nav bar -->
                        <div class="absolute bottom-0 left-0 right-0 h-16 bg-slate-900/95 border-t border-slate-700 flex items-center justify-around px-6">
                            @foreach(['M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6', 'M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z', 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z', 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z'] as $idx => $path)
                            <div class="{{ $idx === 0 ? 'text-sky-400' : 'text-slate-600' }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $path }}"/></svg>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Floating info cards -->
                    <div class="absolute -left-16 top-20 glass rounded-2xl p-3 shadow-xl" style="animation: float 3s ease-in-out infinite;">
                        <p class="text-xs text-slate-400">Jarak Terdekat</p>
                        <p class="text-lg font-bold text-sky-400">0.8 km</p>
                    </div>
                    <div class="absolute -right-16 bottom-32 glass rounded-2xl p-3 shadow-xl" style="animation: float 3s ease-in-out infinite 1.5s;">
                        <p class="text-xs text-slate-400">Denominasi</p>
                        <p class="text-lg font-bold text-amber-400">{{ $stats['categories'] }}+ Jenis</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Float animation -->
<style>
@keyframes float { 0%, 100% { transform: translateY(0px); } 50% { transform: translateY(-10px); } }
</style>

<!-- ═══════════════════════════════════════════ STATS ═══════════════════════════════════════════ -->
<section class="py-12 border-y border-slate-800">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            @foreach([
                ['value' => $stats['churches'], 'suffix' => '+', 'label' => 'Gereja Terverifikasi', 'color' => 'text-sky-400'],
                ['value' => $stats['categories'], 'suffix' => '', 'label' => 'Denominasi Gereja', 'color' => 'text-amber-400'],
                ['value' => '< 1', 'suffix' => 'dtk', 'label' => 'Kecepatan Pencarian', 'color' => 'text-emerald-400'],
                ['value' => '100', 'suffix' => '%', 'label' => 'Gratis Selamanya', 'color' => 'text-purple-400'],
            ] as $stat)
            <div class="text-center stat-item">
                <p class="text-4xl font-black {{ $stat['color'] }}" style="font-family:'Outfit',sans-serif">
                    {{ $stat['value'] }}<span class="text-2xl">{{ $stat['suffix'] }}</span>
                </p>
                <p class="text-slate-500 text-sm mt-1">{{ $stat['label'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════ FEATURES ═══════════════════════════════════════════ -->
<section id="features" class="py-24 relative">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
            <p class="text-sky-400 font-semibold text-sm uppercase tracking-widest mb-4">Keunggulan Sistem</p>
            <h2 class="text-4xl md:text-5xl font-black text-white" style="font-family:'Outfit',sans-serif">
                Semua yang Anda Butuhkan,<br>
                <span class="gradient-text">dalam Satu Aplikasi</span>
            </h2>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach([
                [
                    'icon' => 'M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z',
                    'title' => 'Haversine Geolocation',
                    'desc' => 'Formula matematika presisi tinggi menghitung jarak garis lurus antara posisi Anda dan setiap gereja dalam hitungan milidetik.',
                    'color' => 'from-sky-500/20 to-blue-600/20',
                    'icon_color' => 'text-sky-400',
                    'badge' => 'Teknologi Utama'
                ],
                [
                    'icon' => 'M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z',
                    'title' => 'Filter Denominasi',
                    'desc' => 'Saring gereja berdasarkan kategori denominasi: Katolik, Toraja, Advent, Pantekosta, Bethel, dan lebih banyak lagi.',
                    'color' => 'from-purple-500/20 to-indigo-600/20',
                    'icon_color' => 'text-purple-400',
                    'badge' => null
                ],
                [
                    'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z',
                    'title' => 'Jadwal Ibadah Lengkap',
                    'desc' => 'Jadwal misa dan ibadah real-time setiap gereja, mulai hari Senin hingga Minggu — tidak perlu bolak-balik telepon.',
                    'color' => 'from-emerald-500/20 to-teal-600/20',
                    'icon_color' => 'text-emerald-400',
                    'badge' => null
                ],
                [
                    'icon' => 'M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7',
                    'title' => 'Navigasi Google Maps',
                    'desc' => 'Tekan satu tombol untuk membuka rute langsung ke gereja pilihan Anda melalui integrasi Google Maps.',
                    'color' => 'from-amber-500/20 to-orange-600/20',
                    'icon_color' => 'text-amber-400',
                    'badge' => null
                ],
                [
                    'icon' => 'M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z',
                    'title' => 'Ajukan Gereja Baru',
                    'desc' => 'Pengguna dapat mengajukan data gereja baru langsung dari aplikasi. Admin akan memverifikasi sebelum data tampil publik.',
                    'color' => 'from-rose-500/20 to-pink-600/20',
                    'icon_color' => 'text-rose-400',
                    'badge' => 'Baru'
                ],
                [
                    'icon' => 'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10',
                    'title' => 'Fasilitas & Kegiatan',
                    'desc' => 'Informasi lengkap fasilitas gereja (aula, parkir, WC) dan kegiatan rutin (sekolah minggu, kelompok doa, paduan suara).',
                    'color' => 'from-cyan-500/20 to-sky-600/20',
                    'icon_color' => 'text-cyan-400',
                    'badge' => null
                ],
            ] as $feature)
            <div class="feature-card glass rounded-2xl p-6 relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-br {{ $feature['color'] }} opacity-50"></div>
                <div class="relative z-10">
                    @if($feature['badge'])
                    <span class="inline-block bg-sky-500/20 text-sky-400 text-xs font-semibold px-2.5 py-1 rounded-full mb-4 border border-sky-500/30">{{ $feature['badge'] }}</span>
                    @endif
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br {{ $feature['color'] }} flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 {{ $feature['icon_color'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $feature['icon'] }}"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-white mb-2">{{ $feature['title'] }}</h3>
                    <p class="text-slate-400 text-sm leading-relaxed">{{ $feature['desc'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════ HOW IT WORKS (HAVERSINE) ═══════════════════════════════════════════ -->
<section id="how-it-works" class="py-24 bg-slate-900/50">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <div>
                <p class="text-amber-400 font-semibold text-sm uppercase tracking-widest mb-4">Teknologi Pencarian</p>
                <h2 class="text-4xl md:text-5xl font-black text-white mb-6" style="font-family:'Outfit',sans-serif">
                    Presisi Tinggi dengan<br>
                    <span class="gradient-text">Formula Haversine</span>
                </h2>
                <p class="text-slate-400 text-lg mb-8 leading-relaxed">
                    Berbeda dengan pencarian biasa, sistem kami menggunakan Formula Haversine untuk menghitung jarak aktual di permukaan bola bumi (great-circle distance) — hasil yang jauh lebih akurat dari metode garis Euclidean biasa.
                </p>
                <div class="space-y-4">
                    @foreach([
                        ['step' => '01', 'title' => 'Ambil Koordinat GPS Anda', 'desc' => 'Aplikasi mengambil latitude dan longitude posisi Anda saat ini secara real-time.'],
                        ['step' => '02', 'title' => 'Hitung Jarak ke Setiap Gereja', 'desc' => 'Formula Haversine dieksekusi di backend Laravel untuk setiap gereja terverifikasi dalam database.'],
                        ['step' => '03', 'title' => 'Urut & Tampilkan Terdekat', 'desc' => 'Hasil diurutkan dari yang paling dekat. Anda bisa melihat jarak tepat dalam kilometer untuk setiap gereja.'],
                    ] as $step)
                    <div class="flex gap-4 items-start">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-sky-500/20 to-blue-600/20 border border-sky-500/30 flex items-center justify-center flex-shrink-0">
                            <span class="text-sky-400 font-black text-sm">{{ $step['step'] }}</span>
                        </div>
                        <div>
                            <p class="font-bold text-white mb-1">{{ $step['title'] }}</p>
                            <p class="text-slate-400 text-sm">{{ $step['desc'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Haversine formula card -->
            <div class="glass rounded-3xl p-8">
                <p class="text-slate-400 text-sm mb-4 font-medium uppercase tracking-wider">Formula Matematika</p>
                <div class="bg-slate-950 rounded-2xl p-6 mb-6 font-mono text-sm overflow-x-auto">
                    <p class="text-emerald-400 mb-2">// Haversine Distance Formula</p>
                    <p class="text-slate-300"><span class="text-amber-400">a</span> = sin²(<span class="text-sky-400">Δlat</span>/2) + cos(lat₁) × cos(lat₂) × sin²(<span class="text-sky-400">Δlon</span>/2)</p>
                    <p class="text-slate-300 mt-2"><span class="text-amber-400">c</span> = 2 × atan2(√a, √(1−a))</p>
                    <p class="text-slate-300 mt-2"><span class="text-amber-400">d</span> = <span class="text-purple-400">R</span> × c  <span class="text-slate-500">// R = 6371 km</span></p>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="glass rounded-xl p-4 text-center">
                        <p class="text-2xl font-black text-sky-400" style="font-family:'Outfit',sans-serif">6,371</p>
                        <p class="text-slate-400 text-xs mt-1">Radius Bumi (km)</p>
                    </div>
                    <div class="glass rounded-xl p-4 text-center">
                        <p class="text-2xl font-black text-amber-400" style="font-family:'Outfit',sans-serif">&lt; 1ms</p>
                        <p class="text-slate-400 text-xs mt-1">Waktu Kalkulasi</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════ DOWNLOAD ═══════════════════════════════════════════ -->
<section id="download" class="py-24 relative overflow-hidden">
    <div class="absolute inset-0" style="background: radial-gradient(ellipse at center, rgba(245,158,11,0.08) 0%, transparent 70%);"></div>
    <div class="max-w-4xl mx-auto px-6 text-center relative z-10">
        <p class="text-amber-400 font-semibold text-sm uppercase tracking-widest mb-4">Unduh Aplikasi</p>
        <h2 class="text-4xl md:text-5xl font-black text-white mb-6" style="font-family:'Outfit',sans-serif">
            Siap Digunakan?<br>
            <span class="gradient-text">Unduh Sekarang — Gratis!</span>
        </h2>
        <p class="text-slate-400 text-lg mb-12 max-w-xl mx-auto">
            Sideload APK langsung ke perangkat Android Anda. Tidak perlu Google Play Store. Gratis selamanya untuk jemaat Makassar.
        </p>

        <div class="glass rounded-3xl p-8 max-w-md mx-auto">
            <!-- App icon -->
            <img src="{{ asset('logo/LOGO.jpeg') }}" alt="Church Finder App Icon" class="w-20 h-20 rounded-3xl object-cover mx-auto mb-6 shadow-xl shadow-sky-500/30">

            <h3 class="text-2xl font-black text-white mb-1" style="font-family:'Outfit',sans-serif">Church Finder Makassar</h3>
            <p class="text-slate-400 text-sm mb-6">v1.0.0 · Android 8.0+ · ~15 MB</p>

            <!-- Requirements -->
            <div class="flex justify-center gap-6 mb-8 text-sm">
                <div class="flex items-center gap-2 text-slate-400">
                    <svg class="w-4 h-4 text-emerald-400" fill="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    Android 8.0+
                </div>
                <div class="flex items-center gap-2 text-slate-400">
                    <svg class="w-4 h-4 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                    Kotlin + Jetpack Compose
                </div>
            </div>

            <a href="/download-apk" class="btn-gold text-slate-900 w-full py-4 rounded-2xl font-black text-lg flex items-center justify-center gap-3 cursor-pointer" style="display:flex;">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                Unduh APK Android
            </a>

            <p class="text-slate-500 text-xs mt-4">
                Aktifkan <strong class="text-slate-400">Sumber Tidak Dikenal</strong> di Pengaturan Android sebelum menginstal.
            </p>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════ FOOTER ═══════════════════════════════════════════ -->
<footer class="border-t border-slate-800 py-12">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="flex items-center gap-3">
                <img src="{{ asset('logo/LOGO.jpeg') }}" alt="Logo" class="w-8 h-8 rounded-xl object-cover">
                <div>
                    <p class="font-bold text-white text-sm" style="font-family:'Outfit',sans-serif">Church Finder Makassar</p>
                    <p class="text-slate-500 text-xs">© {{ date('Y') }} Hak cipta dilindungi</p>
                </div>
            </div>

            <div class="flex items-center gap-8 text-sm text-slate-500">
                <a href="#features" class="hover:text-slate-300 transition-colors cursor-pointer">Fitur</a>
                <a href="#how-it-works" class="hover:text-slate-300 transition-colors cursor-pointer">Cara Kerja</a>
                <a href="#download" class="hover:text-slate-300 transition-colors cursor-pointer">Unduh APK</a>

            </div>

            <div class="text-slate-500 text-xs text-center">
                Backend: <span class="text-sky-500">Laravel 12</span> · API: <span class="text-amber-500">REST JSON</span> · DB: <span class="text-emerald-500">MySQL</span>
            </div>
        </div>
    </div>
</footer>

<script>
    // Navbar scroll effect
    const navbar = document.getElementById('navbar');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            navbar.classList.add('nav-scrolled');
        } else {
            navbar.classList.remove('nav-scrolled');
        }
    });

    // Mobile menu toggle
    document.getElementById('nav-toggle').addEventListener('click', () => {
        document.getElementById('mobile-menu').classList.toggle('hidden');
    });

    // Close mobile menu on link click
    document.querySelectorAll('#mobile-menu a').forEach(link => {
        link.addEventListener('click', () => {
            document.getElementById('mobile-menu').classList.add('hidden');
        });
    });
</script>
</body>
</html>
