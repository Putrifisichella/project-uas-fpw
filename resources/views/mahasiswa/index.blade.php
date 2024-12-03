<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
</head>
<body>
    <h1>Data Mahasiswa</h1>

    <!-- Form Tambah Data -->
    <form action="{{ route('mahasiswa.store') }}" method="POST">
        @csrf
        <input type="text" name="npm" placeholder="NPM" required>
        <input type="text" name="nama" placeholder="Nama" required>
        <input type="text" name="prodi" placeholder="Prodi" required>
        <button type="submit">Simpan</button>
    </form>

    <!-- Tabel Data Mahasiswa -->
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>NPM</th>
                <th>Nama</th>
                <th>Prodi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mahasiswa as $m)
                <tr>
                    <td>{{ $m->id }}</td>
                    <td>{{ $m->npm }}</td>
                    <td>{{ $m->nama }}</td>
                    <td>{{ $m->prodi }}</td>
                    <td>
                        <form action="{{ route('mahasiswa.destroy', $m->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
