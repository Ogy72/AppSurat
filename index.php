<?php
    include "controller/Antarmuka.php";

    $main = new Main();
    

class Main{

    public function main(){
        $ant = new Antarmuka();

        if(!empty($_COOKIE["user"])){

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
                        case "logout":
                            $val = new Validasi();
                            $val->logout();
                            break;
                        default:
                            $ant->halamanAdmin();
                            break;
                    }            
                }
            } else {
                $ant->halamanAdmin();
            }

        } else {
            $ant->halamanLogin();
        }
    }

}


?>