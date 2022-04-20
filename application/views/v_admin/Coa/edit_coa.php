<div class="container-fluid">
    <p class="title_halaman text-dark"><i class="far fa-list-alt"></i> Edit Akun</p>
    <hr>

    <!-- Button Kembali -->
    <div class='text-right btnBack'>
        <a class="btn btn-sm btn-warning" href="<?php echo base_url('Master_data/Coa/account'); ?>"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
    </div>

    <div class="card">
        <div class="card-header">
            <h class="text-primary font-weight-bold">Form Edit Akun</h>
        </div>
        <div class="card-body">
            <?php foreach ($coa as $coa) : ?>
                <form method="post" name="coa" action="<?php echo base_url('Master_data/Coa/prosesEdit') ?>">
                    <div class="form-row">
                        <div class="form-group col-lg-12">
                            <label for="">Nama Akun <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="nama_akun" onkeypress="return hanyaHuruf(event)" value="<?php echo $coa->nama_akun ?>">
                            <?php echo form_error('nama_akun') ?>
                        </div>
                        <div class="form-group col-lg-12">
                            <label for="Kategori Akun">Kategori Akun <span class="text-danger">*</span></label>
                            <select name="kategori_akun" id="kategori_akun" class="form-control" onchange="nomor(event)">
                                <option value="">-- Pilih Kategori --</option>
                                <option value="1" <?php if ($coa->kategori_akun == 1) {
                                                        echo "selected";
                                                    } ?>>Aset</option>
                                <option value="2" <?php if ($coa->kategori_akun == 2) {
                                                        echo "selected";
                                                    } ?>>Kewajiban</option>
                                <option value="3" <?php if ($coa->kategori_akun == 3) {
                                                        echo "selected";
                                                    } ?>>Ekuitas</option>
                                <option value="4" <?php if ($coa->kategori_akun == 4) {
                                                        echo "selected";
                                                    } ?>>Pendapatan</option>
                                <option value="5" <?php if ($coa->kategori_akun == 5) {
                                                        echo "selected";
                                                    } ?>>Harga Pokok Penjualan</option>
                                <option value="6" <?php if ($coa->kategori_akun == 6) {
                                                        echo "selected";
                                                    } ?>>Beban</option>
                                <option value="8" <?php if ($coa->kategori_akun == 8) {
                                                        echo "selected";
                                                    } ?>>Pendapatan Lain-Lain</option>
                                <option value="9" <?php if ($coa->kategori_akun == 9) {
                                                        echo "selected";
                                                    } ?>>Pengeluaran Lain-Lain</option>
                                <option value="10" <?php if ($coa->kategori_akun == 10) {
                                                        echo "selected";
                                                    } ?>>Bank</option>
                                <option value="11" <?php if ($coa->kategori_akun == 11) {
                                                        echo "selected";
                                                    } ?>>Piutang</option>
                                <option value="12" <?php if ($coa->kategori_akun == 12) {
                                                        echo "selected";
                                                    } ?>>Utang</option>
                                <option value="13" <?php if ($coa->kategori_akun == 13) {
                                                        echo "selected";
                                                    } ?>>Asset Lain</option>
                                <option value="14" <?php if ($coa->kategori_akun == 14) {
                                                        echo "selected";
                                                    } ?>>Kewajiban Lain</option>
                            </select>
                            <?php echo form_error('kategori_akun') ?>
                        </div>
                        <div class="form-group col-lg-2">
                            <label for="">Nomor Akun <span class="text-danger">*</span></label>
                            <input type="hidden" name="id_akun" value="<?php echo $coa->id_akun ?>">
                            <input class="form-control" type="text" name="kode_akun" id="kode_akun" value="<?php echo $coa->kode_akun ?>" readonly>
                        </div>
                        <div class="form-group col-lg-2">
                            <label for="">&nbsp;<span></span></label>
                            <input class="form-control text-center" type="text" value="-" readonly>
                        </div>
                        <div class="form-group col-lg-8">
                            <label for="">&nbsp;<span></span></label>
                            <input class="form-control" type="text" name="no_akun" id="no_akun" onkeypress="return hanyaAngka(event)" value="<?php echo $coa->no_akun ?>">
                            <?php echo form_error('no_akun') ?>
                        </div>
                        <div class="ket_level">
                            <p class="text-danger">Keterangan Level :</p>
                            <p class="font-weight-bolder">------------ <span class="font-italic">Level 1</span></p>
                            <p class="font-weight-bolder">&nbsp;&nbsp;------------ <span class="font-italic">Level 2</span></p>
                            <p class="font-weight-bolder">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;------------ <span class="font-italic">Level 3</span></p>
                            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;------------ <span class="font-italic">Level 4</span></p>
                        </div>
                        <div class="form-group col-lg-12">
                            <label for="Level Akun">Level <span class="text-danger">*</span></label>
                            <select name="level" id="level" class="form-control" value="<?php echo $coa->level ?>">
                                <option value="">-- Pilih Level --</option>
                                <option value="1" <?php if ($coa->level == 1) {
                                                        echo "selected";
                                                    } ?>>Level 1</option>
                                <option value="2" <?php if ($coa->level == 2) {
                                                        echo "selected";
                                                    } ?>>Level 2</option>
                                <option value="3" <?php if ($coa->level == 3) {
                                                        echo "selected";
                                                    } ?>>Level 3</option>
                                <option value="4" <?php if ($coa->level == 4) {
                                                        echo "selected";
                                                    } ?>>Level 4</option>
                            </select>
                            <?php echo form_error('level') ?>
                        </div>
                        <div class="form-group col-lg-12">
                            <label for="Kategori Akun">Parent Akun<span class="text-danger">*</span></label>
                            <select name="parent_id" id="parent_id" class="form-control parent_id">
                                <option value="">-- Pilih Parent Akun --</option>
                                <option value="0" <?php if ($coa->parent_id == 0) {
                                                        echo "selected";
                                                    } ?>>Header Utama</option>
                                <?php foreach ($header as $head) { ?>
                                    <option value="<?php echo $head->id_akun ?>" <?php echo $head->id_akun == $coa->parent_id ? 'selected' : '' ?>><?php echo $head->nama_akun ?></option>
                                <?php } ?>
                            </select>
                            <?php echo form_error('parent_id') ?>
                        </div>
                        <div class="form-group col-lg-12">
                            <label for="Jenis Akun">Jenis Akun <span class="text-danger">*</span></label>
                            <select class="form-control" name="jenis_akun" id="jenis_akun">
                                <option value="" selected="selected" disabled="disable">-- Pilih Jenis Akun --</option>
                                <option value="Kosong" <?php if ($coa->jenis_akun == "Kosong") {
                                                            echo "selected";
                                                        } ?>>Kosong</option>
                                <option value="Aktiva" <?php if ($coa->jenis_akun == "Aktiva") {
                                                            echo "selected";
                                                        } ?>>Aktiva</option>
                                <option value="Pasiva" <?php if ($coa->jenis_akun == "Pasiva") {
                                                            echo "selected";
                                                        } ?>>Pasiva</option>
                                <option value="L/R" <?php if ($coa->jenis_akun == "L/R") {
                                                        echo "selected";
                                                    } ?>>Laba / Rugi</option>
                            </select>
                            <?php echo form_error('jenis_akun') ?>
                        </div>
                        <div class="form-group col-lg-12" id="saldo_normal" style="display:none;">
                            <label for="Jenis Akun">Saldo Normal <span class="text-danger">*</span></label>
                            <select class="form-control" name="saldo_normal">
                                <option value="-" <?php if ($coa->saldo_normal == "-") {
                                                        echo "selected";
                                                    } ?>>-- Pilih Jenis Akun --</option>
                                <option value="D" <?php if ($coa->saldo_normal == "D") {
                                                        echo "selected";
                                                    } ?>>Debit</option>
                                <option value="K" <?php if ($coa->saldo_normal == "K") {
                                                        echo "selected";
                                                    } ?>>Kredit</option>
                            </select>
                            <?php echo form_error('saldo_normal') ?>
                        </div>
                        <div class="form-group col-lg-12">
                            <label for="">Keterangan Akun <span class="text-danger">*</span></label>
                            <textarea class="form-control" type="text-area" name="keterangan" onkeypress="return hanyaHuruf(event)"><?php echo $coa->keterangan_akun ?></textarea>
                            <?php echo form_error('keterangan') ?>
                        </div>
                        <p class="text-danger reminder col-lg-12"><span>*</span> : Wajib Diisi</p>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-sm btn-primary btn-submit mr-2"><i class="fas fa-save mr-1"></i> Simpan</button>
                        <button type="reset" class="btn btn-sm btn-undo btn-danger"><i class="fas fa-undo-alt mr-1"></i> Ulang</button>
                    </div>
                </form>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        var level = $("#level").val();

        if (level == 4) {
            $("#saldo_normal").css('display', 'block');
        } else {
            $("#saldo_normal").css('display', 'none');
        }
    })
    $(document).ready(function() {
        $('#level').on('change', function() {
            var level = $("#level").val();

            if (level == 4) {
                $("#saldo_normal").css('display', 'block');
            } else {
                $("#saldo_normal").css('display', 'none');
            }
        })
    })

    $(document).ready(function() {
        $('#kategori_akun').on('change', function() {
            var id = $('#kode_akun').val();
            // var no = $("select[id^='id_produk']").attr('id').split('id_produk')[1];
            // var supp = $("#id_supplier").val();
            $.ajax({
                url: "<?= base_url('Master_data/Coa/getHeaderAkun'); ?>",
                method: "POST",
                dataType: "JSON",
                data: {
                    id: id
                },
                success: function(array) {
                    var html = "<option selected='selected' disabled='disabled'>-- Pilih Parent --  </option>"
                    for (let index = 0; index < array.length; index++) {
                        html += "<option value= '" + array[index].id_akun + "' >" + array[index].nama_akun + "</option>"
                    }
                    $('.parent_id').html(html);
                }
            });
        })
    })
</script>