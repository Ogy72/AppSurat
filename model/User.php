<?php

include_once "KoneksiDb.php";

class User{

    private $username;
    private $usernamex;
    private $password;
    private $nama_lengkap;
    private $level;

    public function setUsername($username){
        $this->username = $username;
    }

    public function setUsernamex($usernamex){
        $this->usernamex = $usernamex;
    }

    public function setPassword($password){
        $this->password = $password;
    }

    public function setNamaLengkap($nama_lengkap){
        $this->nama_lengkap = $nama_lengkap;
    }

    public function setLevel($level){
        $this->level = $level;
    }

    public function queryMemasukkanAkun(){
        $kdb = new KoneksiDb();
        $query = "INSERT INTO user VALUES('$this->username', '$this->password', '$this->nama_lengkap', '$this->level')";
        $kdb->execute($query);
    }

    public function queryMelihatAkun(){
        $kdb = new KoneksiDb();
        $query = "SELECT * FROM user WHERE nama_lengkap LIKE '%$this->nama_lengkap%'";
        return $kdb->execute($query);
    }

    public function queryMencariAkun(){
        $kdb = new KoneksiDb();
        $query = "SELECT * FROM user WHERE username='$this->username'";
        $result = $kdb->execute($query);
        return $result->fetch_array();
    }

    public function queryMerubahAkun(){
        $kdb = new KoneksiDb();
        $query = "UPDATE user SET username='$this->username', password='$this->password', nama_lengkap='$this->nama_lengkap', level='$this->level' WHERE username='$this->usernamex'";
        $kdb->execute($query);
    }

    public function queryMenghapusAkun(){
        $kdb = new KoneksiDb();
        $query = "DELETE FROM user WHERE username='$this->username'";
        $kdb->execute($query);
    }

    public function queryCekLogin(){
        $kdb = new KoneksiDb();
        $query = "SELECT * FROM user WHERE username='$this->username'";
        $result = $kdb->execute($query);
        return $result->fetch_array();
    }

}
?>