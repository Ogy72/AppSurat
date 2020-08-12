<?php

include_once "../controller/ManajemenSuratKeluar.php";
include_once "../model/SuratKeluar.php";
include_once "../model/Instansi.php";

function penyebut($nilai)
{
    $nilai = abs($nilai);
    $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
    $temp = "";
    if ($nilai < 12) {
        $temp = " " . $huruf[$nilai];
    } else if ($nilai < 20) {
        $temp = penyebut($nilai - 10) . " belas";
    } else if ($nilai < 100) {
        $temp = penyebut($nilai / 10) . " puluh" . penyebut($nilai % 10);
    } else if ($nilai < 200) {
        $temp = " seratus" . penyebut($nilai - 100);
    } else if ($nilai < 1000) {
        $temp = penyebut($nilai / 100) . " ratus" . penyebut($nilai % 100);
    } else if ($nilai < 2000) {
        $temp = " seribu" . penyebut($nilai - 1000);
    } else if ($nilai < 1000000) {
        $temp = penyebut($nilai / 1000) . " ribu" . penyebut($nilai % 1000);
    } else if ($nilai < 1000000000) {
        $temp = penyebut($nilai / 1000000) . " juta" . penyebut($nilai % 1000000);
    } else if ($nilai < 1000000000000) {
        $temp = penyebut($nilai / 1000000000) . " milyar" . penyebut(fmod($nilai, 1000000000));
    } else if ($nilai < 1000000000000000) {
        $temp = penyebut($nilai / 1000000000000) . " trilyun" . penyebut(fmod($nilai, 1000000000000));
    }
    return $temp;
}

function bulan()
{
    $month = date('n');

    switch ($month) {
        case 1:
            return "januari";
            break;
        case 2:
            return "februari";
            break;
        case 3:
            return "maret";
            break;
        case 4:
            return "april";
            break;
        case 5:
            return "mei";
            break;
        case 6:
            return "juni";
            break;
        case 7:
            return "juli";
            break;
        case 8:
            return "agustus";
            break;
        case 9:
            return "september";
            break;
        case 10:
            return "oktober";
            break;
        case 11:
            return "november";
            break;
        default:
            return "desember";
            break;
    }
}

function terbilang($nilai)
{
    if ($nilai < 0) {
        $hasil = "minus " . trim(penyebut($nilai));
    } else {
        $hasil = trim(penyebut($nilai));
    }
    return $hasil;
}

if (isset($_POST["create"])) {
    /*error handle*/
    if (empty($_POST["nm_instansi"])) {
        $nm_instansi = "";
        $ins = new Instansi();
        $ins->setKdInstansi($_POST["kd_instansi"]);
        $instansi = $ins->queryMencariInstansi();

        $pelanggan = $instansi["nm_instansi"];
        $pic = $instansi["pic"];
        $alamat = $instansi["alamat"];
    } else {
        $pelanggan = $_POST["nm_instansi"];
        $nm_instansi = $_POST["nm_instansi"];
        $pic = $_POST["pic"];
        $alamat = $_POST["alamat"];
    }

    $tglIni = terbilang(date('d'));
    $thnIni = terbilang(date('Y'));
    $tblBarang = "";

    $no_surat = $_POST["no_surat"];
    $ext = ".pdf";
    $no_surat_new = str_replace("/", "_", $no_surat) . $ext;
    $msuk = new ManajemenSuratKeluar();
    if(empty($_POST["pekerjaan"])){
        $pekerjaan = "Berita Acara Serah Terima Barang";
    } else{
        $pekerjaan = $_POST["pekerjaan"];
    }
    $msuk->buatSurat($no_surat, $_POST["tgl_surat"], $pekerjaan, "UMUM", $_POST["kd_instansi"], "", "ayunda919", $nm_instansi, $pic, $alamat);

    if (empty($_POST["barang"])) {

        $perihal = "Menerangkan Sebagai Berikut :";
        $deskripsi = "
                    <tr>
                        <td >Pekerjaan</td>
                        <td >:</td>
                        <td  colspan='5'>$_POST[pekerjaan]</td>
                    </tr>
                    <tr>
                        <td >No. Surat</td>
                        <td >:</td>
                        <td  colspan='5'>$_POST[no_po]</td>
                    </tr>
                    <tr>
                        <td >Pada Instansi</td>
                        <td >:</td>
                        <td  colspan='5'>$pelanggan</td>
                    </tr>
                    <tr>
                        <td >PIC</td>
                        <td >:</td>
                        <td  colspan='5'>$pic</td>
                    </tr>
                    <tr>
                        <td >Alamat</td>
                        <td >:</td>
                        <td  colspan='5'>$alamat</td>
                    </tr>";
        $kesimpulan = "Pelaksanaan pekerjaan ini telah selesai dikerjakan dengan baik oleh pihak PT. Alfitra Raya Vespindo";
        $tblBarang = "";
    } else {
        $barang = $_POST["barang"];
        $satuan = $_POST["satuan"];
        $jumlah = $_POST["jumlah"];
        $no = 1;
        $perihal = "Menyerahkan Barang Kepada :";
        $deskripsi = "
                    <tr>
                        <td >Instansi</td>
                        <td >:</td>
                        <td  colspan='5'>$pelanggan</td>
                    </tr>
                    <tr>
                        <td >PIC</td>
                        <td >:</td>
                        <td  colspan='5'>$pic</td>
                    </tr>
                    <tr>
                        <td >Alamat</td>
                        <td >:</td>
                        <td  colspan='5'>$alamat</td>
                    </tr>
                    <tr>
                        <td >Berupa</td>
                        <td >:</td>
                        <td  colspan='5'></td>
                    </tr>";

        
        $tblBarang .="
                    <table cellspacing='0' border='1'>
                       <tr>
                           <td width='10px'>NO</td>
                           <td width='360px' align='center'>BARANG</td>
                           <td align='center' width='120px'>SATUAN</td>
                           <td align='center' width='132px'>JUMLAH</td>
                       </tr>";
                       foreach($barang as $key => $b){
                        $tblBarang .="
                                <tr>
                                    <td align='center'>$no</td>
                                    <td>$barang[$key]</td>
                                    <td align='center'>$satuan[$key]</td>
                                    <td align='center'>$jumlah[$key]</td>
                                </tr>";
                        $no++;
                    }
                $tblBarang .="
                   </table>";


        $kesimpulan = "Barang-barang tersebut telah diserahkan dengan baik dengan kondisi lengkap oleh pihak PT. Alfitra Raya Vespindo";
    }

    $content .= "
    <html>
       <table cellspacing='0'>
           <tr>
               <td style='border-bottom:solid 1'><img src='../img/logo.png' width='85px' height='75px'></td>
               <td colspan='6' align='center' style='border-bottom:solid 1; padding-right:65px'>
                   <h2 color='red'>PT. Alfitra Raya Vespindo</h2>
                   <h5>JL. Mawar No. S-15 RT.05 Samarinda, Kal-Tim 75123</h5>
                   <h5>Telp: 0541-749637/0811 554 296/0822 5432 9300</h5>
                   <p color='#0d7ef0'>info.alfitravespindo@gmail.com</p>
               </td>
           </tr>
           <tr>
               <td colspan='7' height='40px' valign='top'></td>
           </tr>
           <tr>
               <td colspan='7' align='center'><h3><u>BERITA ACARA SERAH TERIMA BARANG DAN HASIL PEKERJAAN</u></h3></td>
           </tr>
           <tr>
                <td colspan='7' align='center'>$no_surat Tanggal " . date('d-m-Y', strtotime($_POST['tgl_surat'])) . "</td>
           </tr>
           <tr>
                <td colspan='7' height='40px'></td>
           </tr>
           <tr>
                <td colspan='7'>Kami yang bertanda tangan dibawah ini. Pada hari ini Tanggal $tglIni Bulan " . bulan() . " Tahun $thnIni (" . date('d-m-Y') . ").</td>
           </tr>
           <tr>
                <td colspan='7' height='40px'></td>
           </tr>
           <tr>
                <td width='100px'>Nama</td>
                <td width='5px'>:</td>
                <td width='300px' colspan='5'>Deddy Irawan</td>
            </tr>
            <tr>
                <td width='100px'>Jabatan</td>
                <td width='5px'>:</td>
                <td width='300px' colspan='5'>Direktur</td>
            </tr>
            <tr>
                <td colspan='7' height='40px'></td>
           </tr>
           <tr>
               <td colspan='7' height='20px' valign='top'>$perihal</td>
           </tr>
           <tr>
                <td colspan='7' height='20px'></td>
           </tr>
                $deskripsi
           <tr>
               <td colspan='7'>
                   $tblBarang
               </td>
           </tr>
           <tr>
               <td colspan='7' height='20px'></td>
           </tr>
           <tr>
               <td colspan='7'> $kesimpulan.</td>
           </tr>
           <tr>
               <td colspan='7'>Demikian berita acara ini dibuat untuk dapat digunakan sebaik-baiknya. </td>
           </tr>
           <tr>
               <td colspan='7' height='40px'></td>
           </tr>
           <tr>
               <td colspan='4'>Yang menerima,</td>
               <td colspan='3' align='right'>Yang menyerahkan,</td>
           </tr>
            <tr>
                <td colspan='4' align='right' height='87px'></td>
                <td colspan='3' align='right'> <img src='../img/ttd.jpg' width='200px' height='77px'> </td>
            </tr>
           <tr>
               <td colspan='4' rowspan='4' valign='top'>(................................)
               <td colspan='3' align='center' height='20px' style='padding-left:170px'>(Deddy Irawan)</td>
           </tr>
       </table>
    </html>";

    require_once "../mpdf/mpdf.php";
    $mpdf = new mPDF();
    $mpdf->AddPage("P", "", "", "", "", "20", "20", "5", "5", "", "", "", "", "", "", "", "", "", "", "", "A4");
    $mpdf->WriteHTML($content);
    $mpdf->Output($no_surat_new, 'I');
} else {
    echo "error";
}
?>
