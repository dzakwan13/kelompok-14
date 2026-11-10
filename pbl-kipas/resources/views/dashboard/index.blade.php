
@extends('layouts.app')

@section('title', 'Dashboard - StayCool')
@section('page-heading', 'Dashboard')

@section('content')

    <div class="welcome-section">
        <h2>Selamat datang!</h2>
        <p>Berikut ringkasan kondisi perangkat kipas Anda.</p>
    </div>

    <div class="summary-grid">

        <div class="summary-card">
            <span class="summary-label">Total Kipas</span>
            <h2>{{ $totalFans }}</h2>
            <p>Perangkat terdaftar</p>
        </div>

        <div class="summary-card">
            <span class="summary-label">Kipas Menyala</span>
            <h2>{{ $runningFans }}</h2>
            <p>{{ $offFans }} kipas sedang mati</p>
        </div>

        <div class="summary-card">
            <span class="summary-label">Suhu Rata-rata</span>
            <h2>-</h2>
            <p>Menunggu data sensor</p>
        </div>

    </div>

    <div class="section-heading">
        <h3>Perangkat Saya</h3>

        <a href="{{ route('fans.create') }}" class="btn-primary">
            + Tambah Kipas
        </a>
    </div>

    <div class="view-controls">
        <span>Pilih Tampilan:</span>

        <button type="button"
                id="tableViewBtn"
                class="view-btn active"
                onclick="showFanView('table')">
            Tampilan Tabel
        </button>

        <button type="button"
                id="cardViewBtn"
                class="view-btn"
                onclick="showFanView('card')">
            Tampilan Kartu
        </button>
    </div>

    <div id="tableView">
        @include('dashboard.partials.fan-table')
    </div>

    <div id="cardView" style="display: none;">
        @include('dashboard.partials.fan-cards')
    </div>

    <script>
        function showFanView(view) {
            const tableView = document.getElementById('tableView');
            const cardView = document.getElementById('cardView');

            const tableButton = document.getElementById('tableViewBtn');
            const cardButton = document.getElementById('cardViewBtn');

            if (view === 'table') {
                tableView.style.display = 'block';
                cardView.style.display = 'none';

                tableButton.classList.add('active');
                cardButton.classList.remove('active');
            } else {
                tableView.style.display = 'none';
                cardView.style.display = 'block';

                cardButton.classList.add('active');
                tableButton.classList.remove('active');
            }
        }
    </script>

@endsection
