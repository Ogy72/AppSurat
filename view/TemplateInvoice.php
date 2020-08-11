<html>

<body>

    <div class='col-12 surat-scroll'>
        <div class='row'>
            <div class='col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center'>
                <h3>Invoice</h3>
            </div>
        </div>
        <form action='view/Invoice.php' method='post' target='_blank'>
            <div class='row'>
                <div class='col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6'>
                    <div class='form-row'>
                        <div class='form-group col-4'>
                            <?php
                            $no_surat = $msuk->getKode("C.");
                            ?>
                            <label for='no_invoice'>No Invoice</label>
                            <input type='text' name='no_invoice' class='form-control form-control-sm' value="<?php echo $no_surat ?>" readonly required>
                        </div>
                        <div class='form-group col-4'>
                            <label for='tgl_invoice'>Tanggal Invoice</label>
                            <input type='date' name='tgl_invoice' class='form-control form-control-sm' placeholder='Tanggal' required>
                        </div>
                        <div class='form-group col-4'>
                            <label for='Pelanggan'>Pelanggan</label>
                            <select name='kd_instansi' class='form-control form-control-sm'>
                                <option value=''>Pilih Intansi</option>
                                <?php
                                foreach ($instansi as $ins) {
                                    echo "
                                <option value='$ins[kd_instansi]'>$ins[nm_instansi]</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class='form-row'>
                        <div class='form-group col-6'>
                            <div class='form-check'>
                                <input class='form-check-input' type='checkbox' id='inputInstansi'>
                                <label class='form-check-label'>Input Instansi Baru</label>
                            </div>
                            <input type='text' name='nm_instansi' class='form-control form-control-sm' id='nm_instansi' required placeholder='Masukkan Nama Instansi'>
                        </div>
                        <div class='form-group col-6 pt-4'>
                            <input type='text' name='pic' class='form-control form-control-sm' id='pic' required placeholder='Masukkan PIC'>
                        </div>
                    </div>
                    <div class='form-row'>
                        <div class='form-group col-12'>
                            <input type='text' name='alamat' class='form-control form-control-sm' id='alamat' required placeholder='Masukkan Alamat'>
                        </div>
                    </div>
                </div>
                <div class='col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6'>
                    <div class='form-row'>
                        <div class='form-group col-4'>
                            <label for='no_po'>PO No</label>
                            <input type='text' name='nopo' class='form-control form-control-sm' placeholder='Nomor PO'>
                        </div>
                        <div class='form-group col-4'>
                            <label for='tgl_PO'>Tanggal PO</label>
                            <input type='date' name='tgl_po' class='form-control form-control-sm'>
                        </div>
                        <div class='form-group col-4'>
                            <label for='temp'>Jatuh Tempo</label>
                            <input type='date' name='tempo' class='form-control form-control-sm'>
                        </div>
                    </div>
                    <div class='form-row pt-4'>
                        <div class='form-group col-12'>
                            <input type='text' name='pekerjaan' class='form-control form-control-sm' placeholder='Masukkan Pekerjaan' required>
                        </div>
                    </div>
                    <div class='form-row'>
                        <div class='form-group col-9'>
                            <input type='text' name='bank_rek' class='form-control form-control-sm' placeholder='Masukkan Bank & No Rekening' required>
                        </div>
                        <div class='col-3 text-right mb-2'>
                            <a class='add-more btn btn-primary btn-sm text-light'>Tambah Item</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class='row'>
                <div class='col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12'>
                    <table class='table table-bordered table-sm mb-0'>
                        <thead class='thead-light'>
                            <tr>
                                <th width='50%'>Deskripsi</th>
                                <th width='10%'>Qty</th>
                                <th width='15%'>Satuan</th>
                                <th width='25%'>Harga Satuan</th>
                            </tr>
                        </thead>
                    </table>
                    <div class='input-group control-group after-add-more'></div>
                </div>
            </div>
            <div class='row mb-2 mt-3'>
                <div class='col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center'>
                    <div class='form-check mb-2 pl-5'>
                        <input class='form-check-input' type='checkbox' id='validasi'>
                        <label class='form-check-label'>Data yang saya masukkan telah sesuai</label>
                    </div>
                    <a class='btn btn-danger btn-sm' href='index.php?menu=BuatSurat&jenis=suratInv'>Batal</a>
                    <input type='submit' name='create' class='btn btn-success btn-sm w-25 create' id='buatSurat' value='Buat Surat'>
                </div>
            </div>
        </form>
    </div>

    <!--Copy Field-->
    <div class='copy hide'>
        <div class='control-group input-group'>
            <table class='table table-bordered table-sm mb-0'>
                <tbody>
                    <tr>
                        <td width='50%'><input type='text' name="deskripsi[]" class='form-control-tabel' placeholder='Masukkan Deskripsi'></td>
                        <td width='10%'><input type='text' name="qty[]" class='form-control-tabel' placeholder='Masukkan Qty'></td>
                        <td width='15%'><input type='text' name="satuan[]" class='form-control-tabel' placeholder='Masukkan Satuan'></td>
                        <td width='25%'><input type='text' name="harga[]" class='form-control-tabel' placeholder='Masukkan Harga'></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- link js -->
    <script src="js/jquery.js"></script>

    <script>
        $(document).ready(function() {
            $(".create").click(function() {
                setTimeout(function() {
                        window.location = "index.php?menu=FormSuratKeluar&key=<?php echo $no_surat ?>&form=edit"},
                    1500);
            });

            $(".hide").hide();

            $(".add-more").click(function() {
                var html = $(".copy").html();
                $(".after-add-more").before(html);
            });

            $("body").on("click", ".remove", function() {
                $(this).parents(".control-group").remove();
            });

            /*disable form intansi*/
            $("#buatSurat").prop("disabled", true);
            $("#nm_instansi").prop("disabled", true);
            $("#alamat").prop("disabled", true);
            $("#pic").prop("disabled", true);

            /*enable when checkbox clicked*/
            $("#inputInstansi").click(function() {
                if ($(this).prop("checked") == true) {
                    $("#nm_instansi").prop("disabled", false);
                    $("#alamat").prop("disabled", false);
                    $("#pic").prop("disabled", false);
                } else if ($(this).prop("checked") == false) {
                    $("#nm_instansi").prop("disabled", true);
                    $("#alamat").prop("disabled", true);
                    $("#pic").prop("disabled", true);
                }
            });

            $("#validasi").click(function(){
                if($(this).prop("checked") == true){
                    $("#buatSurat").prop("disabled", false);
                } else {
                    $("#buatSurat").prop("disabled", true);
                }
            });
        })
    </script>
</body>

</html>