<?php

class KoneksiDb{

    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $db = "db_surat";

    private function open(){
       return $connect = new mysqli($this->host, $this->username, $this->password, $this->db);
    }

    public function execute($query){
        return $this->open()->query($query);
        $this->close();
    }

    private function close(){
        $this->open()->close();
    }
}

?>