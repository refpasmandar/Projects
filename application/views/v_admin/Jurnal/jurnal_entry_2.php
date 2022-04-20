<div class="container-fluid">
    <p class="title_halaman text-dark"><i class="far fa-file-alt"></i> Entri Jurnal</p>
    <hr>
    <?php $this->view('flashdata') ?>
    <div class="card">
        <div class="card-header">
            <h6 class="text-primary font-weight-bold">Form Entri Jurnal</h6>
        </div>
        <div class="card-body">
            <form method="post" action="<?php echo base_url('Jurnal/Jurnal_entry/tambahJurnal') ?>">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-row">
                            <div class="form-group col-lg-6">
                                <?php foreach ($setting as $set) : ?>
                                    <label for="Kode Transaksi"><?php echo $set->kode_entry ?></label>
                                    <input type="hidden" name="kode_entry" value="<?php echo $set->kode_entry ?>">
                                <?php endforeach; ?>
                                <input class="form-control" type="text" name="kode_jurnal" id="kode_jurnal" value="<?php echo set_value('kode_jurnal') ?>">
                                <input class="form-control" type="hidden" name="jenis_transaksi" id="jenis_transaksi" value="Jurnal">
                                <input type="hidden" name="status" value="Open">
                                <?php echo form_error('kode_jurnal') ?>
                            </div>
                            <div class="form-group col-lg-6">
                                <!-- Pindah Baris -->
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="Tanggal Transaksi">Tanggal Transaksi</label>
                                <input class="form-control" type="date" name="tanggal_transaksi" id="tanggal_transaksi" value="<?php echo set_value('tanggal_transaksi') ?>">
                                <?php echo form_error('tanggal_transaksi') ?>
                            </div>
                            <div class="form-group col-lg-6">
                                <!-- Pindah Baris -->
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="Memo Transaksi">Memo</label>
                                <input class="form-control" type="text" name="memo" id="memo" value="<?php echo set_value('memo') ?>">
                                <?php echo form_error('memo') ?>
                            </div>
                            <div class="form-group col-lg-6">
                                <!-- Pindah Baris -->
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="entry">
                                    <thead class="text-center text-white bg-primary">
                                        <tr>
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
                                                        <option value="">-- Pilih Akun --</option>
                                                        <?php foreach ($coa as $c) { ?>
                                                            <option value="<?php echo $c->id_akun ?>" data-no_akun="<?php echo $c->kode_akun . "-" . $c->no_akun ?>">
                                                                <?php echo $c->nama_akun ?>
                                                            </option>
                                                        <?php } ?>
                                                    </select>
                                                    <?php echo form_error('id_akun[]') ?>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <input class="form-control no_akun" name="no_akun[]" id="no_akun_1" type="text" readonly>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <input type="text" name="debit[]" id="debit1" class="form-control debit uang" onkeypress="return hanyaAngka(event)">
                                                    <?php echo form_error('saldo[]') ?>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <input type="text" name="kredit[]" id="kredit1" class="form-control kredit uang" onkeypress="return hanyaAngka(event)">
                                                    <?php echo form_error('saldo[]') ?>
                                                </div>
                                            </td>
                                            <td hidden>
                                                <div class="form-group">
                                                    <input type="text" name="posisi[]" id="posisi1" class="form-control">
                                                </div>
                                            </td>
                                            <td hidden>
                                                <div class="form-group">
                                                    <input type="text" name="saldo[]" id="saldo1" class="form-control saldo">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-group">
                                                    <select class="form-control id_akun" name="id_akun[]" id="id_akun2">
                                                        <option value="">-- Pilih Akun --</option>
                                                        <?php foreach ($coa as $c) { ?>
                                                            <option value="<?php echo $c->id_akun ?>" data-no_akun="<?php echo $c->kode_akun . "-" . $c->no_akun ?>">
                                                                <?php echo $c->nama_akun ?>
                                                            </option>
                                                        <?php } ?>
                                                    </select>
                                                    <?php echo form_error('id_akun[]') ?>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <input class="form-control no_akun" name="no_akun[]" id="no_akun_2" type="text" readonly>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <input type="text" name="debit[]" id="debit2" class="form-control debit uang" onkeypress="return hanyaAngka(event)">
                                                </div>
                                                <?php echo form_error('saldo[]') ?>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <input type="text" name="kredit[]" id="kredit2" class="form-control kredit uang" onkeypress="return hanyaAngka(event)">
                                                </div>
                                                <?php echo form_error('saldo[]') ?>
                                            </td>
                                            <td hidden>
                                                <div class="form-group">
                                                    <input type="text" name="posisi[]" id="posisi2" class="form-control">
                                                </div>
                                            </td>
                                            <td hidden>
                                                <div class="form-group">
                                                    <input type="text" name="saldo[]" id="saldo2" class="form-control saldo">
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <a class="btn btn-sm  text-white btn-tambah" id="tambah_baris"><i class="fas fa-plus mr-1"></i>Tambah Baris</a>
                        <!-- <a class="btn btn-sm btn-danger text-white" id="test">Tambah Baris</a> -->
                        <br>
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
                                <label class="col-form-label col-sm-4 text-right" for="">Selisih :</label>
                                <div class="col-sm-8">
                                    <input class="form-control uang" type="text" id="balance" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <button id="jurnal_entry" type="submit" class="btn btn-sm btn-submit btn-primary mr-2"><i class="fas fa-save mr-1"></i> Simpan</button>
                    <button type="reset" class="btn btn-sm btn-undo btn-danger"><i class="fas fa-undo-alt mr-1"></i> Ulang</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        var counter = 2;
        var counterNext = parseInt(counter) + 1;
        $("#tambah_baris").on("click", function() {
            var html = "<tr>" +
                "<td>" +
                "<div class='form-group'>" +
                "<select class='form-control id_akun' name='id_akun[]' id='id_akun" + counterNext + "'>" +
                "<option value=''>-- Pilih Akun --</option>" +
                "<?php foreach ($coa as $c) { ?>" +
                "<option value='<?php echo $c->id_akun ?>' data-no_akun='<?php echo $c->kode_akun . '-' . $c->no_akun ?>'>" +
                "<?php echo $c->nama_akun ?>" +
                "</option>" +
                "<?php } ?>" +
                "</select>" +
                "<?php echo form_error('id_akun[]') ?>" +
                "</div>" +
                "<span><a href='javascript:void(0);' id='hapus'>Hapus Baris</a></span>" +
                "</td>" +
                "<td>" +
                "<div class='form-group'>" +
                "<input class='form-control no_akun' name='no_akun[]' id=no_akun_" + counterNext + "' type='text' readonly>" +
                "</div>" +
                "</td>" +
                "<td>" +
                "<div class='form-group'>" +
                "<input type='text' name='debit[]' id='debit" + counterNext + "' class='form-control debit uang' onkeypress='return hanyaAngka(event)'>" +
                "</div>" +
                "<?php echo form_error('saldo[]') ?>" +
                "</td>" +
                "<td>" +
                "<div class='form-group'>" +
                "<input type='text' name='kredit[]' id='kredit" + counterNext + "' class='form-control kredit uang' onkeypress='return hanyaAngka(event)'>" +
                "</div>" +
                "<?php echo form_error('saldo[]') ?>" +
                "</td>" +
                "<td hidden>" +
                "<div class='form-group'>" +
                "<input type='text' name='posisi[]' id='posisi" + counterNext + "' class='form-control'>" +
                "</div>" +
                "</td>" +
                "<td hidden>" +
                "<div class='form-group'>" +
                "<input type='text' name='saldo[]' id='saldo" + counterNext + "' class='form-control saldo'>" +
                "</div>" +
                "</td>" +
                "</tr>"
            $("#entry tbody").append(html);
            counterNext++;
        });

        $("#entry").on('click', '#hapus', function() {
            $(this).closest('tr').remove();
        });

    });
</script>