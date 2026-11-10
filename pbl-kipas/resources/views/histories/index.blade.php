
@extends('layouts.app')

@section('title', 'Riwayat Kipas - StayCool')

@section('page-heading', 'Riwayat Kipas')

@section('content')

    <div class="section-heading">
        <div>
            <h2>Riwayat Aktivitas Kipas</h2>
            <p>Catatan suhu, status, dan kecepatan perangkat kipas.</p>
        </div>
    </div>

    <div class="fan-form-card">

        <h3>Daftar Riwayat</h3>

        @if ($histories->isNotEmpty())

            <table class="fan-table">
                <thead>
                    <tr>
                        <th>Waktu</th>
                        <th>Nama Kipas</th>
                        <th>Suhu</th>
                        <th>Status</th>
                        <th>Kecepatan</th>
                        <th>Jenis Data</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($histories as $history)
                        <tr>
                            <td>
                                {{ $history->created_at->format('d/m/Y H:i:s') }}
                            </td>

                            <td>
                                {{ $history->fan?->name ?? 'Perangkat tidak tersedia' }}
                            </td>

                            <td>
                                {{ $history->temperature }}°C
                            </td>

                            <td>
                                {{ $history->status }}
                            </td>

                            <td>
                                {{ $history->speed }}%
                            </td>

                            <td>
                                @if ($history->is_simulated)
                                    <span>SIMULASI</span>
                                @else
                                    <span>ASLI</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            
            <div class="pagination-wrapper">

                @if ($histories->onFirstPage())
                    <span class="pagination-link disabled">
                        Sebelumnya
                    </span>
                @else
                    <a href="{{ $histories->previousPageUrl() }}"
                    class="pagination-link">
                        Sebelumnya
                    </a>
                @endif

                <span class="pagination-info">
                    Halaman {{ $histories->currentPage() }}
                    dari {{ $histories->lastPage() }}
                </span>

                @if ($histories->hasMorePages())
                    <a href="{{ $histories->nextPageUrl() }}"
                    class="pagination-link">
                        Berikutnya
                    </a>
                @else
                    <span class="pagination-link disabled">
                        Berikutnya
                    </span>
                @endif

            </div>


        @else

            <p>Belum ada riwayat aktivitas kipas.</p>

            <p>
                Riwayat akan muncul setelah perangkat mulai mengirimkan
                data suhu dan status kipas.
            </p>

        @endif

    </div>

@endsection
