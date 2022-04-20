<div class="container-fluid">
    <div class='text-right btnBack'>
        <a class="btn btn-sm btn-warning" onclick="goBack()"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
    </div>
    <div class="card">
        <div class="card-header">
            <h6 class="text-primary font-weight-bold"><i class="fas fa-cart-arrow-down mr-2"></i>Form Edit Penjualan</h6>
        </div>
        <div class="card-body">
            <?php $this->view('flashdata') ?>
            <form action="<?php echo base_url('Penjualan/Penjualan/prosesEditPenjualan') ?>" method="post">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card-header">
                            <?php foreach ($single as $s) : ?>
                                <?php if ($s->jenis_transaksi == 'Penjualan') { ?>
                                    <?php foreach ($jurnal as $jur) : ?>
                                        <?php if ($jur->jenis_transaksi == 'Penjualan') { ?>
                                            <input type="hidden" name="id_jurnal[]" id="id_jurnal" value="<?= $jur->id_jurnal ?>">
                                        <?php } ?>
                                    <?php endforeach; ?>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <?php foreach ($setting as $set) : ?>
                                                <label for="Kode Transaksi"><?php echo $set->kode_transaksi ?></label>
                                            <?php endforeach; ?>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" id="nomor_invoice" name="nomor_invoice" placeholder="" class="form-control" value="<?php echo $s->kode_jurnal ?>" readonly>
                                            <input type="hidden" id="jenis_transaksi" name="jenis_transaksi" value="Penjualan">
                                            <?php echo form_error('nomor_invoice') ?>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="" class=" form-control-label">Tanggal Transaksi</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="date" id="tanggal_transaksi" name="tanggal_transaksi" placeholder="Text" class="form-control" value="<?php echo $s->tanggal_transaksi ?>">
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
                                            <label for="" class=" form-control-label">Pelanggan</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <select class="form-control" name="id_customer" id="id_customer" readonly>
                                                <option value="0">Umum</option>
                                                <?php foreach ($cust as $cust) { ?>
                                                    <?php foreach ($customer as $ct) { ?>
                                                        <option value="<?php echo $cust->id_customer ?>" <?php echo $ct->id_customer == $cust->id_customer ? 'selected' : '' ?>><?php echo $cust->nama_customer ?></option>
                                                    <?php } ?>
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
                                                <option value="" selected="selected" disabled="disabled">-- Pilih Akun Pembayaran -- </option>
                                                <?php foreach ($getAkunTerima as $akun) { ?>
                                                    <?php foreach ($akunTerima as $byr) { ?>
                                                        <option value="<?php echo $byr->id_akun ?>" <?php echo $byr->id_akun == $akun->id_akun ? 'selected' : '' ?>><?php echo $byr->nama_akun ?></option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                            <?php echo form_error("akun_penerimaan") ?>
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php endforeach; ?>
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
                                        <td hidden>Harga Pokok</td>
                                        <td>Harga Jual</td>
                                        <td>Jumlah</td>
                                        <td>Satuan</td>
                                        <td>Diskon</td>
                                        <td>Total</td>
                                        <td hidden>Total HPP</td>
                                        <td hidden>Aksi</td>
                                    </thead>
                                    <tbody class="text-center">
                                        <?php
                                        $no = 1;
                                        foreach ($listBarang as $lb) { ?>
                                            <tr>
                                                <td>
                                                    <div class="form-group">
                                                        <select class="form-control id_barang" name="id_barang[]" id="id_barang<?php echo $no ?>">
                                                            <option value="">-- Pilih Barang --</option>
                                                            <?php foreach ($barang as $brg) { ?>
                                                                <option value="<?php echo $brg->id_barang ?>" <?php echo $brg->id_barang == $lb->id_barang ? 'selected' : '' ?> data-kode_barang="<?php echo $brg->kode_barang ?>" data-kode_pabrik="<?php echo $brg->kode_pabrik ?>" data-harga_beli="<?php echo $brg->harga_jual ?>" data-satuan="<?php echo $brg->satuan_jual ?>" data-hpp="<?php echo $brg->hpp ?>">
                                                                    <?php echo $brg->nama_barang ?>
                                                                </option>
                                                            <?php } ?>
                                                        </select>
                                                        <?php echo form_error('id_barang[]') ?>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input class="form-control kode_barang" name="kode_barang[]" id="kode_barang<?php echo $no ?>" type="text" readonly value="<?php echo $lb->kode_barang ?>">
                                                        <input type="hidden" name="id_transaksi[]" id="id_transaksi" value="<?= $lb->id_transaksijual ?>">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input class="form-control kode_pabrik" name="kode_pabrik[]" id="kode_pabrik<?php echo $no ?>" type="text" value="<?php echo $lb->kode_pabrik ?>" readonly>
                                                    </div>
                                                </td>
                                                <td hidden>
                                                    <div class="form-group">
                                                        <input class="form-control no_akun" name="hpp[]" id="hpp<?php echo $no ?>" type="text" value="<?php echo $lb->hpp ?>" readonly>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input class="form-control harga_beli" name="harga_beli[]" id="harga_beli<?php echo $no ?>" type="text" value="<?php echo $lb->harga_jual ?>" readonly>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input class="form-control qty" name="qty[]" id="qty<?php echo $no ?>" value="<?php echo $lb->qty_jual ?>" type="number">
                                                    </div>
                                                    <?php echo form_error('qty[]') ?>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input class="form-control no_akun" name="satuan_beli[]" id="satuan<?php echo $no ?>" type="text" value="<?php echo $lb->satuan_jual ?>" readonly>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input class="form-control disc" name="diskon[]" id="diskon<?php echo $no ?>" value="<?php echo $lb->diskon_jual ?>" type="text">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input class="form-control total" name="total[]" id="total<?php echo $no ?>" type="text" value="<?php echo $lb->total_jual ?>" readonly>
                                                    </div>
                                                </td>
                                                <td hidden>
                                                    <div class="form-group">
                                                        <input class="form-control totalhpp" name="total_hpp[]" id="total_hpp<?php echo $no ?>" type="text" value="<?php echo $lb->total_hpp ?>" readonly>
                                                    </div>
                                                </td>
                                                <td hidden>
                                                    <button type="button" id="hapus" class="btn btn-danger">Delete</button>
                                                </td>
                                            </tr>
                                        <?php $no++;
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                            <a class="btn btn-sm btn-info text-white" id="tambah_barang" hidden>Tambah Barang</a>
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
                                    <label for="grand_total" class=" form-control-label">Grand Total</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="grand_total" name="grand_total" placeholder="" class="form-control" readonly>
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
                                    <?php foreach ($jumlahTerima as $jb) { ?>
                                        <?php if ($jb->saldo_jurnal == 0) { ?>
                                            <input type="text" id="jumlah_bayar" name="saldo[]" placeholder="" class="form-control" value=<?php echo ($jb->saldo_jurnal) ?>>
                                        <?php } else { ?>
                                            <input type="text" id="jumlah_bayar" name="saldo[]" placeholder="" class="form-control" value=<?php echo substr($jb->saldo_jurnal, 0, 6) ?>>
                                        <?php } ?>
                                    <?php } ?>
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
                                <?php foreach ($single as $s) { ?>
                                    <?php if ($s->jenis_transaksi == 'Penjualan') { ?>
                                        <div class="col-12 col-md-9">
                                            <textarea type="text" id="memo" name="memo" placeholder="" class="form-control"><?php echo $s->memo ?></textarea>
                                            <?php echo form_error('memo') ?>
                                        </div>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 mt-4">
                        <button class="btn btn-primary btn-submit col-lg-5 mr-4" type="submit"><i class="fas fa-save mr-1"></i> Simpan</button>
                        <button class="btn btn-danger btn-undo col-lg-5" type="reset"><i class="fas fa-undo-alt mr-1"></i> Ulang</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
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
        var diskon_total = parseInt($("#diskon_total").val());
        var jumlah_bayar = parseInt($("#jumlah_bayar").val());
        $('.total').each(function() {
            grand_total += +$(this).val();
        });
        $('.totalhpp').each(function() {
            grand_totalhpp += +$(this).val();
        });

        $('#jumlah_bayar_1').val("-" + jumlah_bayar);
        $("#grand_total").val(grand_total);
        $("#grand_totalhpp").val(grand_totalhpp);
        $('#grand_total_1,#penjualan').val("-" + grand_total);
        $("#persediaan").val("-" + grand_totalhpp);
        // var grand_total = sub_total - diskon_total;
        // $("#grand_total").val(grand_total);

        var selisih = grand_total - jumlah_bayar;
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
        var grand_total = 0;
        var grand_totalhpp = 0;
        var diskon_total = parseInt($("#diskon_total").val());
        var jumlah_bayar = parseInt($("#jumlah_bayar").val());
        $('.total').each(function() {
            grand_total += +$(this).val();
        });
        $('.totalhpp').each(function() {
            grand_totalhpp += +$(this).val();
        });

        $('#jumlah_bayar_1').val("-" + jumlah_bayar);
        $("#grand_total").val(grand_total);
        $("#grand_totalhpp").val(grand_totalhpp);
        $('#grand_total_1,#penjualan').val("-" + grand_total);
        $("#persediaan").val("-" + grand_totalhpp);
        // var grand_total = sub_total - diskon_total;
        // $("#grand_total").val(grand_total);

        var selisih = grand_total - jumlah_bayar;
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

            $("#selisih_1").val(selisih);
        }
    });

    function goBack() {
        window.history.go(-1);
    }

    $(document).ready(function() {
        $("#pilih_akun").on("change", function() {
            var akun = $("#pilih_akun").val();
            $("#akun_penerimaan").val(akun);
        })
    })

    $(document).ready(function() {
        var akun = $("#pilih_akun").val();
        $("#akun_penerimaan").val(akun);
    })
</script>