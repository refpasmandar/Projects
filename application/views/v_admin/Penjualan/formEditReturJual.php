<div class="container-fluid">
    <!-- Button Kembali -->
    <div class='text-right btnBack'>
        <a class="btn btn-sm btn-warning" onclick="goBack()"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
    </div>

    <?php $this->view('flashdata') ?>
    <!-- Form Retur Pembelian -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-exchange-alt mr-1"></i>Form Edit Retur Penjualan</h6>
        </div>
        <div class="card-body">
            <form action="<?php echo base_url('Penjualan/Penjualan/prosesEditReturJual') ?>" method="post">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card-header">
                            <input class="form-control" name="id_pegawai" type="hidden" value="<?php echo ($this->fungsi->user_login()->id_user) ?>">
                            <input type="hidden" name="jenis_transaksi" value="Retur Penjualan">
                            <?php foreach ($single as $s) : ?>
                                <?php if ($s->jenis_transaksi == 'Retur Penjualan') { ?>
                                    <?php foreach ($jurnal as $j) { ?>
                                        <?php if ($j->jenis_transaksi == 'Retur Penjualan') { ?>
                                            <input class="form-control" type="hidden" name="id_jurnal[]" value="<?php echo $j->id_jurnal ?>">
                                        <?php } ?>
                                    <?php } ?>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <?php foreach ($setting as $set) : ?>
                                                <label for="Kode Transaksi"><?php echo $set->kode_transaksi ?> Penjualan</label>
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
                                            <input type="date" id="tanggal_transaksi" name="tanggal_transaksi" placeholder="Text" class="form-control" value="<?php echo $tanggal ?>">
                                            <?php echo form_error('tanggal_transaksi') ?>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="" class=" form-control-label">Pelanggan</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <select class="form-control" name="id_customer" id="id_customer" readonly>
                                                <option value="0">Umum</option>
                                                <?php foreach ($customer as $gc) { ?>
                                                    <?php foreach ($cust as $ct) { ?>
                                                        <option value="<?php echo $ct->id_customer ?>" <?php echo $ct->id_customer == $gc->id_customer ? 'selected' : '' ?>><?php echo $ct->nama_customer ?></option>
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
                                    <input type="text" id="memo" name="memo" class="form-control" value="<?php echo $s->memo ?>">
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
                                    <td hidden>Harga Pokok</td>
                                    <td>Harga Jual</td>
                                    <td>Jumlah Jual</td>
                                    <td>Telah Di Retur</td>
                                    <td>Diskon</td>
                                    <td>Jumlah Retur</td>
                                    <td>Total</td>
                                    <td hidden>Total HPP</td>
                                    <td hidden>Aksi</td>
                                </thead>
                                <tbody class="text-center">
                                    <?php
                                    $no = 1;
                                    foreach ($listBarang as $gp) { ?>
                                        <tr>
                                            <td>
                                                <div class="form-group">
                                                    <select class="form-control id_barang" name="id_barang[]" id="id_barang<?php echo $no ?>" readonly>
                                                        <option value="">-- Pilih Barang --</option>
                                                        <?php foreach ($barang as $brg) { ?>
                                                            <option value="<?php echo $brg->id_barang ?>" <?php echo $brg->id_barang == $gp->id_barang ? 'selected' : '' ?> data-kode_barang="<?php echo $brg->kode_barang ?>" data-kode_pabrik="<?php echo $brg->kode_pabrik ?>" data-harga_beli="<?php echo $brg->harga_jual ?>" data-satuan="<?php echo $brg->id_satuanjual ?>">
                                                                <?php echo $brg->nama_barang ?>
                                                            </option>
                                                        <?php } ?>

                                                    </select>
                                                    <input type="hidden" name="id_transaksi[]" id="id_transaksi" value="<?= $gp->id_returjual ?>">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <input class="form-control no_akun" name="kode_produk[]" id="kode_produk<?php echo $no ?>" type="text" readonly value="<?php echo $gp->kode_barang ?>">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <input class="form-control no_akun" name="kode_pabrik[]" id="kode_pabrik<?php echo $no ?>" type="text" value="<?php echo $gp->kode_pabrik ?>" readonly>
                                                </div>
                                            </td>
                                            <td hidden>
                                                <div class="form-group">
                                                    <input class="form-control hpp" name="hpp[]" id="hpp<?php echo $no ?>" type="text" value="<?php echo $gp->hpp ?>" readonly>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <input class="form-control no_akun" name="harga_beli[]" id="harga_beli<?php echo $no ?>" type="text" value="<?php echo $gp->harga_jual ?>" readonly>
                                                </div>
                                            </td>
                                            <td>
                                                <?php $qty = $this->db->query("SELECT qty_jual,diskon_jual from tb_transaksijual where kode_jurnal = '$gp->kode_jurnal' and id_barang = '$gp->id_barang'")->row_array(); ?>
                                                <div class="form-group">
                                                    <input class="form-control no_akun" name="qty_jual[]" id="qty_jual<?php echo $no ?>" type="text" value="<?php echo $qty['qty_jual'] ?>" readonly>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <input class="form-control no_akun" name="jumlahRetur[]" id="jumlahRetur<?php echo $no ?>" type="text" value="<?php echo $gp->jumlahRetur ?>" readonly>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <input class="form-control no_akun" name="diskon_beli[]" id="diskon_beli<?php echo $no ?>" type="text" value="<?php echo $qty['diskon_jual'] ?>" readonly>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <input class="form-control qty" name="qty[]" id="qty_retur<?php echo $no ?>" type="number" value="<?php echo $gp->qty_returjual ?>">
                                                    <?php echo form_error('qty[]') ?>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <input class="form-control total_retur" name="total[]" id="total_retur<?php echo $no ?>" value="<?php echo $gp->total_returjual ?>" type="text" readonly>
                                                </div>
                                            </td>
                                            <td hidden>
                                                <div class="form-group">
                                                    <input class="form-control total_hpp" name="total_hpp[]" id="total_hpp<?php echo $no ?>" value="<?php echo $gp->total_returhpp ?>" type="text" readonly>
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
                            <a class="btn btn-sm btn-info text-white" id="tambah_barang" hidden>Tambah Barang</a>
                        </div>
                    </div>


                    <?php foreach ($penjualan as $pj) { ?>
                        <input type="hidden" name="posisi[]" value="Debit">
                        <input name='id_akun[]' type="hidden" value="<?php echo $pj->id_akun ?>">
                        <input type="hidden" name="saldo[]" id="total_penjualan" placeholder="">
                    <?php } ?>

                    <?php foreach ($jumlahPiutang as $jp) { ?>
                        <?php if ($jp->totalPiutang == 0) { ?>
                            <?php foreach ($getAkunTerima as $p) { ?>
                                <input type="hidden" name="posisi[]" value="Kredit">
                                <input name='id_akun[]' type="hidden" value="<?php echo $p->id_akun ?>">
                                <input type="hidden" name="saldo[]" id="total_penerimaan" placeholder="">
                            <?php } ?>
                        <?php } else { ?>
                            <?php foreach ($piutang as $u) { ?>
                                <input type="hidden" name="posisi[]" value="Kredit">
                                <input name='id_akun[]' type="hidden" value="<?php echo $u->id_akun ?>">
                                <input type="hidden" name="saldo[]" id="total_penerimaan" placeholder="">
                            <?php } ?>
                        <?php } ?>
                    <?php } ?>

                    <?php foreach ($persediaan as $p) { ?>
                        <input type="hidden" name="posisi[]" value="Debit">
                        <input name='id_akun[]' type="hidden" value="<?php echo $p->id_akun ?>">
                        <input type="hidden" name="saldo[]" id="barang_retur" placeholder="">
                    <?php } ?>

                    <?php foreach ($hpp as $hpp) { ?>
                        <input type="hidden" name="posisi[]" value="Kredit">
                        <input name='id_akun[]' type="hidden" value="<?php echo $hpp->id_akun ?>">
                        <input type="hidden" id="total_hpp" name="saldo[]">
                    <?php } ?>

                    <div class="col-lg-12 mt-4 text-center">
                        <button class="btn btn-primary btn-submit" type="submit"><i class="fas fa-save mr-1"></i>Simpan</button>
                        <button class="btn btn-danger btn-undo" type="reset"><i class="fas fa-undo-alt mr-1"></i>Ulang</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        var grand_total = 0;
        var total_hpp = 0;
        $('.total_retur').each(function() {
            grand_total += +$(this).val();
        });
        $('.total_hpp').each(function() {
            total_hpp += +$(this).val();
        });
        $('#total_penjualan').val(grand_total);
        $('#total_penerimaan').val("-" + grand_total);
        $('#barang_retur').val(total_hpp);
        $('#total_hpp').val("-" + total_hpp)
    });

    $(document).on('keyup keydown click change', function() {
        var grand_total = 0;
        var total_hpp = 0;
        $('.total_retur').each(function() {
            grand_total += +$(this).val();
        });
        $('.total_hpp').each(function() {
            total_hpp += +$(this).val();
        });
        $('#total_penjualan').val(grand_total);
        $('#total_penerimaan').val("-" + grand_total);
        $('#barang_retur').val(total_hpp);
        $('#total_hpp').val("-" + total_hpp)
    });

    function goBack() {
        window.history.go(-1);
    }
</script>