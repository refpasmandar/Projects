<!-- Begin Page Content -->
<div class="container-fluid">
    <div class='text-right btnBack'>
        <a class="btn btn-sm btn-warning" onclick="goBack()"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fab fa-cc-amazon-pay mr-1"></i>Form Edit Bayar Utang</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <form action="<?php echo base_url('Pembelian/Pembelian/prosesEditBayarUtang') ?>" method="post">
                        <?php foreach ($detailInvoice as $jr) : ?>
                            <div class="form-group">
                                <?php foreach ($setting as $set) : ?>
                                    <label for="Kode Transaksi"><?php echo $set->kode_transaksi ?></label>
                                    <input type="hidden" name="kode_entry" value="<?php echo $set->kode_entry ?>">
                                <?php endforeach; ?>
                                <input type="text" name="kode_jurnal" id="kode_jurnal" class="form-control" value="<?php echo $jr->kode_jurnal ?>" readonly> <?= form_error('kode_jurnal'); ?>
                                <input type="hidden" name="jenis_transaksi" id="jenis_transaksi" value="Bayar Utang">
                            </div>

                            <div class="row">
                                <div class="form-group col-4">
                                    <label>Jumlah Transaksi </label>
                                    <input value="Rp <?= number_format($jr->totalTransaksi, 0, ',', '.') ?>" class="form-control" readonly>
                                </div>

                                <div class="form-group col-4">
                                    <?php foreach ($detailInvoice as $b) : ?>
                                        <?php if ($b->totalBayar == 0) { ?>
                                            <label>Jumlah Bayar</label>
                                            <input value="Rp <?= number_format($b->totalBayar, 0, ',', '.') ?>" class="form-control" readonly>
                                        <?php } else { ?>
                                            <label>Jumlah Bayar</label>
                                            <input value="Rp <?= number_format(substr($b->totalBayar, 1, 6), 0, ',', '.') ?>" class="form-control" readonly>
                                        <?php } ?>
                                    <?php endforeach ?>
                                </div>
                                <div class="form-group col-4">
                                    <?php foreach ($detailInvoice as $u) : ?>
                                        <?php if ($u->totalUtang == 0) { ?>
                                            <label>Sisa Utang</label>
                                            <input id="batasan" value="Rp <?= number_format($u->totalUtang, 0, ',', '.') ?>" class="form-control" readonly>
                                        <?php } else if ($u->totalUtang != 0) { ?>
                                            <label>Sisa Utang</label>
                                            <input id="batasan" value="Rp <?= number_format(substr($u->totalUtang, 1, 6), 0, ',', '.') ?>" class="form-control" readonly>
                                        <?php } ?>
                                    <?php endforeach ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <?php foreach ($single as $s) : ?>
                            <?php if ($s->jenis_transaksi == 'Bayar Utang') { ?>
                                <div class="form-group">
                                    <label>Tanggal Pembayaran Utang</label>
                                    <input type="date" name="tanggal_transaksi" id="tanggal_transaksi" class="form-control" value="<?php echo $s->tanggal_transaksi ?>">
                                    <?= form_error('tanggal_transaksi'); ?>
                                </div>

                                <div class="form-group">
                                    <label>Memo</label>
                                    <input type="text" name="memo" id="memo" class="form-control" value="<?php echo $s->memo ?>">
                                    <?= form_error('memo'); ?>
                                </div>
                            <?php } ?>
                        <?php endforeach ?>

                        <div class="table-responsive">
                            <table class="table table-bordered " id="entry">
                                <thead class="text-white bg-primary">
                                    <tr class="text-center">
                                        <td>Nama Akun</td>
                                        <td>Nomor Akun</td>
                                        <td>Debit</td>
                                        <td>Kredit</td>
                                        <td hidden>test</td>
                                        <td hidden>test</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="form-group">
                                                <?php foreach ($akunUtang as $c) { ?>
                                                    <?php if ($c->jenis_transaksi == 'Bayar Utang') { ?>
                                                        <input type="hidden" name="id_jurnal[]" value="<?php echo $c->id_jurnal ?>">
                                                        <select class="form-control id_akun" name="id_akun[]" id="id_akun1" readonly>
                                                            <option id="akunUtang" value="<?php echo $c->id_akun ?>" data-no_akun="<?php echo $c->kode_akun . "-" . $c->no_akun ?>" selected="selected">
                                                                <?php echo $c->nama_akun ?>
                                                            </option>
                                                        </select>
                                                        <?= form_error('id_akun[]'); ?>
                                                    <?php } ?>
                                                <?php } ?>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <input class="form-control no_akun" name="no_akun[]" id="no_akun_1" type="text" readonly>
                                            </div>
                                        </td>
                                        <?php foreach ($akunUtang as $c) { ?>
                                            <?php if ($c->jenis_transaksi == 'Bayar Utang') { ?>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" name="debit[]" id="debit1" class="form-control debit" value="<?= $c->saldo_jurnal ?>">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" name="kredit[]" id="kredit1" class="form-control kredit" readonly>
                                                    </div>
                                                </td>
                                                <td hidden>
                                                    <div class="form-group">
                                                        <input type="text" name="posisi[]" id="posisi1" class="form-control" value="<?= $c->posisi ?>">
                                                    </div>
                                                </td>
                                                <td hidden>
                                                    <div class="form-group">
                                                        <input type="text" name="saldo[]" id="saldo1" class="form-control" value="<?= $c->saldo_jurnal ?>">
                                                    </div>
                                                </td>
                                            <?php } ?>
                                        <?php } ?>
                                    </tr>
                                    <?php foreach ($getAkunBayar as $akun) { ?>
                                        <tr>
                                            <td>
                                                <div class="form-group">

                                                    <input type="hidden" name="id_jurnal[]" value="<?php echo $akun->id_jurnal ?>">
                                                    <select class="form-control id_akun" name="id_akun[]" id="id_akun2">
                                                        <option value="">Pilih Akun Penerimaan --</option>
                                                        <?php foreach ($akunBayar as $byr) { ?>
                                                            <option value="<?php echo $byr->id_akun ?>" <?php echo $byr->id_akun == $akun->id_akun ? 'selected' : '' ?> data-no_akun="<?php echo $byr->kode_akun . "-" . $byr->no_akun ?>">
                                                                <?php echo $byr->nama_akun ?>
                                                            </option>
                                                        <?php } ?>

                                                    </select>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="form-group">
                                                    <input class="form-control no_akun" name="no_akun[]" id="no_akun_2" type="text" value="<?php echo $akun->kode_akun . '-' . $akun->no_akun ?>" readonly>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <input type="text" name="debit[]" id="debit2" class="form-control debit" readonly>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="form-group">
                                                    <input type="text" name="kredit[]" id="kredit2" class="form-control kredit" value="<?= substr($akun->saldo_jurnal, 1) ?>">
                                                </div>
                                            </td>
                                            <td hidden>
                                                <div class="form-group">
                                                    <input type="text" name="posisi[]" id="posisi2" class="form-control" value="<?= $akun->posisi ?>">
                                                </div>
                                            </td>
                                            <td hidden>
                                                <div class="form-group">
                                                    <input type="text" name="saldo[]" id="saldo2" class="form-control" value="<?= $akun->saldo_jurnal ?>">
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="col-lg-6 float-right">
                            <div class="form-group row col-lg-12">
                                <label class="col-form-label col-sm-4 text-right" for="">Total Debit :</label>
                                <div class="col-sm-8">
                                    <input class="form-control" type="text" id="t_debit" readonly>
                                </div>
                            </div>
                            <div class="form-group row col-lg-12">
                                <label class="col-form-label col-sm-4 text-right" for="">Total Kredit :</label>
                                <div class="col-sm-8">
                                    <input class="form-control" type="text" id="t_kredit" readonly>
                                </div>
                            </div>
                            <div class="form-group row col-lg-12">
                                <label class="col-form-label col-sm-4 text-right" for="">Selisih :</label>
                                <div class="col-sm-8">
                                    <input class="form-control" type="text" id="balance" readonly>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            <div class="text-center mt-4">
                <button type="submit" id="jurnal_entry" name="tambah" class="btn btn-primary font-weight-bold btn-submit" onclick="balance(event)"><i class="fas fa-save mr-1"></i> Simpan
                </button>
                <button type="reset" class="btn btn-danger font-weight-bold btn-undo"><i class="fas fa-undo mr-1"></i> Ulang</button>
            </div>
        </div>
    </div>
    </form>
</div>

<script>
    $(document).ready(function() {
        var selected = $('#akunUtang').attr("data-no_akun");
        $('#no_akun_1').val(selected);
    })
</script>
<script>
    $(document).ready(function() {

        var t_kredit = 0;
        $('.kredit').each(function() {
            t_kredit += +$(this).val();
        });
        $("#t_kredit").val(t_kredit)

        var t_debit = 0;
        $('.debit').each(function() {
            t_debit += +$(this).val();
        });
        $("#t_debit").val(t_debit);

        var t_kredit = parseInt($("#t_kredit").val());
        var t_debit = parseInt($("#t_debit").val());
        var balance = t_debit - t_kredit;
        if (isNaN(balance)) {
            $("#balance").val("");
        } else {
            $("#balance").val(balance);
        }
    });
</script>