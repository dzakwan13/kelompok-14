
@extends('layouts.app')

@section('title', 'Perangkat Kipas - StayCool')

@section('page-heading', 'Perangkat Kipas')

@section('content')

    <div class="section-heading">
        <div>
            <h2>Daftar Perangkat</h2>
            <p>Kelola seluruh perangkat kipas yang terhubung.</p>
        </div>

        <a href="{{ route('fans.create') }}" class="btn-primary">
            + Tambah Perangkat
        </a>
    </div>

    @if (session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    @include('dashboard.partials.fan-table')

@endsection