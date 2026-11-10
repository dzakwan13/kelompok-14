
<div class="fan-grid">
    @forelse ($fans as $fan)
        <div class="fan-card"
             onclick="window.location='{{ route('fans.show', $fan->id) }}'"
             style="cursor: pointer;">

            <div class="fan-card-header">
                <h3>{{ $fan->name }}</h3>
                <span>{{ $fan->status }}</span>
            </div>

            <p>ID Perangkat: {{ $fan->device_id }}</p>

            <div class="fan-temperature">
                - °C
            </div>

            <p>
                Mode:
                {{ $fan->setting?->mode ?? 'Belum diatur' }}
            </p>

            <p>
                Batas Suhu:
                @if ($fan->setting?->mode === 'otomatis')
                    {{ $fan->setting->temperature_limit }}°C
                @elseif ($fan->setting?->mode === 'manual')
                    Tidak digunakan
                @else
                    -
                @endif
            </p>

            <p>Kecepatan: {{ $fan->speed }}%</p>

            <div class="fan-card-actions"
                 onclick="event.stopPropagation()">

                <a href="{{ route('fans.edit', $fan->id) }}"
                   class="btn-secondary">
                    Edit
                </a>

                <form action="{{ route('fans.destroy', $fan->id) }}"
                      method="POST"
                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus perangkat ini?')">

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn-danger">
                        Hapus
                    </button>
                </form>
            </div>
        </div>

    @empty
        <p>Belum ada perangkat kipas yang terdaftar.</p>
    @endforelse
</div>
