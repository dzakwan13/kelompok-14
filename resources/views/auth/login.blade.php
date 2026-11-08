@extends('layouts.app')
@section('title','Masuk')
@section('content')
<div class="grid min-h-screen lg:grid-cols-2">
 <section class="hidden flex-col justify-between bg-gradient-to-br from-blue-700 via-blue-600 to-cyan-500 p-12 text-white lg:flex"><a href="{{ route('home') }}" class="text-2xl font-extrabold">≋ FanIoT</a><div><p class="text-sm font-bold uppercase tracking-[.25em] text-blue-100">Smart fan monitoring</p><h1 class="mt-5 text-5xl font-extrabold leading-tight">Kontrol suhu.<br>Lebih cerdas.</h1><p class="mt-5 max-w-md text-lg leading-8 text-blue-50">Masuk untuk mengelola perangkat kipas dan melihat data pemantauanmu.</p></div><p class="text-sm text-blue-100">FanIoT · Internet of Things</p></section>
 <section class="flex items-center justify-center px-6 py-12"><div class="w-full max-w-md"><a href="{{ route('home') }}" class="font-bold text-blue-600">← Kembali ke beranda</a><div class="mt-10"><h2 class="text-3xl font-extrabold">Selamat datang</h2><p class="mt-2 text-slate-500">Masuk ke akun FanIoT kamu.</p></div>
 @if($errors->any())<div class="mt-5 rounded-xl bg-red-50 p-3 text-sm text-red-700">{{ $errors->first() }}</div>@endif
 <form method="POST" action="{{ route('login.store') }}" class="mt-7 space-y-5">@csrf
 <div><label class="mb-2 block text-sm font-semibold">Email</label><input class="field" type="email" name="email" value="{{ old('email') }}" autocomplete="email" required></div>
 <div><label class="mb-2 block text-sm font-semibold">Kata sandi</label><div class="relative"><input id="password" class="field pr-20" type="password" name="password" autocomplete="current-password" required><button type="button" onclick="togglePassword('password',this)" class="absolute right-3 top-3 text-sm font-semibold text-blue-600">Lihat</button></div></div>
 <label class="flex items-center gap-2 text-sm text-slate-600"><input type="checkbox" name="remember" class="rounded border-slate-300"> Ingat saya</label>
 <button class="w-full rounded-xl bg-blue-600 py-3.5 font-bold text-white shadow-lg shadow-blue-100 hover:bg-blue-700">Masuk</button></form>
 <p class="mt-6 text-center text-sm text-slate-500">Belum punya akun? <a class="font-bold text-blue-600" href="{{ route('register') }}">Daftar sekarang</a></p></div></section></div>
@endsection
@push('scripts')<script>function togglePassword(id,btn){const input=document.getElementById(id);const visible=input.type==='password';input.type=visible?'text':'password';btn.textContent=visible?'Sembunyikan':'Lihat';}</script>@endpush
