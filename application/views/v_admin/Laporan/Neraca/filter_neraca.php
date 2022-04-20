<!-- Begin Page Content -->
<div class="container-fluid">
    <p class="title_halaman"><i class="fas fa-balance-scale"></i> Neraca Keuangan</p>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Periode Neraca</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <form method="post" action="<?php echo base_url('Laporan/Neraca/prosesFilterNeraca') ?>">
                        <div class="form-group">
                            <?php foreach ($setting as $c) { ?>
                                <input class="form-control" name="tanggal1neraca" type="hidden" value="<?php echo $c->tanggal_pembukuan ?>">
                            <?php } ?>
                            <?php echo form_error('tanggal1neraca') ?>
                        </div>
                        <div class="form-group">
                            <label for="tanggal2">Tanggal <span class="text-danger">*</span></label>
                            <input class="form-control" name="tanggal2neraca" type="date">
                            <?php echo form_error('tanggal2neraca') ?>
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