<?php

include_once "model/SuratKeluar.php";
include_once "model/Instansi.php";
include_once "model/User.php";

class ManajemenSuratKeluar{

    public function buatSurat($no_surat, $tgl_surat, $perihal, $sifat, $kd_instansi, $file, $id_user, $nm_instansi, $pic, $alamat){
        $suk = new SuratKeluar();
        $ins = new Instansi();

        $suk->setNoSurat($no_surat);
        $suk->setTglSurat($tgl_surat);
        $suk->setPerihal($perihal);
        $suk->setSifat($sifat);
        $suk->setFile($file);
        $suk->setIdUser($id_user);

        if(!empty($nm_instansi)){    
            $kdInst = $ins->getKode();
            $ins->setKdInstansi($kdInst);
            $ins->setNmInstansi($nm_instansi);
            $ins->setAlamat($alamat);
            $ins->setPic($pic);
            $ins->queryInputInstansi();
            $suk->setKdInstansi($kdInst);
            $suk->queryInputSuratKeluar();
        } else{
            $suk->setKdInstansi($kd_instansi);
            $suk->queryInputSuratKeluar();
        }
    }

    public function inputSuratKeluar($no_surat, $tgl_surat, $sifat, $perihal, $kd_instansi, $file, $nm_instansi, $pic, $alamat, $tmp, $id_user){
        $suk = new SuratKeluar();
        $ins = new Instansi();

        $suk->setNoSurat($no_surat);
        $suk->setTglSurat($tgl_surat);
        $suk->setPerihal($perihal);
        $suk->setSifat($sifat);
        $suk->setFile($file);
        $suk->setIdUser($id_user);

        $find = $this->mencariSuratKeluar($no_surat);
        if(!empty($find)){
            return $msg_err ="Nomor Surat Yand Anda Masukkan Sudah Terdaftar";
        } else{
            $upload = $this->uploadFile($file, $tmp);
            if($upload === true){
                if(!empty($nm_instansi)){
                    $kdInst = $ins->getKode();
                    $ins->setKdInstansi($kdInst);
                    $ins->setNmInstansi($nm_instansi);
                    $ins->setAlamat($alamat);
                    $ins->setPic($pic);
                    $ins->queryInputInstansi();
                    $suk->setKdInstansi($kdInst);
                    $suk->queryInputSuratKeluar();
                } else{
                    $suk->setKdInstansi($kd_instansi);
                    $suk->queryInputSuratKeluar();
                }
            } else {
                return $msg_err ="Format File Tidak Di Dukung";
            }
        }
        header("location:index.php?menu=SuratKeluarAdmin");
    }

    public function melihatSuratKeluar($search){
        $suk = new SuratKeluar();
        $data = $suk->queryMelihatSuratKeluar($search);
        include_once "view/DataSuratKeluar.php";
    }


    public function pencarian($search){
        $suk = new SuratKeluar();
        $data = $suk->queryPencarian($search);
        include_once "view/DataSuratKeluar.php";
    }

    public function melihatInstansi(){
        $ins = new Instansi();
        return $ins->queryMelihatInstansi();
    }

    public function mencariSuratKeluar($no_surat){
        $suk = new SuratKeluar();
        $suk->setNoSurat($no_surat);
        return $suk->queryMencariSuratKeluar();
    }

    public function editSuratKeluar($no_surat, $no_suratx, $tgl_surat, $perihal, $sifat, $kd_instansi, $file, $filex, $nm_instansi, $pic, $alamat, $tmp){
        $suk = new SuratKeluar();
        $ins = new Instansi();

        $suk->setNoSurat($no_surat);
        $suk->setNoSuratx($no_suratx);
        $suk->setTglSurat($tgl_surat);
        $suk->setPerihal($perihal);
        $suk->setSifat($sifat);
        
        if(!empty($file)){
            $suk->setFile($file);
            $file_for_delete = "file/SuratKeluar/$filex";
            unlink($file_for_delete); //delete file
            $upload = $this->uploadFile($file, $tmp);
            if($upload === true){
                if(!empty($nm_instansi)){
                    $kdInst = $ins->getKode();
                    $ins->setKdInstansi($kdInst);
                    $ins->setNmInstansi($nm_instansi);
                    $ins->setAlamat($alamat);
                    $ins->setPic($pic);
                    $ins->queryInputInstansi();
                    $suk->setKdInstansi($kdInst);
                    $suk->queryEditSuratKeluar();
                } else{
                    $suk->setKdInstansi($kd_instansi);
                    $suk->queryEditSuratKeluar();
                }
            } else {
                return $msg_err ="Format File Tidak Di Dukung";
            }
        } else{
            $suk->setFile($filex);
            if(!empty($nm_instansi)){
                $kdInst = $ins->getKode();
                $ins->setKdInstansi($kdInst);
                $ins->setNmInstansi($nm_instansi);
                $ins->setAlamat($alamat);
                $ins->setPic($pic);
                $ins->queryInputInstansi();
                $suk->setKdInstansi($kdInst);
                $suk->queryEditSuratKeluar();
            } else{
                $suk->setKdInstansi($kd_instansi);
                $suk->queryEditSuratKeluar();
            }
        }
        header("location:index.php?menu=SuratKeluarAdmin");
        
    }

    public function hapusSuratKeluar($no_surat, $file){
        $suk = new SuratKeluar();
        $suk->setNoSurat($no_surat);
        $suk->queryHapusSuratkeluar();
        $file_for_delete = "file/SuratKeluar/$file";
        unlink($file_for_delete); //delete file
        header("location:index.php?menu=SuratKeluarAdmin");
    }

    public function uploadFile($file, $tmp){
        $allow_ext = array('pdf');
        $berkas = $file;
        $x = explode('.', $berkas);
        $extensi = strtolower(end($x));
        $file_tmp = $tmp;

        if(in_array($extensi, $allow_ext) === true){
            move_uploaded_file($file_tmp, 'file/SuratKeluar/'.$berkas);
            return $upload = true;
        } else {
            return $upload = false;
        }

    }

    public function getKode($char){
        $suk = new SuratKeluar();
        $data = $suk->queryMax();
        $getKode = $data['numer'];
        $year = date('Y');
            $dayDate = date('d-m');
            if($dayDate == "1-1"){
                $kode = 1;
            }
            $split = "/";
            $month = $this->getRomawi();
            $company = "ARV";

        if($getKode){
            $nilai = substr($getKode, 2, 3);
            $kode = (int) $nilai;

            $kode++;
            
            $getKode = $char.sprintf("%03s",$kode).$split.$company.$split.$month.$split.$year;

        } else{
            $kode = 1;
            $getKode = $char.sprintf("%03s",$kode).$split.$company.$split.$month.$split.$year;
        }

        $no_surat = $getKode;
        return $no_surat;

    }

    public function getRomawi(){
        $month = date('n');

        switch ($month){
            case 1:
                return "I";
                break;
            case 2:
                return "II";
                break;
            case 3:
                return "III";
                break;
            case 4:
                return "IV";
                break;
            case 5:
                return "V";
                break;
            case 6:
                return "VI";
                break;
            case 7:
                return "VII";
                break;
            case 8:
                return "VIII";
                break;
            case 9:
                return "IX";
                break;
            case 10:
                return "X";
                break;
            case 11:
                return "XI";
                break;
            default:
                return "XII";
                break;
        }
    }

}
?>
