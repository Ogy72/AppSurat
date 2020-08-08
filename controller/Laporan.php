<?php

include_once "model/SuratMasuk.php";
include_once "model/SuratKeluar.php";

class Laporan{

    public function melihatGrafikSurat(){
        $search = "";
        $suk = new SuratKeluar();
        $sum = new SuratMasuk();
        $suratKeluar = mysqli_num_rows($suk->queryMelihatSuratKeluar($search));
        $suratMasuk = mysqli_num_rows($sum->queryMelihatSuratMasuk($search));
        $aSuk = mysqli_num_rows($suk->queryFilterSurat("A."));
        $dSuk = mysqli_num_rows($suk->queryFilterSurat("D."));
        $cSuk = mysqli_num_rows($suk->queryFilterSurat("C."));
        include_once "view/GrafikSurat.php";
    }

    public function cetakLaporan(){

    }

    public function rekapSuratMasuk(){
        $nilai = "Rekap Surat Masuk";
        include_once "view/RekapSuratMasuk.php";
    }
}

?>