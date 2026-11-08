@extends('layouts.app')
@section('title','Beranda')
@section('content')
<header class="sticky top-0 z-30 border-b border-blue-100/70 glass">
  <nav class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4">
    <a href="{{ route('home') }}" class="flex items-center gap-3 text-2xl font-extrabold"><span class="grid h-11 w-11 place-items-center rounded-2xl bg-gradient-to-br from-blue-500 to-cyan-400 text-white">≋</span>FanIoT</a>
    <div class="hidden items-center gap-7 text-sm font-semibold text-slate-600 md:flex"><a href="#fitur" class="hover:text-blue-600">Fitur</a><a href="#cara-kerja" class="hover:text-blue-600">Cara Kerja</a><a href="#tentang" class="hover:text-blue-600">Tentang</a></div>
    <div class="flex gap-2"><a href="{{ route('login') }}" class="rounded-xl px-4 py-2 font-semibold text-blue-700 hover:bg-blue-50">Masuk</a><a href="{{ route('register') }}" class="rounded-xl bg-blue-600 px-4 py-2 font-semibold text-white shadow-lg shadow-blue-200 hover:bg-blue-700">Mulai</a></div>
  </nav>
</header>
<main>
<section class="relative overflow-hidden">
 <div class="absolute -right-20 -top-24 h-96 w-96 rounded-full bg-cyan-200/50 blur-3xl"></div><div class="absolute -left-24 top-44 h-80 w-80 rounded-full bg-blue-200/50 blur-3xl"></div>
 <div class="relative mx-auto grid max-w-7xl items-center gap-12 px-6 py-20 md:grid-cols-2 md:py-28">
  <div><span class="inline-flex items-center gap-2 rounded-full border border-blue-100 bg-white px-4 py-2 text-sm font-semibold text-blue-700"><span class="h-2 w-2 animate-pulse rounded-full bg-emerald-500"></span> Smart temperature monitoring</span>
   <h1 class="mt-6 text-5xl font-extrabold leading-tight tracking-tight md:text-6xl">Kendali kipas lebih <span class="bg-gradient-to-r from-blue-600 to-cyan-500 bg-clip-text text-transparent">cerdas.</span></h1>
   <p class="mt-5 max-w-xl text-lg leading-8 text-slate-600">FanIoT membantu memantau suhu dan status kipas dari satu dashboard. Pantau data, lihat riwayat, dan kelola perangkat dengan lebih mudah.</p>
   <div class="mt-8 flex flex-wrap gap-3"><a href="{{ route('register') }}" class="rounded-2xl bg-blue-600 px-6 py-3.5 font-bold text-white shadow-xl shadow-blue-200 transition hover:-translate-y-1 hover:bg-blue-700">Mulai Sekarang ↗</a><a href="#fitur" class="rounded-2xl border border-slate-200 bg-white px-6 py-3.5 font-bold text-slate-700 hover:border-blue-300">Jelajahi fitur</a></div>
   <div class="mt-10 flex gap-8 text-sm text-slate-500"><div><b class="block text-2xl text-slate-900">24/7</b>Pemantauan*</div><div><b class="block text-2xl text-slate-900">IoT</b>Konektivitas</div><div><b class="block text-2xl text-slate-900">1 panel</b>Kontrol terpusat</div></div>
  </div>
  <div class="rounded-[2rem] border border-white bg-white/80 p-5 shadow-2xl shadow-blue-100 md:p-7">
   <div class="flex items-center justify-between"><div><p class="text-sm font-semibold text-slate-500">PREVIEW DASHBOARD</p><h2 class="mt-1 text-xl font-extrabold">Status perangkat</h2></div><span class="rounded-full bg-emerald-50 px-3 py-1 text-xs font-bold text-emerald-700">DEMO</span></div>
   <div class="mt-6 grid grid-cols-2 gap-4"><div class="rounded-2xl bg-blue-50 p-5"><p class="text-sm text-slate-500">Suhu saat ini</p><p id="demoTemp" class="mt-2 text-4xl font-extrabold text-blue-700">28.7°C</p><p class="mt-2 text-xs text-slate-500">Pratinjau animasi</p></div><div class="rounded-2xl bg-slate-50 p-5"><p class="text-sm text-slate-500">Status kipas</p><p class="mt-2 text-3xl font-extrabold">ON</p><p class="mt-2 text-xs text-emerald-600">● Sistem siap dipantau</p></div></div>
   <div class="mt-5 rounded-2xl border border-slate-100 p-4"><div class="mb-3 flex justify-between text-sm"><span class="font-semibold">Tren suhu (demo)</span><span class="text-slate-400">Terakhir diperbarui</span></div><canvas id="landingChart" height="150"></canvas></div>
  </div>
 </div>
</section>
<section id="fitur" class="bg-white py-20"><div class="mx-auto max-w-7xl px-6"><div class="mx-auto max-w-2xl text-center"><p class="font-bold uppercase tracking-widest text-blue-600">Fitur utama</p><h2 class="mt-3 text-3xl font-extrabold md:text-4xl">Semua informasi dalam satu tempat</h2><p class="mt-4 text-slate-600">Antarmuka yang ringkas untuk membantu pengelolaan perangkat kipas berbasis IoT.</p></div>
 <div class="mt-12 grid gap-5 md:grid-cols-3"><article class="rounded-3xl border border-slate-100 p-7 transition hover:-translate-y-1 hover:shadow-soft"><div class="grid h-12 w-12 place-items-center rounded-2xl bg-blue-50 text-2xl">🌡️</div><h3 class="mt-5 text-xl font-bold">Monitoring suhu</h3><p class="mt-2 leading-7 text-slate-600">Lihat suhu yang dilaporkan perangkat dan bandingkan dengan batas suhu yang ditentukan.</p></article><article class="rounded-3xl border border-slate-100 p-7 transition hover:-translate-y-1 hover:shadow-soft"><div class="grid h-12 w-12 place-items-center rounded-2xl bg-cyan-50 text-2xl">〰️</div><h3 class="mt-5 text-xl font-bold">Grafik suhu</h3><p class="mt-2 leading-7 text-slate-600">Amati perubahan suhu melalui grafik sehingga tren lebih mudah dipahami.</p></article><article class="rounded-3xl border border-slate-100 p-7 transition hover:-translate-y-1 hover:shadow-soft"><div class="grid h-12 w-12 place-items-center rounded-2xl bg-violet-50 text-2xl">🗂️</div><h3 class="mt-5 text-xl font-bold">Riwayat perangkat</h3><p class="mt-2 leading-7 text-slate-600">Periksa catatan waktu, suhu, status kipas, dan keterangan kejadian sebelumnya.</p></article></div>
</div></section>
<section id="cara-kerja" class="py-20"><div class="mx-auto max-w-5xl px-6 text-center"><p class="font-bold uppercase tracking-widest text-blue-600">Cara kerja</p><h2 class="mt-3 text-3xl font-extrabold">Dari sensor ke dashboard</h2><div class="mt-10 grid gap-4 text-left md:grid-cols-3"><div class="rounded-2xl bg-white p-6 shadow-soft"><b class="text-blue-600">01 · Baca</b><h3 class="mt-3 font-bold">Sensor LM35</h3><p class="mt-2 text-sm leading-6 text-slate-600">Mengukur suhu lingkungan dan mengirim nilai ke mikrokontroler.</p></div><div class="rounded-2xl bg-white p-6 shadow-soft"><b class="text-blue-600">02 · Kendali</b><h3 class="mt-3 font-bold">Arduino / ESP32</h3><p class="mt-2 text-sm leading-6 text-slate-600">Memproses ambang suhu dan mengatur kipas melalui rangkaian driver/relay.</p></div><div class="rounded-2xl bg-white p-6 shadow-soft"><b class="text-blue-600">03 · Pantau</b><h3 class="mt-3 font-bold">Website FanIoT</h3><p class="mt-2 text-sm leading-6 text-slate-600">Menampilkan data yang dikirim perangkat melalui jaringan.</p></div></div></div></section>
<section id="tentang" class="bg-slate-900 py-16 text-white"><div class="mx-auto flex max-w-7xl flex-col justify-between gap-6 px-6 md:flex-row md:items-center"><div><h2 class="text-3xl font-extrabold">Siap memantau kipas dengan lebih mudah?</h2><p class="mt-3 text-slate-300">Mulai kelola perangkat melalui dashboard FanIoT.</p></div><a href="{{ route('register') }}" class="w-fit rounded-2xl bg-cyan-400 px-6 py-3 font-bold text-slate-900 hover:bg-cyan-300">Buat akun gratis →</a></div></section>
</main><footer class="bg-slate-950 px-6 py-6 text-center text-sm text-slate-400">© {{ date('Y') }} FanIoT · Smart Fan Monitoring <span class="block mt-1">*Ketersediaan pemantauan bergantung pada koneksi dan integrasi perangkat.</span></footer>
@endsection
@push('scripts')
<script>
const ctx=document.getElementById('landingChart');
new Chart(ctx,{type:'line',data:{labels:['08:00','09:00','10:00','11:00','12:00','13:00'],datasets:[{label:'Suhu °C',data:[26.1,26.8,27.2,28.4,29.1,28.7],borderColor:'#3478f6',backgroundColor:'rgba(52,120,246,.12)',fill:true,tension:.38}]},options:{plugins:{legend:{display:false}},scales:{y:{grid:{color:'#edf2f7'}},x:{grid:{display:false}}}}});
setInterval(()=>{const el=document.getElementById('demoTemp');el.textContent=(27.5+Math.random()*2.2).toFixed(1)+'°C'},3500);
</script>
@endpush
