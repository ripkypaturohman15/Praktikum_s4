<?php
class Mobil{
    public $merk;
    public function __construct($merk){
        $this->merk=$merk;
    }
    public function info(){
        return "Mobil ini adalah ".$this->merk;
    }
}
$mobil1 =new Mobil("Toyota AE86");
echo $mobil1->info();