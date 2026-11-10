<div class="fan-table-wrapper">
    <table class="fan-table">
        <thead>
            <tr>
                <th>Nama Kipas</th>
                <th>ID Perangkat</th>
                <th>Suhu</th>
                <th>Mode</th>
                <th>Status</th>
                <th>Kecepatan</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($fans as $fan)
                <tr>
                    <td>{{ $fan->name }}</td>
                    <td>{{ $fan->device_id }}</td>
                    <td>-</td>
                    <td>{{ $fan->setting?->mode ?? 'Belum diatur' }}</td>
                    <td>{{ $fan->status }}</td>
                    <td>{{ $fan->speed }}%</td>
                    <td>
                        <a href="{{ route('fans.show', $fan->id) }}"
                        class="btn-primary">
                            Detail
                        </a>
                        
                        <a href="{{ route('fans.edit', $fan->id) }}" class="btn-secondary">
                            Edit
                        </a>

                        <form action="{{ route('fans.destroy', $fan->id) }}"
                            method="POST"
                            style="display: inline;"
                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus perangkat ini?')">

                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn-danger">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>