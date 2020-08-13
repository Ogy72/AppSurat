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

    if (empty($_POST["nb"])) {
        $nb = array("");
    } else {
        $nb = $_POST["nb"];
    }

    $no_surat = $_POST["no_surat"];
    $ext = ".pdf";
    $no_surat_new = str_replace("/","_",$no_surat).$ext;
    $msuk = new ManajemenSuratKeluar();
    $msuk->buatSurat($no_surat, $_POST["tgl_surat"], $_POST["pekerjaan"], "UMUM", $_POST["kd_instansi"], $no_surat_new, $_COOKIE["user"], $nm_instansi, $pic, $alamat);

    $deskripsi = $_POST["deskripsi"];
    $qty = $_POST["qty"];
    $satuan = $_POST["satuan"];
    $harga = $_POST["harga"];
    $totalHarga = 0;
    $subtotal = 0;
    $tax = 0;
    $total = 0;
    $no = 1;

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
               <td colspan='7' align='center'><h3><u>SURAT PENAWARAN HARGA (QUOTATION)</u></h3></td>
           </tr>
           <tr>
                <td colspan='7' align='center'>$no_surat Tanggal ".date('d-m-Y', strtotime($_POST['tgl_surat']))."</td>
           </tr>
           <tr>
                <td colspan='7' height='20px'></td>
           </tr>
           <tr>
               <td colspan='7' height='20px' valign='top'></td>
           </tr>
           <tr>
               <td width='150px'>Kepada YTH</td>
               <td width='5px'>:</td>
               <td width='600px' colspan='5'>$pelanggan</td>
           </tr>
           <tr>
               <td valign='top'>Alamat</td>
               <td width='5px'>:</td>
               <td colspan='5'>$alamat</td>
           </tr>
           <tr>
               <td >PIC</td>
               <td >:</td>
               <td colspan='5'>$pic</td>
           </tr>
           <tr>
               <td valign='top'>Pekerjaan</td>
               <td valign='top'>:</td>
               <td colspan='5'>$_POST[pekerjaan]</td>
            </tr>
           <tr>
               <td colspan='7' height='20px'></td>
           </tr>
           <tr>
               <td colspan='7'>
                   <table cellspacing='0' border='1'>
                       <tr>
                           <td rowspan='2' width='10px'>NO</td>
                           <td rowspan='2' width='360px' align='center'>DESKRIPSI</td>
                           <td colspan='2' align='center' width='112px'>KUANTITAS</td>
                           <td rowspan='2' align='center' width='120px'>HARGA SATUAN</td>
                           <td rowspan='2' align='center' width='132px'>TOTAL</td>
                       </tr>
                       <tr>
                           <td align='center'>Qty</td>
                           <td align='center'>Satuan</td>
                       </tr>";
                        foreach ($deskripsi as $key => $c) {
                            $totalHarga = $qty[$key] * $harga[$key];
                            $hargaRp = "Rp." . number_format($harga[$key], 0, ',', '.');
                            $totalHargaRp = "Rp." . number_format($totalHarga, 0, ',', '.');
                            $content .= "
                                        <tr>
                                            <td align='center'>$no</td>
                                            <td>$deskripsi[$key]</td>
                                            <td align='center'>$qty[$key]</td>
                                            <td align='center'>$satuan[$key]</td>
                                            <td>$hargaRp</td>
                                            <td>$totalHargaRp</td>
                                        </tr>";
                            $subtotal = $subtotal + $totalHarga;
                            $subtotalRp = "Rp." . number_format($subtotal, 0, ',', '.');
                            $tax = ($subtotal * 10) / 100;
                            $taxRp = "Rp." . number_format($tax, 0, ',', '.');
                            $total = $subtotal + $tax;
                            $totalRp = "Rp." . number_format($total, 0, ',', '.');
                            $no++;
                        }
                        $content .= "
                        <tr>
                           <td colspan='5'>Sub Total</td>
                           <td>$subtotalRp</td>
                       </tr>
                       <tr>
                           <td colspan='5'>Tax 10%</td>
                           <td>$taxRp</td>
                       </tr>
                       <tr>
                           <td colspan='5'>Total</td>
                           <td>$totalRp</td>
                       </tr>
                       <tr>
                           <td colspan='6' align='center'><i>Terbilang : #" . terbilang($total) . "#</i></td>
                       </tr>
                   </table>
               </td>
           </tr>
           <tr>
               <td colspan='7' height='40px'></td>
           </tr>
           <tr>
               <td colspan='4'><i>NB :</i></td>
               <td colspan='3' align='right'>PT. ALFITRA RAYA VESPINDO</td>
           </tr>
            <tr>
                <td colspan='4' rowspan='6' valign='top'>
                <table>";
                foreach($nb as $ky => $n) {
                $content .= "
                    <tr>
                        <td>* <i>$nb[$ky]</i></td>
                    </tr>";
                }
                $content .= "
                </table>
                </td>
                <td colspan='3' align='right'> <img src='../img/ttd.jpg' width='230px' height='87px'> </td>
            </tr>
           <tr>
               
               <td colspan='3' align='center' height='20px' style='padding-left:170px'>Deddy Irawan</td>
           </tr>
           <tr>
               
               <td colspan='3'></td>
           </tr>
           <tr>
               
               <td colspan='3'></td>
           </tr>
           <tr>
                
                <td colspan='3'></td>
           </tr>
           <tr>
                
                <td colspan='3'></td>
           </tr>
       </table>
    </html>";

    require_once "../mpdf/mpdf.php";
    $mpdf = new mPDF();
    $mpdf->AddPage("P", "", "", "", "", "5", "5", "5", "5", "", "", "", "", "", "", "", "", "", "", "", "A4");
    $mpdf->WriteHTML($content);
    $mpdf->Output("../file/SuratKeluar/$no_surat_new", 'F');
    $mpdf->Output($no_surat_new, 'I');
} else {
    echo "error";
}
?>