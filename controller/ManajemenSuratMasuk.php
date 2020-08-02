<?php

include_once "model/SuratMasuk.php";
include_once "model/Instansi.php";

class ManajemenSuratMasuk{

    public function inputSuratMasuk($no_surat, $tgl_surat, $tgl_diterima, $perihal, $sifat, $kd_instansi, $file, $kd_perusahaan, $kd_instansi_new, $nm_instansi, $pic, $alamat, $tmp){
        $sum = new SuratMasuk();
        $ins = new Instansi();

        $sum->setNoSurat($no_surat);
        $sum->setTglSurat($tgl_surat);
        $sum->setTglDiterima($tgl_diterima);
        $sum->setPerihal($perihal);
        $sum->setSifat($sifat);
        $sum->setFile($file);
        $sum->setKdPerusahaan($kd_perusahaan);

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

    public function melihatSuratMasuk($kd_perusahaan, $search){
        $sum = new SuratMasuk();
        $sum->setKdPerusahaan($kd_perusahaan);
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

    public function uploadFile($file, $tmp){
        $allow_ext = array('pdf', 'doc', 'docx');
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