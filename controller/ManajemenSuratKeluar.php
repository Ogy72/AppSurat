<?php

include_once "model/SuratKeluar.php";
include_once "model/Instansi.php";

class ManajemenSuratKeluar{

    public function inputSuratKeluar($no_surat, $tgl_surat, $sifat, $perihal, $kd_instansi, $file, $kd_instansi_new, $nm_instansi, $pic, $alamat, $tmp, $id_user){
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
                if(!empty($kd_instansi_new)){
                    $ins->setKdInstansi($kd_instansi_new);
                    $ins->setNmInstansi($nm_instansi);
                    $ins->setAlamat($alamat);
                    $ins->setPic($pic);
                    $ins->queryInputInstansi();
                    $suk->setKdInstansi($kd_instansi_new);
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

    public function melihatInstansi(){
        $ins = new Instansi();
        return $ins->queryMelihatInstansi();
    }

    public function mencariSuratKeluar($no_surat){
        $suk = new SuratKeluar();
        $suk->setNoSurat($no_surat);
        return $suk->queryMencariSuratKeluar();
    }

    public function editSuratKeluar($no_surat, $no_suratx, $tgl_surat, $perihal, $sifat, $kd_instansi, $file, $filex, $kd_instansi_new, $nm_instansi, $pic, $alamat, $tmp){
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
                if(!empty($kd_instansi_new)){
                    $ins->setKdInstansi($kd_instansi_new);
                    $ins->setNmInstansi($nm_instansi);
                    $ins->setAlamat($alamat);
                    $ins->setPic($pic);
                    $ins->queryInputInstansi();
                    $suk->setKdInstansi($kd_instansi_new);
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
            if(!empty($kd_instansi_new)){
                $ins->setKdInstansi($kd_instansi_new);
                $ins->setNmInstansi($nm_instansi);
                $ins->setAlamat($alamat);
                $ins->setPic($pic);
                $ins->queryInputInstansi();
                $suk->setKdInstansi($kd_instansi_new);
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

}
?>