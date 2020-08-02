<?php
    $result = "";
    if(isset($_POST["action"])){
        $msum = new ManajemenSuratMasuk();
        $action = $_POST["action"];

        /*error handle*/
        if(empty($_POST["kd_instansi_new"])){
            $kd_instansi_new = "";
            $nm_instansi = "";
            $pic = "";
            $alamat = "";
        } else{
            $kd_instansi_new = $_POST["kd_instansi_new"];
            $nm_instansi = $_POST["nm_instansi"];
            $pic = $_POST["pic"];
            $alamat = $_POST["alamat"];
        }
       
        switch ($action){
            case "Simpan":
                $result = $msum->inputSuratMasuk($_POST["no_surat"], $_POST["tgl_surat"], $_POST["tgl_diterima"], $_POST["perihal"], $_POST["sifat"], $_POST["kd_instansi"], $_FILES['berkas']['name'], $_POST["kd_perusahaan"], $kd_instansi_new, $nm_instansi, $pic, $alamat, $_FILES['berkas']['tmp_name']);
                break;
            case "Ubah":
                $result = $ma->editAkun($_POST["nama_lengkap"], $_POST["username"], $_POST["usernamex"], $_POST["level"], $_POST["password1"], $_POST["password2"], $_POST["pass_hide"]);
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
    <title>Surat Masuk</title>

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
                            <a class="a-clr nav-link  active" href="index.php?menu=SuratMasukAdmin">Surat Masuk</a>
                        </li>
                        <li class="nav-item">
                            <a class="a-clr nav-link" href="index.php?menu=SuratKeluarAdmin">Surat Keluar</a>
                        </li>
                        <li class="nav-item">
                            <a class="a-clr nav-link" href="index.php?menu=ManajemenAkun">Manajemen Akun</a>
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
                            echo "<form action='' method='post' enctype='multipart/form-data'>
                                <div class='form-row'>
                                    <div class='form-group col-12'>                                    
                                        <h5 class='text-white font-weight-light text-uppercase font-weight-bold mt-2 mb-2 text-center'>
                                            Form Edit Surat Masuk
                                        </h5>
                                    </div>
                                </div>
                                <div class='form-row'>
                                    <div class='form-group col-4'>
                                        <label for='nosurat'>No Surat</label>
                                        <input type='text' name='no_surat' value='$data[no_surat]' class='form-control form-control-sm' placeholder='No Surat' required>
                                    </div>
                                    <div class='form-group col-4'>
                                        <label for='tgl'>Tanggal Surat</label>
                                        <input type='date' name='tgl_surat' value='$data[tgl_surat]' class='form-control form-control-sm' placeholder='Tgl Surat' required>
                                    </div>
                                    <div class='form-group col-4'>
                                        <label for='tgl'>Tanggal Diterima</label>
                                        <input type='date' name='tgl_diterima' value='$data[tgl_diterima]' class='form-control form-control-sm' placeholder='Tgl Diterima' required>
                                    </div>
                                </div>
                                <div class='form-row'>
                                    <div class='form-group col-6'>
                                        <input type='text' name='perihal' value='$data[perihal]' class='form-control form-control-sm' required placeholder='Perihal Surat'>
                                    </div>
                                    <div class='form-group col-6'>
                                        <input type='text' name='sifat' value='$data[sifat]' class='form-control form-control-sm' required placeholder='Sifat Surat'>
                                    </div>
                                </div>
                                <div class='form-row'>
                                    <div class='form-group col-6'>
                                        <label>Pilih Instansi</label>
                                        <select name='kd_instansi' class='form-control form-control-sm'>
                                            <option value='$data[kd_instansi]'>$data[nm_instansi]</option>";
                                            foreach($instansi as $ins){
                                                if($data[kd_instansi] == $ins[kd_instansi]){
                                                    continue;
                                                } else{
                                                    echo"
                                                    <option value='$ins[kd_instansi]'>$ins[nm_instansi]</option>";
                                                }
                                            }
                                        echo"
                                        </select>
                                    </div>
                                    
                                    <div class='form-group col-6'>
                                        <label for='upload'>Upload File Surat</label>
                                        <input type='file' name='berkas' class='form-control-file form-control-sm' value='$data[file]' required>
                                    </div>
                                </div>
                                <div class='form-row'>
                                    <div class='form-group col-4'>    
                                        <div class='form-check'>
                                            <input class='form-check-input' type='checkbox' id='inputInstansi'>
                                            <label class='form-check-label'>Input Instansi Baru</label>
                                        </div>
                                        <input type='text' name='kd_instansi_new' class='form-control form-control-sm' id='kd_instansi' required placeholder='Masukkan Kode Intansi'>
                                    </div>
                                    <div class='form-group col-4 pt-4'>
                                        <input type='text' name='nm_instansi' class='form-control form-control-sm' id='nm_instansi' required placeholder='Masukkan Nama Instansi'>
                                    </div>
                                    <div class='form-group col-4 pt-4'>
                                        <input type='text' name='pic' class='form-control form-control-sm' id='pic' required placeholder='Masukkan PIC'>
                                    </div>
                                </div>
                                <div class='form-row'>
                                    <div class='form-group col-12'>
                                        <input type='text' name='alamat' class='form-control form-control-sm' id='alamat' required placeholder='Masukkan Alamat'>
                                    </div>
                                </div>
                                <div class='form-row'>
                                    <div class='form-group col-12'>                                    
                                        <a class='text-danger'>$result $file</a>
                                    </div>
                                </div>
                                <div class='form-row'>
                                    <div class='form-group col-4'>
                                        <a href='index.php?menu=SuratMasukAdmin' class='btn btn-sm btn-danger w-100'>Batal</a>
                                    </div>
                                    <div class='form-group col-8'>
                                        <input type='submit' name='action' value='Simpan' class='btn btn-sm btn-primary w-100'>
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
                            echo "<form action='' method='post' enctype='multipart/form-data'>
                                <div class='form-row'>
                                    <div class='form-group col-12'>                                    
                                        <h5 class='text-white font-weight-light text-uppercase font-weight-bold mt-2 mb-2 text-center'>
                                            Form Input Surat Masuk
                                        </h5>
                                    </div>
                                    <input type='hidden' name='kd_perusahaan' value='PT-ARV'>
                                </div>
                                <div class='form-row'>
                                    <div class='form-group col-4'>
                                        <label for='nosurat'>No Surat</label>
                                        <input type='text' name='no_surat' class='form-control form-control-sm' placeholder='No Surat' required>
                                    </div>
                                    <div class='form-group col-4'>
                                        <label for='tgl'>Tanggal Surat</label>
                                        <input type='date' name='tgl_surat' class='form-control form-control-sm' placeholder='Tgl Surat' required>
                                    </div>
                                    <div class='form-group col-4'>
                                        <label for='tgl'>Tanggal Diterima</label>
                                        <input type='date' name='tgl_diterima' class='form-control form-control-sm' placeholder='Tgl Diterima' required>
                                    </div>
                                </div>
                                <div class='form-row'>
                                    <div class='form-group col-6'>
                                        <input type='text' name='perihal' class='form-control form-control-sm' required placeholder='Perihal Surat'>
                                    </div>
                                    <div class='form-group col-6'>
                                        <input type='text' name='sifat' class='form-control form-control-sm' required placeholder='Sifat Surat'>
                                    </div>
                                </div>
                                <div class='form-row'>
                                    <div class='form-group col-6'>
                                        <label>Pilih Instansi</label>
                                        <select name='kd_instansi' class='form-control form-control-sm'>
                                            <option value=''>Pilih Intansi</option>";
                                            foreach($instansi as $ins){
                                             echo"
                                               <option value='$ins[kd_instansi]'>$ins[nm_instansi]</option>";
                                            }
                                        echo"
                                        </select>
                                    </div>
                                    
                                    <div class='form-group col-6'>
                                        <label for='upload'>Upload File Surat</label>
                                        <input type='file' name='berkas' class='form-control-file form-control-sm' required>
                                    </div>
                                </div>
                                <div class='form-row'>
                                    <div class='form-group col-4'>    
                                        <div class='form-check'>
                                            <input class='form-check-input' type='checkbox' id='inputInstansi'>
                                            <label class='form-check-label'>Input Instansi Baru</label>
                                        </div>
                                        <input type='text' name='kd_instansi_new' class='form-control form-control-sm' id='kd_instansi' required placeholder='Masukkan Kode Intansi'>
                                    </div>
                                    <div class='form-group col-4 pt-4'>
                                        <input type='text' name='nm_instansi' class='form-control form-control-sm' id='nm_instansi' required placeholder='Masukkan Nama Instansi'>
                                    </div>
                                    <div class='form-group col-4 pt-4'>
                                        <input type='text' name='pic' class='form-control form-control-sm' id='pic' required placeholder='Masukkan PIC'>
                                    </div>
                                </div>
                                <div class='form-row'>
                                    <div class='form-group col-12'>
                                        <input type='text' name='alamat' class='form-control form-control-sm' id='alamat' required placeholder='Masukkan Alamat'>
                                    </div>
                                </div>
                                <div class='form-row'>
                                    <div class='form-group col-12'>                                    
                                        <a class='text-danger'>$result $file</a>
                                    </div>
                                </div>
                                <div class='form-row'>
                                    <div class='form-group col-4'>
                                        <a href='index.php?menu=SuratMasukAdmin' class='btn btn-sm btn-danger w-100'>Batal</a>
                                    </div>
                                    <div class='form-group col-8'>
                                        <input type='submit' name='action' value='Simpan' class='btn btn-sm btn-primary w-100'>
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
            /*disable form intansi*/
            $("#kd_instansi").prop("disabled", true);
            $("#nm_instansi").prop("disabled", true);
            $("#alamat").prop("disabled", true);
            $("#pic").prop("disabled", true);

            /*enable when checkbox clicked*/
            $("#inputInstansi").click(function(){
                if($(this).prop("checked") == true){
                    $("#kd_instansi").prop("disabled", false);
                    $("#nm_instansi").prop("disabled", false);
                    $("#alamat").prop("disabled", false);
                    $("#pic").prop("disabled", false);
                } else if($(this).prop("checked") == false){
                    $("#kd_instansi").prop("disabled", true);
                    $("#nm_instansi").prop("disabled", true);
                    $("#alamat").prop("disabled", true);
                    $("#pic").prop("disabled", true);
                }
            });
        });
    </script>

</body>

</html>
