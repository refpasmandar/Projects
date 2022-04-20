<!-- Begin Page Content -->
<div class="container-fluid">
    <p class="title_halaman"><i class="fas fa-money-bill mr-1"></i> Terima Piutang</p>
    <hr>
    <div class='text-right btnBack'>
        <a class="btn btn-sm btn-warning" onclick="goBack()"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Terima Piutang</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <form action="<?php echo base_url('Penjualan/Penjualan/prosesTerimaPiutang') ?>" method="post">
                        <?php foreach ($detailInvoice as $jr) : ?>
                            <div class="form-group">
                                <?php foreach ($setting as $set) : ?>
                                    <label for="Kode Transaksi"><?php echo $set->kode_transaksi ?></label>
                                    <input type="hidden" name="kode_entry" value="<?php echo $set->kode_entry ?>">
                                <?php endforeach; ?>
                                <input type="text" name="kode_jurnal" id="kode_jurnal" class="form-control" value="<?php echo $jr->kode_jurnal ?>" readonly> <?= form_error('kode_jurnal'); ?>
                                <input type="hidden" name="jenis_transaksi" id="jenis_transaksi" value="Terima Piutang">
                                <input type="hidden" name="status" value="Open">
                            </div>

                            <div class="row">
                                <?php foreach ($detailInvoice as $t) : ?>
                                    <div class="form-group col-4">
                                        <label>Jumlah Transaksi </label>
                                        <input value="RP <?= substr(number_format($t->totalTransaksi, 0, ',', '.'), 1, 12) ?>" class="form-control" readonly>
                                    </div>
                                <?php endforeach ?>

                                <div class="form-group col-4">
                                    <?php foreach ($detailInvoice as $b) : ?>
                                        <label>Jumlah Bayar</label>
                                        <input value="Rp <?= number_format($b->totalBayar, 0, ',', '.') ?>" class="form-control" readonly>
                                    <?php endforeach ?>
                                </div>
                                <div class="form-group col-4">
                                    <?php foreach ($detailInvoice as $u) : ?>
                                        <label>Sisa Piutang</label>
                                        <input id="batasan" value="Rp <?= number_format($u->totalPiutang, 0, ',', '.') ?>" class="form-control" readonly>
                                    <?php endforeach ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Tanggal Pembayaran Piutang</label>
                                <input type="date" name="tanggal_transaksi" id="tanggal_transaksi" class="form-control">
                                <?= form_error('tanggal_transaksi'); ?>
                            </div>

                            <div class="form-group">
                                <label>Keterangan</label>
                                <input type="text" name="memo" id="memo" class="form-control">
                                <?= form_error('memo'); ?>
                            </div>
                        <?php endforeach; ?>
                        <div class="table-responsive">
                            <table class="table table-bordered " id="entry">
                                <thead class="bg-primary text-white">
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
                                                <select class="form-control id_akun" name="id_akun[]" id="id_akun1">
                                                    <option value="" selected="selected" disabled="disabled">-- Pilih Akun Penerimaan --</option>
                                                    <?php foreach ($akunPenerimaan as $c) { ?>
                                                        <option value="<?php echo $c->id_akun ?>" data-no_akun="<?php echo $c->kode_akun . "-" . $c->no_akun ?>">
                                                            <?php echo $c->nama_akun ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                                <?= form_error('id_akun[]'); ?>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="form-group">
                                                <input class="form-control no_akun" name="no_akun[]" id="no_akun_1" type="text" readonly>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <input type="text" name="debit[]" id="debit1" class="form-control debit">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <input type="text" name="kredit[]" id="kredit1" class="form-control kredit" readonly>
                                            </div>
                                        </td>
                                        <td hidden>
                                            <div class="form-group">
                                                <input type="text" name="posisi[]" id="posisi1" class="form-control" hidden>
                                            </div>
                                        </td>
                                        <td hidden>
                                            <div class="form-group">
                                                <input type="text" name="saldo[]" id="saldo1" class="form-control" hidden>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="form-group">
                                                <select class="form-control id_akun" name="id_akun[]" id="id_akun2" readonly>
                                                    <?php foreach ($akunPiutang as $c) { ?>
                                                        <option id="akunPiutang" value="<?php echo $c->id_akun ?>" data-no_akun="<?php echo $c->kode_akun . "-" . $c->no_akun ?>" selected="selected">
                                                            <?php echo $c->nama_akun ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="form-group">
                                                <input class="form-control no_akun" name="no_akun[]" id="no_akun_2" type="text" readonly>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="form-group">
                                                <input type="text" name="debit[]" id="debit2" class="form-control debit" readonly>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="form-group">
                                                <input type="text" name="kredit[]" id="kredit2" class="form-control kredit">
                                            </div>
                                        </td>
                                        <td hidden>
                                            <div class="form-group">
                                                <input type="text" name="posisi[]" id="posisi2" class="form-control" hidden>
                                            </div>
                                        </td>
                                        <td hidden>
                                            <div class="form-group">
                                                <input type="text" name="saldo[]" id="saldo2" class="form-control" hidden>
                                            </div>
                                        </td>
                                    </tr>
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
                <button type="submit" id="jurnal_entry" name="tambah" class="btn btn-submit btn-primary font-weight-bold" onclick="balance(event)"><i class="fas fa-money-bill mr-1"></i>Terima
                </button>
                <button type="reset" class="btn btn-danger font-weight-bold btn-undo"><i class="fas fa-undo mr-1"></i> Ulang</button>
            </div>
        </div>
    </div>
    </form>
</div>

<script>
    $(document).ready(function() {
        var selected = $('#akunPiutang').attr("data-no_akun");
        $('#no_akun_2').val(selected);
    })

    // $(document).ready(function(){
    //     $('#debit1,#kredit2').on('change',function(){
    //         var batas = $('#batasan').val().replace('.', '');
    //         if($('#debit1').val() > batas ){
    //             alert("Nominal Yang Diinputkan Lebih Besar Dari Piutang");
    //             $('#debit1').val("");
    //             $('#debit1').focus();
    //         }else if($('#kredit2').val() > batas ){
    //             alert("Nominal Yang Diinputkan Lebih Besar Dari Piutang");
    //             $('#kredit2').val("");
    //             $('#kredit2').focus();
    //         }
    //     })
    // })
</script>