<html>
    <table class="table table-dark table-striped table-hover table-sm mb-0">
        <thead class="thead-light text-sm">
            <tr>
                <th width="3%">No</th>
                <th width="17%">Nomor Surat</th>
                <th width="13%">Tanggal Surat</th>
                <th width="22%">Perihal</th>
                <th width="17%">Untuk Instansi</th>
                <th width="15%">Dibuat Oleh</th>
                <th width="13%">Pilihan</th>
            </tr>
        </thead>
    </table>
    <div class="table-scroll">
        <table class="table table-dark table-striped table-hover table-sm">
            <tbody>
        <?php
            $no = 1;
            foreach($data as $d){
            $ins = new Instansi();
            $usr = new User();
            $ins->setKdInstansi($d["kd_instansi"]);
            $usr->setUsername($d["username"]);
            $instansi = $ins->queryMencariInstansi();
            $user = $usr->queryMencariAkun();
            echo"
                <tr>
                    <td width='3%'>$no</td>
                    <td width='17%'>$d[no_surat]</td>
                    <td width='13%'>$d[tgl_surat]</td>
                    <td width='22%'>$d[perihal]</td>
                    <td width='17%'>$instansi[nm_instansi]</td>
                    <td width='15%'>$user[nama_lengkap]</td>
                    <td width='13%'>";
                    if(!empty($d["file"])){
                        echo "
                        <a href='file/SuratKeluar/$d[file]' target='_blank' class='btn btn-success btn-sm'>View</a>
                        <a href='index.php?menu=FormSuratKeluar&key=$d[no_surat]&form=edit' class='btn btn-warning btn-sm'>Edit</a>
                        <a href='index.php?menu=FormSuratKeluar&key=$d[no_surat]&form=hapus' class='btn btn-danger btn-sm'>Hapus</a>";
                    } else{
                        echo "
                        <a href='index.php?menu=FormSuratKeluar&key=$d[no_surat]&form=edit' class='btn btn-warning btn-sm'>Edit</a>
                        <a href='index.php?menu=FormSuratKeluar&key=$d[no_surat]&form=hapus' class='btn btn-danger btn-sm'>Hapus</a>";
                    }
                    echo"
                    </td>
                </tr>";
                $no++;
            }
        ?>
            </tbody>
        </table>
    </div>
</html>
