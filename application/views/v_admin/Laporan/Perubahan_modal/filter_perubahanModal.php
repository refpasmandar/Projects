<!-- Begin Page Content -->
<div class="container-fluid">
    <p class="title_halaman"><i class="fas fa-chart-line"></i> Perubahan Modal</p>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Perubahan Modal</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <form method="post" action="<?php echo base_url('Laporan/Perubahan_modal/prosesFilterPerubahanModal') ?>">
                        <div class="form-row">
                            <div class="form-group col-lg-6">
                                <label for="tanggal1">Tanggal <span class="text-danger">*</span></label>
                                <input class="form-control" name="tanggal1modal" type="date">
                                <?php echo form_error('tanggal1modal') ?>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="tanggal2">Tanggal <span class="text-danger">*</span></label>
                                <input class="form-control" name="tanggal2modal" type="date">
                                <?php echo form_error('tanggal2modal') ?>
                            </div>
                        </div>
                        <div class="text-center">
                            <label class="text-white" for="">aa</label>
                            <button type="submit" class="btn btn-primary font-weight-bold" style="width:100%;"> <i class="fas fa-search"></i> Tampilkan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>