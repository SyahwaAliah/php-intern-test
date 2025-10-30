<!DOCTYPE html>
<html>
<head>
    <title>Edit Pegawai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">

    <h2>Edit Pegawai</h2>

    <form action="{{ route('employees.update', $employee->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nomor</label>
            <input type="text" name="nomor" value="{{ $employee->nomor }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" value="{{ $employee->nama }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Jabatan</label>
            <input type="text" name="jabatan" value="{{ $employee->jabatan }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Tanggal Lahir</label>
            <input type="date" name="talahir" value="{{ $employee->talahir }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Foto Saat Ini</label><br>
            @if($employee->photo_upload_path)
                <img src="{{ $employee->photo_upload_path }}" width="100"><br><br>
            @else
                Tidak ada foto
            @endif
            <input type="file" name="photo" class="form-control mt-2">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('employees.index') }}" class="btn btn-secondary">Kembali</a>
    </form>

</body>
</html>
