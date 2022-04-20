<div class="container-fluid">
    <p class="title_halaman text-dark"><i class="fas fa-money-bill-wave"></i> Update Saldo Awal Akun</p>
    <hr>

    <?php $this->view('flashdata') ?>
    <div class="card">
        <div class="card-header">
            <h6 class="text-primary font-weight-bold">Form Update Saldo Awal</h6>
        </div>
        <div class="card-body">
            <?php foreach ($periode as $per) { ?>
                <p class="display-4 text-center">Periode <?php echo format_indo($per->periode_saldo) ?></p>
            <?php } ?>
            <form class="" method="post" action="<?php echo base_url('Pengaturan/Saldo_awal/prosesUpdateSaldoAwal') ?>">
                <!-- <div class="form-group">
                        <label>Tanggal Input Saldo Awal</label>
                        <input type="date" class="form-control" id="periode" name="periode" placeholder="Tanggal Transaksi">
                        <?= form_error('tanggaltransaksi', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div> -->
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
                                <th>saldo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $d = 1;
                            $k = 1;
                            $s = 1;
                            foreach ($saldo as $c) { ?>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <input class="form-control" type="text" value="<?php echo $c->nama_akun ?>" readonly>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input class="form-control" type="text" value="<?php echo $c->kode_akun . "-" . $c->no_akun ?>" readonly>
                                            <input type="hidden" name="id_akun[]" value="<?php echo $c->id_akun ?>">
                                        </div>
                                    </td>
                                    <?php if ($c->saldo_normal == 'D' && $c->saldo >= 0) { ?>
                                        <td>
                                            <div class="form-group">
                                                <input class="form-control awal_debit" id="awal_debit<?php echo $d++ ?>" value="<?php echo $c->saldo ?>" type="text">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <input class="form-control awal_kredit" id="awal_kredit<?php echo $k++ ?>" type="text" readonly>
                                            </div>
                                        </td>
                                    <?php } elseif ($c->saldo_normal == 'D' && $c->saldo < 0) { ?>
                                        <td>
                                            <div class="form-group">
                                                <input class="form-control awal_debit" id="awal_debit<?php echo $d++ ?>" type="text" value="<?php echo substr($c->saldo, 0) ?>">
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
                                                <input class="form-control awal_kredit" id="awal_kredit<?php echo $k++ ?>" type="text" value="<?php echo substr($c->saldo, 0) ?>">
                                            </div>
                                        </td>
                                    <?php } ?>

                                    <td>
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="saldo[]" id="saldo_awal<?php echo $s++ ?>" value="<?php echo $c->saldo ?>" readonly>
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