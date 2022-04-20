<div class="container-fluid">
    <p class="title_halaman text-dark"><i class="fa fa-plus-circle"></i> Jurnal Entry</p>
    <hr>
    <div class="container">
        <?php $this->view('flashdata') ?>
        <form method="post" action="<?php echo base_url('Transaksi/Jurnal_entry/tambahJurnal') ?>">
            <div class="form-row">
                <div class="form-group col-lg-6">
                    <label for="Kode Transaksi">Kode Transaksi</label>
                    <input class="form-control" type="text" name="kode_transaksi" id="kode_transaksi">
                </div>
                <div class="form-group col-lg-6">
                    <!-- Pindah Baris -->
                </div>
                <div class="form-group col-lg-6">
                    <label for="Tanggal Transaksi">Tanggal Transaksi</label>
                    <input class="form-control" type="date" name="tanggal_transaksi" id="tanggal_transaksi">
                </div>
                <div class="form-group col-lg-6">
                    <!-- Pindah Baris -->
                </div>
                <div class="form-group col-lg-6">
                    <label for="Memo Transaksi">Memo</label>
                    <input class="form-control" type="text" name="memo" id="memo">
                </div>
                <div class="form-group col-lg-6">
                    <!-- Pindah Baris -->
                </div>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr class="text-center">
                            <th>Nama Akun</th>
                            <th>Nomor Akun</th>
                            <th>Debit</th>
                            <th>Kredit</th>
                            <th>test</th>
                            <th>test</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="form-group">
                                    <select class="form-control" name="id_akun[]" id="id_akun1">
                                        <option value="">-- Pilih Akun --</option>
                                        <?php foreach ($coa as $c) { ?>
                                            <option value="<?php echo $c->id_akun ?>" data-no_akun="<?php echo $c->kode_akun . "-" . $c->no_akun ?>">
                                                <?php echo $c->nama_akun ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input class="form-control" name="no_akun[]" id="no_akun" type="text" readonly>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="text" name="debit[]" id="debit1" class="form-control">
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="text" name="kredit[]" id="kredit1" class="form-control">
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="text" name="posisi[]" id="posisi1" class="form-control" readonly>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="text" name="saldo[]" id="saldo1" class="form-control" readonly>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-group">
                                    <select class="form-control" name="id_akun[]" id="id_akun2">
                                        <option value="">-- Pilih Akun --</option>
                                        <?php foreach ($coa as $c) { ?>
                                            <option value="<?php echo $c->id_akun ?>" data-no_akun="<?php echo $c->kode_akun . "-" . $c->no_akun ?>">
                                                <?php echo $c->nama_akun ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input class="form-control" name="no_akun[]" id="no_akun_2" type="text" readonly>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="text" name="debit[]" id="debit2" class="form-control">
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="text" name="kredit[]" id="kredit2" class="form-control">
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="text" name="posisi[]" id="posisi2" class="form-control" readonly>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="text" name="saldo[]" id="saldo2" class="form-control" readonly>
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
                        <input class="form-control uang" type="text" id="t_debit" readonly>
                    </div>
                </div>
                <div class="form-group row col-lg-12">
                    <label class="col-form-label col-sm-4 text-right" for="">Total Kredit :</label>
                    <div class="col-sm-8">
                        <input class="form-control uang" type="text" id="t_kredit" readonly>
                    </div>
                </div>
                <div class="form-group row col-lg-12">
                    <label class="col-form-label col-sm-4 text-right" for="">Out of Balance :</label>
                    <div class="col-sm-8">
                        <input class="form-control uang" type="text" id="balance" readonly>
                    </div>
                </div>
            </div>
            <button id="jurnal_entry" type="submit" class="btn btn-sm btn-primary col-lg-12" onclick="balance(event)"><i class="fa fa-plus"></i> Simpan</button>
        </form>
    </div>
</div>

<script>

</script>