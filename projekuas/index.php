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
        <title>Obat Masuk</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.php">Aplikasi Stok Obat</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Aprin Dwi Suryo Nugroho</div>
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Stok Obat
                            </a>
                            <a class="nav-link" href="obat_masuk.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Obat Masuk
                            </a>
                            <a class="nav-link" href="obat_keluar.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Obat Keluar
                            </a>          
                        </div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Laporan Stok Obat</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Data Laporan Stok Obat</li>
                        </ol>

                        <div class="card mb-4">
                            <div class="card-header">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                                Tambah Obat
                            </button>
                            </div>
                            <div class="card-body">
                                <!-- Menambahkan responsivitas dan lebar penuh -->
                                <div class="table-responsive">
                                    <table id="datatablesSimple" class="table table-striped table-bordered" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Obat</th>
                                                <th>Satuan</th>
                                                <th>Stock</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                                $ambilsemuadatastock = mysqli_query($conn, "SELECT * FROM stock");
                                                $i = 1; // Inisialisasi $i di luar loop
                                                while ($data = mysqli_fetch_array($ambilsemuadatastock)) {
                                                    $namabarang = $data['namaobat'];
                                                    $deskripsi = $data['satuan'];
                                                    $stock = $data['stock'];
                                                    $idb = $data['idbarang'];
                                                ?>
                                                    <tr>
                                                        <td><?= $i++; ?></td>
                                                        <td><?= $namabarang; ?></td>
                                                        <td><?= $deskripsi; ?></td>
                                                        <td><?= $stock; ?></td>
                                                        <td>
                                                            <!-- Tombol Edit -->
                                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?= $idb; ?>">
                                                                Edit
                                                            </button>

                                                            <!-- Tombol Delete -->
                                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete<?= $idb; ?>">
                                                                Delete
                                                            </button>
                                                        </td>
                                                    </tr>

                                                    <!-- Modal Edit -->
                                                    <div class="modal fade" id="edit<?= $idb; ?>" tabindex="-1" aria-labelledby="editLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <form method="post">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="editLabel">Edit Obat</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <input type="hidden" name="idbarang" value="<?= $idb; ?>">
                                                                        <div class="mb-3">
                                                                            <label for="namaObat" class="form-label">Nama Obat</label>
                                                                            <input type="text" name="namaobat" value="<?= $namabarang; ?>" class="form-control" required>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="satuanObat" class="form-label">Satuan</label>
                                                                            <input type="text" name="satuan" value="<?= $deskripsi; ?>" class="form-control" required>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="stockObat" class="form-label">Stock</label>
                                                                            <input type="number" name="stock" value="<?= $stock; ?>" class="form-control" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-primary" name="updatebarang">Submit</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Modal Delete -->
                                                    <div class="modal fade" id="delete<?= $idb; ?>" tabindex="-1" aria-labelledby="deleteLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <form method="post">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="deleteLabel">Hapus Obat</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <input type="hidden" name="idbarang" value="<?= $idb; ?>">
                                                                        Apakah Anda yakin ingin menghapus <strong><?= $namabarang; ?></strong>?
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                        <button type="submit" class="btn btn-danger" name="deletebarang">Hapus</button>
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
                            <div class="text-muted">Pemrograman Website</div>
                            <div>
                            <a href="https://www.instagram.com/aprin_dwi22" target="_blank">Instagram</a>
                            &middot;
                            <a href="mailto:aprindwi3@gmail.com">Email</a>
                            &middot;
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

            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Tambah Obat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Body -->
            <form method="post">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="namaObat" class="form-label">Nama Obat</label>
                        <input type="text" name="namaobat" id="namaObat" placeholder="Nama Obat" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="satuanObat" class="form-label">Satuan</label>
                        <input type="text" name="satuan" id="satuan" placeholder="Satuan obat" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="satuanObat" class="form-label">Stock</label>
                        <input type="number" name="stock" id="stock" placeholder="Stock Obat" class="form-control" required>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="addnewobat">Submit</button>
                </div>
            </form>

        </div>
    </div>
</div>

</html>