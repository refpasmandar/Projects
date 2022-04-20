<div class="container-fluid">
    <div class='text-right btnBack'>
        <a class="btn btn-sm btn-warning" href="<?php echo base_url("Master_data/Supplier/daftarSupplier") ?>"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
    </div>
    <div class="card">
        <div class="card-header">
            <h6 class="font-weight-bold text-primary"><i class="fas fa-cart-arrow-down mr-2"></i>
                Utang Awal
            </h6>
        </div>
        <div class="card-body">
            <?php $this->view('flashdata') ?>
            <form action="<?php echo base_url('Master_data/Supplier/prosesTambahUtangAwal') ?>" method="post">
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
                                    <input type="hidden" name="jenis_transaksi" value="Utang Awal">
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
                                    <label for="pegawai" class=" form-control-label">Pegawai</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="pegawai" name="" placeholder="" class="form-control" value="<?php echo ($this->fungsi->user_login()->nama_user) ?>" readonly>
                                    <input class="form-control" name="id_pegawai" type="hidden" value="<?php echo ($this->fungsi->user_login()->id_user) ?>">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="" class=" form-control-label">Pemasok</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <select class="form-control" name="id_supplier" id="id_supplier">
                                        <option value="" selected="selected" disabled="disabled">-- Pilih Pemasok -- </option>
                                        <?php foreach ($supp as $sp) { ?>
                                            <option value="<?php echo $sp->id_supplier ?>"><?php echo $sp->nama_supplier ?></option>
                                        <?php } ?>
                                    </select>
                                    <?php echo form_error("id_supplier") ?>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="" class=" form-control-label">Akun Pembayaran</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <select class="form-control" name="akun_pembayaran" id="pilih_akun">
                                        <option value="" selected="selected" disabled="disabled">-- Pilih Akun Pembayaran -- </option>
                                        <?php foreach ($akunBayar as $byr) { ?>
                                            <option value="<?php echo $byr->id_akun ?>"><?php echo $byr->nama_akun ?></option>
                                        <?php } ?>
                                    </select>
                                    <?php echo form_error("akun_pembayaran") ?>
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
                                <table class="table table-bordered table-hover" id="formPembelian">
                                    <thead class="text-center text-white bg-primary">
                                        <td>Nama Barang</td>
                                        <td>Kode Barang</td>
                                        <td>Kode Pabrik</td>
                                        <td>Harga Beli</td>
                                        <td>Jumlah</td>
                                        <td>Satuan</td>
                                        <td>Diskon</td>
                                        <td>Total</td>
                                        <td>Aksi</td>
                                    </thead>
                                    <tbody class="text-center">
                                        <tr>
                                            <td>
                                                <div class="form-group">
                                                    <select class="form-control id_barang" name="id_barang[]" id="id_barang1">
                                                        <option value="" selected="selected" disabled="disabled">-- Pilih Barang --</option>
                                                        <!-- <?php foreach ($barang as $brg) { ?>
                                                            <option value="<?php echo $brg->id_barang ?>" data-kode_barang="<?php echo $brg->kode_barang ?>"
                                                            data-kode_pabrik="<?php echo $brg->kode_pabrik ?>"
                                                            data-harga_beli="<?php echo $brg->harga_beli ?>" data-satuan="<?php echo $brg->satuan_beli ?>">
                                                                <?php echo $brg->nama_barang ?>
                                                            </option>
                                                        <?php } ?> -->
                                                    </select>
                                                    <?php echo form_error('id_barang[]') ?>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <input class="form-control kode_barang" name="kode_barang[]" id="kode_barang1" type="text" readonly>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <input class="form-control kode_pabrik" name="kode_pabrik[]" id="kode_pabrik1" type="text" readonly>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <input class="form-control harga_beli" name="harga_beli[]" id="harga_beli1" type="text" readonly>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <input class="form-control no_akun" name="qty[]" id="qty1" type="number">
                                                </div>
                                                <?php echo form_error('qty[]') ?>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <input class="form-control satuan_beli" name="satuan_beli[]" id="satuan1" type="text" readonly>
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
                                            <td>
                                                <button type="button" id="hapus" class="btn btn-danger btn-hapus"><i class="fas fa-trash"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <a class="btn btn-sm btn-info text-white btn-tambah" id="tambah_barang"><i class="fa fa-plus mr-1"></i> Tambah Barang</a>
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
                                    <input type="text" id="grand_total" name="saldo[]" placeholder="" class="form-control" readonly>
                                    <input type="hidden" name="posisi[]" value="Debit">
                                    <?php foreach ($persediaan as $brg) { ?>
                                        <input name='id_akun[]' type="hidden" value="<?php echo $brg->id_akun ?>">
                                    <?php } ?>
                                </div>
                                <div class="col col-md-3">
                                    <label for="grand_total" class=" form-control-label">Batas Nominal Utang</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <?php if ($batasUtang['totalUtang'] == 0) { ?>
                                        <input type="hidden" id="saldoUtang" name="batasUtang" placeholder="" class="form-control" value="<?php echo substr($batasUtang['saldo_awal'], 1) ?>" readonly>
                                        <input type="text" id="batasUtang" name="batasUtang" placeholder="" class="form-control" value="<?php echo substr($batasUtang['saldo_awal'], 1) ?>" readonly>
                                    <?php } else { ?>
                                        <input type="hidden" id="saldoUtang" name="batasUtang" placeholder="" class="form-control" value="<?php echo substr($batasUtang['batasUtang'], 1) ?>" readonly>
                                        <input type="text" id="batasUtang" name="batasUtang" placeholder="" class="form-control" value="<?php echo substr($batasUtang['batasUtang'], 1) ?>" readonly>
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
                                    <input type="text" id="jumlah_bayar" name="jumlah_bayar" placeholder="" class="form-control" value="0">
                                    <input type="hidden" id="jumlah_bayar_1" name="saldo[]" placeholder="" class="form-control" value="0">
                                    <input type="hidden" name="posisi[]" value="Kredit">
                                    <input name='id_akun[]' id="akun_pembayaran" type="hidden">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="Selisih" class=" form-control-label">Selisih</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="hidden" id="selisih" name="saldo[]" placeholder="" class="form-control" readonly>
                                    <input type="hidden" name="posisi[]" value="Kredit">
                                    <input type="text" id="selisih_1" name="selisih" placeholder="" class="form-control" readonly>
                                    <?php foreach ($utang as $by) { ?>
                                        <input name='id_akun[]' type="hidden" value="<?php echo $by->id_akun ?>">
                                    <?php } ?>
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
                        <button class="btn btn-primary btn-submit col-lg-5 mr-4" type="submit" id="prosesUtangAwal"><i class="fas fa-save mr-1"></i> Simpan</button>
                        <button class="btn btn-danger btn-undo col-lg-5" type="reset"><i class="fas fa-undo-alt mr-1"></i> Ulang</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        var counter = 1;
        var counterNext = parseInt(counter) + 1;
        var count = 1;
        $("#tambah_barang").on("click", function() {
            var supp = $("#id_supplier").val();
            var html = '<tr>' +
                '<td>' +
                '<div class="form-group">' +
                '<select class="form-control id_barang" name="id_barang[]" id="id_barang' + counterNext + '">' +
                '<option value="" selected="selected" disabled="disabled">-- Pilih Akun --</option>'
                // +'<?php foreach ($barang as $brg) { ?>'
                //     +'<option value="<?php echo $brg->id_barang ?>" data-kode_barang="<?php echo $brg->kode_barang ?>"data-kode_pabrik="<?php echo $brg->kode_pabrik ?>" data-harga_beli="<?php echo $brg->harga_beli ?>" data-satuan="<?php echo $brg->satuan_beli ?>"><?php echo $brg->nama_barang ?></option>'
                // +'<?php } ?>'
                +
                '</select>' +
                '<? echo form_error("id_barang[]") ?>' +
                '</div>' +
                '</td>' +
                '<td>' +
                '<div class="form-group">' +
                '<input class="form-control kode_barang" name="kode_barang[]" id="kode_barang' + counterNext + '" type="text" readonly>' +
                '</div>' +
                '</td>' +
                '<td>' +
                '<div class="form-group">' +
                '<input class="form-control kode_pabrik" name="kode_pabrik[]" id="kode_pabrik' + counterNext + '" type="text" readonly>' +
                '</div>' +
                '</td>' +
                '<td>' +
                '<div class="form-group">' +
                '<input class="form-control harga_beli" name="harga_beli[]" id="harga_beli' + counterNext + '" type="text" readonly>' +
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
                '<input class="form-control satuan_beli" name="satuan_beli[]" id="satuan' + counterNext + '" type="text" readonly>' +
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
                '</td>' +
                '<td>' +
                '<button type="button" id="hapus" class="btn btn-danger btn-hapus"><i class="fas fa-trash"></i></button>' +
                '</td>' +
                '</tr>'
            $("#formPembelian tbody").append(html);

            $.ajax({
                url: "<?= base_url('Pembelian/Pembelian/get_namaproduk'); ?>",
                method: "POST",
                dataType: "JSON",
                data: {
                    id: supp
                },
                success: function(array) {
                    var html2 = "<option selected='selected' disabled='disabled'>-- Pilih Barang -- </option>";
                    for (let index = 0; index < array.length; index++) {
                        html2 += "<option value= '" + array[index].id_barang + "' data-kode_barang= '" + array[index].kode_barang + "' data-kode_pabrik ='" + array[index].kode_pabrik + "' data-harga_beli = '" + array[index].harga_beli + "' data-satuan = '" + array[index].satuan_beli + "' >" + array[index].nama_barang + "</option>"
                    }
                    $('#id_barang' + count).html(html2);
                }
            });
            count++;
            counterNext++;
        });

        $("#formPembelian").on("click", "#hapus", function() {
            $(this).closest('tr').remove();
        });
    });

    $(document).ready(function() {
        $("#id_supplier").on('change', function() {
            var id = $(this).val();
            // var no = $("select[id^='id_produk']").attr('id').split('id_produk')[1];
            // var supp = $("#id_supplier").val();
            $.ajax({
                url: "<?= base_url('Pembelian/Pembelian/get_namaproduk'); ?>",
                method: "POST",
                dataType: "JSON",
                data: {
                    id: id
                },
                success: function(array) {
                    var html = "<option selected='selected' disabled='disabled'>-- Pilih Barang --  </option>"
                    for (let index = 0; index < array.length; index++) {
                        html += "<option value= '" + array[index].id_barang + "' data-kode_barang= '" + array[index].kode_barang + "' data-kode_pabrik ='" + array[index].kode_pabrik + "' data-harga_beli = '" + array[index].harga_beli + "' data-satuan = '" + array[index].satuan_beli + "' >" + array[index].nama_barang + "</option>"
                    }
                    $('.id_barang').html(html);
                }
            });
            $('.kode_barang, .kode_pabrik, .harga_beli, .satuan').val('');
        })
    })

    $(document).ready(function() {
        $("#pilih_akun").on("change", function() {
            var akun = $("#pilih_akun").val();
            $("#akun_pembayaran").val(akun);
        })
    })

    // Total
    $(document).on('keyup keydown click change', function() {
        $("input[id^='qty']").on('change click load', function() {
            var id = $(this).attr('id').split('qty')[1];
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
        var batasUtang = parseInt($("#saldoUtang").val());
        var diskon_total = parseInt($("#diskon_total").val());
        var jumlah_bayar = parseInt($("#jumlah_bayar").val());
        // var batasUtang = parseInt($("#batasUtang").val());
        $('.total').each(function() {
            grand_total += +$(this).val();
            // batasUtang += +$(this).val();
        });
        var selisih = grand_total - jumlah_bayar;
        $('#jumlah_bayar_1').val("-" + jumlah_bayar);
        $("#grand_total").val(grand_total);
        $('#grand_total_1').val("-" + grand_total);
        $('#batasUtang').val(batasUtang - selisih);
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
            if ($('#jenis_transaksi').val() == 'Penjualan') {
                $("#selisih").val(selisih);
                $("#selisih_1").val(selisih);
            } else {
                $("#selisih").val("-" + selisih);
                $("#selisih_1").val(selisih);
            }
        }
    });

    $(document).ready(function() {
        $("#prosesUtangAwal").on("click", function() {
            var batasUtang = parseInt($("#batasUtang").val());
            if (batasUtang < 0) {
                alert("Nilai Utang Melebihi Batas Nominal Utang");
                return false;
            }
        })
    })
</script>

<div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table dtTable table-bordered table-striped table-hover dt-responsive">
                    <thead>
                        <tr class="text-center bg-primary text-white">
                            <td>Kode Barang</td>
                            <td>Kode Pabrik</td>
                            <td>Nama Barang</td>
                            <td>Harga Beli Barang</td>
                            <td>Satuan Beli Barang</td>
                            <td>Stok Barang 1</td>
                            <td>Aksi</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($barang as $brg) { ?>
                            <tr class="text-center">
                                <td><?php echo $brg->kode_barang ?></td>
                                <td><?php echo $brg->kode_pabrik ?></td>
                                <td><?php echo $brg->nama_barang ?></td>
                                <td>Rp <?php echo number_format($brg->harga_beli, 0, ',', '.') ?></td>
                                <td><?php echo $brg->satuan_beli ?></td>
                                <td><?php echo $brg->stok_beli ?></td>
                                <td>
                                    <button class="btn btn-primary">Pilih</button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>