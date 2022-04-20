<div class="container-fluid">
    <!-- Button Kembali -->
    <div class='text-right btnBack'>
        <a class="btn btn-sm btn-warning" onclick="goBack()"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
    </div>

    <?php $this->view('flashdata') ?>
    <!-- Form Retur Pembelian -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-exchange-alt mr-1"></i> Retur Pembelian</p>
        </div>
        <div class="card-body">
            <form action="<?php echo base_url('Pembelian/Pembelian/prosesReturBeli') ?>" method="post">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card-header">
                            <input class="form-control" name="id_pegawai" type="hidden" value="<?php echo ($this->fungsi->user_login()->id_user) ?>">
                            <input type="hidden" name="jenis_transaksi" value="Retur Pembelian">
                            <input type="hidden" name="status" value="Open">
                            <?php foreach ($single as $s) : ?>
                                <?php if ($s->jenis_transaksi == 'Pembelian') { ?>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <?php foreach ($setting as $set) : ?>
                                                <label for="Kode Transaksi"><?php echo $set->kode_transaksi ?> Pembelian</label>
                                            <?php endforeach; ?>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" id="nomor_invoice" name="nomor_invoice" placeholder="" class="form-control" value="<?php echo $s->kode_jurnal ?>" readonly>
                                        </div>
                                        <?php echo form_error('nomor_invoice') ?>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="" class=" form-control-label">Tanggal Transaksi</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="date" id="tanggal_transaksi" name="tanggal_transaksi" placeholder="Text" class="form-control">
                                            <input type="date" name="tanggal_beli" value="<?php echo $tanggal ?>" hidden>
                                            <?php echo form_error('tanggal_transaksi') ?>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="" class=" form-control-label">Pemasok</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <select class="form-control" name="id_supplier" id="id_supplier" readonly>
                                                <option value="0">Umum</option>
                                                <?php foreach ($supplier as $gs) { ?>
                                                    <?php foreach ($supp as $sp) { ?>
                                                        <option value="<?php echo $sp->id_supplier ?>" <?php echo $sp->id_supplier == $gs->id_supplier ? 'selected' : '' ?>><?php echo $sp->nama_supplier ?></option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php endforeach; ?>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="" class=" form-control-label">Memo</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="memo" name="memo" class="form-control">
                                    <?php echo form_error('memo') ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 mt-3">
                        <div class="card-header">
                            <table class="table table-bordered table-hover" id="formPembelian">
                                <thead class="text-center text-white bg-primary">
                                    <td>Nama Barang</td>
                                    <td>Kode Barang</td>
                                    <td>Kode Pabrik</td>
                                    <td>Harga Beli</td>
                                    <td>Jumlah Beli</td>
                                    <td>Diskon</td>
                                    <td>Jumlah Retur</td>
                                    <!-- <td>Satuan</td>
                                    <td>Discount Item</td> -->
                                    <td>Total</td>
                                    <td hidden>Aksi</td>
                                </thead>
                                <tbody class="text-center">
                                    <?php
                                    $no = 1;
                                    foreach ($listBarang as $gp) { ?>
                                        <tr>
                                            <td>
                                                <div class="form-group">
                                                    <select class="form-control id_produk" name="id_barang[]" id="id_barang<?php echo $no ?>" readonly>
                                                        <option value="<?= $gp->id_barang ?>"><?= $gp->nama_barang ?>
                                                        </option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <input class="form-control no_akun" name="kode_barang[]" id="kode_barang<?php echo $no ?>" type="text" readonly value="<?php echo $gp->kode_barang ?>">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <input class="form-control no_akun" name="kode_pabrik[]" id="kode_pabrik<?php echo $no ?>" type="text" value="<?php echo $gp->kode_pabrik ?>" readonly>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <input class="form-control no_akun" name="harga_beli[]" id="harga_beli<?php echo $no ?>" type="text" value="<?php echo $gp->harga_beli ?>" readonly>
                                                </div>
                                            </td>
                                            <?php if ($gp->qtyRetur == 0) { ?>
                                                <td>
                                                    <div class="form-group">
                                                        <input class="form-control" id="qty_beli<?php echo $no ?>" type="number" value="<?php echo $gp->qty_beli ?>" readonly>
                                                    </div>
                                                </td>
                                            <?php } else { ?>
                                                <td>
                                                    <div class="form-group">
                                                        <input class="form-control" id="qty_beli<?php echo $no ?>" type="number" value="<?php echo $gp->totalQtyBeli ?>" readonly>
                                                    </div>
                                                </td>
                                            <?php } ?>
                                            <td>
                                                <div class="form-group">
                                                    <input class="form-control no_akun" name="diskon_beli[]" id="diskon_beli<?php echo $no ?>" type="text" value="<?php echo $gp->diskon_beli ?>" readonly>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <input class="form-control qty" name="qty[]" id="qty_retur<?php echo $no ?>" type="number" value="0">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <input class="form-control total_retur" name="total[]" id="total_retur<?php echo $no ?>" type="text" readonly>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php $no++;
                                    } ?>
                                </tbody>
                            </table>
                            <a class="btn btn-sm btn-info text-white" id="tambah_barang" hidden>Tambah Barang</a>
                        </div>
                    </div>


                    <?php foreach ($jumlahUtang as $ju) { ?>
                        <?php if ($ju->totalUtang == 0) { ?>
                            <?php foreach ($getAkunBayar as $p) { ?>
                                <input type="hidden" name="posisi[]" value="Debit">
                                <input name='id_akun[]' type="hidden" value="<?php echo $p->id_akun ?>">
                                <input type="hidden" name="saldo[]" id="total_retur" placeholder="">
                            <?php } ?>
                        <?php } else { ?>
                            <?php foreach ($utang as $u) { ?>
                                <input type="hidden" name="posisi[]" value="Debit">
                                <input name='id_akun[]' type="hidden" value="<?php echo $u->id_akun ?>">
                                <input type="hidden" name="saldo[]" id="total_retur" placeholder="">
                            <?php } ?>
                        <?php } ?>
                    <?php } ?>

                    <?php foreach ($persediaan as $p) { ?>
                        <input type="hidden" name="posisi[]" value="Kredit">
                        <input name='id_akun[]' type="hidden" value="<?php echo $p->id_akun ?>">
                        <input type="hidden" name="saldo[]" id="barang_retur" placeholder="">
                    <?php } ?>

                    <div class="col-lg-12 mt-4 text-center">
                        <button class="btn btn-primary btn-submit" type="submit"><i class="fas fa-exchange-alt mr-1"></i>Retur</button>
                        <button class="btn btn-danger btn-undo" type="reset"><i class="fas fa-undo-alt mr-1"></i>Ulang</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).on('keyup keydown click change', function() {
        var grand_total = 0;
        var disc = parseInt($)
        $('.total_retur').each(function() {
            grand_total += +$(this).val();
        });
        $('#total_retur').val(grand_total);
        $('#barang_retur').val("-" + grand_total);
    });

    function goBack() {
        window.history.go(-1);
    }
</script>