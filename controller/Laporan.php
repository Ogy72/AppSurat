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
        $cSuk = mysqli_num_rows($suk->queryFilterSurat("C."));
        $eSuk = mysqli_num_rows($suk->queryFilterSurat("E."));
        include_once "view/GrafikSurat.php";
    }

    public function cetakLaporan($tgl1, $tgl2){
        $suk = new SuratKeluar();
        $sum = new SuratMasuk();
        $suratKeluar = mysqli_num_rows($suk->queryLaporan($tgl1, $tgl2, ""));
        $suratMasuk = mysqli_num_rows($sum->queryLaporan($tgl1, $tgl2));
        $aSuk = mysqli_num_rows($suk->queryLaporan($tgl1, $tgl2, "A."));
        $cSuk = mysqli_num_rows($suk->queryLaporan($tgl1, $tgl2, "C."));
        $eSuk = mysqli_num_rows($suk->queryLaporan($tgl1, $tgl2, "E."));
        $sumSurat= $aSuk+$cSuk+$eSuk;

        return array($suratKeluar, $suratMasuk, $aSuk, $cSuk, $eSuk, $sumSurat);
    }

    public function rekapSurat($tgl1, $tgl2){
        $suk = new SuratKeluar();
        $sum = new SuratMasuk();
        $suratKeluar = mysqli_num_rows($suk->queryLaporan($tgl1, $tgl2, ""));
        $suratMasuk = mysqli_num_rows($sum->queryLaporan($tgl1, $tgl2));
        $aSuk = mysqli_num_rows($suk->queryLaporan($tgl1, $tgl2, "A."));
        $cSuk = mysqli_num_rows($suk->queryLaporan($tgl1, $tgl2, "C."));
        $eSuk = mysqli_num_rows($suk->queryLaporan($tgl1, $tgl2, "E."));
        $sumSurat= $aSuk+$cSuk+$eSuk;
        include_once "view/RekapSurat.php";

    }
}

?>