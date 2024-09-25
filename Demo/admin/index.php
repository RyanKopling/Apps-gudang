<?php
$kon = mysqli_connect("localhost", "root", "", "test");

if (!$kon) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$cek = "SELECT * FROM inventory WHERE jml_stok <= 0";
$hasil = mysqli_query($kon, $cek);
$tampilkanAlert = (mysqli_num_rows($hasil) > 0);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link href="../aset/bootstrap.min.css" rel="stylesheet">
    <style>
        .nav-link.active {
            background-color: lightgray; 
        }
        .nav-link:hover {
            background-color: #6c757d;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar" style="height: 100vh;">
                <div class="position-sticky pt-3">
                    <h3 class="text-center text-white py-3 bg-primary">Dashboard</h3>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active text-dark" aria-current="page" href="#inventory" data-bs-toggle="tab">Inventory</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="#storage" data-bs-toggle="tab">Storage</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="#vendor" data-bs-toggle="tab">Vendor</a>
                        </li>
                        <li class="nav-item mt-4">
                            <a class="nav-link text-danger" href="../logout.php">Logout</a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2 text-primary">Selamat Datang</h1>
                    <form method="get" class="d-flex w-20">
                        <input type="text" class="form-control me-2" name="search" placeholder="Cari" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                        <button class="btn btn-sm btn-outline-secondary" type="submit">Telusuri</button>
                    </form>
                </div>

                <div class="tab-content">
                    <div class="tab-pane fade show active" id="inventory">
                        <h2 class="text-secondary">Inventory</h2>
                        <table class="table table-striped table-hover table-bordered">
                            <thead class="table-primary">
                                <tr>
                                    <th>Id Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Jenis Barang</th>
                                    <th>Harga</th>
                                    <th>Jumlah Stok</th>
                                    <th>Barcode</th>
                                    <th>Lokasi Gudang</th>
                                    <th>Nama Vendor</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $search = isset($_GET['search']) ? mysqli_real_escape_string($kon, $_GET['search']) : '';
                                $qry = "SELECT * FROM inventory 
                                        INNER JOIN vendor ON inventory.id_vendor = vendor.id_vendor
                                        INNER JOIN storage ON inventory.id_gudang = storage.id_gudang
                                        WHERE inventory.nama_brg LIKE '%$search%' OR
                                              inventory.jenis_brg LIKE '%$search%' OR
                                              vendor.nama_vendor LIKE '%$search%'";

                                $hsl = mysqli_query($kon, $qry);

                                if (!$hsl) {
                                    die("Query gagal: " . mysqli_error($kon));
                                }
                                while ($dt = mysqli_fetch_assoc($hsl)) {
                                    echo "<tr>";
                                    echo "<td>{$dt['id_brg']}</td>";
                                    echo "<td>{$dt['nama_brg']}</td>";
                                    echo "<td>{$dt['jenis_brg']}</td>";
                                    echo "<td>{$dt['harga']}</td>";
                                    echo "<td>{$dt['jml_stok']}</td>";
                                    echo "<td>{$dt['barcode']}</td>";
                                    echo "<td>{$dt['lokasi_gudang']}</td>";
                                    echo "<td>{$dt['nama_vendor']}</td>";
                                    echo "<td>
                                        <button class='btn btn-success'><a href='editinven.php?id={$dt['id_brg']}' class='text-white'>Edit</a></button>
                                        <button class='btn btn-danger'><a class='text-white' href='hapusinven.php?id={$dt['id_brg']}' onclick='return confirm(\"Apakah Anda yakin?\")'>Delete</a></button>
                                    </td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                        <button class="btn btn-sm btn-primary" type="button"><a class="text-white" href="prosesinven.php">Tambah</a></button>
                    </div>

                    <div class="tab-pane fade" id="storage">
                        <h2 class="text-secondary">Storage</h2>
                        <table class="table table-striped table-hover table-bordered">
                            <thead class="table-primary">
                                <tr>
                                    <th>Id Gudang</th>
                                    <th>Nama Gudang</th>
                                    <th>Lokasi Gudang</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $qry = "SELECT * FROM storage 
                                        WHERE nama_gudang LIKE '%$search%' OR
                                              lokasi_gudang LIKE '%$search%'";

                                $hsl = mysqli_query($kon, $qry);

                                if (!$hsl) {
                                    die("Query gagal: " . mysqli_error($kon));
                                }
                                while ($dt = mysqli_fetch_assoc($hsl)) {
                                    echo "<tr>";
                                    echo "<td>{$dt['id_gudang']}</td>";
                                    echo "<td>{$dt['nama_gudang']}</td>";
                                    echo "<td>{$dt['lokasi_gudang']}</td>";
                                    echo "<td>
                                        <button class='btn btn-success'><a href='editstorage.php?id={$dt['id_gudang']}' class='text-white'>Edit</a></button>
                                        <button class='btn btn-danger'><a class='text-white' href='hapusstorage.php?id={$dt['id_gudang']}' onclick='return confirm(\"Apakah Anda yakin?\")'>Delete</a></button>
                                    </td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                        <button class="btn btn-sm btn-primary" type="button"><a class="text-white" href="prosesstorage.php">Tambah</a></button>
                    </div>

                    <div class="tab-pane fade" id="vendor">
                        <h2 class="text-secondary">Vendor</h2>
                        <table class="table table-striped table-hover table-bordered">
                            <thead class="table-primary"> 
                                <tr>
                                    <th>Id Vendor</th>
                                    <th>Nama Vendor</th>
                                    <th>Kontak</th>
                                    <th>Nama Barang</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $qry = "SELECT * FROM vendor 
                                        WHERE nama_vendor LIKE '%$search%' OR
                                              kontak LIKE '%$search%'";

                                $hsl = mysqli_query($kon, $qry);

                                if (!$hsl) {
                                    die("Query gagal: " . mysqli_error($kon));
                                }
                                while ($dt = mysqli_fetch_assoc($hsl)) {
                                    echo "<tr>";
                                    echo "<td>{$dt['id_vendor']}</td>";
                                    echo "<td>{$dt['nama_vendor']}</td>";
                                    echo "<td>{$dt['kontak']}</td>";
                                    echo "<td>{$dt['nama_brgg']}</td>";
                                    echo "<td>
                                        <button class='btn btn-success'><a href='editvendor.php?id={$dt['id_vendor']}' class='text-white'>Edit</a></button>
                                        <button class='btn btn-danger'><a class='text-white' href='hapusvendor.php?id={$dt['id_vendor']}' onclick='return confirm(\"Apakah Anda yakin?\")'>Delete</a></button>
                                    </td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                        <button class="btn btn-sm btn-primary" type="button"><a class="text-white" href="prosesvendor.php">Tambah</a></button>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <footer class="text-center text-muted p-2 bg-dark">
        <div class="container">
            <p class="text-white">&copy; Pt. Bismillah 2024. All rights reserved.</p>
        </div>
    </footer>

    <?php if ($tampilkanAlert): ?>
        <script>
            alert("Stok barang ada yang mencapai nol. Harap periksa!");
        </script>
    <?php endif; ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../aset/bootstrap.bundle.min.js"></script>
</body>
</html>
