<div class="container-fluid">
    <p class="title_halaman text-dark"><i class="fas fa-link"></i> Tambah Link Account</p>
    <hr>

    <div class='text-right btnBack'>
        <a class="btn btn-sm btn-warning" href="<?php echo base_url('Pengaturan/Link_acc/updateLink'); ?>"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <!-- Button Kembali -->
            <div class="card">
                <div class="card-header">
                    <h6 class="text-primary font-weight-bold">Form Tambah Link Account</h6>
                </div>
                <div class="card-body">
                    <form method="post" name="" action="<?php echo base_url('Pengaturan/Link_acc/prosesTambahLinkAcc') ?>">
                        <div class="form-group">
                            <label for="">Account <span class="text-danger">*</span></label>
                            <select class="form-control" name="id_akun" id="id_akun">
                                <option value="" selected disabled>-- Pilih Account --</option>
                                <?php foreach ($coa as $akun) : ?>
                                    <option value="<?= $akun->id_akun ?>">
                                        <?= "(" . $akun->kode_akun . "-" . $akun->no_akun . ")" . " - " .  $akun->nama_akun  ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <?php echo form_error('id_akun') ?>
                        </div>
                        <div class="form-group">
                            <label for="">Keterangan Link Account</label>
                            <select class="form-control" name="keterangan" id="">
                                <option value="" disabled selected>-- Pilih Keterangan --</option>
                                <option value="Akun Penerimaan">Akun Penerimaan</option>
                                <option value="Akun Pembayaran">Akun Pembayaran</option>
                            </select>
                            <?php echo form_error('keterangan') ?>
                        </div>
                        <div class="form-group">
                            <label for="">Jenis Link Account</label>
                            <select class="form-control" name="jenis" id="">
                                <option value="" disabled selected>-- Pilih Keterangan --</option>
                                <option value="Penjualan">Penjualan</option>
                                <option value="Pembelian">Pembelian</option>
                            </select>
                            <?php echo form_error('jenis') ?>
                        </div>
                        <p class="text-danger reminder"><span>*</span> : Wajib Diisi</p>
                        <div class="text-center">
                            <button type="submit" class="btn btn-sm btn-primary btn-submit"><i class="fas fa-save mr-1"></i> Simpan</button>
                            <button type="reset" class="btn btn-sm btn-danger btn-undo"><i class="fas fa-undo-alt mr-1"></i> Ulang</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>