<?php
include_once "KoneksiDb.php";

class SuratKeluar{

    private $no_surat;
    private $no_suratx;
    private $tgl_surat;
    private $perihal;
    private $sifat;
    private $kd_instansi;
    private $file;
    private $id_user;

    public function setNoSurat($no_surat){
        $this->no_surat = $no_surat;
    }

    public function setNoSuratx($no_suratx){
        $this->no_suratx = $no_suratx;
    }

    public function setTglSurat($tgl_surat){
        $this->tgl_surat = $tgl_surat;
    }

    public function setPerihal($perihal){
        $this->perihal = $perihal;
    }

    public function setSifat($sifat){
        $this->sifat = $sifat;
    }

    public function setKdInstansi($kd_instansi){
        $this->kd_instansi = $kd_instansi;
    }

    public function setFile($file){
        $this->file = $file;
    }

    public function setIdUser($id_user){
        $this->id_user = $id_user;
    }

    public function queryInputSuratKeluar(){
        $kdb = new KoneksiDb();
        $query = "INSERT INTO surat_keluar VALUES('$this->no_surat', '$this->tgl_surat', '$this->perihal', '$this->sifat', '$this->kd_instansi', '$this->file', '$this->id_user')";
        $kdb->execute($query);
    }

    public function queryMelihatSuratKeluar($search){
        $kdb = new KoneksiDb();
        $query = "SELECT * FROM surat_keluar WHERE no_surat LIKE '%$search%' OR tgl_surat LIKE '%$search%' OR perihal LIKE '%$search%'";
        return $kdb->execute($query);
    }
    
    public function queryMencariSuratKeluar(){
        $kdb = new KoneksiDb();
        $query = "SELECT surat_keluar.*, instansi.nm_instansi FROM surat_keluar, instansi WHERE surat_keluar.kd_instansi=instansi.kd_instansi AND surat_keluar.no_surat='$this->no_surat'";
        $result = $kdb->execute($query);
        return $result->fetch_array();
    }

    public function queryEditSuratKeluar(){
        $kdb = new KoneksiDb();
        $query = "UPDATE surat_keluar SET no_surat='$this->no_surat', tgl_surat='$this->tgl_surat', perihal='$this->perihal', sifat='$this->sifat', kd_instansi='$this->kd_instansi', file='$this->file' WHERE no_surat='$this->no_suratx'";
        $kdb->execute($query);
    }

    public function queryHapusSuratKeluar(){
        $kdb = new KoneksiDb();
        $query = "DELETE FROM surat_keluar WHERE no_surat='$this->no_surat'";
        $kdb->execute($query);
    }   

    public function queryFilterSurat($jenis){
        $kdb = new KoneksiDb();
        $query = "SELECT * FROM surat_keluar WHERE no_surat LIKE '%$jenis%'";
        return $kdb->execute($query);
    }

    public function queryMax(){
        $kdb = new KoneksiDb();
        $query = "SELECT MAX(no_surat) AS numer FROM surat_keluar";
        $result = $kdb->execute($query);
        return $result->fetch_array();
    }

    public function queryLaporan($tgl1, $tgl2, $filter){
        $kdb = new KoneksiDb();
        $query = "SELECT * FROM surat_keluar WHERE tgl_surat BETWEEN '$tgl1' AND '$tgl2' AND no_surat LIKE '%$filter%'";
        return $kdb->execute($query);
    }

}
?>
