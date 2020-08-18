<?php
include_once "controller/Validasi.php";
include_once "controller/ManajemenSuratMasuk.php";
include_once "controller/ManajemenSuratKeluar.php";
include_once "controller/ManajemenAkun.php";
include_once "controller/Laporan.php";

class Antarmuka{

    public function halamanLogin(){
        include_once "view/HalamanLogin.php";
    }

    public function halamanAdmin(){
        include_once "view/HalamanAdmin.php";
    }

    public function menuSuratMasukAdmin(){
        include_once "view/MenuSuratMasukAdmin.php";
    }  

    public function menuSuratKeluarAdmin(){
        include_once "view/MenuSuratKeluarAdmin.php";
    }  

    public function menuManajemenAkun(){
        include_once "view/MenuManajemenAkun.php";
    }  

    public function menuDataPerusahaan(){
        include_once "view/MenuDataPerusahaan.php";
    }  

    public function formBuatSurat($jenis){
        $jenis_surat = $jenis;
        include_once "view/FormBuatSurat.php";
    }

    public function formSuratMasuk($form, $key){
        $msum = new ManajemenSuratMasuk();
        $data = $msum->mencariSuratMasuk($key);
        $instansi = $msum->melihatInstansi();
        include_once "view/FormSuratMasuk.php";
    }

    public function formSuratKeluar($form, $key){
        $msuk = new ManajemenSuratKeluar();
        $data = $msuk->mencariSuratKeluar($key);
        $instansi = $msuk->melihatInstansi();
        include_once "view/FormSuratKeluar.php";
    }

    public function formAkun($form, $key){
        $ma = new ManajemenAkun();
        $data = $ma->mencariAkun($key);
        include_once "view/FormAkun.php";
    }
}
?>