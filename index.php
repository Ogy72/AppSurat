<?php
    include "controller/Antarmuka.php";

    $ant = new Antarmuka();

    if(!empty($_GET)){

        if(!empty($_GET["menu"])){
            $menu = $_GET["menu"];

            switch ($menu){
                case "SuratMasukAdmin":
                    $ant->menuSuratMasukAdmin();
                    break;
                case "SuratKeluarAdmin":
                    $ant->menuSuratKeluarAdmin();
                    break;
                case "ManajemenAkun":
                    $ant->menuManajemenAkun();
                    break;
                case "DataPerusahaan":
                    $ant->menuDataPerusahaan();
                    break;
                case "BuatSurat":
                    $ant->formBuatSurat($_GET["jenis"]);
                    break;
                case "FormSuratMasuk":
                    $ant->formSuratMasuk($_GET["form"], $_GET["key"]);
                    break;
                case "FormSuratKeluar":
                    $ant->formSuratKeluar($_GET["form"], $_GET["key"]);
                    break;
                case "FormAkun":
                    $ant->formAkun($_GET["form"], $_GET["key"]);
                    break;
                default:
                    $ant->halamanAdmin();
                    break;
            }            
        }


    } else {
        $ant->halamanAdmin();
    }
?>