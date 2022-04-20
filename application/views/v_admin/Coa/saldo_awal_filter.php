<div class="container-fluid">
    <p class="title_halaman text-dark"><i class="fas fa-history"></i> Riwayat Saldo Awal Akun</p>
    <hr>
    <div class="card">
        <div class="card-header">
            <h6 class="text-primary font-weight-bold">Periode Saldo Awal</h6>
        </div>
        <div class="card-body">
            <form method="post" action="<?php echo base_url('Laporan/Riwayat_saldo/prosesFilter') ?>">
                <div class="form-row">
                    <div class="form-group col-lg-6">
                        <label for="tanggal1">Tanggal <span class="text-danger">*</span></label>
                        <input class="form-control" name="tanggal1" type="date">
                        <?php echo form_error("tanggal1") ?>
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="tanggal2">Tanggal <span class="text-danger">*</span></label>
                        <input class="form-control" name="tanggal2" type="date">
                        <?php echo form_error("tanggal2") ?>
                    </div>
                </div>
                <div class="text-center">
                    <label class="text-white" for="">aa</label>
                    <button type="submit" class="btn btn-primary font-weight-bold" style="width:100%;"><i class="fas fa-search"></i> Tampilkan</button>
                </div>
            </form>
        </div>
    </div>
    <?php $this->view('flashdata') ?>
</div>