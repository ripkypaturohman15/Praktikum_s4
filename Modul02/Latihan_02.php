<?php
class Alumni{
    protected $nama;
    protected $tahunLulus;
    public function __construct($nama, $tahunLulus){
        $this->nama = $nama;
        $this->tahunLulus =$tahunLulus;
    }
    public function getInfo(){
        return "Nama :$this->nama, Tahun Lulus:$this->tahunLulus";
    }
}
class Admin extends Alumni{
    public function updateTahunLulus($tahunBaru){
        $this->tahunLulus=$tahunBaru;
        return" Tahun Lulus diperbarui menjadi: $this->tahunLulus";
    }
}
$admin=new Admin("Milchatun",2015);
echo $admin->getInfo();
echo $admin->updateTahunLulus(2017);