<?php
    $result = "";
    if(isset($_POST["action"])){
        $ma = new ManajemenAkun();
        $action = $_POST["action"];
        
        /*error handle*/
        if(empty($_POST["password1"])){
            $pass1 = "";
            $pass2 = "";
        } else {
            $pass1 = $_POST["password1"];
            $pass2 = $_POST["password2"];
        };
        
        $cek_username = $ma->mencariAkun($_POST["username"]);
        switch ($action){
            case "Simpan":
                $result = $ma->inputAkun($_POST["nama_lengkap"], $_POST["username"], $_POST["level"], $pass1, $pass2);
                break;
            case "Ubah":
                $result = $ma->editAkun($_POST["nama_lengkap"], $_POST["username"], $_POST["usernamex"], $_POST["level"], $pass1, $pass2, $_POST["pass_hide"]);
                break;
            case "Hapus":
                $ma->hapusAkun($_POST["username"]);
                break;
            default:
                echo "<h4 class='text-white'>Logika Error</h4>";
                break;
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Manajemen Akun</title>

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
                <img src="img/logo.png" width="75px" height="55px" >
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
                            <a class="nav-link a-clr dropdown-toggle" data-toggle="dropdown" href="#">Buat Surat</a>
                            <div class="dropdown-menu ">
                                <a class="dropdown-item text-danger" href="index.php?form=BuatSurat&bag=suratA">A.Quotation</a>
                                <a class="dropdown-item text-danger" href="index.php?form=BuatSurat&bag=suratB">B.Purchase Order</a>
                                <a class="dropdown-item text-danger" href="index.php?form=BuatSurat&bag=suratC">C.Invoice</a>
                                <a class="dropdown-item text-danger" href="index.php?form=BuatSurat&bag=suratD">D.Berita Acara </a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="a-clr nav-link" href="index.php?menu=SuratMasukAdmin">Surat Masuk</a>
                        </li>
                        <li class="nav-item">
                            <a class="a-clr nav-link" href="index.php?menu=SuratKeluarAdmin">Surat Keluar</a>
                        </li>
                        <li class="nav-item">
                            <a class="a-clr nav-link active" href="index.php?menu=ManajemenAkun">Manajemen Akun</a>
                        </li>
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
        <!-- Konten -->
        <div class="row">
            <!-- isi Konten -->
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 konten" >
                
                <div class="row mt-1 mr-1 ml-1 mb-1 text-white">
                    <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3">
                        <!--space kiri-->
                    </div>

                    <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <?php
                    switch ($form){
                        case "edit":
                            echo "<form action='' method='post'>
                                <div class='form-row'>
                                    <div class='form-group col-12'>                                    
                                        <h5 class='text-white font-weight-light text-uppercase font-weight-bold mt-5 mb-4 text-center'>
                                            Form Edit Akun
                                        </h5>
                                    </div>
                                </div>
                                <div class='form-row'>
                                    <div class='form-group col-8'>
                                        <label>Nama Lengkap</label>
                                        <input type='text' name='nama_lengkap' value='$data[nama_lengkap]' class='form-control' placeholder='Nama Lengkap' required>
                                    </div>
                                    <div class='form-group col-4'>
                                        <label>Username</label>
                                        <input type='text' name='username' value='$data[username]' class='form-control' placeholder='Username' required>
                                        <input type='hidden' name='usernamex' value='$data[username]' required>
                                    </div>
                                </div>
                                <div class='form-row'>
                                    <div class='form-group col-12'>
                                        <label for='level'>Level</label>
                                        <select name='level' class='form-control'>";
                                        if($data["level"] == "Admin"){
                                        echo"
                                            <option value='Admin' selected>Admin</option>
                                            <option value='Direktur'>Direktur</option>";
                                        } else {
                                        echo"
                                            <option value='Admin'>Admin</option>
                                            <option value='Direktur' selected>Direktur</option>";
                                        }
                                        echo"
                                        </select>
                                    </div>
                                </div>
                                <div class='form-row'>
                                    <div class='form-group col-6'>
                                    <div class='form-check'>
                                        <input class='form-check-input' type='checkbox' id='ubahPass'>
                                        <label class='form-check-label'>Ubah Password</label>
                                    </div>
                                        <input type='password' name='password1' class='form-control ubahPass' placeholder='Masukkan Password Baru'>
                                        <input type='hidden' name='pass_hide' value='$data[password]'>
                                    </div>
                                    <div class='form-group col-6 pt-4'>
                                        <input type='password' name='password2' class='form-control ubahPass' placeholder='Retype Password'>
                                    </div>
                                </div>
                                <div class='form-row'>
                                    <div class='form-group col-12'>                                    
                                        <a class='text-danger'>$result</a>
                                    </div>
                                </div>
                                <div class='form-row'>
                                    <div class='form-group col-4'>
                                        <a href='index.php?menu=ManajemenAkun' class='btn btn-danger w-100'>Batal</a>
                                    </div>
                                    <div class='form-group col-8'>
                                        <input type='submit' name='action' value='Ubah' class='btn btn-primary w-100'>
                                    </div>
                                </div>
                            </form>";
                            break;
                        case "hapus":
                            echo "<form action='' method='post'>
                                <div class='form-row'>
                                    <div class='form-group col-12'>                                    
                                        <h5 class='text-white font-weight-light text-uppercase font-weight-bold mt-5 mb-4 text-center'>
                                            Hapus Akun?
                                        </h5>
                                    </div>
                                </div>
                                <div class='form-row'>
                                    <div class='form-group col-8'>
                                        <input type='text' name='nama_lengkap' class='form-control' value='$data[nama_lengkap]' disabled>
                                    </div>
                                    <div class='form-group col-4'>
                                        <input type='text' class='form-control' value='$data[username]' disabled>
                                        <input type='hidden' name='username' value='$data[username]' required>
                                    </div>
                                </div>
                                <div class='form-row'>
                                    <div class='form-group col-12'>
                                        <label for='level'>Level</label>
                                        <input type='text' name='level' class='form-control' value='$data[level]' disabled>
                                    </div>
                                </div>
                                <div class='form-row'>
                                    <div class='form-group col-4'>
                                        <a href='index.php?menu=ManajemenAkun' class='btn btn-danger w-100'>Batal</a>
                                    </div>
                                    <div class='form-group col-8'>
                                        <input type='submit' name='action' value='Hapus' class='btn btn-primary w-100'>
                                    </div>
                                </div>
                            </form>";
                            break;
                        default:
                            echo "<form action='' method='post'>
                                <div class='form-row'>
                                    <div class='form-group col-12'>                                    
                                        <h5 class='text-white font-weight-light text-uppercase font-weight-bold mt-5 mb-4 text-center'>
                                            Form Input Akun
                                        </h5>
                                    </div>
                                </div>
                                <div class='form-row'>
                                    <div class='form-group col-8'>
                                        <input type='text' name='nama_lengkap' class='form-control' placeholder='Nama Lengkap' required>
                                    </div>
                                    <div class='form-group col-4'>
                                        <input type='text' name='username' class='form-control' placeholder='Username' required>
                                    </div>
                                </div>
                                <div class='form-row'>
                                    <div class='form-group col-12'>
                                        <label for='level'>Level</label>
                                        <select name='level' class='form-control'>
                                            <option value=''>Pilih Level</option>
                                            <option value='Admin'>Admin</option>
                                            <option value='Direktur'>Direktur</option>
                                        </select>
                                    </div>
                                </div>
                                <div class='form-row'>
                                    <div class='form-group col-6'>
                                        <input type='password' name='password1' class='form-control' required placeholder='Password'>
                                    </div>
                                    <div class='form-group col-6'>
                                        <input type='password' name='password2' class='form-control' required placeholder='Retype Password'>
                                    </div>
                                </div>
                                <div class='form-row'>
                                    <div class='form-group col-12'>                                    
                                        <a class='text-danger'>$result</a>
                                    </div>
                                </div>
                                <div class='form-row'>
                                    <div class='form-group col-4'>
                                        <a href='index.php?menu=ManajemenAkun' class='btn btn-danger w-100'>Batal</a>
                                    </div>
                                    <div class='form-group col-8'>
                                        <input type='submit' name='action' value='Simpan' class='btn btn-primary w-100'>
                                    </div>
                                </div>
                            </form>";
                            break;
                    }
                    ?>
                    </div>

                    <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3">
                        <!--space kanan-->
                    </div>
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

    <script>
        $(document).ready(function(){
            $(".ubahPass").prop("disabled", true);

            $("#ubahPass").click(function(){
                if($(this).prop("checked") == true){
                    $(".ubahPass").prop("disabled", false);
                } else if($(this).prop("checked") == false){
                    $(".ubahPass").prop("disabled", true);
                }
            })
        })
    </script>

</body>

</html>
