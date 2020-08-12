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

    public function cetakLaporan($tgl1, $tgl2){
        $suk = new SuratKeluar();
        $sum = new SuratMasuk();
        $suratKeluar = mysqli_num_rows($suk->queryLaporan($tgl1, $tgl2, ""));
        $suratMasuk = mysqli_num_rows($sum->queryLaporan($tgl1, $tgl2));
        $aSuk = mysqli_num_rows($suk->queryLaporan($tgl1, $tgl2, "A."));
        $cSuk = mysqli_num_rows($suk->queryLaporan($tgl1, $tgl2, "C."));
        $dSuk = mysqli_num_rows($suk->queryLaporan($tgl1, $tgl2, "D."));
        $sumSurat= $aSuk+$cSuk+$dSuk;

        return array($suratKeluar, $suratMasuk, $aSuk, $cSuk, $dSuk, $sumSurat);
    }

    public function rekapSurat($tgl1, $tgl2){
        $suk = new SuratKeluar();
        $sum = new SuratMasuk();
        $suratKeluar = mysqli_num_rows($suk->queryLaporan($tgl1, $tgl2, ""));
        $suratMasuk = mysqli_num_rows($sum->queryLaporan($tgl1, $tgl2));
        $aSuk = mysqli_num_rows($suk->queryLaporan($tgl1, $tgl2, "A."));
        $cSuk = mysqli_num_rows($suk->queryLaporan($tgl1, $tgl2, "C."));
        $dSuk = mysqli_num_rows($suk->queryLaporan($tgl1, $tgl2, "D."));
        $sumSurat= $aSuk+$cSuk+$dSuk;
        include_once "view/RekapSurat.php";

    }
}

?>