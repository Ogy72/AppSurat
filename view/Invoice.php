<?php

include_once "../controller/ManajemenSuratKeluar.php";
include_once "../model/SuratKeluar.php";
include_once "../model/Instansi.php";

   function penyebut($nilai) {
    $nilai = abs($nilai);
    $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
    $temp = "";
    if ($nilai < 12) {
        $temp = " ". $huruf[$nilai];
    } else if ($nilai <20) {
        $temp = penyebut($nilai - 10). " belas";
    } else if ($nilai < 100) {
        $temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);
    } else if ($nilai < 200) {
        $temp = " seratus" . penyebut($nilai - 100);
    } else if ($nilai < 1000) {
        $temp = penyebut($nilai/100) . " ratus" . penyebut($nilai % 100);
    } else if ($nilai < 2000) {
        $temp = " seribu" . penyebut($nilai - 1000);
    } else if ($nilai < 1000000) {
        $temp = penyebut($nilai/1000) . " ribu" . penyebut($nilai % 1000);
    } else if ($nilai < 1000000000) {
        $temp = penyebut($nilai/1000000) . " juta" . penyebut($nilai % 1000000);
    } else if ($nilai < 1000000000000) {
        $temp = penyebut($nilai/1000000000) . " milyar" . penyebut(fmod($nilai,1000000000));
    } else if ($nilai < 1000000000000000) {
        $temp = penyebut($nilai/1000000000000) . " trilyun" . penyebut(fmod($nilai,1000000000000));
    }     
    return $temp;
}

function terbilang($nilai) {
    if($nilai<0) {
        $hasil = "minus ". trim(penyebut($nilai));
    } else {
        $hasil = trim(penyebut($nilai));
    }     		
    return $hasil;
}

if(isset($_POST["create"])){
    /*error handle*/
    if(empty($_POST["nm_instansi"])){
        $nm_instansi = "";
        $ins = new Instansi();
        $ins->setKdInstansi($_POST["kd_instansi"]);
        $instansi = $ins->queryMencariInstansi();

        $pelanggan = $instansi["nm_instansi"];
        $pic = $instansi["pic"];
        $alamat = $instansi["alamat"];
    } else{
        $pelanggan = $_POST["nm_instansi"];
        $nm_instansi = $_POST["nm_instansi"];
        $pic = $_POST["pic"];
        $alamat = $_POST["alamat"];
    }
   
    $no_invoice = $_POST["no_invoice"];
    $msuk = new ManajemenSuratKeluar();
    $msuk->buatSurat($no_invoice, $_POST["tgl_invoice"], $_POST["pekerjaan"], "UMUM", $_POST["kd_instansi"], "", "ayunda919", $nm_instansi, $pic, $alamat);

    $deskripsi = $_POST["deskripsi"];
    $qty = $_POST["qty"];
    $satuan = $_POST["satuan"];
    $harga = $_POST["harga"];
    $totalHarga = 0;
    $subtotal = 0;
    $tax = 0;
    $total = 0;
    $no = 1;

$content .="
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
               <td colspan='7' align='center'><h3>INVOICE</h3></td>
           </tr>
           <tr>
                <td colspan='7' height='20px' style='border-bottom:solid 1'></td>
           </tr>
           <tr>
               <td style='border-left:solid 1; border-right:solid 1' colspan='7' height='20px' valign='top'></td>
           </tr>
           <tr>
               <td style='border-left:solid 1' width='40px'>No Invoice</td>
               <td width='5px'>:</td>
               <td width='350px'>$no_invoice</td>
               <td width='10px'></td>
               <td width='100px'>PO No</td>
               <td width='5px'>:</td>
               <td width='200px' style='border-right:solid 1'>$_POST[nopo]</td>
           </tr>
           <tr>
               <td style='border-left:solid 1'>Tanggal</td>
               <td>:</td>
               <td>".date('d-m-Y', strtotime($_POST['tgl_invoice']))."</td>
               <td></td>
               <td>Tanggal PO</td>
               <td>:</td>
               <td style='border-right:solid 1'>".date('d-m-Y', strtotime($_POST['tgl_po']))."</td>
           </tr>
           <tr>
               <td style='border-left:solid 1'>Pelanggan</td>
               <td>:</td>
               <td>$pelanggan</td>
               <td></td>
               <td>Jatuh Tempo</td>
               <td>:</td>
               <td style='border-right:solid 1'>".date('d-m-Y', strtotime($_POST['tempo']))."</td>
           </tr>
           <tr>
               <td style='border-left:solid 1'valign='top'>PIC</td>
               <td valign='top'>:</td>
               <td>$pic</td>
               <td></td>
               <td></td>
               <td></td>
               <td style='border-right:solid 1'></td>
           </tr>
           <tr>
               <td style='border-left:solid 1'valign='top'>Alamat</td>
               <td valign='top'>:</td>
               <td>$alamat</td>
               <td></td>
               <td></td>
               <td></td>
               <td style='border-right:solid 1'></td>
           </tr>
           <tr>
               <td style='border-left:solid 1' valign='top'>Pekerjaan</td>
               <td valign='top'>:</td>
               <td>$_POST[pekerjaan]</td>
               <td></td>
               <td></td>
               <td></td>
               <td style='border-right:solid 1'></td>
           </tr>
           <tr>
               <td style='border-left:solid 1; border-right:solid 1' colspan='7' height='20px'></td>
           </tr>
           <tr>
               <td style='border-left:solid 1; border-right:solid 1; border-bottom:solid 1' colspan='7'>
                   <table cellspacing='0' border='1'>
                       <tr>
                           <td rowspan='2' width='10px'>NO</td>
                           <td rowspan='2' width='360px' align='center'>DESKRIPSI</td>
                           <td colspan='2' align='center' width='112px'>JUMLAH</td>
                           <td rowspan='2' align='center' width='120px'>HARGA SATUAN</td>
                           <td rowspan='2' align='center' width='132px'>TOTAL</td>
                       </tr>
                       <tr>
                           <td align='center'>Qty</td>
                           <td align='center'>Satuan</td>
                       </tr>";
                    foreach($deskripsi as $key => $c){
                        $totalHarga = $qty[$key]*$harga[$key];
                        $hargaRp = "Rp.". number_format($harga[$key],0,',','.');
                        $totalHargaRp = "Rp.". number_format($totalHarga,0,',','.');
                    $content .="
                       <tr>
                           <td align='center'>$no</td>
                           <td>$deskripsi[$key]</td>
                           <td align='center'>$qty[$key]</td>
                           <td align='center'>$satuan[$key]</td>
                           <td>$hargaRp</td>
                           <td>$totalHargaRp</td>
                       </tr>";
                       $subtotal = $subtotal+$totalHarga;
                       $subtotalRp = "Rp.". number_format($subtotal,0,',','.');
                       $tax = ($subtotal*10)/100;
                       $taxRp = "Rp.". number_format($tax,0,',','.');
                       $total = $subtotal+$tax;
                       $totalRp = "Rp.". number_format($total,0,',','.');
                       $no++;
                    }
                    $content .="
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
                           <td colspan='6' align='center'><i>Terbilang : #".terbilang($total)."#</i></td>
                       </tr>
                   </table>
               </td>
           </tr>
           <tr>
               <td colspan='7' height='40px'></td>
           </tr>
           <tr>
               <td colspan='3'>Pembayaran Melalui Bank Transfer :</td>
               <td colspan='4' align='right'>PT. ALFITRA RAYA VESPINDO</td>
           </tr>
           <tr>
               <td colspan='3'><u>$_POST[bank_rek]</u></td>
               <td></td>
               <td colspan='3' rowspan='3'></td>
           </tr>
           <tr>
               <td colspan='3'>Atas Nama PT. Alfitra Raya Vespindo</td>
               <td></td>
           </tr>
           <tr>
               <td colspan='3' height='20px'></td>
               <td></td>
           </tr>
           <tr>
               <td colspan='3'></td>
               <td></td>
               <td colspan='3' align='center' style='padding-left:90px'>Deddy Irawan</td>
           </tr>
       </table>
   </html>";
   
   require_once "../mpdf/mpdf.php";
   $mpdf = new mPDF();
   $mpdf->AddPage("P", "", "", "", "", "5", "5", "5", "5", "", "", "", "", "", "", "", "", "", "", "", "A4");
   $mpdf->WriteHTML($content);
   $mpdf->Output($no_invoice.".pdf",'I');
   

} else{
    echo "error";
}
?>
