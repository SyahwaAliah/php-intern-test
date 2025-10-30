<!DOCTYPE html>
<html>
<head>
    <title>Tambah Pegawai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">

    <h2>Tambah Pegawai</h2>

    <form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Nomor</label>
            <input type="text" name="nomor" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Jabatan</label>
            <input type="text" name="jabatan" class="form-control">
        </div>

        <div class="mb-3">
            <label>Tanggal Lahir</label>
            <input type="date" name="talahir" class="form-control">
        </div>

        <div class="mb-3">
            <label>Foto</label>
            <input type="file" name="photo" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('employees.index') }}" class="btn btn-secondary">Kembali</a>
    </form>

</body>
</html>
