<div class="container-fluid">
    <p class="title_halaman text-dark"><i class="far fa-list-alt"></i> Tambah Akun</p>
    <hr>

    <!-- Button Kembali -->
    <div class='text-right btnBack'>
        <a class="btn btn-sm btn-warning" href="<?php echo base_url('Master_data/Coa/account'); ?>"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
    </div>

    <div class="card">
        <div class="card-header">
            <h6 class=" font-weight-bold text-primary">Form Tambah Barang</h6>
        </div>
        <div class="card-body">
            <form class=" col-md-12" method="post" name="coa" action="<?php echo base_url('Master_data/Coa/prosesTambah') ?>">
                <div class="form-row">
                    <div class="form-group col-lg-12">
                        <label for="">Nama Akun <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="nama_akun" onkeypress="return hanyaHuruf(event)" value="<?php echo set_value('nama_akun') ?>">
                        <?php echo form_error('nama_akun') ?>
                    </div>
                    <div class="form-group col-lg-12">
                        <label for="Kategori Akun">Kategori Akun <span class="text-danger">*</span></label>
                        <select name="kategori_akun" id="kategori_akun" class="form-control" value="<?php echo set_value('kategori_akun') ?>" onchange="nomor(event)">
                            <option value="">-- Pilih Kategori --</option>
                            <option value="1">Asset</option>
                            <option value="2">Kewajiban</option>
                            <option value="3">Ekuitas</option>
                            <option value="4">Pendapatan</option>
                            <option value="5">Harga Pokok Penjualan</option>
                            <option value="6">Beban</option>
                            <option value="8">Pendapatan Lain-Lain</option>
                            <option value="9">Pengeluaran Lain-Lain</option>
                            <option value="10">Bank</option>
                            <option value="11">Piutang</option>
                            <option value="12">Utang</option>
                            <option value="13">Asset Lain</option>
                            <option value="14">Kewajiban Lain</option>
                        </select>
                        <?php echo form_error('kategori_akun') ?>
                    </div>
                    <div class="form-group col-lg-2">
                        <label for="">Nomor Akun <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="kode_akun" id="kode_akun" readonly>
                    </div>
                    <div class="form-group col-lg-2">
                        <label for="">&nbsp;<span></span></label>
                        <input class="form-control text-center" type="text" value="-" readonly>
                    </div>
                    <div class="form-group col-lg-8">
                        <label for="">&nbsp;<span></span></label>
                        <input class="form-control" type="text" name="no_akun" id="no_akun" onkeypress="return hanyaAngka(event)" value="<?php echo set_value('no_akun') ?>">
                        <?php echo form_error('no_akun') ?>
                    </div>
                    <div class="ket_level col-lg-12">
                        <p class="text-danger">Keterangan Level :</p>
                        <p class="font-weight-bolder">------------ <span class="font-italic">Level 1</span></p>
                        <p class="font-weight-bolder">&nbsp;&nbsp;------------ <span class="font-italic">Level 2</span></p>
                        <p class="font-weight-bolder">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;------------ <span class="font-italic">Level 3</span></p>
                        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;------------ <span class="font-italic">Level 4</span></p>
                    </div>
                    <div class="form-group col-lg-12">
                        <label for="Level Akun">Level Akun <span class="text-danger">*</span></label>
                        <select name="level" id="level" class="form-control" value="<?php echo set_value('level') ?>">
                            <option value="">-- Pilih Level --</option>
                            <option value="1">Level 1</option>
                            <option value="2">Level 2</option>
                            <option value="3">Level 3</option>
                            <option value="4">Level 4</option>
                        </select>
                        <?php echo form_error('level') ?>
                    </div>
                    <div class="form-group col-lg-12">
                        <label for="Kategori Akun">Parent Akun<span class="text-danger">*</span></label>
                        <select name="parent_id" id="parent_id" class="form-control parent_id" value="<?php echo set_value('parent_id') ?>">
                            <option value="">-- Pilih Parent --</option>
                            <option value="0">Header Utama</option>
                            <?php foreach ($header as $c) { ?>
                                <!-- <option value="<?php echo $c->id_akun ?>">
                                    <?php echo $c->nama_akun ?>
                                </option> -->
                            <?php } ?>
                        </select>
                        <?php echo form_error('parent_id') ?>
                    </div>
                    <div class="form-group col-lg-12">
                        <label for="Jenis Akun">Jenis Akun<span class="text-danger">*</span></label>
                        <select class="form-control" name="jenis_akun" id="jenis_akun">
                            <option value="" selected="selected" disabled="disable">-- Pilih Jenis Akun --</option>
                            <option value="Kosong">Kosong</option>
                            <option value="Aktiva">Aktiva</option>
                            <option value="Pasiva">Pasiva</option>
                            <option value="L/R">Laba / Rugi</option>
                        </select>
                        <?php echo form_error('jenis_akun') ?>
                    </div>
                    <div class="form-group col-lg-12" id="saldo_normal" style="display:none;">
                        <label for="Jenis Akun">Saldo Normal<span class="text-danger">*</span></label>
                        <select class="form-control" name="saldo_normal">
                            <option value="-" selected="selected">-- Pilih Jenis Akun --</option>
                            <option value="D">Debit</option>
                            <option value="K">Kredit</option>
                        </select>
                        <?php echo form_error('saldo_normal') ?>
                    </div>
                    <div class="form-group col-lg-12">
                        <label for="">Keterangan Akun <span class="text-danger">*</span></label>
                        <textarea class="form-control" type="text-area" name="keterangan" onkeypress="return hanyaHuruf(event)"><?php echo set_value('keterangan') ?></textarea>
                        <?php echo form_error('keterangan') ?>
                    </div>
                    <p class="text-danger reminder col-lg-12"><span>*</span> : Wajib Diisi</p>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-sm btn-submit btn-primary mr-2"><i class="fas fa-save mr-1"></i> Simpan</button>
                    <button type="reset" class="btn btn-sm btn-undo btn-danger"><i class="fas fa-undo-alt mr-1"></i> Ulang</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
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
                    var html = "<option selected='selected' disabled='disabled'>-- Pilih Parent --  </option>" +
                        "<option value= '0'>Header Utama</option>"
                    for (let index = 0; index < array.length; index++) {
                        html += "<option value= '" + array[index].id_akun + "' >" + array[index].nama_akun + "</option>"
                    }
                    $('.parent_id').html(html);
                }
            });
        })
    })
</script>