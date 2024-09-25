<?php
if($_POST){
    $nama_barang = $_POST['nama_brg'];
    $jenis_barang = $_POST['jenis_brg'];
    $kuantitas_stok = $_POST['jml_stok'];
    $barcode = $_POST['barcode'];
    $id_vendor = $_POST['id_vendor'];
    $harga_barang = $_POST['harga'];
    $id_storage = $_POST['id_gudang'];
    if(empty($nama_barang)){
        echo "<script>alert('Nama Barang Tidak Boleh Kosong');location.href='tambah_inventory.php';</script>";
    } elseif(empty($jenis_barang)){
        echo "<script>alert('Jenis Barang Tidak Boleh Kosong');location.href='tambah_inventory.php';</script>";
    } elseif (empty($kuantitas_stok)){
        echo "<script>alert('Kuantitas Stok Tidak Boleh Kosong');location.href='tambah_inventory.php';</script>";
    } elseif (empty($barcode)){
        echo "<script>alert('Barcode Tidak Boleh Kosong');location.href='tambah_inventory.php';</script>";
    } elseif (empty($harga_barang)){
        echo "<script>alert('Harga Barang Tidak Boleh Kosong');location.href='tambah_inventory.php';</script>";
    }else {
        include "koneksi.php";
        $insert = mysqli_query($koneksi,"INSERT INTO inventory (nama_brg, jenis_brg, jml_stok , barcode, id_vendor, harga, id_gudang) value
        ('".$nama_barang."','".$jenis_barang."','".$kuantitas_stok."','".$barcode."','".$id_vendor."', '".$harga_barang."', '".$id_storage."')")
        or die(mysqli_error($koneksi));
        if($insert){
            echo "<script>alert('Sukses Menambahkan Barang Baru');location.href='index.php';</script>";
        } else {
            "<script>alert('Gagal Menambahkan Barang Baru');location.href='index.php';</script>";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Barang Baru</title>
    <link href="../aset/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Tambah Barang Baru</h2>
        <form action="prosesinven.php" method="post">
            <div class="mb-3">
                <label for="id_vendor" class="form-label">Nama Vendor:</label>
                <select name="id_vendor" class="form-select" id="id_vendor">
                    <option value="" disabled selected>Pilih Nama Vendor</option>
                    <?php
                    include "koneksi.php";
                    $query = mysqli_query($koneksi, "SELECT * FROM vendor");
                    while ($data = mysqli_fetch_array($query)) {
                        echo '<option value="' . $data['id_vendor'] . '">' . $data['nama_vendor'] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="nama_brgg" class="form-label">Nama Barang Vendor:</label>
                <input type="text" class="form-control" id="nama_brgg" name="nama_brg" readonly>
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
                    $query = mysqli_query($koneksi, "SELECT * FROM storage");
                    while ($data = mysqli_fetch_array($query)) {
                        echo '<option value="' . $data['id_gudang'] . '">' . $data['lokasi_gudang'] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="barcode" class="form-label">Barcode:</label>
                <input type="text" class="form-control" id="barcode" name="barcode" value="">
            </div>
            <button type="submit" class="btn btn-primary" name="submit" value="submit">Tambah</button>
            <a class="btn btn-sm btn-danger" href="index.php">Cancel</a>
        </form>
    </div>
    <script src="../aset/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('id_vendor').addEventListener('change', function() {
            var id_vendor = this.value;
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'get_barang.php?id_vendor=' + id_vendor, true);
            xhr.onload = function() {
                if (this.status == 200) {
                    var response = JSON.parse(this.responseText);
                    document.getElementById('nama_brgg').value = response.nama_brgg;
                }
            };
            xhr.send();
        });
    </script>
</body>
</html>
