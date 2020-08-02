<?php

include_once "model/User.php";

class ManajemenAkun{

    public function inputAkun($nama_lengkap, $username, $level, $password1, $password2){
        $akun = new User();
        $cek_username = $this->mencariAkun($username);
        if($password1 != $password2){
            return $msg_err ="*Retype Password Tidak Sama, Harap Input Ulang";
        } else if(!empty($cek_username)){
            return $msg_err ="*Username Sudah Terdaftar, Harap Gunakan Username Lain..";
        } else{
            $akun->setNamaLengkap($nama_lengkap);
            $akun->setUsername($username);
            $akun->setLevel($level);
            $akun->setPassword(password_hash($password1, PASSWORD_DEFAULT));
            $akun->queryMemasukkanAkun();
            header("location:index.php?menu=ManajemenAkun");
        }
    }

    public function melihatAkun($search){
        $akun = new User();
        $akun->setNamaLengkap($search);
        $data = $akun->queryMelihatAkun();
        include_once "view/DataAkun.php";
    }

    public function mencariAkun($username){
        $akun = new User();
        $akun->setUsername($username);
        return $akun->queryMencariAkun();
    }

    public function editAkun($nama_lengkap, $username, $usernamex, $level, $password1, $password2, $pass_hide){
        $akun = new User();
        $akun->setNamaLengkap($nama_lengkap);
        $akun->setUsername($username);
        $akun->setUsernamex($usernamex);
        $akun->setLevel($level);
        if(!empty($password1)){
            $akun->setPassword(password_hash($password1, PASSWORD_DEFAULT));
        } else {
            $akun->setPassword($pass_hide);
        }

        $cek_username = $this->mencariAkun($username);
        if($password1 != $password2){
            return $msg_err ="*Retype Password Tidak Sama, Harap Input Ulang";
        } else if($username != $usernamex){
            if(!empty($cek_username)){
                return $msg_err ="*Username Sudah Terdaftar, Harap Gunakan Username Lain..";
            } else{
                $akun->queryMerubahAkun();
                header("location:index.php?menu=ManajemenAkun");
            }
        } else{
            $akun->queryMerubahAkun();
            header("location:index.php?menu=ManajemenAkun");
        }      
    }

    public function hapusAkun($username){
        $akun = new User();
        $akun->setUsername($username);
        $akun->queryMenghapusAkun();
        header("location:index.php?menu=ManajemenAkun");
    }
}
?>