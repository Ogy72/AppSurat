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
        $baSuk = mysqli_num_rows($suk->queryFilterSurat("BA"));
        $baSum = mysqli_num_rows($sum->queryFilterSurat("BA"));
        $poSuk = mysqli_num_rows($suk->queryFilterSurat("PO"));
        $poSum = mysqli_num_rows($sum->queryFilterSurat("PO"));
        $quSuk = mysqli_num_rows($suk->queryFilterSurat("Qu"));
        $quSum = mysqli_num_rows($sum->queryFilterSurat("Qu"));
        $invSuk = mysqli_num_rows($suk->queryFilterSurat("Invoice"));
        $invSum = mysqli_num_rows($sum->queryFilterSurat("Invoice"));
        include_once "view/GrafikSurat.php";
    }
}

?>