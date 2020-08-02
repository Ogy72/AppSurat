<?php
include_once "controller/ManajemenSuratMasuk.php";
include_once "controller/ManajemenAkun.php";

class Antarmuka{

    public function halamanLogin(){

    }

    public function halamanAdmin(){
        include_once "view/HalamanAdmin.php";
    }

    public function halamanDirektur(){

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

    public function formBuatSurat($bag){
        if($bag == "suratA"){
            header("location:view/menuBuatSurat.php?surat=A");
        } else if($bag == "suratB") {
            header("location:view/menuBuatSurat.php?surat=B");
        }
    }

    public function formSuratMasuk($form, $key){
        $msum = new ManajemenSuratMasuk();
        $data = $msum->mencariSuratMasuk($key);
        $instansi = $msum->melihatInstansi();
        include_once "view/FormSuratMasuk.php";
    }

    public function formAkun($form, $key){
        $ma = new ManajemenAkun();
        $data = $ma->mencariAkun($key);
        include_once "view/FormAkun.php";
    }
}
?>