<?php
include_once "model/User.php";

class Validasi{

    public function login($user, $pass){
        $akun = new User();
        $akun->setUsername($user);
        $data = $akun->queryCekLogin();
        if(password_verify($pass, $data["password"])){
            setcookie('level',"$data[level]",strtotime('+7 days'),'/');
            setcookie('user',"$data[username]",strtotime('+7 days'),'/');
            setcookie('nama',"$data[nama_lengkap]",strtotime('+7 days'),'/');
            setcookie('pass',"$data[password]",strtotime('+7 days'),'/');
            header("location:index.php");
        } else {
            setcookie('level','',0,'/');
            setcookie('user','',0,'/');
            setcookie('nama','',0,'/');
            setcookie('pass','',0,'/');
            return $msg = "Username dan Password tidak sesuai !";
        }

    }

    public function logout(){
        setcookie('level','',0,'/');
        setcookie('user','',0,'/');
        setcookie('nama','',0,'/');
        setcookie('pass','',0,'/');
        header("location:index.php");
    }
}

?>