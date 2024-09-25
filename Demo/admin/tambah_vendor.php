<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Vendor </title>
    <link href="../aset/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Tambah Vendor / Supplier Baru</h2>
        <form action="proses_tambah_vendor.php" method="post">
            <div class="mb-3">
                <label for="nama_vendor" class="form-label">Nama Vendor:</label>
                <input type="text" class="form-control" id="nama_vendor" name="nama_vendor" value="">
            </div>
            <div class="mb-3">
                <label for="kontak" class="form-label">Kontak:</label>
                <input type="text" class="form-control" id="kontak" name="kontak" value="">
            </div>
            <div class="mb-3">
                <label for="nama_brgg" class="form-label">Nama Barang:</label>
                <input type="text" class="form-control" id="nama_brgg" name="nama_brgg" value="">
            </div>
            <button type="submit" class="btn btn-primary" name="submit" value="submit">Tambah</button>
        </form>
    </div>
    <script src="../aset/bootstrap.bundle.min.js"></script>
</body>
</html>
