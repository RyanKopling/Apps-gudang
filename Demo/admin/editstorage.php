<?php
include "koneksi.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_storage = $_POST['id_gudang'];
    $nama_gudang = $_POST['nama_gudang'];
    $lokasi_gudang = $_POST['lokasi_gudang'];

    $sql = "UPDATE storage SET nama_gudang='$nama_gudang', lokasi_gudang='$lokasi_gudang' WHERE id_gudang='$id_storage'";

    if ($koneksi ->query($sql) === TRUE) {
        echo "<script>alert('Sukses Mengubah Gudang Baru');location.href='index.php';</script>";
    } else {
        echo "Error updating record: " . $koneksi->error;
    }

    $koneksi->close();
 } else {
    $id_storage = $_GET['id'];
    $sql = "SELECT * FROM storage WHERE id_gudang='$id_storage'";
    $result = $koneksi->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Record not found!";
    }
 }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Gudang</title>
    <link href="../aset/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h3 class="mb-4">Edit Gudang</h3>
        <form action="editstorage.php" method="post">
            <input type="hidden" name="id_gudang" value="<?php echo htmlspecialchars($row['id_gudang']); ?>">
            <div class="mb-3">
                <label for="nama_gudang" class="form-label">Nama Gudang:</label>
                <input type="text" class="form-control" id="nama_gudang" name="nama_gudang" value="<?php echo htmlspecialchars($row['nama_gudang']); ?>">
            </div>
            <div class="mb-3">
                <label for="lokasi_gudang" class="form-label">Lokasi Gudang:</label>
                <input type="text" class="form-control" id="lokasi_gudang" name="lokasi_gudang" value="<?php echo htmlspecialchars($row['lokasi_gudang']); ?>">
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Edit</button>
            <a class="btn btn-sm btn-danger" href="index.php">Cancel</a>
        </form>
    </div>
    <script src="../aset/bootstrap.bundle.min.js"></script>
</body>
</html>