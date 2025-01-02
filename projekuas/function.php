<?php
session_start();

// Membuat koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "projekuas");


if (isset($_POST['addnewobat'])) {
    // Tangkap data dari formulir
    $namaobat = $_POST['namaobat'];
    $satuan = $_POST['satuan'];
    $stock = $_POST['stock'];
    $addtotable = mysqli_query($conn,"insert into stock (namaobat,satuan,stock) values ('$namaobat','$satuan','$stock')");
    if($addtotable){
        header ('location:index.php');
    } else {
        echo 'gagal';
        header ('location:index.php');
    }

}


 //menambah barang masuk
    // if (isset($_POST['obatnya'])){
    //     $barangya = $_POST['']
    // }

    // Tambah barang baru ke tabel `stock`
    if (isset($_POST['addnewbarang'])) {
        $namaobat = $_POST['namaobat']; // Nama obat dari form
        $satuan = $_POST['satuan']; // Satuan obat dari form
        $stock = $_POST['stock']; // Stok awal dari form

        // Query untuk menambahkan barang baru ke tabel `stock`
        $addtotable = mysqli_query($conn, "INSERT INTO stock (namaobat, deskripsi, stock) VALUES ('$namaobat', '$satuan', '$stock')");
        
        if ($addtotable) {
            header('location:index.php');
        } else {
            echo 'Gagal menambahkan barang baru';
            header('location:index.php');
        }
    }
    
        // Tambah barang masuk ke tabel `masuk`
        if (isset($_POST['addnewbarang'])) {
            $barangnya = $_POST['obatnya']; // ID barang dari dropdown
            $satuanObat = $_POST['satuan']; // Satuan dari form
            $qty = $_POST['qty']; // Jumlah barang yang masuk

            // Ambil stok saat ini dari tabel `stock`
            $cekstocksekarang = mysqli_query($conn, "SELECT * FROM stock WHERE idbarang='$barangnya'");
            $ambildatanya = mysqli_fetch_array($cekstocksekarang);

            $stocksekarang = $ambildatanya['stock']; // Stok saat ini
            $tambahkanstocksekarangdenganquantity = $stocksekarang + $qty;

            // Query untuk menambahkan barang masuk ke tabel `masuk`
            $addtomasuk = mysqli_query($conn, "INSERT INTO masuk (idbarang, keterangan, qty) VALUES ('$barangnya', '$satuanObat', '$qty')");
            
            // Query untuk memperbarui stok di tabel `stock`
            $updatestockmasuk = mysqli_query($conn, "UPDATE stock SET stock='$tambahkanstocksekarangdenganquantity' WHERE idbarang='$barangnya'");
            
            if ($addtomasuk && $updatestockmasuk) {
                header('location:obat_masuk.php');
            } else {
                echo "Error: " . mysqli_error($conn); // Debugging error
            }
        }


        
// Tambah barang keluar ke tabel `keluar`
if (isset($_POST['addbarangkeluar'])) {
    $barangnya = $_POST['obatnya']; // ID barang dari dropdown
    $penerima = $_POST['satuan']; // Penerima/satuan dari form
    $qty = $_POST['stock']; // Jumlah barang yang keluar

    // Ambil stok saat ini dari tabel `stock`
    $cekstocksekarang = mysqli_query($conn, "SELECT * FROM stock WHERE idbarang='$barangnya'");
    $ambildatanya = mysqli_fetch_array($cekstocksekarang);

    $stocksekarang = $ambildatanya['stock']; // Stok saat ini
    $stokakhir = $stocksekarang - $qty; // Hitung stok setelah pengurangan

    // Validasi jika stok mencukupi
    if ($stokakhir < 0) {
        echo "<script>alert('Stok tidak mencukupi!');</script>";
        echo "<script>window.location.href='obat_keluar.php';</script>";
        exit();
    }

    // Query untuk menambahkan data barang keluar ke tabel `keluar`
    $tanggal_keluar = date("Y-m-d H:i:s"); // Tanggal otomatis
    $addtokeluar = mysqli_query($conn, "INSERT INTO keluar (idbarang, tanggal, penerima, qty) VALUES ('$barangnya', '$tanggal_keluar', '$penerima', '$qty')");
    
    // Query untuk memperbarui stok di tabel `stock`
    $updatestockkeluar = mysqli_query($conn, "UPDATE stock SET stock='$stokakhir' WHERE idbarang='$barangnya'");

    // Cek apakah query berhasil
    if ($addtokeluar && $updatestockkeluar) {
        header('location:obat_keluar.php');
    } else {
        echo "Error: " . mysqli_error($conn); // Debugging error
    }
}



function updateBarang($idbarang, $namaobat, $satuan, $stock)
{
    global $conn;
    $query = "UPDATE stock SET 
                namaobat='$namaobat', 
                satuan='$satuan', 
                stock='$stock' 
              WHERE idbarang='$idbarang'";
    return mysqli_query($conn, $query);
}

// Fungsi untuk delete barang
function deleteBarang($idbarang)
{
    global $conn;
    $query = "DELETE FROM stock WHERE idbarang='$idbarang'";
    return mysqli_query($conn, $query);
}

// Fungsi untuk menangani input POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['updatebarang'])) {
        // Proses update barang
        $idbarang = $_POST['idbarang']; // ID Barang (idb) dari form
        $namaobat = $_POST['namaobat'];
        $satuan = $_POST['satuan'];
        $stock = $_POST['stock'];

        if (updateBarang($idbarang, $namaobat, $satuan, $stock)) {
            header("Location: index.php?status=update-success");
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } elseif (isset($_POST['deletebarang'])) {
        // Proses delete barang
        $idbarang = $_POST['idbarang']; // ID Barang (idb) dari form

        if (deleteBarang($idbarang)) {
            header("Location: index.php?status=delete-success");
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}


    // Fungsi untuk update data masuk
function updateMasuk($idmasuk, $tanggal, $qty, $keterangan)
{
    global $conn;
    $query = "UPDATE masuk SET 
                tanggal='$tanggal', 
                qty='$qty', 
                keterangan='$keterangan' 
              WHERE idmasuk='$idmasuk'";
    return mysqli_query($conn, $query);
}

// Fungsi untuk delete data masuk
function deleteMasuk($idmasuk)
{
    global $conn;
    $query = "DELETE FROM masuk WHERE idmasuk='$idmasuk'";
    return mysqli_query($conn, $query);
}

// Proses form untuk update dan delete
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['updateMasuk'])) {
        $idmasuk = $_POST['idmasuk'];
        $tanggal = $_POST['tanggal'];
        $qty = $_POST['qty'];
        $keterangan = $_POST['keterangan'];

        if (updateMasuk($idmasuk, $tanggal, $qty, $keterangan)) {
            header("Location: obat_masuk.php?status=update-success");
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } elseif (isset($_POST['deleteMasuk'])) {
        $idmasuk = $_POST['idmasuk'];

        if (deleteMasuk($idmasuk)) {
            header("Location: obat_masuk.php?status=delete-success");
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}


// Fungsi untuk update data keluar
function updateKeluar($idkeluar, $tanggal, $qty, $penerima)
{
    global $conn;
    $query = "UPDATE keluar SET 
                tanggal='$tanggal', 
                qty='$qty', 
                penerima='$penerima' 
              WHERE idkeluar='$idkeluar'";
    return mysqli_query($conn, $query);
}

// Fungsi untuk delete data keluar
function deleteKeluar($idkeluar)
{
    global $conn;
    $query = "DELETE FROM keluar WHERE idkeluar='$idkeluar'";
    return mysqli_query($conn, $query);
}

// Proses form untuk update dan delete
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['updateKeluar'])) {
        $idkeluar = $_POST['idkeluar'];
        $tanggal = $_POST['tanggal'];
        $qty = $_POST['qty'];
        $penerima = $_POST['penerima'];

        if (updateKeluar($idkeluar, $tanggal, $qty, $penerima)) {
            header("Location: obat_keluar.php?status=update-success");
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } elseif (isset($_POST['deleteKeluar'])) {
        $idkeluar = $_POST['idkeluar'];

        if (deleteKeluar($idkeluar)) {
            header("Location: obat_keluar.php?status=delete-success");
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}


    ?>
    
                
 