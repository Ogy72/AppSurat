<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Buat Surat</title>

    <!-- link css -->
    <link rel="stylesheet" href="../css/bootstrap.css">    
    <link rel="stylesheet" href="../css/style.css">
</head>

<body background="../img/bg.png" class="pl-2 pr-2">
    <div class="container-fluid">

        <!-- Header -->
        <div class="row mt-2">

            <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 header">

            </div>

            <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 header text-center">
            <h3 class="text-white font-weight-light text-uppercase font-weight-bold"> 
                <img src="../img/logo.png" width="75px" height="55px" >
                PT. Alfitra Raya Vespindo
            </h3>
            </div>

            <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 header">

            </div>
        </div>

        <!-- Navigasi -->
        <div class="row">
            <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">

            </div>

            <div class="col-8 col-sm-8 col-md-8 col-lg-8 col-xl-8" >
                <nav class="navbar navbar-expand justify-content-center">
                    <ul class="nav nav-pills nav-fill">
                        <li class="nav-item">
                            <a class="nav-item nav-link a-clr" href="../index.php">Laporan</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link a-clr active dropdown-toggle" data-toggle="dropdown" href="#">Buat Surat</a>
                            <div class="dropdown-menu ">
                                <a class="dropdown-item text-danger" href="../index.php?form=BuatSurat&bag=suratA">A.Quotation</a>
                                <a class="dropdown-item text-danger" href="../index.php?form=BuatSurat&bag=suratB">B.Purchase Order</a>
                                <a class="dropdown-item text-danger" href="../index.php?form=BuatSurat&bag=suratC">C.Invoice</a>
                                <a class="dropdown-item text-danger" href="../index.php?form=BuatSurat&bag=suratD">D.Berita Acara </a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="a-clr nav-link" href="../index.php?menu=suratMasukAdmin">Surat Masuk</a>
                        </li>
                        <li class="nav-item">
                            <a class="a-clr nav-link" href="../index.php?menu=suratKeluarAdmin">Surat Keluar</a>
                        </li>
                        <li class="nav-item">
                            <a class="a-clr nav-link" href="../index.php?menu=logout">Logout</a>
                        </li>
                    </ul>
                </nav>
            </div>

            <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">

            </div>

        </div>

        <!-- Konten -->
        <div class="row">
            <!-- isi Konten -->
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 konten" >
                <h2 class="text-white font-weight-light mb-5 text-uppercase font-weight-bold">Buat Surat</h2>
                <?php
                    if(!empty($_GET)){
                        $surat = $_GET["surat"];

                        if($surat == "A"){
                            echo "BUAT SURAT A";
                        } else if($surat == "B"){
                            echo "BUAT SURAT B";
                        }
                    }
                ?>
            </div>
        </div>

        <!-- Footer -->
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 bg-danger">
                ini Footer
            </div>
        </div>
    </div>

    <!-- link js -->
    <script src="../js/jquery.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>

</body>

</html>
