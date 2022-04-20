<div class="container-fluid">
    <div class='text-right btnBack'>
        <a class="btn btn-sm btn-warning" href="<?php echo base_url("Master_data/Customer/daftarCustomer") ?>"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
    </div>
    <div class="card">
        <div class="card-header">
            <h6 class="text-primary font-weight-bold"><i class="fas fa-cart-arrow-down mr-2"></i>Piutang Awal</h6>
        </div>
        <div class="card-body">
            <?php $this->view('flashdata') ?>
            <form method="post" action="<?php echo base_url('Master_data/Customer/prosesTambahPiutang') ?>">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card-header">
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <?php foreach ($setting as $set) : ?>
                                        <label for="Kode Transaksi"><?php echo $set->kode_transaksi ?></label>
                                        <input type="hidden" name="kode_transaksi" value="<?php echo $set->kode_transaksi ?>">
                                    <?php endforeach; ?>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="nomor_invoice" name="nomor_invoice" placeholder="" class="form-control" value="<?php echo set_value("nomor_invoice") ?>">
                                    <input type="hidden" name="jenis_transaksi" id="jenis_transaksi" value="Piutang Awal">
                                    <?php echo form_error('nomor_invoice') ?>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="" class=" form-control-label">Tanggal Transaksi</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="date" id="tanggal_transaksi" name="tanggal_transaksi" placeholder="Text" class="form-control" value="<?php echo set_value("tanggal_transaksi") ?>">
                                    <?php echo form_error('tanggal_transaksi') ?>
                                </div>
                            </div>
                            <div class="row form-group" hidden>
                                <div class="col col-md-3">
                                    <label for="pegawai" class="form-control-label">Pegawai</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="pegawai" name="" placeholder="" class="form-control" value="<?php echo ($this->fungsi->user_login()->nama_user) ?>" readonly>
                                    <input class="form-control" name="id_pegawai" type="hidden" value="<?php echo ($this->fungsi->user_login()->id_user) ?>">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="" class=" form-control-label">Pelanggan</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <select class="form-control" name="id_customer" id="id_customer">
                                        <option value="0">Umum</option>
                                        <?php foreach ($cust as $ct) { ?>
                                            <option value="<?php echo $ct->id_customer ?>"><?php echo $ct->nama_customer ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="" class=" form-control-label">Akun Penerimaan</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <select class="form-control" name="akun_penerimaan" id="pilih_akun">
                                        <option value="" selected="selected" disabled="disabled">-- Pilih Akun Penerimaan -- </option>
                                        <?php foreach ($akunTerima as $byr) { ?>
                                            <option value="<?php echo $byr->id_akun ?>"><?php echo $byr->nama_akun ?></option>
                                        <?php } ?>
                                    </select>
                                    <?php echo form_error("akun_penerimaan") ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-lg-6">
                        <div class="card-header">
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="" class=" form-control-label">Kode Barang</label>
                                </div>
                                <div class="col-12 col-md-9 input-group">
                                    <input type="text" id="" name="" placeholder="" class="form-control">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-info btn-flat" data-toggle="modal" data-target="#exampleModal">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="" class=" form-control-label">Qty</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="number" id="" name="" placeholder="" class="form-control">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <button class="btn btn-warning btn-flat" type="button">
                                        Tambah Barang
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <div class="col-lg-12 mt-3">
                        <div class="card-header">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="formPenjualan">
                                    <thead class="text-center text-white bg-primary">
                                        <td>Nama Barang</td>
                                        <td>Kode Barang</td>
                                        <td>Kode Pabrik</td>
                                        <td hidden>Harga Pokok</td>
                                        <td>Harga Jual</td>
                                        <td>Jumlah</td>
                                        <td>Satuan</td>
                                        <td>Diskon</td>
                                        <td>Total</td>
                                        <td hidden>Total HPP</td>
                                        <td>Aksi</td>
                                    </thead>
                                    <tbody class="text-center">
                                        <tr>
                                            <td>
                                                <div class="form-group">
                                                    <select class="form-control id_barang" name="id_barang[]" id="id_barang1">
                                                        <option value="">-- Pilih Barang --</option>
                                                        <?php foreach ($barang as $brg) { ?>
                                                            <option value="<?php echo $brg->id_barang ?>" data-kode_barang="<?php echo $brg->kode_barang ?>" data-kode_pabrik="<?php echo $brg->kode_pabrik ?>" data-harga_beli="<?php echo $brg->harga_jual ?>" data-satuan="<?php echo $brg->satuan_jual ?>" data-hpp="<?php echo $brg->hpp ?>">
                                                                <?php echo $brg->nama_barang ?>
                                                            </option>
                                                        <?php } ?>
                                                    </select>
                                                    <?php echo form_error('id_barang[]') ?>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <input class="form-control no_akun" name="kode_barang[]" id="kode_barang1" type="text" readonly>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <input class="form-control no_akun" name="kode_pabrik[]" id="kode_pabrik1" type="text" readonly>
                                                </div>
                                            </td>
                                            <td hidden>
                                                <div class="form-group">
                                                    <input class="form-control no_akun" name="hpp[]" id="hpp1" type="text" readonly>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <input class="form-control no_akun" name="harga_beli[]" id="harga_beli1" type="text" readonly>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <input class="form-control no_akun" name="qty[]" id="qty1" type="number">
                                                    <?php echo form_error('qty[]') ?>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <input class="form-control no_akun" name="satuan_beli[]" id="satuan1" type="text" readonly>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <input class="form-control no_akun" name="diskon[]" id="diskon1" type="text" value="0">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <input class="form-control no_akun total" name="total[]" id="total1" type="text" readonly>
                                                </div>
                                            </td>
                                            <td hidden>
                                                <div class="form-group">
                                                    <input class="form-control no_akun totalhpp" name="total_hpp[]" id="total_hpp1" type="text" readonly>
                                                </div>
                                            </td>
                                            <td>
                                                <button type="button" id="hapus" class="btn btn-danger btn-hapus"><i class="fas fa-trash"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <a class="btn btn-sm btn-tambah text-white btn-info" id="tambah_barang"><i class="fas fa-plus mr-1"></i>Tambah Barang</a>
                        </div>
                    </div>
                    <div class="col-lg-3 mt-3">
                        <div class="card-header">
                            <!-- <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="" class=" form-control-label">Sub-Total</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="sub_total" name="" placeholder="" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="" class=" form-control-label">Discount</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="diskon_total" name="" placeholder="" class="form-control" value="0">
                                </div>
                            </div> -->
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="grand_total" class=" form-control-label">Total Transaksi</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="grand_total" name="grand_total" placeholder="" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="row form-group" hidden>
                                <div class="col col-md-3">
                                    <label for="grand_total" class=" form-control-label">Grand Total HPP</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="" name="grand_total" placeholder="" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="grand_total" class="form-control-label">Batas Nominal Piutang</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <?php if ($batasPiutang['totalPiutang'] == 0) { ?>
                                        <input type="hidden" id="saldoPiutang" name="saldoPiutang" placeholder="" class="form-control" value="<?php echo $batasPiutang['saldoAwal'] ?>" readonly>
                                        <input type="text" id="batasPiutang" name="batasPiutang" placeholder="" class="form-control" value="<?php echo $batasPiutang['saldoAwal'] ?>" readonly>
                                    <?php } else { ?>
                                        <input type="hidden" id="saldoPiutang" name="saldoPiutang" placeholder="" class="form-control" value="<?php echo $batasPiutang['batasPiutang'] ?>" readonly>
                                        <input type="text" id="batasPiutang" name="batasPiutang" placeholder="" class="form-control" value="<?php echo $batasPiutang['batasPiutang'] ?>" readonly>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 mt-3">
                        <div class="card-header">
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="Jumlah Bayar" class=" form-control-label">Jumlah Bayar</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <!-- Akun Penerimaan -->
                                    <input type="text" id="jumlah_bayar" name="saldo[]" placeholder="" class="form-control" value="0">
                                    <input type="hidden" name="posisi[]" value="Debit">
                                    <input name='id_akun[]' id="akun_penerimaan" type="hidden">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="Selisih" class=" form-control-label">Selisih</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <!-- Akun Piutang -->
                                    <input type="text" id="selisih" name="saldo[]" placeholder="" class="form-control" readonly>
                                    <input type="hidden" name="posisi[]" value="Debit">
                                    <?php foreach ($piutang as $by) { ?>
                                        <input name='id_akun[]' type="hidden" value="<?php echo $by->id_akun ?>">
                                    <?php } ?>

                                    <!-- Akun Penjualan -->
                                    <input type="hidden" id="penjualan" name="saldo[]" placeholder="" class="form-control" readonly>
                                    <input type="hidden" name="posisi[]" value="Kredit">
                                    <?php foreach ($penjualan as $by) { ?>
                                        <input name='id_akun[]' type="hidden" value="<?php echo $by->id_akun ?>">
                                    <?php } ?>

                                    <!-- HPP -->
                                    <input type="hidden" name="posisi[]" value="Debit">
                                    <?php foreach ($hpp as $hpp) { ?>
                                        <input name='id_akun[]' type="hidden" value="<?php echo $hpp->id_akun ?>">
                                    <?php } ?>
                                    <input type="hidden" id="grand_totalhpp" name="saldo[]" placeholder="" class="form-control" value="">

                                    <!-- Akun Persediaan -->
                                    <input type="hidden" name="posisi[]" value="Kredit">
                                    <?php foreach ($persediaan as $brg) { ?>
                                        <input name='id_akun[]' type="hidden" value="<?php echo $brg->id_akun ?>">
                                    <?php } ?>
                                    <input type="hidden" id="persediaan" name="saldo[]" placeholder="" class="form-control" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 mt-3">
                        <div class="card-header">
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="" class=" form-control-label">Memo</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <textarea type="text" id="memo" name="memo" placeholder="" class="form-control"></textarea>
                                    <?php echo form_error('memo') ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 mt-4">
                        <button class="btn btn-primary btn-submit col-lg-5 mr-4" type="submit" id="prosesPiutangAwal"><i class="fas fa-save mr-1"></i> Simpan</button>
                        <button class="btn btn-danger btn-undo col-lg-5" type="reset"><i class="fas fa-undo-alt mr-1"></i> Ulang</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $("#prosesPiutangAwal").on('click', function() {
            if ($("#id_customer").val() == 0 && $("#selisih").val() != 0) {
                alert("Customer Umum Tidak Dapat Mengutang");
                return false;
            }

            var batasPiutang = parseInt($("#batasPiutang").val());
            if (batasPiutang < 0) {
                alert("Nilai Piutang Melebihi Batas Nominal Piutang");
                return false;
            }
        })
    })

    $(document).ready(function() {
        var counter = 1;
        var counterNext = parseInt(counter) + 1;
        $("#tambah_barang").on("click", function() {
            var html = '<tr>' +
                '<td>' +
                '<div class="form-group">' +
                '<select class="form-control id_barang" name="id_barang[]" id="id_barang' + counterNext + '">' +
                '<option value="">-- Pilih Akun --</option>' +
                '<?php foreach ($barang as $brg) { ?>' +
                '<option value="<?php echo $brg->id_barang ?>" data-kode_barang="<?php echo $brg->kode_barang ?>"data-kode_pabrik="<?php echo $brg->kode_pabrik ?>" data-harga_beli="<?php echo $brg->harga_jual ?>" data-satuan="<?php echo $brg->satuan_jual ?>" data-hpp="<?php echo $brg->hpp ?>"><?php echo $brg->nama_barang ?></option>' +
                '<?php } ?>' +
                '</select>' +
                '<? echo form_error("id_barang[]") ?>' +
                '</div>' +
                '</td>' +
                '<td>' +
                '<div class="form-group">' +
                '<input class="form-control no_akun" name="kode_barang[]" id="kode_barang' + counterNext + '" type="text" readonly>' +
                '</div>' +
                '</td>' +
                '<td>' +
                '<div class="form-group">' +
                '<input class="form-control no_akun" name="kode_pabrik[]" id="kode_pabrik' + counterNext + '" type="text" readonly>' +
                '</div>' +
                '</td>' +
                '<td hidden>' +
                '<div class="form-group">' +
                '<input class="form-control no_akun" name="hpp[]" id="hpp' + counterNext + '" type="text" readonly>' +
                '</div>' +
                '</td>' +
                '<td>' +
                '<div class="form-group">' +
                '<input class="form-control no_akun" name="harga_beli[]" id="harga_beli' + counterNext + '" type="text" readonly>' +
                '</div>' +
                '</td>' +
                '<td>' +
                '<div class="form-group">' +
                '<input class="form-control no_akun" name="qty[]" id="qty' + counterNext + '" type="number">' +
                '<? echo form_error("qty[]") ?>' +
                '</div>' +
                '</td>' +
                '<td>' +
                '<div class="form-group">' +
                '<input class="form-control no_akun" name="satuan_beli[]" id="satuan' + counterNext + '" type="text" readonly>' +
                '</div>' +
                '</td>' +
                '<td>' +
                '<div class="form-group">' +
                '<input class="form-control no_akun" name="diskon[]" id="diskon' + counterNext + '" type="text" value="0">' +
                '</div>' +
                '</td>' +
                '<td>' +
                '<div class="form-group">' +
                '<input class="form-control no_akun total" name="total[]" id="total' + counterNext + '" type="text" readonly>' +
                '</div>' +
                '<td hidden>' +
                '<div class="form-group">' +
                '<input class="form-control no_akun totalhpp" name="total_hpp[]" id="total_hpp' + counterNext + '" type="text" readonly>' +
                '</div>' +
                '</td>' +
                '<td>' +
                '<button type="button" id="hapus" class="btn btn-danger btn-hapus"><i class="fas fa-trash"></i></button>' +
                '</td>' +
                '</tr>'
            $("#formPenjualan tbody").append(html);
            counterNext++;
        });

        $("#formPenjualan").on("click", "#hapus", function() {
            $(this).closest('tr').remove();
        });

        $(document).ready(function() {
            $("#pilih_akun").on("change", function() {
                var akun = $("#pilih_akun").val();
                $("#akun_penerimaan").val(akun);
            })
        })
    });

    // Total
    $(document).on('keyup keydown click change', function() {
        $("input[id^='qty']").on('change click load', function() {
            var id = $(this).attr('id').split('qty')[1];
            var harga_beli = parseInt($("#harga_beli" + id).val());
            var qty = parseInt($("#qty" + id).val());
            var disc = parseInt($("#diskon" + id).val());
            var hpp = parseInt($("#hpp" + id).val());
            var t_diskon = qty * disc;
            var total = harga_beli * qty;
            var total_hpp = hpp * qty;
            var t_total = total - t_diskon
            $("#total" + id).val(t_total);
            $("#total_hpp" + id).val(total_hpp);
            if (!$('#diskon' + id).val()) {
                $("input[id^='diskon" + id + "']").each(function() {
                    $(this).val("0");
                })
            }
            if (isNaN(t_total) || isNaN(total_hpp)) {
                $("#total" + id).val("");
                $("#total_hpp" + id).val("");
            } else {
                $("#total" + id).val(t_total);
                $("#total_hpp" + id).val(total_hpp);
            }
        });
        $("input[id^='diskon']").on('change click load', function() {
            var id = $(this).attr('id').split('diskon')[1];
            var harga_beli = parseInt($("#harga_beli" + id).val());
            var qty = parseInt($("#qty" + id).val());
            var disc = parseInt($("#diskon" + id).val());
            var t_diskon = qty * disc;
            var total = harga_beli * qty;
            var t_total = total - t_diskon
            $("#total" + id).val(t_total);
            if (!$('#diskon' + id).val()) {
                $("input[id^='diskon" + id + "']").each(function() {
                    $(this).val("0");
                })
            }

            if (isNaN(t_total)) {
                $("#total" + id).val("");
            } else {
                $("#total" + id).val(t_total);
            }
        });
        var grand_total = 0;
        var grand_totalhpp = 0;
        var batasPiutang = 0;
        var saldoPiutang = parseInt($("#saldoPiutang").val());
        var diskon_total = parseInt($("#diskon_total").val());
        var jumlah_bayar = parseInt($("#jumlah_bayar").val());
        $('.total').each(function() {
            grand_total += +$(this).val();
        });

        $('.totalhpp').each(function() {
            grand_totalhpp += +$(this).val();
        });

        $('.total_awal').each(function() {
            batasPiutang += +$(this).val();
        });
        var selisih = grand_total - jumlah_bayar;
        $('#batasPiutang').val(saldoPiutang - selisih);
        $('#jumlah_bayar_1').val("-" + jumlah_bayar);
        $("#grand_total").val(grand_total);
        $("#grand_totalhpp").val(grand_totalhpp);
        $('#grand_total_1,#penjualan').val("-" + grand_total);
        $("#persediaan").val("-" + grand_totalhpp);
        // var grand_total = sub_total - diskon_total;
        // $("#grand_total").val(grand_total);

        $("#selisih").val(selisih);

        if (isNaN(grand_total)) {
            $("#grand_total").val("");
        } else {
            $("#grand_total").val(grand_total);
        }
        if (isNaN(selisih)) {
            $("#selisih").val("");
            $("#selisih_1").val("");
        } else {
            if ($('#jenis_transaksi').val() == 'Penjualan' || $('#jenis_transaksi').val() == 'Piutang Awal') {
                $("#selisih").val(selisih);
                $("#selisih_1").val(selisih);
            } else {
                $("#selisih").val("-" + selisih);
                $("#selisih_1").val(selisih);
            }
        }
    });
</script>