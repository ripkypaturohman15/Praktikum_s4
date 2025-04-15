<?php
class Pegawai {
    private $nama;
    private $jabatan;
    private $gaji;
   
    public function __construct($nama, $jabatan, $gaji) {
        $this->nama = $nama;
        $this->jabatan = $jabatan;
        $this->gaji = $gaji;
    }
    
    public function getNama() {
        return $this->nama;
    }
    
    public function getJabatan() {
        return $this->jabatan;
    }
    
    public function getGaji() {
        return $this->gaji;
    }
    
    public function tampilkanInfo() {
        echo "Informasi Pegawai:<br>";
        echo "Nama: " . $this->nama . "<br>";
        echo "Jabatan: " . $this->jabatan . "<br>";
        echo "Gaji: Rp " . number_format($this->gaji, 0, ',', '.') . "<br>";
    }
    
    public function getInfoTerformat() {
        $info = "Informasi Pegawai:\n";
        $info .= "Nama: " . $this->nama . "\n";
        $info .= "Jabatan: " . $this->jabatan . "\n";
        $info .= "Gaji: Rp " . number_format($this->gaji, 0, ',', '.') . "\n";
        return $info;
    }
}

$pegawai1 = new Pegawai("Matsumoto", "Manager", 8000000);
$pegawai2 = new Pegawai("Suzuka", "Staff", 4500000);

echo "<h3>Tugas 1: Class Pegawai</h3>";
$pegawai1->tampilkanInfo();
echo "<br>";
$pegawai2->tampilkanInfo();
echo "<hr>";
?>
