<!DOCTYPE html>
<html>
<head>
    <title>Data Pegawai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">

    <h2>Daftar Pegawai</h2>
    <a href="{{ route('employees.create') }}" class="btn btn-primary mb-3">Tambah Pegawai</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nomor</th>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Tanggal Lahir</th>
                <th>Foto</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employees as $emp)
            <tr>
                <td>{{ $emp->nomor }}</td>
                <td>{{ $emp->nama }}</td>
                <td>{{ $emp->jabatan }}</td>
                <td>{{ $emp->talahir }}</td>
                <td>
                    @if($emp->photo_upload_path)
                        <img src="{{ $emp->photo_upload_path }}" alt="Foto" width="70">
                    @else
                        -
                    @endif
                </td>
                <td>
                    <a href="{{ route('employees.edit', $emp->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('employees.destroy', $emp->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
