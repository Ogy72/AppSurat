<html>
    <table class="table table-dark table-striped table-hover table-sm">
        <thead class="thead-light text-sm">
            <tr>
                <th width="3%">No</th>
                <th width="17%">Nomor Surat</th>
                <th width="13%">Tanggal Surat</th>
                <th width="13%">Tanggal Diterima</th>
                <th width="21%">Asal Surat</th>
                <th width="20%">Perihal</th>
                <th width="13%">Pilihan</th>
            </tr>
        </thead>
        <tbody>
    <?php
        $no = 1;
        foreach($data as $d){
        echo"
            <tr>
                <td>$no</td>
                <td>$d[no_surat]</td>
                <td>$d[tgl_surat]</td>
                <td>$d[tgl_diterima]</td>
                <td>$d[nm_instansi]</td>
                <td>$d[perihal]</td>
                <td>
                    <a href='index.php?menu=FormSuratMasuk&key=$d[no_surat]&form=view' class='btn btn-success btn-sm'>View</a>
                    <a href='index.php?menu=FormSuratMasuk&key=$d[no_surat]&form=edit' class='btn btn-warning btn-sm'>Edit</a>
                    <a href='index.php?menu=FormSuratMasuk&key=$d[no_surat]&form=hapus' class='btn btn-danger btn-sm'>Hapus</a>
                </td>
            </tr>";
            $no++;
        }
    ?>
        </tbody>
    </table>
</html>