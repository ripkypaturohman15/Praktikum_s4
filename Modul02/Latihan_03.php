<?php
class Alumni{
    public $nama;
    public $jurusan;

    public function __construct($nama,$jurusan){
        $this->nama=$nama;
        $this->jurusan=$jurusan;
    }
    public function tampilkanProfil(){
        return "Nama: $this->nama <br> Jurusan: $this->jurusan";
    }
}
$alumni =new Alumni("Asgord","Teknik informatika");
echo $alumni->tampilkanProfil();
?>