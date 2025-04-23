<?php 
require_once "latihan_05.php";

class Pengumuman {
    private $conn;
    private $table_name = "pengumuman";

    public $id_pengumuman;
    public $judul;
    public $isi;
    public $tanggal;
    public $status;
    public $penulis;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getAll() {
        $query = "SELECT * FROM $this->table_name ORDER BY tanggal DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function getById() {
        $query = "SELECT * FROM $this->table_name WHERE id_pengumuman = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id_pengumuman);
        $stmt->execute();
        return $stmt;
    }

    public function getActive() {
        $query = "SELECT * FROM $this->table_name WHERE status = 'aktif' ORDER BY tanggal DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function add() {
        $query = "INSERT INTO $this->table_name (judul, isi, tanggal, status, penulis) VALUES (:judul, :isi, :tanggal, :status, :penulis)";
        $stmt = $this->conn->prepare($query);

        $this->sanitize();

        $stmt->bindParam(":judul", $this->judul);
        $stmt->bindParam(":isi", $this->isi);
        $stmt->bindParam(":tanggal", $this->tanggal);
        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":penulis", $this->penulis);

        return $stmt->execute();
    }

    public function update() {
        $query = "UPDATE $this->table_name SET judul = :judul, isi = :isi, tanggal = :tanggal, status = :status, penulis = :penulis WHERE id_pengumuman = :id";
        $stmt = $this->conn->prepare($query);

        $this->sanitize();
        $this->id_pengumuman = htmlspecialchars(strip_tags($this->id_pengumuman));

        $stmt->bindParam(":judul", $this->judul);
        $stmt->bindParam(":isi", $this->isi);
        $stmt->bindParam(":tanggal", $this->tanggal);
        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":penulis", $this->penulis);
        $stmt->bindParam(":id", $this->id_pengumuman);

        return $stmt->execute();
    }

    public function delete() {
        $query = "DELETE FROM $this->table_name WHERE id_pengumuman = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id_pengumuman);
        return $stmt->execute();
    }

    public function toggleStatus() {
        $query = "UPDATE $this->table_name SET status = CASE WHEN status = 'aktif' THEN 'tidak_aktif' ELSE 'aktif' END WHERE id_pengumuman = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id_pengumuman);
        return $stmt->execute();
    }

    public function search($keyword) {
        $query = "SELECT * FROM $this->table_name WHERE judul LIKE :keyword OR isi LIKE :keyword OR penulis LIKE :keyword ORDER BY tanggal DESC";
        $stmt = $this->conn->prepare($query);
        $keyword = "%$keyword%";
        $stmt->bindParam(":keyword", $keyword);
        $stmt->execute();
        return $stmt;
    }

    private function sanitize() {
        $this->judul = htmlspecialchars(strip_tags($this->judul));
        $this->isi = htmlspecialchars(strip_tags($this->isi));
        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->penulis = htmlspecialchars(strip_tags($this->penulis));
    }
}

$pengumuman = new Pengumuman();
$action = $_GET['action'] ?? 'list';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pengumuman->judul = $_POST['judul'] ?? '';
    $pengumuman->isi = $_POST['isi'] ?? '';
    $pengumuman->tanggal = $_POST['tanggal'] ?? '';
    $pengumuman->status = $_POST['status'] ?? '';
    $pengumuman->penulis = $_POST['penulis'] ?? '';

    if (isset($_POST['add'])) {
        $message = $pengumuman->add() ? "Pengumuman berhasil ditambahkan." : "Gagal menambahkan pengumuman.";
        $action = 'list';
    } elseif (isset($_POST['update'])) {
        $pengumuman->id_pengumuman = $_POST['id_pengumuman'] ?? '';
        $message = $pengumuman->update() ? "Pengumuman berhasil diperbarui." : "Gagal memperbarui pengumuman.";
        $action = 'list';
    } elseif (isset($_POST['search'])) {
        $stmt = $pengumuman->search($_POST['keyword'] ?? '');
    }
}

if ($action === 'delete' && isset($_GET['id'])) {
    $pengumuman->id_pengumuman = $_GET['id'];
    $message = $pengumuman->delete() ? "Pengumuman berhasil dihapus." : "Gagal menghapus pengumuman.";
    $action = 'list';
}

if ($action === 'toggle' && isset($_GET['id'])) {
    $pengumuman->id_pengumuman = $_GET['id'];
    $message = $pengumuman->toggleStatus() ? "Status pengumuman berhasil diubah." : "Gagal mengubah status pengumuman.";
    $action = 'list';
}

if ($action === 'edit' && isset($_GET['id'])) {
    $pengumuman->id_pengumuman = $_GET['id'];
    $stmt = $pengumuman->getById();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$row) {
        $message = "Data pengumuman tidak ditemukan.";
        $action = 'list';
    }
}

if ($action === 'list' || !isset($stmt)) {
    $stmt = $pengumuman->getAll();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengelolaan Pengumuman - Web Alumni</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Pengelolaan Pengumuman</h1>
            <div>
                <a href="latihan_07.php" class="btn btn-secondary">Kembali ke Daftar Alumni</a>
                <?php if($action == 'list'): ?>
                    <a href="?action=add" class="btn btn-primary">Tambah Pengumuman</a>
                <?php endif; ?>
            </div>
        </div>

        <?php if(isset($message)): ?>
            <div class="alert alert-info"><?php echo $message; ?></div>
        <?php endif; ?>

        <?php if($action == 'list'): ?>
            <!-- Pencarian -->
            <div class="card mb-4">
                <div class="card-body">
                    <form method="POST" class="row g-3">
                        <div class="col-md-10">
                            <input type="text" name="keyword" class="form-control" placeholder="Cari pengumuman..." value="<?php echo isset($keyword) ? $keyword : ''; ?>">
                        </div>
                        <div class="col-md-2">
                            <button type="submit" name="search" class="btn btn-primary w-100">Cari</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Tabel Pengumuman -->
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Penulis</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $row['judul']; ?></td>
                            <td><?php echo date('d-m-Y', strtotime($row['tanggal'])); ?></td>
                            <td>
                                <span class="badge bg-<?php echo $row['status'] == 'aktif' ? 'success' : 'danger'; ?>">
                                    <?php echo $row['status']; ?>
                                </span>
                            </td>
                            <td><?php echo $row['penulis']; ?></td>
                            <td>
                                <a href="?action=view&id=<?php echo $row['id_pengumuman']; ?>" class="btn btn-sm btn-info">Lihat</a>
                                <a href="?action=edit&id=<?php echo $row['id_pengumuman']; ?>" class="btn btn-sm btn-warning">Edit</a>
                                <a href="?action=toggle&id=<?php echo $row['id_pengumuman']; ?>" class="btn btn-sm btn-<?php echo $row['status'] == 'aktif' ? 'danger' : 'success'; ?>">
                                    <?php echo $row['status'] == 'aktif' ? 'Nonaktifkan' : 'Aktifkan'; ?>
                                </a>
                                <a href="?action=delete&id=<?php echo $row['id_pengumuman']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus pengumuman ini?')">Hapus</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                        <?php if($stmt->rowCount() == 0): ?>
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada data pengumuman.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

        <?php elseif($action == 'add' || $action == 'edit'): ?>
            <!-- Form Tambah/Edit Pengumuman -->
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><?php echo $action == 'add' ? 'Tambah' : 'Edit'; ?> Pengumuman</h5>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <?php if($action == 'edit'): ?>
                            <input type="hidden" name="id_pengumuman" value="<?php echo $row['id_pengumuman']; ?>">
                        <?php endif; ?>

                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul</label>
                            <input type="text" class="form-control" id="judul" name="judul" value="<?php echo $action == 'edit' ? $row['judul'] : ''; ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="isi" class="form-label">Isi Pengumuman</label>
                            <textarea class="form-control" id="isi" name="isi" rows="5" required><?php echo $action == 'edit' ? $row['isi'] : ''; ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?php echo $action == 'edit' ? $row['tanggal'] : date('Y-m-d'); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="aktif" <?php echo ($action == 'edit' && $row['status'] == 'aktif') ? 'selected' : ''; ?>>Aktif</option>
                                <option value="tidak_aktif" <?php echo ($action == 'edit' && $row['status'] == 'tidak_aktif') ? 'selected' : ''; ?>>Tidak Aktif</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="penulis" class="form-label">Penulis</label>
                            <input type="text" class="form-control" id="penulis" name="penulis" value="<?php echo $action == 'edit' ? $row['penulis'] : ''; ?>">
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="?action=list" class="btn btn-secondary">Batal</a>
                            <button type="submit" name="<?php echo $action == 'add' ? 'add' : 'update'; ?>" class="btn btn-primary">
                                <?php echo $action == 'add' ? 'Tambah' : 'Update'; ?>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        <?php elseif($action == 'view' && isset($_GET['id'])): ?>
            <!-- Detail Pengumuman -->
            <?php 
            $pengumuman->id_pengumuman = $_GET['id'];
            $stmt = $pengumuman->getById();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if(!$row) {
                echo '<div class="alert alert-danger">Data pengumuman tidak ditemukan.</div>';
            } else {
            ?>
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">Detail Pengumuman</h5>
                </div>
                <div class="card-body">
                    <h3><?php echo $row['judul']; ?></h3>
                    <div class="d-flex justify-content-between mb-3">
                        <div>
                            <span class="badge bg-<?php echo $row['status'] == 'aktif' ? 'success' : 'danger'; ?>">
                                <?php echo $row['status']; ?>
                            </span>
                            <small class="text-muted ms-2">Penulis: <?php echo $row['penulis']; ?></small>
                        </div>
                        <div>
                            <small class="text-muted">Tanggal: <?php echo date('d-m-Y', strtotime($row['tanggal'])); ?></small>
                        </div>
                    </div>
                    <div class="card mb-3">
                        <div class="card-body">
                            <p><?php echo nl2br($row['isi']); ?></p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="?action=list" class="btn btn-secondary">Kembali</a>
                        <div>
                            <a href="?action=edit&id=<?php echo $row['id_pengumuman']; ?>" class="btn btn-warning">Edit</a>
                            <a href="?action=delete&id=<?php echo $row['id_pengumuman']; ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus pengumuman ini?')">Hapus</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
