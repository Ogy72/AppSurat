<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Buat Surat</title>

    <!-- link css -->
    <link rel="stylesheet" href="css/bootstrap.css">    
    <link rel="stylesheet" href="css/style.css">

</head>

<body background="img/bg.png" class="pl-2 pr-2">
    <div class="container-fluid">

        <!-- Header -->
        <div class="row mt-2">

            <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 header">
                <!-- Sapace Kiri -->
            </div>

            <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 header text-center">
            <h3 class="text-white font-weight-light text-uppercase font-weight-bold"> 
                <img src="img/logo.png" width="75px" height="55px">
                PT. Alfitra Raya Vespindo
            </h3>
            </div>

            <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 header">
                <!-- Sapace Kanan -->
            </div>
        </div>

        <!-- Navigasi -->
        <div class="row">
            <div class="col-1 col-sm-1 col-md-1 col-lg-1 col-xl-1">
                <!-- Sapace Kiri -->
            </div>

            <div class="col-10 col-sm-10 col-md-10 col-lg-10 col-xl-10" >
                <nav class="navbar navbar-expand justify-content-center">
                    <ul class="nav nav-pills nav-fill">
                        <li class="nav-item">
                            <a class="a-clr nav-link" href="index.php">Laporan</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link a-clr dropdown-toggle active" data-toggle="dropdown" href="#">Buat Surat</a>
                            <div class="dropdown-menu ">
                                <a class="dropdown-item text-danger" href="index.php?menu=BuatSurat&jenis=suratQu">A.Quotation</a>
                                <a class="dropdown-item text-danger" href="index.php?menu=BuatSurat&jenis=suratInv">C.Invoice</a>
                                <a class="dropdown-item text-danger" href="index.php?menu=BuatSurat&jenis=suratBa">E.Berita Acara </a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="a-clr nav-link" href="index.php?menu=SuratMasukAdmin">Surat Masuk</a>
                        </li>
                        <li class="nav-item">
                            <a class="a-clr nav-link" href="index.php?menu=SuratKeluarAdmin">Surat Keluar</a>
                        </li>
                        <?php
                            if($_COOKIE["level"] == "Super Admin"){
                                echo '
                                <li class="nav-item">
                                    <a class="a-clr nav-link" href="index.php?menu=ManajemenAkun">Manajemen Akun</a>
                                </li>';
                            }
                        ?>
                        <li class="nav-item">
                            <a class="a-clr nav-link" href="index.php?menu=logout">Logout</a>
                        </li>
                    </ul>
                </nav>
            </div>

            <div class="col-1 col-sm-1 col-md-1 col-lg-1 col-xl-1">
                <!-- Sapace Kanan -->
            </div>

        </div>

        <!-- Konten -->
        <div class="row">
            <!-- isi Konten -->
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 konten">
                <div class="row mt-3 mr-1 ml-1 mb-1">
                    <?php
                        $msuk = new ManajemenSuratKeluar();
                        $instansi = $msuk->melihatInstansi();
                        switch ($jenis_surat){
                            case "suratQu":
                                include_once "view/TemplateQuotation.php";
                                break;
                            case "suratInv":
                                include_once "view/TemplateInvoice.php";
                                break;
                            default:
                                include_once "view/TemplateBeritaAcara.php";
                                break;
                        }
                    ?>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 bg-danger text-center">
                <a class="text-white">@Copyright 2020</a>
            </div>
        </div>
    </div>

    <!-- link js -->
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
