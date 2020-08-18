<?php

include_once "KoneksiDb.php";

class Instansi{

    private $kd_instansi;
    private $nm_instansi;
    private $alamat;
    private $pic;

    public function setKdInstansi($kd_instansi){
        $this->kd_instansi = $kd_instansi;
    }

    public function setNmInstansi($nm_instansi){
        $this->nm_instansi = $nm_instansi;
    }

    public function setAlamat($alamat){
        $this->alamat = $alamat;
    }

    public function setPic($pic){
        $this->pic = $pic;
    }

    public function queryInputInstansi(){
        $kdb = new KoneksiDb();
        $query = "INSERT INTO instansi VALUES('$this->kd_instansi', '$this->nm_instansi', '$this->alamat', '$this->pic')";
        $kdb->execute($query);
    }

    public function queryMelihatInstansi(){
        $kdb = new KoneksiDb();
        $query = "SELECT * FROM instansi";
        return $kdb->execute($query);
    }

    public function queryMencariInstansi(){
        $kdb = new KoneksiDb();
        $query = "SELECT * FROM instansi WHERE kd_instansi='$this->kd_instansi'";
        $result = $kdb->execute($query);
        return $result->fetch_array();
    }

    public function getKode(){
        $kdb = new KoneksiDb();
        $query = "SELECT MAX(kd_instansi) AS kd FROM instansi";
        $result = $kdb->execute($query);
        $data = $result->fetch_array();
        $getKode = $data['kd'];

        if($getKode){
            $nilai = substr($getKode, 4, 3);
            $kode = (int) $nilai;

            $kode++;
            $char = "Inst";
            $getKode = $char.sprintf("%03s",$kode);
        } else{
            $getKode = "Inst001";
        }

        $kdInst = $getKode;
        return $kdInst;

    }

}
?>