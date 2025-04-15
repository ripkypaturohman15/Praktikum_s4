<?php
class Mahasiswa{
    public $nama;
    public $nim;
    public function Perkenalan(){
        return "Halo, nama saya " . $this->nama . " dan Nim saya " . $this->nim;
    }
}
$mahasiswa1 = new Mahasiswa();
$mahasiswa1->nama = "Budi";
$mahasiswa1->nim = "20230009930";
echo $mahasiswa1->Perkenalan(); 