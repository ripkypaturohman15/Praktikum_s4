<?php
class Alumni{
    private $nama;
    private $email;
    private $password;
    public function __construct($nama,$email,$password){
        $this->nama = $nama;
        $this->email = $email;
        $this->password =password_hash($password, PASSWORD_DEFAULT);
    }
    public function getNama(){
        return $this->nama;
    }
    public function getEmail(){
        return "Email Alumni bersifat rahasia! ";
    }
    public function verifyPassword($password){
        return password_verify($password, $this->password);
    }
}
$alumni=new Alumni("Budi Santoso ","budi@example.com ","password123");
echo $alumni->getNama();
echo $alumni->getEmail();

if($alumni->verifyPassword("password123")){
    echo "Password benar!";
}else{
    echo "Password Salah!";
}?>