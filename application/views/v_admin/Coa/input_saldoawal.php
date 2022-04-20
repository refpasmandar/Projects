<div class="container-fluid">
    <p class="title_halaman text-dark"><i class="fas fa-money-bill-wave"></i> Input Saldo Awal Akun</p>
    <hr>

    <?php $this->view('flashdata') ?>
    <div class="card">
        <div class="card-header">
            <h6 class="text-primary font-weight-bold">Form Input Saldo Awal</h6>
        </div>
        <div class="card-body">
            <!-- <?php foreach ($periode as $per) { ?>
                    <p class="display-4 text-center">Periode <?php echo format_indo($per->periode) ?></p>
                <?php } ?> -->
            <form class="" method="post" action="<?php echo base_url('Pengaturan/Saldo_awal/prosesInputSaldoAwal') ?>">
                <div class="form-group">
                    <?php foreach ($setting as $set) : ?>
                        <label>Tanggal Input Saldo Awal</label>
                        <input type="date" class="form-control" id="periode" name="periode" placeholder="Tanggal Transaksi" value="<?php echo $set->tanggal_pembukuan ?>" readonly>
                        <?php echo form_error('periode') ?>
                    <?php endforeach; ?>
                </div>
                <br>
                <p style="text-align: justify;" class="text-danger">NOTE : Isi saldo awal dengan benar karena data tidak dapat diubah jika transaksi sudah berjalan.</p>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="saldo_awal">
                        <thead>
                            <tr class="text-center">
                                <th>Nama Akun</th>
                                <th>Nomor Akun</th>
                                <th>Debit</th>
                                <th>Kredit</th>
                                <th>Saldo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $d = 1;
                            $k = 1;
                            $s = 1;
                            $n = 1;
                            foreach ($saldo as $c) { ?>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <input class="form-control" type="text" value="<?php echo $c->nama_akun ?>" readonly>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input class="form-control" id="no_akun<?php echo $n++ ?>" type="text" value="<?php echo $c->kode_akun . "-" . $c->no_akun ?>" readonly>
                                            <input type="hidden" name="id_akun[]" value="<?php echo $c->id_akun ?>">
                                        </div>
                                    </td>
                                    <?php if ($c->saldo_normal == 'D') { ?>
                                        <td>
                                            <div class="form-group">
                                                <input class="form-control awal_debit" id="awal_debit<?php echo $d++ ?>" type="text" value="0">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <input class="form-control awal_kredit" id="awal_kredit<?php echo $k++ ?>" type="text" readonly>
                                            </div>
                                        </td>
                                    <?php } elseif ($c->saldo_normal == 'K') { ?>
                                        <td>
                                            <div class="form-group">
                                                <input class="form-control awal_debit" id="awal_debit<?php echo $d++ ?>" type="text" readonly>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <input class="form-control awal_kredit" id="awal_kredit<?php echo $k++ ?>" type="text" value="0">
                                            </div>
                                        </td>
                                    <?php } ?>
                                    <td>
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="saldo[]" id="saldo_awal<?php echo $s++ ?>" readonly>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <!-- <div class="col-lg-6 float-right">
                            <div class="form-group row col-lg-12">
                                <label class="col-form-label col-sm-4 text-right" for="">Total Debit :</label>
                                <div class="col-sm-8">
                                    <input class="form-control" type="text" id="saldo_debit" readonly>
                                </div>
                            </div>
                            <div class="form-group row col-lg-12">
                                <label class="col-form-label col-sm-4 text-right" for="">Total Kredit :</label>
                                <div class="col-sm-8">
                                    <input class="form-control" type="text" id="saldo_kredit" readonly>
                                </div>
                            </div>
                            <div class="form-group row col-lg-12">
                                <label class="col-form-label col-sm-4 text-right" for="">Out of Balance :</label>
                                <div class="col-sm-8">
                                    <input class="form-control" type="text" id="awal_balance" readonly>
                                </div>
                            </div>
                        </div> -->
                <div class="text-center">
                    <button id="input_saldo" type="submit" class="btn btn-sm btn-primary btn-submit mb-4"><i class="fas fa-save mr-1"></i> Simpan</button>
                    <button id="" type="reset" class="btn btn-sm btn-danger btn-undo mb-4"><i class="fas fa-undo-alt mr-1"></i> Ulang</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        var no_akun = $("input[id^='no_akun']").val().substring(0, 1);
        var id = $("input[id^='no_akun']").attr('id').split('no_akun')[1];
        var substr = no_akun.substring(0, 1);
        if (no_akun == 1) {
            $("#awal_kredit" + id).prop('readonly', true);
        }
    })
</script>