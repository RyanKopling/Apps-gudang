<?php
include "koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_brg = $_POST['id_brg'];
    $nama_brg = $_POST['nama_brg'];
    $jenis_brg = $_POST['jenis_brg'];
    $harga = $_POST['harga'];
    $jml_stok = $_POST['jml_stok'];
    $lokasi = $_POST['id_gudang'];
    $barcode = $_POST['barcode'];
    $ven = $_POST['id_vendor'];

    $sql = "UPDATE inventory SET
            nama_brg = '$nama_brg',
            jenis_brg = '$jenis_brg',
            harga = '$harga',
            jml_stok = '$jml_stok',
            id_gudang = '$lokasi',
            barcode = '$barcode',
            id_vendor = '$ven'
            WHERE id_brg = '$id_brg'";
        
    if ($koneksi->query($sql) === TRUE) {
        echo "<script>alert('Sukses Mengubah Barang Baru');location.href='index.php';</script>";
        exit(); 
    } else {
        echo "Error updating record: " . $koneksi->error;
    }

    $koneksi->close();
} else {
    $id_brg = $_GET['id'];
    $sql = "SELECT * FROM inventory WHERE id_brg='$id_brg'";
    $result = $koneksi->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Record not found!";
        exit(); 
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Inventory</title>
    <link href="../aset/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h3 class="mb-4">Edit Inventory</h3>
        <form action="editinven.php" method="post">
            <input type="hidden" name="id_brg" value="<?php echo htmlspecialchars($row['id_brg']); ?>">

            <div class="mb-3">
                <label for="nama_brg" class="form-label">Nama Barang:</label>
                <input type="text" class="form-control" id="nama_brg" name="nama_brg" value="<?php echo htmlspecialchars($row['nama_brg']); ?>">
            </div>

            <div class="mb-3">
                <label for="jenis_brg" class="form-label">Nama Jenis:</label>
                <input type="text" class="form-control" id="jenis_brg" name="jenis_brg" value="<?php echo htmlspecialchars($row['jenis_brg']); ?>">
            </div>

            <div class="mb-3">
                <label for="harga" class="form-label">Harga Barang:</label>
                <input type="text" class="form-control" id="harga" name="harga" value="<?php echo htmlspecialchars($row['harga']); ?>">
            </div>

            <div class="mb-3">
                <label for="jml_stok" class="form-label">Jumlah Stok:</label>
                <input type="text" class="form-control" id="jml_stok" name="jml_stok" value="<?php echo htmlspecialchars($row['jml_stok']); ?>">
            </div>

            <div class="mb-3">
                <label for="id_gudang" class="form-label">Lokasi Gudang:</label>
                <?php
                include "koneksi.php";
                
               
                $id_gudang_terpilih = htmlspecialchars($row['id_gudang']);
                
   
                $query = mysqli_query($koneksi, "SELECT * FROM storage");
                ?>
                <select name="id_gudang" class="form-select">
                    <option value="" disabled>Pilih Lokasi Gudang</option>
                    <?php
                    while ($data = mysqli_fetch_array($query)) {
                      
                        $selected = ($data['id_gudang'] == $id_gudang_terpilih) ? 'selected' : '';
                        echo '<option value="'.$data['id_gudang'].'" '.$selected.'>'.$data['lokasi_gudang'].'</option>';
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="barcode" class="form-label">Barcode:</label>
                <input type="text" class="form-control" id="barcode" name="barcode" value="<?php echo htmlspecialchars($row['barcode']); ?>">
            </div>

            <div class="mb-3">
                <label for="id_vendor" class="form-label">Nama Vendor:</label>
                <?php
               
                $id_vendor_terpilih = htmlspecialchars($row['id_vendor']);
                

                $query = mysqli_query($koneksi, "SELECT * FROM vendor");
                ?>
                <select name="id_vendor" class="form-select">
                    <option value="" disabled>Pilih Nama Vendor</option>
                    <?php
                    while ($data = mysqli_fetch_array($query)) {
                       
                        $selected = ($data['id_vendor'] == $id_vendor_terpilih) ? 'selected' : '';
                        echo '<option value="'.$data['id_vendor'].'" '.$selected.'>'.$data['nama_vendor'].'</option>';
                    }
                    ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary" name="submit">Edit</button>
            <a class="btn btn-sm btn-danger" href="index.php">Cancel</a>
        </form>
    </div>
    <script src="../aset/bootstrap.bundle.min.js"></script>
</body>
</html>
