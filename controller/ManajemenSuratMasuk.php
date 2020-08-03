<?php

include_once "model/SuratMasuk.php";
include_once "model/Instansi.php";

class ManajemenSuratMasuk{

    public function inputSuratMasuk($no_surat, $tgl_surat, $tgl_diterima, $perihal, $sifat, $kd_instansi, $file, $kd_instansi_new, $nm_instansi, $pic, $alamat, $tmp){
        $sum = new SuratMasuk();
        $ins = new Instansi();

        $sum->setNoSurat($no_surat);
        $sum->setTglSurat($tgl_surat);
        $sum->setTglDiterima($tgl_diterima);
        $sum->setPerihal($perihal);
        $sum->setSifat($sifat);
        $sum->setFile($file);

        $upload = $this->uploadFile($file, $tmp);
        if($upload === true){
            if(!empty($kd_instansi_new)){
                $ins->setKdInstansi($kd_instansi_new);
                $ins->setNmInstansi($nm_instansi);
                $ins->setAlamat($alamat);
                $ins->setPic($pic);
                $ins->queryInputInstansi();
                $sum->setKdInstansi($kd_instansi_new);
                $sum->queryInputSuratMasuk();
            } else{
                $sum->setKdInstansi($kd_instansi);
                $sum->queryInputSuratMasuk();
            }
        } else {
            return $msg_err ="Format File Tidak Di Dukung";
        }
        header("location:index.php?menu=SuratMasukAdmin");
    }

    public function melihatSuratMasuk($search){
        $sum = new SuratMasuk();
        $data = $sum->queryMelihatSuratMasuk($search);
        include_once "view/DataSuratMasuk.php";
    }

    public function melihatInstansi(){
        $ins = new Instansi();
        return $ins->queryMelihatInstansi();
    }

    public function mencariSuratMasuk($no_surat){
        $sum = new SuratMasuk();
        $sum->setNoSurat($no_surat);
        return $sum->queryMencariSuratMasuk();
    }

    public function editSuratMasuk($no_surat, $no_suratx, $tgl_surat, $tgl_diterima, $perihal, $sifat, $kd_instansi, $file, $filex, $kd_instansi_new, $nm_instansi, $pic, $alamat, $tmp){
        $sum = new SuratMasuk();
        $ins = new Instansi();

        $sum->setNoSurat($no_surat);
        $sum->setNoSuratx($no_suratx);
        $sum->setTglSurat($tgl_surat);
        $sum->setTglDiterima($tgl_diterima);
        $sum->setPerihal($perihal);
        $sum->setSifat($sifat);
        
        if(!empty($file)){
            $sum->setFile($file);
            $file_for_delete = "file/SuratMasuk/$filex";
            unlink($file_for_delete); //delete file
            $upload = $this->uploadFile($file, $tmp);
            if($upload === true){
                if(!empty($kd_instansi_new)){
                    $ins->setKdInstansi($kd_instansi_new);
                    $ins->setNmInstansi($nm_instansi);
                    $ins->setAlamat($alamat);
                    $ins->setPic($pic);
                    $ins->queryInputInstansi();
                    $sum->setKdInstansi($kd_instansi_new);
                    $sum->queryEditSuratMasuk();
                } else{
                    $sum->setKdInstansi($kd_instansi);
                    $sum->queryEditSuratMasuk();
                }
            } else {
                return $msg_err ="Format File Tidak Di Dukung";
            }
        } else{
            $sum->setFile($filex);
            if(!empty($kd_instansi_new)){
                $ins->setKdInstansi($kd_instansi_new);
                $ins->setNmInstansi($nm_instansi);
                $ins->setAlamat($alamat);
                $ins->setPic($pic);
                $ins->queryInputInstansi();
                $sum->setKdInstansi($kd_instansi_new);
                $sum->queryEditSuratMasuk();
            } else{
                $sum->setKdInstansi($kd_instansi);
                $sum->queryEditSuratMasuk();
            }
        }
        header("location:index.php?menu=SuratMasukAdmin");
        
    }

    public function hapusSuratMasuk($no_surat, $file){
        $sum = new SuratMasuk();
        $sum->setNoSurat($no_surat);
        $sum->queryHapusSuratMasuk();
        $file_for_delete = "file/SuratMasuk/$file";
        unlink($file_for_delete); //delete file
        header("location:index.php?menu=SuratMasukAdmin");
    }

    public function uploadFile($file, $tmp){
        $allow_ext = array('pdf');
        $berkas = $file;
        $x = explode('.', $berkas);
        $extensi = strtolower(end($x));
        $file_tmp = $tmp;

        if(in_array($extensi, $allow_ext) === true){
            move_uploaded_file($file_tmp, 'file/SuratMasuk/'.$berkas);
            return $upload = true;
        } else {
            return $upload = false;
        }

    }

}
?>