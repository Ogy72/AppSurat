<html>
    <table class="table table-dark table-striped table-hover table-sm mb-0 mt-2">
        <thead class="thead-light text-sm">
            <tr>
                <th width="5%">No</th>
                <th width="35%">Nama Lengkap</th>
                <th width="25%">Username</th>
                <th width="25%">Level</th>
                <th width="10%">Pilihan</th>
            </tr>
        </thead>
    </table>
    <div class="table-scroll">
        <table class="table table-dark table-striped table-hover table-sm">
            <tbody>
        <?php
            $no = 1;
            foreach($data as $d){
            echo"
                <tr>
                    <td width='5%'>$no</td>
                    <td width='35%'>$d[nama_lengkap]</td>
                    <td width='25%'>$d[username]</td>
                    <td width='25%'>$d[level]</td>
                    <td width='10%'>
                        <a href='index.php?menu=FormAkun&key=$d[username]&form=edit' class='btn btn-warning btn-sm'>Edit</a>
                        <a href='index.php?menu=FormAkun&key=$d[username]&form=hapus' class='btn btn-danger btn-sm'>Hapus</a>
                    </td>
                </tr>";
                $no++;
            }
        ?>
            </tbody>
        </table>
    </div>
</html>