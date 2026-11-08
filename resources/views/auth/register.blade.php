@extends('layouts.app')
@section('title','Daftar')
@section('content')
<div class="grid min-h-screen lg:grid-cols-2">
 <section class="hidden flex-col justify-between bg-gradient-to-br from-blue-700 via-blue-600 to-cyan-500 p-12 text-white lg:flex"><a href="{{ route('home') }}" class="text-2xl font-extrabold">≋ FanIoT</a><div><p class="text-sm font-bold uppercase tracking-[.25em] text-blue-100">Mulai sekarang</p><h1 class="mt-5 text-5xl font-extrabold leading-tight">Semua kipas.<br>Satu pusat pantau.</h1><p class="mt-5 max-w-md text-lg leading-8 text-blue-50">Buat akun untuk membuka dashboard monitoring FanIoT.</p></div><p class="text-sm text-blue-100">FanIoT · Internet of Things</p></section>
 <section class="flex items-center justify-center px-6 py-12"><div class="w-full max-w-md"><a href="{{ route('home') }}" class="font-bold text-blue-600">← Kembali ke beranda</a><div class="mt-8"><h2 class="text-3xl font-extrabold">Buat akun</h2><p class="mt-2 text-slate-500">Isi data berikut untuk mulai menggunakan FanIoT.</p></div>
 @if($errors->any())<div class="mt-4 rounded-xl bg-red-50 p-3 text-sm text-red-700"><ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
 <form method="POST" action="{{ route('register.store') }}" class="mt-6 space-y-4">@csrf
 <div><label class="mb-2 block text-sm font-semibold">Nama lengkap</label><input class="field" name="name" value="{{ old('name') }}" autocomplete="name" required></div>
 <div><label class="mb-2 block text-sm font-semibold">Email</label><input class="field" type="email" name="email" value="{{ old('email') }}" autocomplete="email" required></div>
 <div><label class="mb-2 block text-sm font-semibold">Kata sandi (minimal 8 karakter)</label><div class="relative"><input id="password" class="field pr-20" type="password" name="password" autocomplete="new-password" required minlength="8"><button type="button" onclick="togglePassword('password',this)" class="absolute right-3 top-3 text-sm font-semibold text-blue-600">Lihat</button></div></div>
 <div><label class="mb-2 block text-sm font-semibold">Konfirmasi kata sandi</label><div class="relative"><input id="password_confirmation" class="field pr-20" type="password" name="password_confirmation" autocomplete="new-password" required minlength="8"><button type="button" onclick="togglePassword('password_confirmation',this)" class="absolute right-3 top-3 text-sm font-semibold text-blue-600">Lihat</button></div></div>
 <button class="mt-2 w-full rounded-xl bg-blue-600 py-3.5 font-bold text-white shadow-lg shadow-blue-100 hover:bg-blue-700">Daftar akun</button></form>
 <p class="mt-5 text-center text-sm text-slate-500">Sudah punya akun? <a class="font-bold text-blue-600" href="{{ route('login') }}">Masuk</a></p></div></section></div>
@endsection
@push('scripts')<script>function togglePassword(id,btn){const input=document.getElementById(id);const visible=input.type==='password';input.type=visible?'text':'password';btn.textContent=visible?'Sembunyikan':'Lihat';}</script>@endpush
