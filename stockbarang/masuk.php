<?php
require 'function.php';
require 'cek.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Barang Masuk</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.php">STOCK BARANG</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <a class="nav-link" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Stock Barang
                        </a>
                        <a class="nav-link" href="masuk.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Barang Masuk
                        </a>
                        <a class="nav-link" href="keluar.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Barang Keluar
                        </a>
                        <a class="nav-link" href="logout.php">
                            Logout
                        </a>
                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Barang Masuk</h1>
                    <div class="card mb-4">
                        <div class="card-header">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                                Tambah Barang
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Nama Barang</th>
                                            <th>Jumlah</th>
                                            <th>Pemasok</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $ambilsemuadatastock = mysqli_query($conn, "select * from masuk m, stock s where s.idbarang = m.idbarang");
                                        while ($data = mysqli_fetch_array($ambilsemuadatastock)) {
                                            $idb = $data['idbarang'];
                                            $idm = $data['idmasuk'];
                                            $tanggal = $data['tanggal'];
                                            $namabarang = $data['namabarang'];
                                            $qty = $data['qty'];
                                            $keterangan = $data['keterangan'];
                                        ?>
                                            <tr>
                                                <td><?= $tanggal; ?></td>
                                                <td><?= $namabarang; ?></td>
                                                <td><?= $qty; ?></td>
                                                <td><?= $keterangan; ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-warning" name="idmasuk" data-bs-toggle="modal" data-bs-target="#edit<?= $idm; ?>">
                                                        Edit
                                                    </button>
                                                    <button type="button" class="btn btn-danger" name="idmasuk" data-bs-toggle="modal" data-bs-target="#delete<?= $idm; ?>">
                                                        Delete
                                                    </button>
                                                </td>
                                            </tr>
                                            <!-- Edit The Modal -->
                                            <div class="modal fade" id="edit<?= $idm; ?>" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="myModalLabel">Edit Barang</h4>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <!-- Edit modal body -->
                                                        <form method="POST" action="function.php">
                                                            <input type="hidden" name="idmasuk" value="<?php echo $data['idmasuk']; ?>"> <!-- Pastikan ini ada -->
                                                            <input type="hidden" name="idb" value="<?php echo $data['idbarang']; ?>">
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label for="namabarang" class="form-label">Nama Barang</label>
                                                                    <input type="text" class="form-control" value="<?= $namabarang; ?>" name="namabarang" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="deskripsi" class="form-label">Quantity</label>
                                                                    <input type="number" value="<?= $qty; ?>" name="qty" required></input>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="keterangan" class="form-label">Pemasok</label>
                                                                    <input type="text" class="form-control" value="<?= $keterangan; ?>" name="keterangan" required> <!-- Ensure this is present -->
                                                                </div>
                                                                <div>
                                                                    <input type="hidden" name="idb" value="<?= $idb ?>">
                                                                    <input type="hidden" name="idmasuk" value="<?= $idm ?>">
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary" name="updatebarangmasuk">Submit</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Delete The Modal -->
                                            <div class="modal fade" id="delete<?= $idm; ?>" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="myModalLabel">Hapus Barang?</h4>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <!-- Delete modal body -->
                                                        <form method="POST" action="function.php">
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    Apakah anda yakin akan hapus barang <?= $namabarang; ?>?
                                                                    <input type="hidden" name="idb" value="<?= $idb ?>">
                                                                    <input type="hidden" name="qty" value="<?= $qty ?>">
                                                                    <input type="hidden" name="idmasuk" value="<?= $idm ?>">
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-danger" name="hapusbarangmasuk">Hapus</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                        };

                                        ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2023</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Tambah Barang Masuk</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- modal body -->
            <form method="POST" action="function.php">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="namabarang" class="form-label">Nama Barang</label>
                        <select name="barangnya" class="form-control">
                            <?php
                            $ambilsemuadatanya = mysqli_query($conn, "select * from stock");
                            while ($fetcharray = mysqli_fetch_array($ambilsemuadatanya)) {
                                $namabarangnya = $fetcharray['namabarang'];
                                $idbarangnya = $fetcharray['idbarang'];
                            ?>

                                <option value="<?= $idbarangnya; ?>"><?= $namabarangnya; ?></option>

                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <input type="number" class="form-control" id="Quantity" name="qty" required>
                    </div>
                    <div class="mb-3">
                        <label for="stock" class="form-label">Penerima</label>
                        <input type="text" class="form-control" name="penerima" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="barangmasuk">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

</html>