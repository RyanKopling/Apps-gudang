<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Barang Baru</title>
    <link href="../aset/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Tambah Barang Baru</h2>
        <form action="proses_tambah_inventory.php" method="post">
            <div class="mb-3">
                <label for="nama_brg" class="form-label">Nama Barang:</label>
                <input type="text" class="form-control" id="nama_brg" name="nama_brg" value="">
            </div>
            <div class="mb-3">
                <label for="jenis_brg" class="form-label">Nama Jenis:</label>
                <input type="text" class="form-control" id="jenis_brg" name="jenis_brg" value="">
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">Harga Barang:</label>
                <input type="text" class="form-control" id="harga" name="harga" value="">
            </div>
            <div class="mb-3">
                <label for="jml_stok" class="form-label">Jumlah Stok:</label>
                <input type="text" class="form-control" id="jml_stok" name="jml_stok" value="">
            </div>
            <div class="mb-3">
                <label for="id_gudang" class="form-label">Lokasi Gudang:</label>
                <select name="id_gudang" class="form-select">
                    <option value="" disabled selected>Pilih Lokasi Gudang</option>
                    <?php
                    include "koneksi.php";
                    $query = mysqli_query($koneksi,"SELECT * FROM storage");
                    while($data = mysqli_fetch_array($query)){
                        echo '<option value="'.$data['id_gudang'].'">'.$data['lokasi_gudang'].'</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="barcode" class="form-label">Barcode:</label>
                <input type="text" class="form-control" id="barcode" name="barcode" value="">
            </div>
            <div class="mb-3">
                <label for="id_vendor" class="form-label">Nama Vendor:</label>
                <select name="id_vendor" class="form-select">
                    <option value="" disabled selected>Pilih Nama Vendor</option>
                    <?php
                    include "koneksi.php";
                    $query = mysqli_query($koneksi,"SELECT * FROM vendor");
                    while($data = mysqli_fetch_array($query)){
                        echo '<option value="'.$data['id_vendor'].'">'.$data['nama_vendor'].'</option>';
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary" name="submit" value="submit">Tambah</button>
        </form>
    </div>
    <script src="../aset/bootstrap.bundle.min.js"></script>
</body>
</html>
