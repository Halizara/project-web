<?php
include 'koneksi.php';
$conn = new mysqli("localhost", "root", "", "pertemuan2");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
$sql = "SELECT * FROM notes ORDER BY created_at DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Catatan</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f0fc; /* Latar belakang pastel pink */
        }
        .header {
            background-color: #e0bbff; /* Ungu pastel */
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            margin-bottom: 30px;
        }
        .btn-custom {
            background-color: #c084fc; /* Ungu pastel */
            color: white;
        }
        .btn-custom:hover {
            background-color: #a855f7; /* Ungu lebih gelap saat hover */
            color: white;
        }
        table {
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
        }
        th {
            background-color: #d8b4fe; /* Header tabel ungu pastel */
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f3e8ff; /* Baris genap pastel pink */
        }
        .action-links a {
            margin-right: 10px;
            text-decoration: none;
        }
        .action-links a.edit {
            color: #6d28d9; /* Warna ungu */
        }
        .action-links a.delete {
            color: #ef4444; /* Warna merah */
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="header">
            <h2>Daftar Catatan</h2>
            <a href="pages/create.php" class="btn btn-custom">Tambah Catatan Baru</a>
        </div>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Judul</th>
                    <th scope="col">Isi Catatan</th>
                    <th scope="col">Tanggal Dibuat</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    $no = 1;
                    // Looping data dari database
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<th scope='row'>" . $no++ . "</th>";
                        echo "<td>" . htmlspecialchars($row['judul']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['isi']) . "</td>";
                        echo "<td>" . date('d-m-Y H:i', strtotime($row['created_at'])) . "</td>";
                        echo "<td class='action-links'>";
                        echo "<a href='./pages/edit.php?id=" . $row['id'] . "' class='edit'>Edit</a> | ";
                        echo "<a href='./actions/delete.php?id=" . $row['id'] . "' class='delete' onclick='return confirm(\"Apakah Anda yakin ingin menghapus catatan ini?\");'>Hapus</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' class='text-center'>Belum ada catatan.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <!-- Bootstrap JS dan dependensi -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php
$conn->close();
?>