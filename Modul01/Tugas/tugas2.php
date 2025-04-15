<?php
abstract class Hewan {
    protected $nama;

    public function __construct($nama) {
        $this->nama = $nama;
    }
    
    abstract public function bersuara();
    
    public function getNama() {
        return $this->nama;
    }

    public function tampilkanInfo() {
        $jenisHewan = $this->getJenisHewan();
        echo "Nama: " . $this->nama . " (" . $jenisHewan . ")<br>";
        echo "Suara: " . $this->bersuara() . "<br>";
    }
    

    protected function getJenisHewan() {
        return "Hewan";
    }
}

class Anjing extends Hewan {
    public function bersuara() {
        return "Guk guk!";
    }
    
    protected function getJenisHewan() {
        return "Anjing";
    }
}

class Kucing extends Hewan {
    public function bersuara() {
        return "Meow meow!";
    }
    protected function getJenisHewan() {
        return "Kucing";
    }
}

$anjing = new Anjing("Buddy");
$kucing = new Kucing("Kitty"); 

echo "<h3>Tugas 2: Class Hewan dengan Turunan</h3>";
$anjing->tampilkanInfo();
echo "<br>";
$kucing->tampilkanInfo();
?>
