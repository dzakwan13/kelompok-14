@extends('layouts.app')

@section('title', 'Detail Perangkat - StayCool')

@section('page-heading', 'Detail Perangkat')

@section('content')

    <div class="section-heading">
        <div>
            <h2>{{ $fan->name }}</h2>
            <p>Informasi lengkap perangkat kipas.</p>
        </div>

        <a href="{{ route('fans.index') }}" class="btn-secondary">
            Kembali
        </a>
    </div>

    <div class="fan-form-card">

        <h3>Informasi Perangkat</h3>

        <p>Nama Kipas: {{ $fan->name }}</p>

        <p>ID Perangkat: {{ $fan->device_id }}</p>

        <p>Status: {{ $fan->status }}</p>

        <p>
            Mode:
            {{ ucfirst($fan->setting?->mode ?? 'Belum diatur') }}
        </p>

        <p>Kecepatan Saat Ini: {{ $fan->speed }}%</p>

        <p>Suhu Saat Ini: -</p>

        <hr>

        @if ($fan->setting?->mode === 'otomatis')

            <h3>Aturan Kecepatan Otomatis</h3>

            <p>
                Kipas akan menyesuaikan kecepatannya berdasarkan
                suhu yang terdeteksi oleh sensor.
                Setiap aturan berlaku ketika suhu mencapai atau
                melewati batas yang ditentukan.
            </p>

            @if ($fan->setting->speedRules->isNotEmpty())

                <table class="fan-table">
                    <thead>
                        <tr>
                            <th>Batas Suhu</th>
                            <th>Kecepatan Kipas</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($fan->setting->speedRules->sortBy('temperature_threshold') as $rule)
                            <tr>
                                <td>
                                    {{ $rule->temperature_threshold }}°C
                                </td>
                                <td>
                                    {{ $rule->fan_speed }}%
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <p>
                    Jika suhu berada di bawah aturan pertama,
                    kipas akan mati.
                </p>

            @else

                <p>Belum ada aturan kecepatan otomatis.</p>

            @endif

        @elseif ($fan->setting?->mode === 'manual')

            <h3>Pengaturan Manual</h3>

            <p>
                Kecepatan yang diatur pengguna:
                {{ $fan->setting->speed }}%
            </p>

        @else

            <p>Pengaturan kipas belum tersedia.</p>

        @endif

        <div class="form-actions">
            <a href="{{ route('fans.edit', $fan->id) }}"
               class="btn-primary">
                Edit Perangkat
            </a>
        </div>

    </div>

@endsection
