<div class="container-fluid">
    <p class="title_halaman text-dark"><i class="fas fa-link"></i> Link Account</p>
    <hr>
    <?php $this->view('flashdata') ?>
    <form action="<?php echo base_url('Pengaturan/Link_acc/addLinkAcc') ?>" method="post">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Linked Account <small class="text-dark">Penjualan</small></h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group" id="akunPenerimaan">
                            <label>Penerimaan</label>
                            <select name="id_akun[]" id="id_akun" class="form-control" style="margin-bottom: 20px;" required>
                                <option value="0" selected="selected">-- Pilih Akun --</option>
                                <?php foreach ($coa as $akun) : ?>
                                    <option value="<?= $akun->id_akun ?>">
                                        <?= "(" . $akun->kode_akun . "-" . $akun->no_akun . ")" . " - " .  $akun->nama_akun  ?></option>
                                <?php endforeach; ?>
                            </select>
                            <input name="link[]" type="hidden" value="Akun Penerimaan">
                            <input name="jenis[]" type="hidden" value="Penjualan">
                        </div>
                        <a class="btn font-weight-bold btn-tambah" id="tambah_penerimaan"><i class="fas fa-plus text-white"></i> Akun Penerimaan</a>
                        <div class="form-group">
                            <label>Piutang</label>
                            <select name="id_akun[]" id="id_akun" class="form-control" style="margin-bottom: 20px;" required>
                                <option value="0" selected="selected">-- Pilih Akun -- </option>
                                <?php foreach ($coa as $akun) : ?>
                                    <option value="<?= $akun->id_akun ?>">
                                        <?= "(" . $akun->kode_akun . "-" . $akun->no_akun . ")" . " - " .  $akun->nama_akun  ?></option>
                                <?php endforeach; ?>
                            </select>
                            <input name="link[]" type="hidden" value="Akun Piutang">
                            <input name="jenis[]" type="hidden" value="Penjualan">
                        </div>
                        <div class="form-group">
                            <label>Persediaan</label>
                            <select name="id_akun[]" id="id_akun" class="form-control" style="margin-bottom: 20px;" required>
                                <option value="0" selected="selected">-- Pilih Akun --</option>
                                <?php foreach ($coa as $akun) : ?>
                                    <option value="<?= $akun->id_akun ?>">
                                        <?= "(" . $akun->kode_akun . "-" . $akun->no_akun . ")" . " - " .  $akun->nama_akun  ?></option>
                                <?php endforeach; ?>
                                <input name="link[]" type="hidden" value="Akun Persediaan (Jual)">
                                <input name="jenis[]" type="hidden" value="Penjualan">
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Harga Pokok Penjualan</label>
                            <select name="id_akun[]" id="id_akun" class="form-control" style="margin-bottom: 20px;" required>
                                <option value="0" selected="selected">-- Pilih Akun --</option>
                                <?php foreach ($coa as $akun) : ?>
                                    <option value="<?= $akun->id_akun ?>">
                                        <?= "(" . $akun->kode_akun . "-" . $akun->no_akun . ")" . " - " .  $akun->nama_akun  ?></option>
                                <?php endforeach; ?>
                            </select>
                            <input name="link[]" type="hidden" value="Akun HPP">
                            <input name="jenis[]" type="hidden" value="Penjualan">
                        </div>
                        <div class="form-group">
                            <label>Penjualan</label>
                            <select name="id_akun[]" id="id_akun" class="form-control" style="margin-bottom: 20px;" required>
                                <option value="0" selected="selected">-- Pilih Akun --</option>
                                <?php foreach ($coa as $akun) : ?>
                                    <option value="<?= $akun->id_akun ?>">
                                        <?= "(" . $akun->kode_akun . "-" . $akun->no_akun . ")" . " - " .  $akun->nama_akun  ?></option>
                                <?php endforeach; ?>
                            </select>
                            <input name="link[]" type="hidden" value="Akun Penjualan">
                            <input name="jenis[]" type="hidden" value="Penjualan">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Linked Account <small class="text-dark">Pembelian</small></h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group" id="akunPembayaran">
                            <label>Pembayaran</label>
                            <select name="id_akun[]" id="id_akun" class="form-control" style="margin-bottom: 20px;" required>
                                <option value="0" selected="selected">-- Pilih Akun --</option>
                                <?php foreach ($coa as $akun) : ?>
                                    <option value="<?= $akun->id_akun ?>">
                                        <?= "(" . $akun->kode_akun . "-" . $akun->no_akun . ")" . " - " .  $akun->nama_akun  ?></option>
                                <?php endforeach; ?>
                            </select>
                            <input name="link[]" type="hidden" value="Akun Pembayaran">
                            <input name="jenis[]" type="hidden" value="Pembelian">
                        </div>
                        <a class="btn font-weight-bold btn-tambah" id="tambah_pembayaran"><i class="fas fa-plus text-white"></i> Akun Pembayaran</a>
                        <div class="form-group">
                            <label>Utang</label>
                            <select name="id_akun[]" id="id_akun" class="form-control" style="margin-bottom: 20px;" required>
                                <option value="0" selected="selected">-- Pilih Akun --</option>
                                <?php foreach ($coa as $akun) : ?>
                                    <option value="<?= $akun->id_akun ?>">
                                        <?= "(" . $akun->kode_akun . "-" . $akun->no_akun . ")" . " - " .  $akun->nama_akun  ?></option>
                                <?php endforeach; ?>
                            </select>
                            <input name="link[]" type="hidden" value="Akun Utang">
                            <input name="jenis[]" type="hidden" value="Pembelian">
                        </div>
                        <div class="form-group">
                            <label>Persediaan</label>
                            <select name="id_akun[]" id="id_akun" class="form-control" style="margin-bottom: 20px;" required>
                                <option value="0" selected="selected">-- Pilih Akun --</option>
                                <?php foreach ($coa as $akun) : ?>
                                    <option value="<?= $akun->id_akun ?>">
                                        <?= "(" . $akun->kode_akun . "-" . $akun->no_akun . ")" . " - " .  $akun->nama_akun  ?></option>
                                <?php endforeach; ?>
                                <input name="link[]" type="hidden" value="Akun Persediaan (Beli)">
                                <input name="jenis[]" type="hidden" value="Pembelian">
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Linked Account <small class="text-dark">Ekuitas</small></h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group" id="akunModal">
                            <label>Laba</label>
                            <select name="id_akun[]" id="id_akun" class="form-control" style="margin-bottom: 20px;" required>
                                <option value="0" selected="selected">-- Pilih Akun -- </option>
                                <?php foreach ($coa as $akun) : ?>
                                    <option value="<?= $akun->id_akun ?>">
                                        <?= "(" . $akun->kode_akun . "-" . $akun->no_akun . ")" . " - " .  $akun->nama_akun  ?></option>
                                <?php endforeach; ?>
                            </select>
                            <input name="link[]" type="hidden" value="Akun Laba">
                            <input name="jenis[]" type="hidden" value="Ekuitas">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center">
            <button type="submit" name="tambah" class="btn btn-primary btn-fill mb-4 btn-submit">
                <i class="fas fa-save mr-1"></i> Simpan
            </button>
            <a href="<?php echo base_url('Admin/data_akun') ?>"> <button type="reset" class="btn btn-danger btn-info btn-fill pull-right mb-4 btn-undo"><i class="fas fa-undo-alt mr-1"></i> Ulang</button></a>
            <div class="clearfix"></div>
        </div>
    </form>
</div>

<script>
    // Tambah Akun Penerimaan
    $(document).ready(function() {
        var counter = 1;
        var counterNext = parseInt(counter) + 1;
        $("#tambah_penerimaan").on("click", function() {
            var html = '<div class="row baris">' + '<div class="col-md-11">' + '<select name = "id_akun[]" id = "id_akun" class = "form-control id_akun" style = "margin-bottom: 20px;" required >' +
                '<option value = "0" selected = "selected" > -- Pilih Akun -- </option>' +
                '<?php foreach ($coa as $akun) : ?>' +
                '<option value = "<?= $akun->id_akun ?>" >' +
                '<?= "(" . $akun->kode_akun . "-" . $akun->no_akun . ")" . " - " .  $akun->nama_akun  ?>' + '</option>' +
                '<?php endforeach; ?>' + '</select>' + '<input name="link[]" type="hidden" value="Akun Penerimaan">' + '<input name="jenis[]" type="hidden" value="Penjualan">' + '</div>' + '<div class="col-auto">' + '<div class="text-right">' + '<button type="button" id="hapus" class="btn btn-hapus font-weight-bold"><i class="fas fa-backspace text-white"></i> Hapus' + '</button>' + '</div>' + '</div>'
            $("#akunPenerimaan").append(html);
            counterNext++;
        });

        $("#akunPenerimaan").on("click", "#hapus", function() {
            $(this).closest('.baris').remove();
        });
    });

    $(document).ready(function() {
        var counter = 1;
        var counterNext = parseInt(counter) + 1;
        $("#tambah_pembayaran").on("click", function() {
            var html = '<div class="row baris">' + '<div class="col-md-11">' + '<select name = "id_akun[]" id = "id_akun" class = "form-control id_akun" style = "margin-bottom: 20px;" required >' +
                '<option value = "0" selected = "selected" > -- Pilih Akun -- </option>' +
                '<?php foreach ($coa as $akun) : ?>' +
                '<option value = "<?= $akun->id_akun ?>" >' +
                '<?= "(" . $akun->kode_akun . "-" . $akun->no_akun . ")" . " - " .  $akun->nama_akun  ?>' + '</option>' +
                '<?php endforeach; ?>' + '</select>' + '<input name="link[]" type="hidden" value="Akun Pembayaran">' + '<input name="jenis[]" type="hidden" value="Pembelian">' + '</div>' + '<div class="col-auto">' + '<div class="text-right">' + '<button type="button" id="hapus" class="btn btn-hapus font-weight-bold"><i class="fas fa-backspace text-white"></i> Hapus' + '</button>' + '</div>' + '</div>'
            $("#akunPembayaran").append(html);
            counterNext++;
        });

        $("#akunPembayaran").on("click", "#hapus", function() {
            $(this).closest('.baris').remove();
        });
    });
</script>

<!-- <div class="content">
    <div class="animated fadeIn">
        <div class="row justify-content-center">
            <div class="col-lg-11">
            <p class="title_halaman text-dark"><i class="fas fa-link"></i> Link Account</p>
            <hr>
                <?php $this->view('flashdata') ?>
                <form action="<?php echo base_url('Pengaturan/Link_acc/addLinkAcc') ?>" method="post">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Linked Account Penjualan</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Penerimaan</label>
                                            <select name="id_akun[]" id="id_akun" class="form-control" style="margin-bottom: 20px;" required>
                                                <option value="0" selected="selected">Pilih..</option>
                                                <?php foreach ($coa as $akun) : ?>
                                                    <option value="<?= $akun->id_akun ?>">
                                                        <?= "(" . $akun->kode_akun . "-" . $akun->no_akun . ")" . " - " .  $akun->nama_akun  ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <input name="link[]" type="hidden" value="Akun Penerimaan">
                                            <input name="jenis[]" type="hidden" value="Penjualan">
                                        </div>
                                        <div class="form-group">
                                            <label>Piutang</label>
                                            <select name="id_akun[]" id="id_akun" class="form-control" style="margin-bottom: 20px;" required>
                                                <option value="0" selected="selected">Pilih..</option>
                                                <?php foreach ($coa as $akun) : ?>
                                                    <option value="<?= $akun->id_akun ?>">
                                                        <?= "(" . $akun->kode_akun . "-" . $akun->no_akun . ")" . " - " .  $akun->nama_akun  ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <input name="link[]" type="hidden" value="Akun Piutang">
                                            <input name="jenis[]" type="hidden" value="Penjualan">
                                        </div>
                                        <div class="form-group">
                                            <label>Persediaan</label>
                                            <select name="id_akun[]" id="id_akun" class="form-control" style="margin-bottom: 20px;" required>
                                                <option value="0" selected="selected">Pilih..</option>
                                                <?php foreach ($coa as $akun) : ?>
                                                    <option value="<?= $akun->id_akun ?>">
                                                        <?= "(" . $akun->kode_akun . "-" . $akun->no_akun . ")" . " - " .  $akun->nama_akun  ?></option>
                                                <?php endforeach; ?>
                                                <input name="link[]" type="hidden" value="Akun Persediaan (Jual)">
                                                <input name="jenis[]" type="hidden" value="Penjualan">
                                            </select>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Linked Account Pembelian</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Pembayaran</label>
                                            <select name="id_akun[]" id="id_akun" class="form-control" style="margin-bottom: 20px;" required>
                                                <option value="0" selected="selected">Pilih..</option>
                                                <?php foreach ($coa as $akun) : ?>
                                                    <option value="<?= $akun->id_akun ?>">
                                                        <?= "(" . $akun->kode_akun . "-" . $akun->no_akun . ")" . " - " .  $akun->nama_akun  ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <input name="link[]" type="hidden" value="Akun Pembayaran">
                                            <input name="jenis[]" type="hidden" value="Pembelian">
                                        </div>
                                        <div class="form-group">
                                            <label>Utang</label>
                                            <select name="id_akun[]" id="id_akun" class="form-control" style="margin-bottom: 20px;" required>
                                                <option value="0" selected="selected">Pilih..</option>
                                                <?php foreach ($coa as $akun) : ?>
                                                    <option value="<?= $akun->id_akun ?>">
                                                        <?= "(" . $akun->kode_akun . "-" . $akun->no_akun . ")" . " - " .  $akun->nama_akun  ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <input name="link[]" type="hidden" value="Akun Utang">
                                            <input name="jenis[]" type="hidden" value="Pembelian">
                                        </div>
                                        <div class="form-group">
                                            <label>Persediaan</label>
                                            <select name="id_akun[]" id="id_akun" class="form-control" style="margin-bottom: 20px;" required>
                                                <option value="0" selected="selected">Pilih..</option>
                                                <?php foreach ($coa as $akun) : ?>
                                                    <option value="<?= $akun->id_akun ?>">
                                                        <?= "(" . $akun->kode_akun . "-" . $akun->no_akun . ")" . " - " .  $akun->nama_akun  ?></option>
                                                <?php endforeach; ?>
                                                <input name="link[]" type="hidden" value="Akun Persediaan (Beli)">
                                                <input name="jenis[]" type="hidden" value="Pembelian">
                                            </select>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" name="tambah" class="btn btn-primary btn-info btn-fill mb-4">
                        Simpan
                    </button>
                    <a href="<?php echo base_url('Admin/data_akun') ?>"> <button type="reset" class="btn btn-danger btn-info btn-fill pull-right mb-4">Reset</button></a>
                    <div class="clearfix"></div>
                </div>
            </div>
        </form>
    </div>
</div> -->