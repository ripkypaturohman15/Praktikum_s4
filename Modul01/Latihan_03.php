<?php
class Bank{
    private $saldo =50000;
    public function lihatSaldo(){
        return "Saldo saat ini: ".$this->saldo;
    }
}
$akun=new Bank();
echo $akun->lihatSaldo();