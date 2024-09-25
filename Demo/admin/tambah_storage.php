<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Gudang Baru</title>
    <link href="../aset/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Tambah Gudang Baru</h2>
        <form action="proses_tambah_storage.php" method="post">
            <div class="mb-3">
                <label for="nama_gudang" class="form-label">Nama Gudang:</label>
                <input type="text" class="form-control" id="nama_gudang" name="nama_gudang" value="">
            </div>
            <div class="mb-3">
                <label for="lokasi_gudang" class="form-label">Lokasi Gudang:</label>
                <input type="text" class="form-control" id="lokasi_gudang" name="lokasi_gudang" value="">
            </div>
            <button type="submit" class="btn btn-primary" name="submit" value="submit">Tambah</button>
        </form>
    </div>
    <script src="../aset/bootstrap.bundle.min.js"></script>
</body>
</html>
